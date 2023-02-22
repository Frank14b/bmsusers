<?php

declare(strict_types=1);

namespace App\Controller\Api\Common;

use App\Controller\AppController;

/**
 * Users Common Controller (functions)
 *
 */
//Code by Frank Donald Fontcha.

class AccessCommonController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Access");
        $this->loadModel("Roleaccess");
        $this->loadModel("Branchs");
        $this->loadModel("UserBranchs");
    }

    public function getBusinessIDbyBranch($request)
    {
        try {
            $result = $this->Branchs->find('all', [
                'conditions' => ['Branchs.id' => $request->getData("branch_id"), 'Branchs.status' => 1],
            ]);
            if ($result->count() > 0) {
                return $result->first()->busines_id;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getUserRoleByBranchID($request)
    {
        try {
            $result = $this->UserBranchs->find('all', [
                'conditions' => [
                    'UserBranchs.branch_id' => $request->getData("branch_id"),
                    'Branchs.status' => 1,
                    'UserBranchs.status' => 1,
                    'Roles.status' => 1,
                    'UserBranchs.user_id' => $request->getData("user_id")
                ],
                'contain' => ['Branchs', 'Roles']
            ]);
            if ($result->count() > 0) {
                return $result->first()->role_id;
            } else {
                return 0;
            }
        } catch (\Throwable $th) {
            return 0;
        }
    }
}
