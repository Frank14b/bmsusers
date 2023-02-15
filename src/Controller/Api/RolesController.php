<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');

        $this->loadModel("Roles");
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
            $rsData = $this->Roles->find()->where(
                [
                    'Roles.business_id' => $this->request->getData('business_id'),
                    'Roles.status' => $this->request->getData("status")
                ]
            );

            $result = [
                "status" => true,
                "message" => "get roles data",
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

    public function createRoles()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // title check rules
            $empData = $this->Roles->find()->where([
                "title" => $this->request->getData("title"),
                'business_id' => $this->request->getData("business_id")
            ]);

            if ($empData->count() > 0) {
                // already exists
                $status = false;
                $message = "Role name already used";
            } else {
                // insert new role
                $empObject = $this->Roles->newEmptyEntity();

                $formData = $this->request->getData();
                $empObject = $this->Roles->patchEntity($empObject, $formData);

                if ($rs = $this->Roles->save($empObject)) {
                    // success response
                    $status = true;
                    $message = "Role has been created";
                    $data = $rs;
                } else {
                    // error responses
                    $status = false;
                    $message = "Failed to create role";
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
            $empData = $this->Roles->find()->where([
                'Roles.id' => $this->request->getData("role_id"),
                'Roles.status' => 1
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
