<?php
namespace EndUserInterface\Controller;

use EndUserInterface\Controller\AppController;

/**
 * Invoices Controller
 *
 * @property \EndUserInterface\Model\Table\InvoicesTable $Invoices
 */
class InvoicesController extends AppController
{

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
            'contain' => ['Clients','Activities' => ['Projects']]
        ]);
	$company = $this->Auth->user('company');
	
        $this->set('company', $company);
        $this->set('invoice', $invoice);
        $this->set('_serialize', ['invoice']);
    }

}
