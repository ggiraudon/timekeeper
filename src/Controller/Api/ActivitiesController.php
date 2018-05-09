<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Datasource\ConnectionManager;

class ActivitiesController extends AppController
{
	public function getUninvoiced()
	{

		$client_id=$this->request->query("client_id");
		$invoice_id=$this->request->query("invoice_id");
		$criteria=['Activities.client_id'=>$client_id,'invoice_id IS NULL'];
		if(!empty($invoice_id))
		{
			$criteria=['AND' => ['Activities.client_id'=>$client_id,'OR'=>['invoice_id IS NULL','invoice_id'=>$invoice_id]]];

		}
		$activities = $this->Activities->find('all',['contain'=>['Projects'],'conditions'=>$criteria]);

		$this->set(compact('activities'));
		$this->set('_serialize', ['activities']);


	}
}
