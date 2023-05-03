<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Currencies Controller
 *
 * @method \App\Model\Entity\Currency[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CurrenciesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $currencies = $this->paginate($this->Currencies);

        $this->set(compact('currencies'));
    }

    /**
     * View method
     *
     * @param string|null $id Currency id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $currency = $this->Currencies->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('currency'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $currency = $this->Currencies->newEmptyEntity();
        if ($this->request->is('post')) {
            $currency = $this->Currencies->patchEntity($currency, $this->request->getData());
            if ($this->Currencies->save($currency)) {
                $this->Flash->success(__('The currency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The currency could not be saved. Please, try again.'));
        }
        $this->set(compact('currency'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Currency id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $currency = $this->Currencies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $currency = $this->Currencies->patchEntity($currency, $this->request->getData());
            if ($this->Currencies->save($currency)) {
                $this->Flash->success(__('The currency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The currency could not be saved. Please, try again.'));
        }
        $this->set(compact('currency'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Currency id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $currency = $this->Currencies->get($id);
        if ($this->Currencies->delete($currency)) {
            $this->Flash->success(__('The currency has been deleted.'));
        } else {
            $this->Flash->error(__('The currency could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
