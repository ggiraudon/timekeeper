<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;

class ClientsController extends AppController
{
	public function initialize()
        {
                parent::initialize();
                $this->Auth->allow(['webhook']);
        }

	public function webhook() {
		//$this->autoRender = false;
		file_put_contents("/tmp/actions.log",print_r($_REQUEST,true)."\n",FILE_APPEND);
		file_put_contents("/tmp/actions.log",print_r($this->request->data,true)."\n",FILE_APPEND);
		file_put_contents("/tmp/actions.log",json_encode($this->request->data)."\n",FILE_APPEND);

		$response = [
				"speech" => "i like to move it move it",
				"displayText" => "i like to move it move it",
				//"contextOut" => [],
				//"source" => "",
				//"followupEvent" => []
			    ];

		$this->set('response',$response);
		$this->set('_serialize','response');
	}
}
