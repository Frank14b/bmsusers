<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * ActivityMetadatas Controller
 *
 * @method \App\Model\Entity\ActivityMetadata[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityMetadatasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $activityMetadatas = $this->paginate($this->ActivityMetadatas);

        $this->set(compact('activityMetadatas'));
    }

    /**
     * View method
     *
     * @param string|null $id Activity Metadata id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activityMetadata = $this->ActivityMetadatas->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('activityMetadata'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activityMetadata = $this->ActivityMetadatas->newEmptyEntity();
        if ($this->request->is('post')) {
            $activityMetadata = $this->ActivityMetadatas->patchEntity($activityMetadata, $this->request->getData());
            if ($this->ActivityMetadatas->save($activityMetadata)) {
                $this->Flash->success(__('The activity metadata has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity metadata could not be saved. Please, try again.'));
        }
        $this->set(compact('activityMetadata'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Activity Metadata id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activityMetadata = $this->ActivityMetadatas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activityMetadata = $this->ActivityMetadatas->patchEntity($activityMetadata, $this->request->getData());
            if ($this->ActivityMetadatas->save($activityMetadata)) {
                $this->Flash->success(__('The activity metadata has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity metadata could not be saved. Please, try again.'));
        }
        $this->set(compact('activityMetadata'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity Metadata id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activityMetadata = $this->ActivityMetadatas->get($id);
        if ($this->ActivityMetadatas->delete($activityMetadata)) {
            $this->Flash->success(__('The activity metadata has been deleted.'));
        } else {
            $this->Flash->error(__('The activity metadata could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
