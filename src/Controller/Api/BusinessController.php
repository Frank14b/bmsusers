<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Business Controller
 *
 * @property \App\Model\Table\BusinessTable $Business
 */
class BusinessController extends BaseApiController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Business");
        $this->loadModel("BusinessPackages");
        $this->loadModel("UserBranchs");
        $this->loadModel("Branchs");
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['test']);
    }

    public function getAll()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        try {
            //code...
            // check if data send
            // check user business
            $rsData = $this->Business->find()->where(
                [
                    'Business.user_id' => $this->request->getData('user_id'),
                    'Business.status' => $this->request->getData("status")
                ]
            );
            // check user branchs
            $userBranch = $this->UserBranchs->find('all', ['fields' => ['branch_id'], 'conditions' => [
                'UserBranchs.user_id' => $this->request->getData('user_id'),
                'UserBranchs.status' => $this->request->getData("status")
            ]]);

            if ($userBranch->count() == 0) {
                $userBranch = [0, 0];
            } else {
                $userBranch = $userBranch->toArray();
            }

            $rsDataJoin = $this->Branchs->find()->where(
                [
                    'Branchs.id IN' => $userBranch,
                    'Branchs.status' => 1
                ]
            )->contain(['Business']);

            $result = [
                "status" => true,
                "message" => "get business data",
                "data" => $rsData,
                "dataJoin" => $rsDataJoin
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

    public function createBusiness()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // email address check rules
            $empData = $this->Business->find()->where([
                "name" => $this->request->getData("name"),
                'user_id' => $this->request->getData("user_id")
            ]);

            if ($empData->count() > 0) {
                // already exists
                $status = false;
                $message = "Business name already used";
            } else {
                // insert new business
                $empObject = $this->Business->newEmptyEntity();

                $this->request = $this->request->withData('reference', sha1($this->request->getData("name").$this->request->getData("user_id").date("Ymdhis")));
                $formData = $this->request->getData();
                $empObject = $this->Business->patchEntity($empObject, $formData);

                if ($rs = $this->Business->save($empObject)) {
                    // success response
                    $status = true;
                    $message = "Business has been created";
                    $data = $rs;
                } else {
                    // error response
                    $status = false;
                    $message = "Failed to create business";
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

    public function getbyid()
    {
        try {
            //code...
            $this->request->allowMethod(["OPTIONS", "POST"]);

            // form data
            // email address check rules
            $empData = $this->Business->find()->where([
                'Business.id' => $this->request->getData("user_id"),
                'Business.status' => 1
            ]);

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
