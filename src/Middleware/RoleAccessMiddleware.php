<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Cake\Datasource\FactoryLocator;

class RoleAccessMiddleware implements MiddlewareInterface
{
    public function __construct()
    {
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $accessTable = FactoryLocator::get('Table')->get('Access');
            $userBranchsTable = FactoryLocator::get('Table')->get('UserBranchs');
            $roleAccessTable = FactoryLocator::get('Table')->get('Roleaccess');

            $th = "Unauthorized Access";
            $error_result = [
                "status" => false,
                "message" => $th
            ];

            $userid = 0;

            $auth = $_SERVER['HTTP_AUTHORIZATION'];
            if ($auth != null) {
                $auth = explode(".", $auth);
                if (isset($auth[1])) {
                    $auth = base64_decode($auth[1]);
                    $userid =  json_decode($auth, true)['sub'];
                }
            }
        }

        // Calling $handler->handle() delegates control to the *next* middleware
        // In your application's queue.

        if (isset($_SERVER['HTTP_AUTHORIZATION']) && isset($_SERVER['HTTP_BRANCH_ID'])) {
            try {
                $url_path = explode("api", $_SERVER['REQUEST_URI']);
                $branch_id = ($_SERVER['HTTP_BRANCH_ID'] != null) ? (int) $_SERVER['HTTP_BRANCH_ID'] : 0;

                if (sizeof($url_path) == 2) {
                    $url_path = $url_path[1];

                    $path_coverage = $accessTable->find('all', [
                        'conditions' => ['apiroute' => $url_path, 'status' => 1],
                    ]);

                    if ($path_coverage->count() > 0) {
                        $path_coverage = $path_coverage->first();
                        if ($path_coverage->coverage == 1) {

                            $userRole = $userBranchsTable->find('all', [
                                'conditions' => ['UserBranchs.branch_id' => $branch_id, 'UserBranchs.user_id' => $userid, 'UserBranchs.status' => 1],
                            ]);

                            if ($userRole->count() > 0) {

                                $userRole = $userRole->first();

                                $checkRoleAccess = $roleAccessTable->find('all', [
                                    'conditions' => ['role_id' => (int)$userRole->role_id, 'acces_id' => (int)$path_coverage->id, 'status' => 1]
                                ]);

                                if ($checkRoleAccess->count() > 0) {
                                } else {
                                    die(json_encode($error_result));
                                }
                            } else {
                                die(json_encode($error_result));
                            }
                        }
                    }
                } else {
                    die(json_encode($error_result));
                }
            } catch (\Throwable $th) {
                die(json_encode($error_result));
            }
        }
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler,
    ): ResponseInterface {
        $response = $handler->handle($request);
        return $response;
    }
}
