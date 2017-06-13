<?php
namespace EndUserInterface\Controller;

use EndUserInterface\Controller\AppController;
use Cake\Routing\Router;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\ShippingAddress;
use Stripe\Stripe;
use Stripe\Plan as StripePlan;
use Stripe\Customer;

/**
 * Subscriptions Controller
 *
 * @property \App\Model\Table\SubscriptionsTable $Subscriptions
 *
 * @method \App\Model\Entity\Subscription[] paginate($object = null, array $settings = [])
 */
class SubscriptionsController extends AppController
{


	private function _getPaypalContext($company)
	{

		$this->apiContext = new \PayPal\Rest\ApiContext(
				new \PayPal\Auth\OAuthTokenCredential(
					$company->paypal_client_id,
					$company->paypal_secret
					)
				);

		$this->apiContext->setConfig(
				array(
					'log.LogEnabled' => true,
					'log.FileName' => '/tmp/PayPal.log',
					'log.LogLevel' => 'DEBUG'
				     )
				);



	}

	private function _getStripeContext($company)
	{
		Stripe::setApiKey($company->stripe_secret);
	}

	public function view($id = null)
	{
		$subscription = $this->Subscriptions->get($id, [
				'contain' => ['Companies', 'Clients']
				]);

		$this->set('subscription', $subscription);
		$this->set('_serialize', ['subscription']);
	}

	private function stripeCreatePlan($subscription)
	{


		if(!empty($subscription->stripe_plan_id))
		{

			$plan = StripePlan::retrieve($subscription->stripe_plan_id);
			return $plan;

		}else{

			try {
				$plan = StripePlan::create([
					  "amount" => $subscription->amount*100,
					  "interval" => $subscription->interval,
					  "interval_count" => $subscription->interval_count,
					  "name" => $subscription->name,
					  "currency" => strtolower($subscription->currency),
					  "id" => $subscription->id
				]);
			
			} catch (Exception $ex) {
				die(print_r($ex,true));
				exit(1);
			}
			$subscription->stripe_plan_id=$plan->id;
			$this->Subscriptions->save($subscription);

			return $plan;
		}

	}


	public function paypalActivate($id = null)
	{
		$subscription = $this->Subscriptions->get($id, [
				'contain' => ['Companies', 'Clients']
				]);

		$this->_getPaypalContext($subscription->company);
		$paypal_plan=$this->paypalCreatePlan($subscription);
		if($paypal_plan->getState()!="ACTIVE")
			$paypal_plan=$this->paypalActivatePlan($paypal_plan);
		$approvalURL=$this->createBillingAgreement($subscription,$paypal_plan);

		$this->redirect($approvalURL);
	}

	public function stripeActivate($id = null)
	{


		$subscription = $this->Subscriptions->get($id, [
				'contain' => ['Companies', 'Clients']
				]);


		$this->_getStripeContext($subscription->company);
		$stripe_plan=$this->stripeCreatePlan($subscription);

		try
		{
			$customer = Customer::create(array(
						'email' => $_POST['stripeEmail'],
						'source'  => $_POST['stripeToken'],
						));

			$stripe_subscription=\Stripe\Subscription::create(array(
						"customer" => $customer->id,
						"plan" => $stripe_plan->id
						));

			$subscription->stripe_subscription_id=$stripe_subscription->id;
			$subscription->status="ACTIVE";
			$subscription->payment_type="STRIPE";
			$this->Subscriptions->save($subscription);
			$this->redirect("/clients/");
		}
		catch(Exception $e)
		{
			die("unable to sign up customer:" . $_POST['stripeEmail'].
					", error:" . $e->getMessage());
		}
		$this->redirect("/clients/");

	}


