<?php

declare(strict_types=1);

namespace App\Controller\Api\Common;
use App\Controller\AppController;
/**
 * Users Common Controller (functions)
 *
 */
//Code by Frank Donald Fontcha.

class UsersCommonController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel("Users");
        $this->loadModel("UserBranchs");
        $this->loadModel("Branchs");
        $this->loadModel("Business");
    }

    public function getUserByBranchs($request)
    {
        try {
            $conditions = [
                'UserBranchs.branch_id' => $request->getData("_user_branch_id"),
                'UserBranchs.status' => 1,
                'Branchs.busines_id' => $request->getData("business_id"),
                'Branchs.status' => 1
            ];

            // $result = $this->UserBranchs->find()->where($conditions)->contain(['Branchs']);
            $result = $this->UserBranchs->find("list", [
                'field' => ['user_id'],
                'conditions' => $conditions,
                'contain' => ['Branchs']
            ]);

            if($result && $result->count() > 0) {
                // $array_userid = [];
                // foreach($result->toArray() as $usr) {
                //     array_push($array_userid, $usr->user_id);
                // }
                return $result->toArray(); //$array_userid;
            }else{
                return null;
            }
        } catch(\Throwable $th) {
            return null;
        }
    }

    public function getBusinessOwnerByBranchId($request)
    {
        try {
            $result = $this->Branchs->find('all', [
                'fields' => ['Business.user_id'],
                'conditions' => ['Branchs.id' => $request->getData("_user_branch_id"), 'Branchs.status' => 1],
                'contain' => ['Business']
            ]);
            if($result->count() > 0) {
                $result = $result->toArray()[0];
                
                return $result;
            }
        } catch(\Throwable $th) {
            return 0;
        }
    }

    public function addUserToBranchs($_datas, $user_id) // add user to branchs when creating new user
    {
        // $this->request->allowMethod(["OPTIONS", "POST"]);

        $status = false;
        $message = "";
        $data = "";

        $all_branchs = $_datas;

        try {
            //code...
            // form data
            // name address check rules

            $nbr_saved = 0;

            foreach($all_branchs as $branch) {

                $empData = $this->UserBranchs->find()->where([
                    "user_id" => $user_id,
                    'branch_id' => $branch["branch_id"]
                ]);
    
                if ($empData->count() > 0) {
                    // already exists
                    $status = false;
                    $message .= "User already linked to the branch ".$branch["branch_id"]."; ";
                } else {
                    // insert new branch
                    $empObject = $this->UserBranchs->newEmptyEntity();
                    $branch["user_id"] = $user_id;
                    $empObject = $this->UserBranchs->patchEntity($empObject, $branch);
    
                    if ($rs = $this->UserBranchs->save($empObject)) {
                        // success response
                        $status = true;
                        $message .= " User has been added to the branch ".$branch["branch_id"]."; ";
                        $data = $rs;

                        $nbr_saved++;
                    } else {
                        // error response
                        $status = false;
                        $message = "Failed to add user to the branch";
                        $data = "";
                    }
                }
            }

            $result = [
                "status" => $status,
                "saved" => $nbr_saved,
                "message" => $message,
                "data" => $data
            ];

            return ($result);
        } catch (\Throwable $th) {
            //throw $th;
            $result = [
                "status" => false,
                "message" => $th
            ];

            return ($result);
        }
    }
}