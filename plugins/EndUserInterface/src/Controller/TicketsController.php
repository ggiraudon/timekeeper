<?php
namespace EndUserInterface\Controller;

use EndUserInterface\Controller\AppController;

/**
 * Tickets Controller
 *
 * @property \EndUserInterface\Model\Table\TicketsTable $Tickets
 */
class TicketsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies', 'Clients', 'Projects', 'Users']
        ];
        $tickets = $this->paginate($this->Tickets);

        $this->set(compact('tickets'));
        $this->set('_serialize', ['tickets']);
    }

    /**
     * View method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticket = $this->Tickets->get($id, [
            'contain' => ['Companies', 'Clients', 'Projects', 'Users', 'Activities', 'TicketAttachments', 'TicketNotes']
        ]);

        $this->set('ticket', $ticket);
        $this->set('_serialize', ['ticket']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ticket = $this->Tickets->newEntity();
        if ($this->request->is('post')) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ticket'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ticket'));
            }
        }
        $companies = $this->Tickets->Companies->find('list', ['limit' => 200]);
        $clients = $this->Tickets->Clients->find('list', ['limit' => 200]);
        $projects = $this->Tickets->Projects->find('list', ['limit' => 200]);
        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'companies', 'clients', 'projects', 'users'));
        $this->set('_serialize', ['ticket']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ticket = $this->Tickets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ticket'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ticket'));
            }
        }
        $companies = $this->Tickets->Companies->find('list', ['limit' => 200]);
        $clients = $this->Tickets->Clients->find('list', ['limit' => 200]);
        $projects = $this->Tickets->Projects->find('list', ['limit' => 200]);
        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'companies', 'clients', 'projects', 'users'));
        $this->set('_serialize', ['ticket']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticket = $this->Tickets->get($id);
        if ($this->Tickets->delete($ticket)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Ticket'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Ticket'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
