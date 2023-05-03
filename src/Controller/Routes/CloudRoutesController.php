<?php

declare(strict_types=1);

namespace App\Controller\Routes;

use Cake\Routing\RouteBuilder;

/**
 * CloudRoutes Controller
 *
 * @method \App\Model\Entity\CloudRoute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CloudRoutesController
{
    protected $_routes;

    public function __construct($routes)
    {
        $this->_routes = $routes;

        $this->_routes->prefix('api/cloud/public', function (RouteBuilder $builder) {
            $builder->applyMiddleware();
            $builder->setExtensions(['']);
            // Connect API actions here.
            // $builder->connect("/signapp", ["controller" => "Users", "action" => "signapp"]);

            // users routes
            $builder->connect("/users/signin2", ["controller" => "Users", "action" => "login"]);
        });

        $this->_routes->prefix('api/cloud/private', function (RouteBuilder $builder) {
            $builder->applyMiddleware();
            $builder->setExtensions(['json']);
            // Connect API actions here.
            // $builder->connect("/signapp", ["controller" => "Users", "action" => "signapp"]);

            // users routes
            $builder->connect("/users/signin3", ["controller" => "Users", "action" => "login"]);
        });
    }
}
