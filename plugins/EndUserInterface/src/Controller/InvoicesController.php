<?php
namespace EndUserInterface\Controller;

use EndUserInterface\Controller\AppController;
use Cake\Routing\Router;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\ShippingAddress;
use PayPal\Api\RedirectUrls;
use Stripe\Stripe;
use Stripe\Plan as StripePlan;
use Stripe\Customer;

/**
 * Invoices Controller
 *
 * @property \EndUserInterface\Model\Table\InvoicesTable $Invoices
 */
class InvoicesController extends AppController
{

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Clients','Activities' => ['Projects']]
        ]);
	$company = $this->Auth->user('company');
	
        $this->set('company', $company);
        $this->set('invoice', $invoice);
        $this->set('_serialize', ['invoice']);
    }
    public function printview($id = null)
    {
	$this->view($id);
    }



	public function paypalPay($id = null)
	{

		$invoice = $this->Invoices->get($id, [
				'contain' => ['Clients' => ['Companies']]
				]);




		$this->_getPaypalContext($invoice->client->company);

		$payer = new Payer();
		$payer->setPaymentMethod("paypal");


		$amount = new Amount();
		$amount->setCurrency($invoice->client->currency)
			->setTotal($invoice->total);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setDescription("Payment for invoice ".$invoice->label)
			->setInvoiceNumber(uniqid());

			
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl(Router::url(['plugin'=>'EndUserInterface','controller'=>'Invoices','action'=>'paypalExecutePayment'],true)."?invoice_id=".$invoice->id."&success=true")
			->setCancelUrl(Router::url(['plugin'=>'EndUserInterface','controller'=>'Invoices','action'=>'paypalExecutePayment'],true)."?invoice_id=".$invoice->id."&success=false");


		$payment = new Payment();
		$payment->setIntent("sale")
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions(array($transaction));
		try {
			$payment->create($this->apiContext);
		} catch (Exception $ex) {
			die(print_r($ex,true));
			exit(1);
		}

		$approvalURL = $payment->getApprovalLink();
		$this->redirect($approvalURL);
	}


	public function stripePay($id = null)
	{


		$invoice = $this->Invoices->get($id, [
				'contain' => ['Clients' => ['Companies']]
				]);

		$this->_getStripeContext($invoice->client->company);

		try
		{

			$stripe_charge = \Stripe\Charge::create(array(
			  "amount" => $invoice->total*100,
			  "currency" => strtolower($invoice->client->currency),
			  "source"  => $_POST['stripeToken'],
			  "description" => "Payment for invoice ".$invoice->label
			));

			$invoice->stripe_charge_id=$stripe_charge->id;
			$invoice->status="PAID";
			$invoice->payment_type="STRIPE";
			$this->Invoices->save($invoice);
			$this->redirect(['controller' => 'clients', 'action' => 'index']);
		}
		catch(Exception $e)
		{
			die("unable to charge customer:" . $_POST['stripeEmail'].
					", error:" . $e->getMessage());
		}
		$this->redirect(['controller' => 'clients', 'action' => 'index']);

	}



	public function paypalExecutePayment()
	{
		if (isset($_GET['invoice_id'])) {
			$id=$_GET['invoice_id'];

			$invoice = $this->Invoices->get($id, [
				'contain' => ['Clients' => ['Companies']]
				]);




			$this->_getPaypalContext($invoice->client->company);


			if (isset($_GET['success']) && $_GET['success'] == 'true') {


				$paymentId = $_GET['paymentId'];
				$payment = Payment::get($paymentId, $this->apiContext);
				$execution = new PaymentExecution();
				$execution->setPayerId($_GET['PayerID']);

/*

				// ### Optional Changes to Amount
				// If you wish to update the amount that you wish to charge the customer,
				// based on the shipping address or any other reason, you could
				// do that by passing the transaction object with just `amount` field in it.
				// Here is the example on how we changed the shipping to $1 more than before.
				$transaction = new Transaction();
				$amount = new Amount();
				$details = new Details();
				$details->setShipping(2.2)
					->setTax(1.3)
					->setSubtotal(17.50);
				$amount->setCurrency('USD');
				$amount->setTotal(21);
				$amount->setDetails($details);
				$transaction->setAmount($amount);
				// Add the above transaction object inside our Execution object.
				$execution->addTransaction($transaction);

*/
				try {
					$result = $payment->execute($execution, $this->apiContext);

					try {
						$payment = Payment::get($paymentId, $this->apiContext);

					} catch (Exception $ex) {
						die(print_r($ex,true));
						exit(1);
					}
				} catch (Exception $ex) {
					die(print_r($ex,true));
					exit(1);
				}
				$invoice->paypal_payment_id=$payment->getId();
				$invoice->status="PAID";
				$invoice->payment_type="PAYPAL";
				$this->Invoices->save($invoice);
				$this->redirect(['controller' => 'clients', 'action' => 'index']);


			} else {
				die(print_r($ex,true));
				exit;
			}


		}else{
			die('Invalid API Call');
		}
	}





}
