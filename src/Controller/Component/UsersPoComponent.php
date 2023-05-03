<?php

declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * Users component
 */
class UsersPoComponent extends Component
{
    public function passwordValidator($password)
    {
        if ($password) {
            if (
                preg_match('@[A-Z]@', $password) &&
                preg_match('@[a-z]@', $password) &&
                preg_match('@[0-9]@', $password) &&
                preg_match('@[^\w]@', $password)
            ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function passSecurity($pass)
    {
        return crypt($pass, '#!Frank@2020');
    }

    public function checkPassSecurity($pass, $hash)
    {
        return password_verify($pass, $hash);
    }
}
