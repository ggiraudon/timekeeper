<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Event\Event;
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

class PaypalController extends AppController
{
	public function initialize()
        {
                parent::initialize();
		$this->loadModel('PaypalLogs');
                $this->Auth->allow(['webhook','createPlan','activatePlan','createBillingAgreement','ExecuteAgreement']);
        }

	public function webhook($company_id=null) {
		$this->autoRender = false;

		if($company_id==null)
			throw new BadRequestException('Company ID required', 405); // 405 Method Not Allowed

		// Paypal sends webhooks as POST only
		if ($this->request->is('post')) {
			$company=$this->PaypalLogs->Companies->get($company_id);
			$event = $this->request->input('json_decode');


			$log=$this->PaypalLogs->newEntity();
			$log->company_id=$company_id;
			$log->date_time=date("Y-m-d H:i:s");
			$log->event_type=$event->event_type;
			$log->content=json_encode($event);
			$this->PaypalLogs->save($log);


			switch ($event->event_type) {								

				case "BILLING.PLAN.CREATED": //A billing plan is created.
					break;
				case "BILLING.PLAN.UPDATED": //A billing plan is updated.
					break;
				case "BILLING.SUBSCRIPTION.CANCELLED": //A billing subscription is cancelled.
					break;
				case "BILLING.SUBSCRIPTION.CREATED": //A billing subscription is created.
					break;
				case "BILLING.SUBSCRIPTION.RE-ACTIVATED": //A billing subscription is re-activated.
					break;
				case "BILLING.SUBSCRIPTION.SUSPENDED": //A billing subscription is suspended.
					break;
				case "BILLING.SUBSCRIPTION.UPDATED": //A billing subscription is updated.
					break;
				case "CUSTOMER.DISPUTE.CREATED": //A customer dispute is created.
					break;
				case "CUSTOMER.DISPUTE.CREATED": //
					break;
				case "CUSTOMER.DISPUTE.RESOLVED": //A customer dispute is resolved.
					break;
				case "IDENTITY.AUTHORIZATION-CONSENT.REVOKED": //A user's consent token is revoked.
					break;
				case "INVOICING.INVOICE.CANCELLED": //An invoice is cancelled.
					break;
				case "INVOICING.INVOICE.PAID": //An invoice is paid.
					break;
				case "INVOICING.INVOICE.REFUNDED": //An invoice is refunded.
					break;
				case "INVOICING.INVOICE.UPDATED": //An invoice is updated.
					break;
				case "PAYMENT.AUTHORIZATION.CREATED": //A payment authorization is created, approved, executed, or a future payment authorization is created.
					break;
				case "PAYMENT.AUTHORIZATION.VOIDED": //A payment authorization is voided.
					break;
				case "PAYMENT.CAPTURE.COMPLETED": //A payment capture is completed.
					break;
				case "PAYMENT.CAPTURE.DENIED": //A payment capture is denied.
					break;
				case "PAYMENT.CAPTURE.PENDING": //The state of a payment capture changes to pending.
					break;
				case "PAYMENT.CAPTURE.REFUNDED": //Merchant refunds a payment capture.
					break;
				case "PAYMENT.CAPTURE.REVERSED": //PayPal reverses a payment capture.
					break;
				case "PAYMENT.ORDER.CANCELLED": //A payment order is cancelled.
					break;
				case "PAYMENT.ORDER.CREATED": //A payment order is created.
					break;
				case "PAYMENT.PAYOUTSBATCH.DENIED": //A batch payout payment is denied.
					break;
				case "PAYMENT.PAYOUTSBATCH.PROCESSING": //The state of a batch payout payment changes to processing.
					break;
				case "PAYMENT.PAYOUTSBATCH.SUCCESS": //A batch payout payment successfully completes processing.
					break;
				case "PAYMENT.PAYOUTS-ITEM.BLOCKED": //A payouts item was blocked.
					break;
				case "PAYMENT.PAYOUTS-ITEM.CANCELED": //A payouts item was canceled.
					break;
				case "PAYMENT.PAYOUTS-ITEM.DENIED": //A payouts item was denied.
					break;
				case "PAYMENT.PAYOUTS-ITEM.FAILED": //A payouts item has failed.
					break;
				case "PAYMENT.PAYOUTS-ITEM.HELD": //A payouts item is held.
					break;
				case "PAYMENT.PAYOUTS-ITEM.REFUNDED": //A payouts item was refunded.
					break;
				case "PAYMENT.PAYOUTS-ITEM.RETURNED": //A payouts item is returned.
					break;
				case "PAYMENT.PAYOUTS-ITEM.SUCCEEDED": //A payouts item has succeeded.
					break;
				case "PAYMENT.PAYOUTS-ITEM.UNCLAIMED": //A payouts item is unclaimed.
					break;
				case "PAYMENT.SALE.COMPLETED": //A sale is completed.
					break;
				case "PAYMENT.SALE.DENIED": //The state of a sale changes from pending to denied.
					break;
				case "PAYMENT.SALE.PENDING": //The state of a sale changes to pending.
					break;
				case "PAYMENT.SALE.REFUNDED": //Merchant refunds the sale.
					break;
				case "PAYMENT.SALE.REVERSED": //PayPal reverses a sale.
					break;
				case "PAYOUTSBATCH": //
					break;
				case "RISK.DISPUTE.CREATED": //A risk dispute is created.
					break;
				case "RISK.DISPUTE.CREATED": //
					break;
				case "VAULT.CREDIT-CARD.CREATED": //A credit card was created.
					break;
				case "VAULT.CREDIT-CARD.DELETED": //A credit card was deleted.
					break;
				case "VAULT.CREDIT-CARD.UPDATED": //A credit card was updated.
					break;


				default:


			}

			return $this->response->statusCode(200);
		}

			throw new BadRequestException('Company ID required', 405); // 405 Method Not Allowed
	}


/*
	public function createWebExperienceProfile($company_id=null) {
		$flowConfig = new \PayPal\Api\FlowConfig();
		$flowConfig->setLandingPageType("Billing");
		$flowConfig->setBankTxnPendingUrl("http://manage.prism19.com/");
		$flowConfig->setUserAction("commit");
		$flowConfig->setReturnUriHttpMethod("GET");
		$presentation = new \PayPal\Api\Presentation();
		$presentation->setLogoImage("http://www.yeowza.com/favico.ico")
			->setBrandName("YeowZa! Paypal")
			->setLocaleCode("US")
			->setReturnUrlLabel("Return")
			->setNoteToSellerLabel("Thanks!");
		$inputFields = new \PayPal\Api\InputFields();
		$inputFields->setAllowNote(true)
			->setNoShipping(1)
			->setAddressOverride(0);
		$webProfile = new \PayPal\Api\WebProfile();
		$webProfile->setName("YeowZa! T-Shirt Shop" . uniqid())
			->setFlowConfig($flowConfig)
			->setPresentation($presentation)
			->setInputFields($inputFields)
			->setTemporary(true);
		$request = clone $webProfile;
		try {
			$createProfileResponse = $webProfile->create($apiContext);
		} catch (\PayPal\Exception\PayPalConnectionException $ex) {
			die("Created Web Profile", "Web Profile", null, $request, $ex);
			exit(1);
		}
		echo("Created Web Profile", "Web Profile", $createProfileResponse->getId(), $request, $createProfileResponse);
		return $createProfileResponse;

	}
*/


