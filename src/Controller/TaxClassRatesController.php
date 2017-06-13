<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TaxClassRates Controller
 *
 * @property \App\Model\Table\TaxClassRatesTable $TaxClassRates
 */
class TaxClassRatesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TaxClasses']
        ];
        $taxClassRates = $this->paginate($this->TaxClassRates);

        $this->set(compact('taxClassRates'));
        $this->set('_serialize', ['taxClassRates']);
    }

    /**
     * View method
     *
     * @param string|null $id Tax Class Rate id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxClassRate = $this->TaxClassRates->get($id, [
            'contain' => ['TaxClasses']
        ]);

        $this->set('taxClassRate', $taxClassRate);
        $this->set('_serialize', ['taxClassRate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taxClassRate = $this->TaxClassRates->newEntity();
        if ($this->request->is('post')) {
            $taxClassRate = $this->TaxClassRates->patchEntity($taxClassRate, $this->request->data);
            if ($this->TaxClassRates->save($taxClassRate)) {
                $this->Flash->success(__('The {0} has been saved.', 'Tax Class Rate'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Tax Class Rate'));
            }
        }
        $taxClasses = $this->TaxClassRates->TaxClasses->find('list', ['limit' => 200]);
        $this->set(compact('taxClassRate', 'taxClasses'));
        $this->set('_serialize', ['taxClassRate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tax Class Rate id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxClassRate = $this->TaxClassRates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxClassRate = $this->TaxClassRates->patchEntity($taxClassRate, $this->request->data);
            if ($this->TaxClassRates->save($taxClassRate)) {
                $this->Flash->success(__('The {0} has been saved.', 'Tax Class Rate'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Tax Class Rate'));
            }
        }
        $taxClasses = $this->TaxClassRates->TaxClasses->find('list', ['limit' => 200]);
        $this->set(compact('taxClassRate', 'taxClasses'));
        $this->set('_serialize', ['taxClassRate']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tax Class Rate id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxClassRate = $this->TaxClassRates->get($id);
        if ($this->TaxClassRates->delete($taxClassRate)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Tax Class Rate'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Tax Class Rate'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
