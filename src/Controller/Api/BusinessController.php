<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

/**
 * Business Controller
 *
 * @property \App\Model\Table\BusinessTable $Business
 */
class BusinessController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('PO');

        $this->loadModel("Business");
        $this->loadModel("BusinessPackages");
    }

    public function getAll()
    {
        $this->request->allowMethod(["OPTIONS", "POST"]);

        // form data
        $formData = $this->request->getData();

        // email address check rules
        $rsData = $this->Business->find();

        $result = [
            "status" => true,
            "message" => "get data",
            "data" => $rsData
        ];

        return $this->response->withType('application/json')->withStringBody(json_encode($rsData));
    }
}
