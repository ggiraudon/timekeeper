<?php

namespace EndUserInterface\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Stripe\Stripe;


class AppController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
	$this->Auth->config(
			'loginAction' , [
			'controller' => 'Clients',
			'action' => 'login'
			]);

	$this->Auth->config(
			'authError' , 'Did you really think you are allowed to see that?'
			);
	$this->Auth->config(
			'authenticate' , [
				'Form' => [
					'userModel' => 'Clients',
					'fields' => ['username' => 'username', 'password' => 'password']
				]
			]);
	$this->Auth->config('storage' , 'Session');
    }


    public function beforeRender(Event $event)
    {
	parent::beforeRender($event);
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        $this->set('theme', Configure::read('Theme'));
    }


// Context functions for Paypal and Stripe

	protected function _getPaypalContext($company)
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

	protected function _getStripeContext($company)
	{
		Stripe::setApiKey($company->stripe_secret);
	}


}
