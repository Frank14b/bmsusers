<?php

/**
 * Routes configuration.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * It's loaded within the context of `Application::routes()` method which
 * receives a `RouteBuilder` instance `$routes` as method argument.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use App\Controller\Routes\CloudRoutesController;
use App\Controller\Routes\AdminRoutesController;

return static function (RouteBuilder $routes) {
    /*
     * The default class to use for all routes
     *
     * The following route classes are supplied with CakePHP and are appropriate
     * to set as the default:
     *
     * - Route
     * - InflectedRoute
     * - DashedRoute
     *
     * If no call is made to `Router::defaultRouteClass()`, the class used is
     * `Route` (`Cake\Routing\Route\Route`)
     *
     * Note that `Route` does not do any inflections on URLs which will result in
     * inconsistently cased URLs when used with `{plugin}`, `{controller}` and
     * `{action}` markers.
     */

    // super admin routes
    new AdminRoutesController($routes);

    // cloud public and private routes
    new CloudRoutesController($routes);

    $routes->prefix('api', function (RouteBuilder $builder) {
        $builder->applyMiddleware();
        $builder->setExtensions([""]);
        // Connect API actions here.
        // $builder->connect("/signapp", ["controller" => "Users", "action" => "signapp"]);

        // users routes
        $builder->connect("/users/signup", ["controller" => "Users", "action" => "register"]);
        $builder->connect("/users/signin", ["controller" => "Users", "action" => "login"]);
        $builder->connect("/users/getall", ["controller" => "Users", "action" => "getAll"]);
        $builder->connect("/users/getbyid/{id}", ["controller" => "Users", "action" => "getById"])->setPatterns(['id' => '[0-9]+']);
        $builder->connect("/users/add", ["controller" => "Users", "action" => "createUser"]);
        $builder->connect("/users/update", ["controller" => "Users", "action" => "update"]);
        $builder->connect("/users/remove", ["controller" => "Users", "action" => "delete"]);
        $builder->connect("/users/getbranchs", ["controller" => "UserBranchs", "action" => "getBranchs"]);
        $builder->connect("/users/getaccess", ["controller" => "Roleaccess", "action" => "getUserAccess"]);
        //
        // business routes
        $builder->connect("/business/getall", ["controller" => "Business", "action" => "getAll"]);
        $builder->connect("/business/getbyid/{id}", ["controller" => "Business", "action" => "getById"])->setPatterns(['id' => '[0-9]+']);
        $builder->connect("/business/add", ["controller" => "Business", "action" => "createBusiness"]);
        //
        // branchs routes
        $builder->connect("/branchs/getall", ["controller" => "Branch", "action" => "getAll"]);
        $builder->connect("/branchs/getbyid/{id}", ["controller" => "Branch", "action" => "getById"])->setPatterns(['id' => '[0-9]+']);
        $builder->connect("/branchs/add", ["controller" => "Branch", "action" => "createBranchs"]);
        $builder->connect("/branchs/adduser", ["controller" => "UserBranchs", "action" => "addUsers"]);
        $builder->connect("/branchs/removeuser", ["controller" => "UserBranchs", "action" => "removeUsers"]);
        $builder->connect("/branchs/getusers", ["controller" => "UserBranchs", "action" => "getUsers"]);
        //
        // roles routes
        $builder->connect("/roles/getall", ["controller" => "Roles", "action" => "getAll"]);
        $builder->connect("/roles/getbyid/{id}", ["controller" => "Roles", "action" => "getById"])->setPatterns(['id' => '[0-9]+']);
        $builder->connect("/roles/add", ["controller" => "Roles", "action" => "createRoles"]);
        $builder->connect("/roles/addaccess", ["controller" => "Roleaccess", "action" => "addAccess"]);
        //
        // access routes
        $builder->connect("/access/getall", ["controller" => "Access", "action" => "getAll"]);
        $builder->connect("/access/getbyid/{id}", ["controller" => "Access", "action" => "getById"])->setPatterns(['id' => '[0-9]+']);
        $builder->connect("/access/add", ["controller" => "Access", "action" => "createAccess"]);
    });

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder) {

        $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
            'httpOnly' => true
        ]));

        $builder->applyMiddleware('csrf');
        /*
         * Here, we are connecting '/' (base path) to a controller called 'Pages',
         * its action called 'display', and we pass a param to select the view file
         * to use (in this case, templates/Pages/home.php)...
         */
        $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

        /*
         * ...and connect the rest of 'Pages' controller's URLs.
         */
        $builder->connect('/pages/*', 'Pages::display');

        /*
         * Connect catchall routes for all controllers.
         *
         * The `fallbacks` method is a shortcut for
         *
         * ```
         * $builder->connect('/{controller}', ['action' => 'index']);
         * $builder->connect('/{controller}/{action}/*', []);
         * ```
         *
         * You can remove these routes once you've connected the
         * routes you want in your application.
         */
        $builder->fallbacks();
    });

    /*
     * If you need a different set of middleware or none at all,
     * open new scope and define routes there.
     *
     * ```
     * $routes->scope('/api', function (RouteBuilder $builder) {
     *     // No $builder->applyMiddleware() here.
     *
     *     // Parse specified extensions from URLs
     *     // $builder->setExtensions(['json', 'xml']);
     *
     *     // Connect API actions here.
     * });
     * ```
     */
};
