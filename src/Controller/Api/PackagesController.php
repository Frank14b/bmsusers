<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Packages Controller
 *
 * @property \App\Model\Table\PackagesTable $Packages
 */
class PackagesController extends BaseApiController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');

        $this->loadModel("Packages");
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
                'Packages.status' => ($this->request->getData("status") != null) ? (int) $this->request->getData("status") : 1,
                'Packages.coverage IN' => [1]
            ];

            if ($this->request->getData("coverage") != null) {
                if (strtolower(strval($this->request->getData("coverage"))) == "all") { // send coverage all to get all api route packages from db
                    $conditions['Packages.coverage IN'] = ["0", "1"];
                }
            }

            if ($this->request->getData("id") != null) {
                $conditions['Packages.id'] = (int) $this->request->getData("id");
            }

            $rsData = $this->Packages->find()->where(
                $conditions
            );

            $result = [
                "status" => true,
                "message" => "get Packages data",
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

    public function createPackages()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // title check rules
            $empData = $this->Packages->find()->where([
                "OR" => [
                    ["title" => $this->request->getData("title")],
                    ["middleware" => $this->request->getData("middleware")]
                ],
                'status' => 1
            ]);

            if ($empData->count() > 0) {
                // already exists
                $status = false;
                $message = "Packages already created";
            } else {
                // insert new role
                $empObject = $this->Packages->newEmptyEntity();

                $formData = $this->request->getData();
                $empObject = $this->Packages->patchEntity($empObject, $formData);

                if ($rs = $this->Packages->save($empObject)) {
                    // success response
                    $status = true;
                    $message = "Packages has been created";
                    $data = $rs;
                } else {
                    // error responses
                    $status = false;
                    $message = "Failed to create packages";
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
            $empData = $this->Packages->find()->where([
                'Packages.id' => $this->request->getData("id"),
                'Packages.status' => 1
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
