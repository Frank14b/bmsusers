<?php
declare(strict_types=1);

namespace App\Controller\Routes;

use Cake\Routing\RouteBuilder;

/**
 * AdminRoutes Controller
 *
 * @method \App\Model\Entity\AdminRoute[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminRoutesController
{
    protected $_routes;

    public function __construct($routes)
    {
        $this->_routes = $routes;

        $this->_routes->prefix('api/admin', function (RouteBuilder $builder) {
            $builder->applyMiddleware();
            $builder->setExtensions(['json']);
            // Connect API actions here.
            // $builder->connect("/signapp", ["controller" => "Users", "action" => "signapp"]);
    
            // users routes
            $builder->connect("/users/signup", ["controller" => "Users", "action" => "register"]);
            $builder->connect("/users/signin", ["controller" => "Users", "action" => "login"]);
            $builder->connect("/users/getall", ["controller" => "Users", "action" => "getAll"]);
            $builder->connect("/users/getbyid", ["controller" => "Users", "action" => "getById"]);
            $builder->connect("/users/add", ["controller" => "Users", "action" => "createUser"]);
            $builder->connect("/users/update", ["controller" => "Users", "action" => "update"]);
            $builder->connect("/users/remove", ["controller" => "Users", "action" => "delete"]);
            $builder->connect("/users/getbranchs", ["controller" => "UserBranchs", "action" => "getBranchs"]);
            $builder->connect("/users/getaccess", ["controller" => "Roleaccess", "action" => "getUserAccess"]);
            //
            // business routes
            $builder->connect("/business/getall", ["controller" => "Business", "action" => "getAll"]);
            $builder->connect("/business/getbyid", ["controller" => "Business", "action" => "getById"]);
            $builder->connect("/business/add", ["controller" => "Business", "action" => "createBusiness"]);
            //
            // branchs routes
            $builder->connect("/branchs/getall", ["controller" => "Branch", "action" => "getAll"]);
            $builder->connect("/branchs/getbyid", ["controller" => "Branch", "action" => "getById"]);
            $builder->connect("/branchs/add", ["controller" => "Branch", "action" => "createBranchs"]);
            $builder->connect("/branchs/adduser", ["controller" => "UserBranchs", "action" => "addUsers"]);
            $builder->connect("/branchs/removeuser", ["controller" => "UserBranchs", "action" => "removeUsers"]);
            $builder->connect("/branchs/getusers", ["controller" => "UserBranchs", "action" => "getUsers"]);
            //
            // roles routes
            $builder->connect("/roles/getall", ["controller" => "Roles", "action" => "getAll"]);
            $builder->connect("/roles/getbyid", ["controller" => "Roles", "action" => "getById"]);
            $builder->connect("/roles/add", ["controller" => "Roles", "action" => "createRoles"]);
            $builder->connect("/roles/addaccess", ["controller" => "Roleaccess", "action" => "addAccess"]);
            //
            // access routes
            $builder->connect("/access/getall", ["controller" => "Access", "action" => "getAll"]);
            $builder->connect("/access/getbyid", ["controller" => "Access", "action" => "getById"]);
            $builder->connect("/access/add", ["controller" => "Access", "action" => "createAccess"]);
        });
    }
}
