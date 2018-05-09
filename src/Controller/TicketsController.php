<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Tickets Controller
 *
 * @property \App\Model\Table\TicketsTable $Tickets
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
            'contain' => ['Companies', 'Users']
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
            'contain' => ['Companies', 'Users', 'TicketAttachments', 'TicketNotes','Activities' ]
        ]);
        $clients = $this->Tickets->Clients->find('list', ['limit' => 200]);
	$projects=[];
	if(!empty($ticket->project_id))
	{
		$projects=$this->Tickets->Projects->find('list')->where(['client_id'=>$ticket->client_id]);
	}
        $this->set(compact('activity', 'user_id', 'clients','projects'));
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
        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'companies', 'users'));
        $this->set('_serialize', ['ticket']);
    }

    public function addTime()
    {
        $activity = $this->Tickets->Activities->newEntity();
        if ($this->request->is('post')||$this->request->is('put')) {
            $activity = $this->Tickets->Activities->patchEntity($activity, $this->request->data);
            if ($this->Tickets->Activities->save($activity)) {
                $this->Flash->success(__('The {0} has been saved.', 'Activity'));
                return $this->redirect(['action' => 'view',$activity->ticket_id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Activity'));
                return $this->redirect(['action' => 'view',$activity->ticket_id]);
            }
        }
        return $this->redirect(['action' => 'view',$activity->ticket_id]);
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

	if($ticket->status != $this->request->data["status"])
	{
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

			$message = "Your case status has been changed from ".$ticket->status." to ".$this->request->data["status"];
			$title = '[#'.$ticket->ticket_number.'] '.$this->request->data["status"].':'.$ticket->ticket_title;
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
	
	}


        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('The {0} has been saved.', 'Ticket'));
                return $this->redirect(['action' => 'view',$ticket->id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Ticket'));
            }
        }
        $companies = $this->Tickets->Companies->find('list', ['limit' => 200]);
        $users = $this->Tickets->Users->find('list', ['limit' => 200]);
        $this->set(compact('ticket', 'companies', 'users'));
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