	private function createBillingAgreement($subscription,$paypal_plan)
	{


		$agreement = new Agreement();
		$agreement->setName($subscription->name)
			->setDescription("$".$subscription->amount."(".$subscription->currency.") every ".$subscription->interval_count." ".$subscription->interval)
			->setStartDate(date("c",time()+24*3600));
		
		$plan = new Plan();
		$plan->setId($paypal_plan->getId());
		$agreement->setPlan($plan);
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		$agreement->setPayer($payer);
		try {
			$agreement = $agreement->create($this->apiContext);
			$approvalUrl = $agreement->getApprovalLink();
		} catch (Exception $ex) {
			die("ouch");
			exit(1);
		}
		return $approvalUrl;

	}


	private function paypalActivatePlan($plan)
	{


		try{
			$patch = new Patch();
			$value = new PayPalModel('{
					"state":"ACTIVE"
					}');
			$patch->setOp('replace')
				->setPath('/')
				->setValue($value);
			$patchRequest = new PatchRequest();
			$patchRequest->addPatch($patch);
			$plan->update($patchRequest, $this->apiContext);
			$plan = Plan::get($plan->getId(), $this->apiContext);
		} catch (Exception $ex) {
			die("ouch");
			exit(1);
		}
		return $plan;

	}


	private function paypalCreatePlan($subscription)
	{


		if(!empty($subscription->paypal_plan_id))
		{

			$plan = Plan::get($subscription->paypal_plan_id, $this->apiContext);
			return $plan;

		}else{

			$plan = new Plan();
			$plan->setName($subscription->id)
				->setDescription($subscription->name)
				->setType('infinite');

			$paymentDefinition = new PaymentDefinition();
			$paymentDefinition->setName('Regular Payments')
				->setType('REGULAR')
				->setFrequency(ucfirst($subscription->interval))
				->setFrequencyInterval("".$subscription->interval_count)
				->setCycles("0")
				->setAmount(new Currency(array('value' => $subscription->amount, 'currency' => $subscription->currency)));

			$merchantPreferences = new MerchantPreferences();

			$baseUrl = Router::url('/', true);
			$merchantPreferences->setReturnUrl($baseUrl."Subscriptions/paypalExecuteAgreement?subscription_id=".$subscription->id."&success=true")
				->setCancelUrl($baseUrl."Subscriptions/paypalExecuteAgreement?subscription_id=".$subscription->id."&success=false")
				->setAutoBillAmount("yes")
				->setInitialFailAmountAction("CONTINUE")
				->setMaxFailAttempts("0");

			$plan->setPaymentDefinitions(array($paymentDefinition));
			$plan->setMerchantPreferences($merchantPreferences);
			
			try {
				$output = $plan->create($this->apiContext);
			} catch (Exception $ex) {
				die(print_r($ex,true));
				exit(1);
			}

			$subscription->paypal_plan_id=$output->getId();
			$this->Subscriptions->save($subscription);

			return $output;
		}

	}



	public function paypalExecuteAgreement()
	{
		if (isset($_GET['subscription_id'])) {
			$id=$_GET['subscription_id'];
			$subscription = $this->Subscriptions->get($id, [
					'contain' => ['Companies', 'Clients']
					]);

			$this->_getPaypalContext($subscription->company);

			if (isset($_GET['success']) && $_GET['success'] == 'true') {
				$token = $_GET['token'];
				$agreement = new \PayPal\Api\Agreement();
				try {
					$agreement->execute($token, $this->apiContext);
				} catch (Exception $ex) {
					die("ouch");
					exit(1);
				}

				try {
					$agreement = \PayPal\Api\Agreement::get($agreement->getId(), $this->apiContext);
				} catch (Exception $ex) {
					die("ouch");
					exit(1);
				}

				$subscription->paypal_agreement_id=$agreement->getId();
				$subscription->status="ACTIVE";
				$subscription->payment_type="PAYPAL";

				$this->Subscriptions->save($subscription);

			} else {
				$this->redirect("/clients/");
			}
		}else{
			die('Invalid API Call');
		}
	}






}
