<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Modules Controller
 *
 * @method \App\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModulesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');

        $this->loadModel("Modules");
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
                'Modules.status' => ($this->request->getData("status") != null) ? (int) $this->request->getData("status") : 1,
                'Modules.coverage IN' => [1]
            ];

            if ($this->request->getData("coverage") != null) {
                if (strtolower(strval($this->request->getData("coverage"))) == "all") { // send coverage all to get all api route modules from db
                    $conditions['Modules.coverage IN'] = ["0", "1"];
                }
            }

            if ($this->request->getData("id") != null) {
                $conditions['Modules.id'] = (int) $this->request->getData("id");
            }

            $rsData = $this->Modules->find()->where(
                $conditions
            );

            $result = [
                "status" => true,
                "message" => "get Modules data",
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

    public function createModules()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // title check rules
            $empData = $this->Modules->find()->where([
                "OR" => [
                    ["title" => $this->request->getData("title")],
                    ["middleware" => $this->request->getData("middleware")]
                ],
                'status' => 1
            ]);

            if ($empData->count() > 0) {
                // already exists
                $status = false;
                $message = "Modules already created";
            } else {
                // insert new role
                $empObject = $this->Modules->newEmptyEntity();

                $formData = $this->request->getData();
                $empObject = $this->Modules->patchEntity($empObject, $formData);

                if ($rs = $this->Modules->save($empObject)) {
                    // success response
                    $status = true;
                    $message = "Modules has been created";
                    $data = $rs;
                } else {
                    // error responses
                    $status = false;
                    $message = "Failed to create modules";
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
            $empData = $this->Modules->find()->where([
                'Modules.id' => $this->request->getData("id"),
                'Modules.status' => 1
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
