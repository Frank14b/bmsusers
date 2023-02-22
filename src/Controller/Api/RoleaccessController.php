<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Api\BaseApiController;
use App\Controller\Api\Common\AccessCommonController;

/**
 * Roleaccess Controller
 *
 * @method \App\Model\Entity\Api/Roleacces[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoleaccessController extends BaseApiController
{
    protected $accessCommonController;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');

        $this->loadModel("Access");
        $this->loadModel("Roleaccess");
        $this->loadModel("Branchs");

        $this->accessCommonController = new AccessCommonController();
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['test']);
    }

    public function getUserAccess()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        try {
            //code...
            // check if data send
            // check role
            $business_id = $this->accessCommonController->getBusinessIDbyBranch($this->request);

            $user_role = $this->accessCommonController->getUserRoleByBranchID($this->request);

            $conditions = [
                'Roleaccess.status' => ($this->request->getData("status") != null) ? (int) $this->request->getData("status") : 1,
                'Access.status' => 1,
                'Access.coverage' => 1,
                'Roles.status' => 1,
                'Roles.business_id' => $business_id,
                'Roleaccess.role_id' => $user_role
            ];

            $rsData = $this->Roleaccess->find()->where(
                $conditions
            )->contain(['Roles', 'Access']);

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

    public function addAccess()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        try {
            //code...
            // form data
            // title check rules
            $empData = $this->Roleaccess->find()->where([
                "OR" => [
                    ["role_id" => $this->request->getData("role_id")],
                    ["acces_id" => $this->request->getData("acces_id")]
                ],
                'status' => 1
            ]);

            if ($empData->count() > 0) {
                // already exists
                $status = false;
                $message = "Role Access already addedd";
            } else {
                // insert new role
                $empObject = $this->Roleaccess->newEmptyEntity();

                $formData = $this->request->getData();
                $empObject = $this->Roleaccess->patchEntity($empObject, $formData);

                if ($rs = $this->Roleaccess->save($empObject)) {
                    // success response
                    $status = true;
                    $message = "Role Access has been added";
                    $data = $rs;
                } else {
                    // error responses
                    $status = false;
                    $message = "Failed to add role access";
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
}
