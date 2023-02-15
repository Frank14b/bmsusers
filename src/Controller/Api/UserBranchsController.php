<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * UserBranchs Controller
 *
 * @property \App\Model\Table\UserBranchsTable $UserBranchs
 */
class UserBranchsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');

        $this->loadModel("Branchs");
        $this->loadModel("Business");
        $this->loadModel("UserBranchs");
        $this->loadModel("Branchs");
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['test']);
    }

    public function getUsers()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        try {
            //code...
            // check if data send
            // check user business
            $rsData = $this->UserBranchs->find()->where(
                [
                    'UserBranchs.branch_id' => $this->request->getData('branch_id')
                ]
            )->contain(['Users', 'Roles']);

            $result = [
                "status" => true,
                "message" => "get branch data",
                "data" => $rsData,
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        } catch (\Throwable $th) {
            //throw $th;
            $result = [
                "status" => false,
                "message" => $th
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        }
    }

    public function getBranchs()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        try {
            //code...
            // check if data send
            // check user business
            $conditions  = ['UserBranchs.user_id' => $this->request->getData('user_id')];
            if($this->request->getData('business_id') != null) {
                $conditions = array_merge($conditions, ['Branchs.busines_id' => $this->request->getData('business_id')]);
            }
            if($this->request->getData('branch_id') != null) {
                $conditions = array_merge($conditions, ['UserBranchs.branch_id' => $this->request->getData('branch_id')]);
            }
            $rsData = $this->UserBranchs->find()->where($conditions)->contain(['Branchs', 'Roles']);

            $result = [
                "status" => true,
                "message" => "get branch data",
                "data" => $rsData,
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        } catch (\Throwable $th) {
            //throw $th;
            $result = [
                "status" => false,
                "message" => $th
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        }
    }

    public function addUsers()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // name address check rules
            $empData = $this->UserBranchs->find()->where([
                "user_id" => $this->request->getData("user_id"),
                'branch_id' => $this->request->getData("branch_id")
            ]);

            if ($empData->count() > 0) {
                // already exists
                $status = false;
                $message = "User already linked to the branch";
            } else {
                // insert new branch
                $empObject = $this->UserBranchs->newEmptyEntity();

                $formData = $this->request->getData();
                $empObject = $this->UserBranchs->patchEntity($empObject, $formData);

                if ($rs = $this->UserBranchs->save($empObject)) {
                    // success response
                    $status = true;
                    $message = "User has been added to the branch";
                    $data = $rs;
                } else {
                    // error response
                    $status = false;
                    $message = "Failed to add user to the branch";
                }
            }

            $result = [
                "status" => $status,
                "message" => $message,
                "data" => $data
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        } catch (\Throwable $th) {
            //throw $th;
            $result = [
                "status" => false,
                "message" => $th
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        }
    }

    public function removeUsers() 
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // if check rules
            if($this->request->getData("id") == null) {
                $result = [
                    "status" => $status,
                    "message" => $message,
                    "data" => $data
                ];
    
                return $this->response->withType('application/json')->withStringBody(json_encode($result));
            }

            $entry = $this->UserBranchs->get($this->request->getData("id"));

            if ($entry) {
                $empData = $this->UserBranchs->delete($entry);
                if($empData) {
                    //
                    $status = true;
                    $message = "User has been removed from the branch";
                }else{
                    //
                    $status = false;
                    $message = "Failed to remove user from the branch";
                }
            } else {
                // error response
                $status = false;
                $message = "Failed to fetch data not found";
            }

            $result = [
                "status" => $status,
                "message" => $message,
                "data" => $data
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        } catch (\Throwable $th) {
            //throw $th;
            $result = [
                "status" => false,
                "message" => $th
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        }
    }

    public function getbyid()
    {
        try {
            //code...
            $this->request->allowMethod(["OPTIONS", "POST"]);

            // form data
            // email address check rules
            $empData = $this->UserBranchs->find()->where([
                'UserBranchs.id' => $this->request->getData("user_id"),
                'UserBranchs.status' => 1
            ])->contain(['Branchs', "Users"]);

            $result = [
                "status" => true,
                "message" => "get data",
                "data" => $empData
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        } catch (\Throwable $th) {
            //throw $th;
            $result = [
                "status" => false,
                "message" => $th
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        }
    }
}
