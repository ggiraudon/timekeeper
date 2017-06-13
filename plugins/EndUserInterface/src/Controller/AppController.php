<?php

namespace EndUserInterface\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

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
    }

}
