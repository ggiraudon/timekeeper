<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TicketAttachments Controller
 *
 * @property \App\Model\Table\TicketAttachmentsTable $TicketAttachments
 */
class TicketAttachmentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tickets']
        ];
        $ticketAttachments = $this->paginate($this->TicketAttachments);

        $this->set(compact('ticketAttachments'));
        $this->set('_serialize', ['ticketAttachments']);
    }

    /**
     * View method
     *
     * @param string|null $id Ticket Attachment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticketAttachment = $this->TicketAttachments->get($id, [
            'contain' => ['Tickets']
        ]);

        $this->set('ticketAttachment', $ticketAttachment);
        $this->set('_serialize', ['ticketAttachment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ticketAttachment = $this->TicketAttachments->newEntity();
        if ($this->request->is('post')) {
            $ticketAttachment = $this->TicketAttachments->patchEntity($ticketAttachment, $this->request->data);
            if ($this->TicketAttachments->save($ticketAttachment)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ticket Attachment'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ticket Attachment'));
            }
        }
        $tickets = $this->TicketAttachments->Tickets->find('list', ['limit' => 200]);
        $this->set(compact('ticketAttachment', 'tickets'));
        $this->set('_serialize', ['ticketAttachment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket Attachment id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ticketAttachment = $this->TicketAttachments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticketAttachment = $this->TicketAttachments->patchEntity($ticketAttachment, $this->request->data);
            if ($this->TicketAttachments->save($ticketAttachment)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ticket Attachment'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ticket Attachment'));
            }
        }
        $tickets = $this->TicketAttachments->Tickets->find('list', ['limit' => 200]);
        $this->set(compact('ticketAttachment', 'tickets'));
        $this->set('_serialize', ['ticketAttachment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket Attachment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticketAttachment = $this->TicketAttachments->get($id);
        if ($this->TicketAttachments->delete($ticketAttachment)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Ticket Attachment'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Ticket Attachment'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function download($id = null)
    {
	    $ticketAttachment = $this->TicketAttachments->get($id, [
			    'contain' => ['Tickets']
			    ]);
	    $response = $this->response;
	    $response = $response->withType('application/octet-stream');
	    $response = $response->withDownload($ticketAttachment->file_name);
	    $response = $response->withStringbody(stream_get_contents($ticketAttachment->file_contents));

	    return $response;
    }



}
