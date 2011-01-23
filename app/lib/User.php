<?php

class User 
{
    public function isAuthorized()
    {
        return $_SESSION['login'];
    }
    public function register($params)
    {
        App::getInstance()->getDbConnection()->addUser($params); 
    }

    public function signin($params)
    {
        if($user = App::getInstance()->getDbConnection()->getUser($params)) {
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id'];

            return true;
        }

        return false;
    }

    public function signout()
    {
        unset($_SESSION['login']); 
        unset($_SESSION['user_id']); 
    }
}
