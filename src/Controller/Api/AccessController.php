<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Access Controller
 *
 * @method \App\Model\Entity\Api/Acces[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccessController extends BaseApiController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');

        $this->loadModel("Access");
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
            // check role
            $conditions = [
                'Access.status' => ($this->request->getData("status") != null) ? (int) $this->request->getData("status") : 1,
                'Access.coverage IN' => [1]
            ];

            if ($this->request->getData("coverage") != null) {
                if (strtolower(strval($this->request->getData("coverage"))) == "all") { // send coverage all to get all api route access from db
                    $conditions['Access.coverage IN'] = ["0", "1"];
                }
            }

            if ($this->request->getData("id") != null) {
                $conditions['Access.id'] = (int) $this->request->getData("id");
            }

            $rsData = $this->Access->find()->where(
                $conditions
            );

            $result = [
                "status" => true,
                "message" => "get Access data",
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

    public function createAccess()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // title check rules
            $empData = $this->Access->find()->where([
                "OR" => [
                    ["title" => $this->request->getData("title")],
                    ["middleware" => $this->request->getData("middleware")]
                ],
                'status' => 1
            ]);

            if ($empData->count() > 0) {
                // already exists
                $status = false;
                $message = "Access already created";
            } else {
                // insert new role
                $empObject = $this->Access->newEmptyEntity();

                $formData = $this->request->getData();
                $empObject = $this->Access->patchEntity($empObject, $formData);

                if ($rs = $this->Access->save($empObject)) {
                    // success response
                    $status = true;
                    $message = "Access has been created";
                    $data = $rs;
                } else {
                    // error responses
                    $status = false;
                    $message = "Failed to create access";
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
            $empData = $this->Access->find()->where([
                'Access.id' => $this->request->getData("role_id"),
                'Access.status' => 1
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