	private function _getContext($company_id)
	{

		$this->apiContext = new \PayPal\Rest\ApiContext(
			new \PayPal\Auth\OAuthTokenCredential(
			    'AaOMQs37u3Iv-7IpXTWQvdmoeAF5RImG3gGZG6tubK6wI8eXPgwjxVP_F23VAGacfQCiXfigimoVIxVv',     // ClientID
			    'EK0eSrOAQLbDeyFWa9qreeybouTZRRtNwZ-fjighs2FQY5daeZpal8wrQc0Sluzx713ZPXN7cMpB8C5S'      // ClientSecret
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


	public function ExecuteAgreement()
	{

		$this->_getContext($company_id);
		if (isset($_GET['success']) && $_GET['success'] == 'true') {
			$token = $_GET['token'];
			$agreement = new \PayPal\Api\Agreement();
			try {
				// ## Execute Agreement
				// Execute the agreement by passing in the token
				$agreement->execute($token, $this->apiContext);
			} catch (Exception $ex) {
				die("ouch");
				exit(1);
			}
			echo("Executed an Agreement");
			

			try {
				$agreement = \PayPal\Api\Agreement::get($agreement->getId(), $this->apiContext);
			} catch (Exception $ex) {
				die("ouch");
				exit(1);
			}
			print_r($agreement);
		} else {
			echo("User Cancelled the Agreement");
		}
		die();
	}


	public function createBillingAgreement($company_id)
	{


		$this->_getContext($company_id);
		$agreement = new Agreement();
		$agreement->setName('Base Agreement')
			->setDescription('Basic Agreement')
			->setStartDate(date("c",time()+24*3600));



		$plan = new Plan();
		$plan->setId("P-9HX27235YK693135TO5HVTCY");
		$agreement->setPlan($plan);
		// Add Payer
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		$agreement->setPayer($payer);
		// For Sample Purposes Only.
		$request = clone $agreement;
		// ### Create Agreement
		try {
			// Please note that as the agreement has not yet activated, we wont be receiving the ID just yet.
			$agreement = $agreement->create($this->apiContext);
			// ### Get redirect url
			// The API response provides the url that you must redirect
			// the buyer to. Retrieve the url from the $agreement->getApprovalLink()
			// method
			$approvalUrl = $agreement->getApprovalLink();
		} catch (Exception $ex) {
			// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
			die("ouch");
			exit(1);
		}


		print_r($agreement);
		print_r($approvalUrl);

		die();

	}


	public function activatePlan($company_id=null)
	{

		$this->_getContext($company_id);


		try {
			$plan = Plan::get("P-9HX27235YK693135TO5HVTCY", $this->apiContext);
		} catch (Exception $ex) {
			die("ouch");
			exit(1);
		}

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
		print_r($plan);
		return $plan;

	}

	public function createPlan($company_id=null)
	{

		$this->_getContext($company_id);
		$this->autoRender = false;
			$plan = new Plan();
		$plan->setName('Subscription Plan')
			->setDescription('Template creation.')
			->setType('infinite');
		
		$paymentDefinition = new PaymentDefinition();
		$paymentDefinition->setName('Regular Payments')
			->setType('REGULAR')
			->setFrequency('Month')
			->setFrequencyInterval("2")
			->setCycles("0")
			->setAmount(new Currency(array('value' => 100, 'currency' => 'USD')));
		/*
		$chargeModel = new ChargeModel();
		$chargeModel->setType('SHIPPING')
			->setAmount(new Currency(array('value' => 10, 'currency' => 'USD')));
		$paymentDefinition->setChargeModels(array($chargeModel));
		*/

		$merchantPreferences = new MerchantPreferences();
		$baseUrl = "https://timekeeper.prism19.com/api/paypal";

		// ReturnURL and CancelURL are not required and used when creating billing agreement with payment_method as "credit_card".
		// However, it is generally a good idea to set these values, in case you plan to create billing agreements which accepts "paypal" as payment_method.
		// This will keep your plan compatible with both the possible scenarios on how it is being used in agreement.



		$merchantPreferences->setReturnUrl("$baseUrl/ExecuteAgreement?success=true")
			->setCancelUrl("$baseUrl/ExecuteAgreement?success=false")
			->setAutoBillAmount("yes")
			->setInitialFailAmountAction("CONTINUE")
			->setMaxFailAttempts("0");

		$plan->setPaymentDefinitions(array($paymentDefinition));
		$plan->setMerchantPreferences($merchantPreferences);
		// For Sample Purposes Only.
		$request = clone $plan;
		// ### Create Plan
		try {
			$output = $plan->create($this->apiContext);
		} catch (Exception $ex) {
			// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
			die(print_r($ex,true));
			exit(1);
		}
		// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
		print_r($output);
		return $output;

	}

}
