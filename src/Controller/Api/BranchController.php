<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Branch Controller
 *
 */
class BranchController extends BaseApiController
{

    public function initialize(): void
    {
        parent::initialize();

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

    public function getAll()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        try {
            //code...
            // check if data send
            // check user business
            $rsData = $this->Branchs->find()->where(
                [
                    'Branchs.busines_id' => $this->request->getData('busines_id'),
                    'Branchs.status' => $this->request->getData("status")
                ]
            )->contain(['Users']);

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

    public function createBranchs()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // name address check rules
            $empData = $this->Branchs->find()->where([
                "name" => $this->request->getData("name"),
                'busines_id' => $this->request->getData("busines_id")
            ]);

            if ($empData->count() > 0) {
                // already exists
                $status = false;
                $message = "Branch name already used";
            } else {
                // insert new branch
                $empObject = $this->Branchs->newEmptyEntity();

                $formData = $this->request->getData();
                $empObject = $this->Branchs->patchEntity($empObject, $formData);

                if ($rs = $this->Branchs->save($empObject)) {
                    // success response
                    $status = true;
                    $message = "Branch has been created";
                    $data = $rs;
                } else {
                    // error response
                    $status = false;
                    $message = "Failed to create branchs";
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
            $empData = $this->Branchs->find()->where([
                'Branchs.id' => $this->request->getData("user_id"),
                'Branchs.status' => 1
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
