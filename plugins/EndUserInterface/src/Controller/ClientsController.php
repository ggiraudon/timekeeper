<?php
namespace EndUserInterface\Controller;

use EndUserInterface\Controller\AppController;

use Cake\Event\Event;
/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[] paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['login', 'logout']);
	}


    public function index()
    {
	$id=$this->Auth->user('id');
        $client = $this->Clients->get($id, [
            'contain' => ['Companies', 
			  'Activities' => function ($q) { return $q->where(['Activities.invoice_id IS NULL'])->order(['created'=>'DESC']); },
			  'Invoices' => [ 'sort' => ['Invoices.payment_due' => 'DESC' ]], 
			  'Projects', 
			  'Subscriptions' 
			  ]
        ]);
        $this->set('client', $client);
        $this->set('_serialize', ['client']);

   }
    public function view($id=null)
    {
	$id=$this->Auth->user('id');
        $client = $this->Clients->get($id, [
            'contain' => ['Companies', 'Activities', 'Invoices', 'Projects', 'Subscriptions', 'UserTimers']
        ]);
        $this->set('client', $client);
        $this->set('_serialize', ['client']);

   }


    public function login()
    {
	$this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }



}
