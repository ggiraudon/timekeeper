<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TaxClasses Controller
 *
 * @property \App\Model\Table\TaxClassesTable $TaxClasses
 */
class TaxClassesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $taxClasses = $this->paginate($this->TaxClasses);

        $this->set(compact('taxClasses'));
        $this->set('_serialize', ['taxClasses']);
    }

    /**
     * View method
     *
     * @param string|null $id Tax Class id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxClass = $this->TaxClasses->get($id, [
            'contain' => ['Companies', 'TaxClassRates']
        ]);

        $this->set('taxClass', $taxClass);
        $this->set('_serialize', ['taxClass']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taxClass = $this->TaxClasses->newEntity();
        if ($this->request->is('post')) {
            $taxClass = $this->TaxClasses->patchEntity($taxClass, $this->request->data);
            if ($this->TaxClasses->save($taxClass)) {
                $this->Flash->success(__('The {0} has been saved.', 'Tax Class'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Tax Class'));
            }
        }
        $companies = $this->TaxClasses->Companies->find('list', ['limit' => 200]);
        $this->set(compact('taxClass', 'companies'));
        $this->set('_serialize', ['taxClass']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tax Class id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxClass = $this->TaxClasses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxClass = $this->TaxClasses->patchEntity($taxClass, $this->request->data);
            if ($this->TaxClasses->save($taxClass)) {
                $this->Flash->success(__('The {0} has been saved.', 'Tax Class'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Tax Class'));
            }
        }
        $companies = $this->TaxClasses->Companies->find('list', ['limit' => 200]);
        $this->set(compact('taxClass', 'companies'));
        $this->set('_serialize', ['taxClass']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tax Class id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxClass = $this->TaxClasses->get($id);
        if ($this->TaxClasses->delete($taxClass)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Tax Class'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Tax Class'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
