<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserTimers Controller
 *
 * @property \App\Model\Table\UserTimersTable $UserTimers
 */
class UserTimersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Clients', 'Projects']
        ];
        $userTimers = $this->paginate($this->UserTimers);

        $this->set(compact('userTimers'));
        $this->set('_serialize', ['userTimers']);
    }

    /**
     * View method
     *
     * @param string|null $id User Timer id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userTimer = $this->UserTimers->get($id, [
            'contain' => ['Users', 'Clients', 'Projects']
        ]);

        $this->set('userTimer', $userTimer);
        $this->set('_serialize', ['userTimer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userTimer = $this->UserTimers->newEntity();
        if ($this->request->is('post')) {
            $userTimer = $this->UserTimers->patchEntity($userTimer, $this->request->data);
            if ($this->UserTimers->save($userTimer)) {
                $this->Flash->success(__('The {0} has been saved.', 'User Timer'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User Timer'));
            }
        }
        $users = $this->UserTimers->Users->find('list', ['limit' => 200]);
        $clients = $this->UserTimers->Clients->find('list', ['limit' => 200]);
        $projects = $this->UserTimers->Projects->find('list', ['limit' => 200]);
        $this->set(compact('userTimer', 'users', 'clients', 'projects'));
        $this->set('_serialize', ['userTimer']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Timer id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userTimer = $this->UserTimers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userTimer = $this->UserTimers->patchEntity($userTimer, $this->request->data);
            if ($this->UserTimers->save($userTimer)) {
                $this->Flash->success(__('The {0} has been saved.', 'User Timer'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User Timer'));
            }
        }
        $users = $this->UserTimers->Users->find('list', ['limit' => 200]);
        $clients = $this->UserTimers->Clients->find('list', ['limit' => 200]);
        $projects = $this->UserTimers->Projects->find('list', ['limit' => 200]);
        $this->set(compact('userTimer', 'users', 'clients', 'projects'));
        $this->set('_serialize', ['userTimer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Timer id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userTimer = $this->UserTimers->get($id);
        if ($this->UserTimers->delete($userTimer)) {
            $this->Flash->success(__('The {0} has been deleted.', 'User Timer'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'User Timer'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
