<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Activities Controller
 *
 * @property \App\Model\Table\ActivitiesTable $Activities
 */
class ActivitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

	$filter=$this->request->query("filter");
        $this->paginate = [
            'contain' => ['Users', 'Clients', 'Projects', 'Invoices']
        ];

	switch($filter)
	{

		case "uninvoiced":
			$criteria=['Activities.invoice_id IS NULL'];
			break;

		case "uninvoiced":
			$criteria=['Activities.invoice_id IS NOT'=>null];
			break;

		default:
			$criteria=[];
	}
        $activities = $this->paginate($this->Activities,['conditions'=>$criteria]);

        $this->set(compact('activities'));
        $this->set('_serialize', ['activities']);
    }

    /**
     * View method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['Users', 'Clients', 'Projects', 'Invoices']
        ]);

        $this->set('activity', $activity);
        $this->set('_serialize', ['activity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activity = $this->Activities->newEntity();

        if ($this->request->is('post')) {

		$project = $this->Activities->Projects->get($this->request->data['project_id']);
		$client = $this->Activities->Clients->get($this->request->data['client_id']);

		if(empty($this->request->data['rate']))
		if(!empty($project->rate))
			$this->request->data['rate']=$project->rate;
		else
			$this->request->data['rate']=$client->default_rate;

		$activity = $this->Activities->patchEntity($activity, $this->request->data);
		if ($this->Activities->save($activity)) {
			$this->Flash->success(__('The activity has been saved.'));

			return $this->redirect(['action' => 'index']);
		} else {
			$this->Flash->error(__('The activity could not be saved. Please, try again.'));
		}
        } 


        $user_id =  $this->Auth->user('id');
        
        $clients = $this->Activities->Clients->find('list', ['limit' => 200]);
        $projects = $this->Activities->Projects->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'user_id', 'clients', 'projects'));
        $this->set('_serialize', ['activity']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activity = $this->Activities->patchEntity($activity, $this->request->data);
            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('The activity has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The activity could not be saved. Please, try again.'));
            }
        }
        $users = $this->Activities->Users->find('list', ['limit' => 200]);
        $clients = $this->Activities->Clients->find('list', ['limit' => 200]);
        $projects = $this->Activities->Projects->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'users', 'clients', 'projects'));
        $this->set('_serialize', ['activity']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activity = $this->Activities->get($id);
        if ($this->Activities->delete($activity)) {
            $this->Flash->success(__('The activity has been deleted.'));
        } else {
            $this->Flash->error(__('The activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
