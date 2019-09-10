<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 */
class CompaniesController extends AppController
{

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
	$id=$this->Auth->user('company_id');
        $company = $this->Companies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $company = $this->Companies->patchEntity($company, $this->request->data);
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The {0} has been saved.', 'Company'));
                return $this->redirect(['action' => 'edit',$company->id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Company'));
            }
        }
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
    }

}
