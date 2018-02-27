<?php
namespace App\Model\Behavior;
use Cake\ORM\Behavior;
use Cake\Network\Session;
use Cake\ORM\TableRegistry;
class CompanyFilterBehavior extends Behavior
{
	private $company_id = null;
	public function initialize(array $config)
	{
		parent::initialize($config);
		$this->session=new Session();
		$this->company_id=$this->session->read('Auth.User.company_id');
		// For APIs
 		if(!$this->company_id && env('PHP_AUTH_USER'))
 			$this->company_id = TableRegistry::get('Users')->find()->select('company_id')->where(['username' => env('PHP_AUTH_USER')])->first()->company_id;
	}
	public function beforeFind(\Cake\Event\Event $event, \Cake\ORM\Query $query, \ArrayObject $options, $primary)
	{
		if(!empty($this->session->read('Auth.User.company_id')) || !empty(env('PHP_AUTH_USER')))		{
			$query->andWhere([$event->subject()->alias().'.company_id' => $this->company_id]);
		}
	}
}
