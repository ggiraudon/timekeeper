<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * TicketNotes Controller
 *
 * @property \App\Model\Table\TicketNotesTable $TicketNotes
 */
class TicketNotesController extends AppController
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
        $ticketNotes = $this->paginate($this->TicketNotes);

        $this->set(compact('ticketNotes'));
        $this->set('_serialize', ['ticketNotes']);
    }

    /**
     * View method
     *
     * @param string|null $id Ticket Note id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ticketNote = $this->TicketNotes->get($id, [
            'contain' => ['Tickets']
        ]);

        $this->set('ticketNote', $ticketNote);
        $this->set('_serialize', ['ticketNote']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
	$ticket_id=$this->request->data['ticket_id'];
	$this->loadModel('Tickets');
        $ticket = $this->Tickets->get($ticket_id, [ 'contain' => [] ]);
        $ticketNote = $this->TicketNotes->newEntity();
        if ($this->request->is('put')) {
            $ticketNote = $this->TicketNotes->patchEntity($ticketNote, $this->request->data);
	    $ticketNote->content = $ticketNote->content_plain;
            if ($this->TicketNotes->save($ticketNote)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ticket Note'));
		if($this->request->data['notify_client']==1)
		if($company=$this->Tickets->Companies->get($ticket->company_id))
		{	
			$username = $company->mail_username;
			$password = $company->mail_password;
			Email::configTransport('outbound', [
			    'host' => $company->smtp_server,
			    'port' => $company->smtp_port,
			    'username' => $username,
			    'password' => $password,
			    'className' => 'Smtp',
			    'tls' => true
			]);
			$to = $company->ticket_mailbox;
			$sp = explode("@",$to);
			$tomailbox = $sp[0];
			$tohost = $sp[1];

			$message = $ticketNote->content_plain;
			$title = '[#'.$ticket->ticket_number.'] UP:'.$ticket->ticket_title;
			$reply_address="$tomailbox+{$ticket->id}@$tohost";
			$email = new Email();
			$email
			    ->transport('outbound')
			    ->emailFormat('text')
			    ->subject($title)
			    ->to($ticket->from_email)
			    ->from($reply_address)
			    ->replyTo($reply_address)
			    ->send($message);

		}
                return $this->redirect(['controller' => 'tickets' , 'action' => 'view', $ticket_id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ticket Note'));
            }
        }
	die('bar');
        return $this->redirect(['controller' => 'tickets' , 'action' => 'view', $ticket_id]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket Note id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ticketNote = $this->TicketNotes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticketNote = $this->TicketNotes->patchEntity($ticketNote, $this->request->data);
            if ($this->TicketNotes->save($ticketNote)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ticket Note'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ticket Note'));
            }
        }
        $tickets = $this->TicketNotes->Tickets->find('list', ['limit' => 200]);
        $this->set(compact('ticketNote', 'tickets'));
        $this->set('_serialize', ['ticketNote']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket Note id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ticketNote = $this->TicketNotes->get($id);
        if ($this->TicketNotes->delete($ticketNote)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Ticket Note'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Ticket Note'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
