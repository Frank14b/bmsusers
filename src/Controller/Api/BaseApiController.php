<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Access Controller
 *
 * @method \App\Model\Entity\Api/Acces[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BaseApiController extends AppController
{
    public $connected_userid;
    public $_user_branch_id;
    public $enable = 1;
    public $disable = 0;
    public $delete = 2;

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');
        $this->loadComponent('UsersPo');

        $this->loadModel("Access");
        $this->loadModel("Roleaccess");
        $this->loadModel("UserBranchs");

        $this->checkConnectedUser(); // check if user connected and get id from token
        $this->checkBranchIdAvailable(); // check if branch_id is available in header
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['register', 'login']);
    }

    public function checkConnectedUser()
    {
        $auth = $this->request->getHeader('Authorization');
        if ($auth != null && isset($auth[0])) {
            $auth = explode(".", $auth[0]);
            if (isset($auth[1])) {
                $auth = base64_decode($auth[1]);
                $this->connected_userid = json_decode($auth, true)['sub'];

                $this->request = $this->request->withData("user_id", $this->connected_userid);
            }
        }
    }

    public function checkBranchIdAvailable()
    {
        $_branch = $this->request->getHeader('branch_id');
        if ($_branch != null) {
            $this->_user_branch_id = (int)($_branch[0]);
            $this->request = $this->request->withData("_user_branch_id", (int)($_branch[0]));
        } else {
            $this->_user_branch_id = 0;
            $this->request = $this->request->withData("_user_branch_id", 0);
        }
    }

    public function checkAuthRoute()
    {
        $status = false;

        try {
            $branch_id = ($this->request->getHeader('branch_id') != null) ? (int) $this->request->getHeader('branch_id') : 0;

            $url_path = explode("api", $this->request->getPath());
            if (sizeof($url_path) == 2) {
                $url_path = $url_path[1];

                $path_coverage = $this->Access->find('all', [
                    'conditions' => ['apiroute' => $url_path, 'status' => 1],
                ]);

                if ($path_coverage->count() > 0) {
                    $path_coverage = $path_coverage->first();
                    if ($path_coverage->coverage == 0) {
                        return "true";
                    }

                    $userRole = $this->UserBranchs->find('all', [
                        'conditions' => ['UserBranchs.branch_id' => $branch_id, 'UserBranchs.user_id' => $this->request->getData("user_id"), 'UserBranchs.status' => 1],
                    ]);

                    if ($userRole->count() > 0) {

                        $userRole = $userRole->first();

                        $checkRoleAccess = $this->Roleaccess->find('all', [
                            'conditions' => ['role_id' => (int)$userRole->role_id, 'acces_id' => (int)$path_coverage->id, 'status' => 1]
                        ]);

                        if ($checkRoleAccess->count() > 0) {

                            return "true";
                        } else {
                            $status = false;
                        }
                    } else {
                        $status = false;
                    }
                } else {
                    $status = false;
                }
            } else {
                $status = false;
            }

            if (!$status) {
                $result = [
                    "status" => $status,
                    "message" => "Not Authorized",
                ];

                return $this->response->withType('application/json')->withStringBody(json_encode($result));
            }
        } catch (\Throwable $th) {
            $result = [
                "status" => $status,
                "message" => "Not Authorized",
            ];

            return $this->response->withType('application/json')->withStringBody(json_encode($result));
        }
    }
}
