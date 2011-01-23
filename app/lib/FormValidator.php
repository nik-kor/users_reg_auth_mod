<?php

class FormValidator
{
    public $errors = '';

    public function __construct(){}


    public function getErrors()
    {
        return $this->errors;
    }

    public function checkEmail($email)
    {
        if(!$email) {
            $this->errors = 'Email is required<br/>';

            return false;
        }

        if(!is_valid_email_address($email)) {
            $this->errors = 'Incorrect email<br/>';

            return false;
        }

        if($this->isEmailExists($email)) {
            $this->errors = 'This is email is already exists<br/>';

            return false;
        }
    
        return true;
    }
    
    public function getSafetyValue($value)
    {
        $value = trim($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    private function isEmailExists($email)
    {
        return App::getInstance()->getDbConnection()->isEmailExists($email);
    }

    public function checkPassword($password, $password_again)
    {
        if(strlen($password) < 6 || strlen($password) > 10) {
            $this->errors = 'Password must be greater or equal as 6 and less or equal as 10<br/>';
            
            return false;
        }

        if( $password != $password_again) {
            $this->errors = 'Passwords must be equal<br/>';

            return false;
        } 

        return true;
    }
}
