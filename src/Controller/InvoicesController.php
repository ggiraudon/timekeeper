<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 */
class InvoicesController extends AppController
{

	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		$this->Auth->allow(['printview']);
	}
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients'],
	    'order' => ['Invoices.invoice_date' => 'DESC']
        ];
        $invoices = $this->paginate($this->Invoices);

        $this->set(compact('invoices'));
        $this->set('_serialize', ['invoices']);
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Clients', 'Activities' => ['Projects']]
        ]);
	$company = $this->Auth->user('company');
	$client_name=str_replace(" ","_",$invoice->client->name);
	$pdf_filename  = "invoice-$client_name-".$invoice->label.".pdf";
	Configure::write('CakePdf.filename',$pdf_filename);
        $this->set('invoice', $invoice);
        $this->set('company', $company);
        $this->set('_serialize', ['invoice','company']);
    }
    public function printview($id = null)
    {
	$this->view($id);
    }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
	$company=$this->Auth->user('company');
	$this->loadModel('Activities');
	$this->loadModel('Companies');
        $invoice = $this->Invoices->newEntity();
        if ($this->request->is('post')) {
	    $this->request->data['tax']=json_encode($this->request->data['tax']);
	    $this->request->data['label']=sprintf($company['invoice_number_format'],$company['next_invoice_number']);
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
            if ($this->Invoices->save($invoice)) {
		foreach($this->request->data['activities'] as $activity_id)
		{
			$activity=$this->Activities->get($activity_id);
			$activity->invoice_id=$invoice->id;
			$this->Activities->save($activity);
		}
		$company_update=$this->Companies->get($company['id']);
		$company_update->next_invoice_number++;
		$this->Companies->save($company_update);
		$this->request->getSession()->write('Auth.User.company',$company_update->toArray());
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }
        $clients = $this->Invoices->Clients->find('all');
	$taxClasses = $this->Invoices->Clients->TaxClasses->find('all',['contain' => ['TaxClassRates']]);
        $this->set(compact('invoice', 'clients','taxClasses'));
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoice = $this->Invoices->get($id, [
            'contain' => ['Activities']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
	    $this->request->data['tax']=json_encode($this->request->data['tax']);
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->data);
            if ($this->Invoices->save($invoice)) {
		$this->Invoices->Activities->updateAll(['invoice_id'=>null],['invoice_id'=>$invoice->id]);
		foreach($this->request->data['activities'] as $activity_id)
		{
			$activity=$this->Invoices->Activities->get($activity_id);
			$activity->invoice_id=$invoice->id;
			$this->Invoices->Activities->save($activity);
		}
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
            }
        }
        $clients = $this->Invoices->Clients->find('all');
	$taxClasses = $this->Invoices->Clients->TaxClasses->find('all',['contain' => ['TaxClassRates']]);
        $this->set(compact('invoice', 'clients','taxClasses'));
        $this->set('_serialize', ['invoice']);
    }


    public function pay($id = null)
    {
        $invoice = $this->Invoices->get($id);
	$invoice->status='PAID';
        if ($this->Invoices->save($invoice)) {
            $this->Flash->success(__('The invoice has been marked as paid.'));
        } else {
            $this->Flash->error(__('The invoice could not be marked as paid. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoices->get($id);
        if ($this->Invoices->delete($invoice)) {
            $this->Flash->success(__('The invoice has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
