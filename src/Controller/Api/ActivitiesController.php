<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;

class ActivitiesController extends AppController
{
	public function getUninvoiced()
	{
		$filter=$this->request->query("client_id");

		$criteria=['Activities.client_id'=>$filter,'invoice_id IS NULL'];
		$activities = $this->Activities->find('all',['contain'=>['Projects'],'conditions'=>$criteria]);

		$this->set(compact('activities'));
		$this->set('_serialize', ['activities']);
 	

	}
}
