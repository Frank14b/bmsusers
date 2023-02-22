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

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');

        $this->loadModel("Roleaccess");

        $this->checkConnectedUser(); // check if user connected and get id from token

        $this->checkAuthRoute(); // check if api route is authorized to the user
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['register', 'login']);
    }

    public function checkConnectedUser()
    {
        $auth = $this->request->getHeader('Authorization');
        if($auth != null && isset($auth[0])) {
            $auth = explode(".", $auth[0]);
            if(isset($auth[1])) {
                $auth = base64_decode($auth[1]);
                $this->connected_userid = json_decode($auth, true)['sub'];

                $this->request = $this->request->withData("user_id", $this->connected_userid);
            }
        }
    }

    public function checkAuthRoute()
    {
        $url_path = explode("api", $this->request->getPath());
        if(sizeof($url_path) == 2) {
            $url_path = $url_path[1];
        }
    }
}
