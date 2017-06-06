<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Event\Event;

class StripeController extends AppController
{
	public function initialize()
        {
                parent::initialize();
		//$this->loadModel('StripeLogs', 'Companies');
		$this->loadModel('StripeLogs');
                $this->Auth->allow(['webhook']);
        }

	public function webhook($company_id=null) {
		$this->autoRender = false;

		if($company_id==null)
			throw new BadRequestException('Company ID required', 405); // 405 Method Not Allowed

		// Stripe sends webhooks as POST only
		if ($this->request->is('post')) {
			$company=$this->StripeLogs->Companies->get($company_id);
			if ($company) {
			\Stripe\Stripe::setApiKey($company->stripe_secret);


			// If using my CakePHP Stripe plugin, these are set in Config/bootstrap.php
			// $mode = Configure::read('Stripe.mode');
			// $key = Configure::read('Stripe.' . $mode . 'Secret');
			// If not using the plugin, set $key to your secret API key

			// This receives the request and runs json_decode, turning the JSON request into a PHP
			// object.
			$event_json = $this->request->input('json_decode');

			$this->log(print_r($event_json,true),'debug');
			// Retrieve the event based on the event id, throw an exception and log what happened if the
			// event wasn't found or couldn't be retrieved. 
			try {
				$event = \Stripe\Event::retrieve($event_json->id);
			} catch (Exception $e) {
				CakeLog::write('hook', 'No event found for: ' . $event_json->id);
				// We still return a HTTP 200 because the webhook was successfully recieved, even if the
				// event was invalid.
				$this->response->statusCode(200);
				return $this->response;
			}


			$log=$this->StripeLogs->newEntity();
			$log->company_id=$company_id;
			$log->date_time=date("Y-m-d H:i:s");
			$log->event_type=$event->type;
			$log->content=json_encode($event);
			$this->StripeLogs->save($log);


			switch ($event->type) {									// depending on the event fired by Stripe, do something different. 
				case "account.updated":
					// do something
					break;
				case "balance.available":
					// do something
					break;
				case "charge.captured":
					// do something
					break;
				case "charge.refunded":
					// do something
					break;
				case "charge.succeeded":
					// do something
					break;
				case "charge.updated":
					// do something
					break;
				case "charge.failed":
					// do something
					break;
				case "charge.dispute.created":
					// do something
					break;
				case "charge.dispute.updated":
					// do something
					break;
				case "charge.dispute.closed":
					// do something
					break;
				case "coupon.created":
					// do something
					break;
				case "coupon.deleted":
					// do something
					break;
				case "customer.created":
					// do something
					break;
				case "customer.updated":
					// do something
					break;
				case "customer.deleted":
					// do something
					break;
				case "customer.card.created":
					// do something
					break;
				case "customer.card.updated":
					// do something
					break;
				case "customer.card.deleted":
					// do something
					break;
				case "customer.discount.created":
					// do something
					break;
				case "customer.discount.updated":
					// do something
					break;
				case "customer.discount.deleted":
					// do something
					break;
				case "customer.subscription.created":
					// do something
					break;
				case "customer.subscription.updated":
					// do something
					break;
				case "customer.subscription.deleted":
					// do something
					break;
				case "customer.subscription.trial_will_end":
					// do something
					break;
				case "invoice.created":
					// do something
					break;
				case "invoice.updated":
					// do something
					break;
				case "invoice.payment_succeeded":
					// do something
					break;
				case "invoice.payment_failed":
					// do something
					break;
				case "invoiceitem.created":
					// do something
					break;
				case "invoiceitem.updated":
					// do something
					break;
				case "invoiceitem.deleted":
					// do something
					break;
				case "plan.created":
					// do something
					break;
				case "plan.updated":
					// do something
					break;
				case "plan.deleted":
					// do something
					break;
				case "transfer.created":
					// do something
					break;
				case "transfer.updated":
					// do something
					break;
				case "transfer.paid":
					// do something
					break;
				case "transfer.failed":
					// do something
					break;
				default:
					// An error has occured, this was not a Stripe.com event - log into your Stripe.com account and check the log.

			}

			// Tell Stripe the webhook request was received so they don't try to resend it.
			$this->response->statusCode(200);
			return $this->response;
			}

			throw new BadRequestException('Company ID required', 405); // 405 Method Not Allowed
		}
	}
}
