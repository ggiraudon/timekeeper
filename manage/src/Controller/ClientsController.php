<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 *
 * @method \App\Model\Entity\Client[] paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{

    public function index()
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
