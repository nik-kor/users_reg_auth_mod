<?php
class ActionController
{
    public function __construct()
    {
        $this->db = App::getInstance()->getDbConnection();
        $this->user = App::getInstance()->getUser();
    }

    public function Logout()
    {
        $this->user->signout();
        $this->getView('logout');
    }

    public function Login()
    {
        if($this->user->isAuthorized()) {
            $this->forwardTo('ModifyRegister');
        }
        if($_POST['Submit']) {
            $formValidator = new FormValidator();
            $_POST['email'] = $formValidator->getSafetyValue($_POST['email']);
            $_POST['password'] = $formValidator->getSafetyValue($_POST['password']);
            if($this->user->signin($_POST)) {
                $this->forwardTo('ModifyRegister');
            }  
            $errors = 'Please try again';
        }
        $this->getView('login', array('errors' => $errors));
    }

    public function Register()
    {
        if($this->user->isAuthorized()) {
            $this->getView('alreadyRegister');
            return true;
        }
        
        $formValidator = new FormValidator;
        if($_POST['Submit']) {
            $_POST['password'] = $formValidator->getSafetyValue($_POST['password']);
            $_POST['email'] = $formValidator->getSafetyValue($_POST['email']);
            $_POST['password_again'] = $formValidator->getSafetyValue($_POST['password_again']);

            if($formValidator->checkEmail($_POST['email']) && 
                $formValidator->checkPassword($_POST['password'], $_POST['password_again'])) {

                $this->user->register($_POST);
                $this->user->signin($_POST);

                $this->forwardTo('ModifyRegister');
            }  
        }

        $this->getView('register', array('registerParams' => new RegisterParams(), 'errors' => $formValidator->getErrors()));
    }
    
    public function ModifyRegister()
    {
        if($this->user->isAuthorized()) {
            $user = $this->db->getUserById($_SESSION['user_id']);

            $this->getView('modifyRegister', array('user' => $user));
        } else {
            $this->forwardTo('Login');
        }
    }
    
    private function forwardTo($action)
    {
        header('location: /?action=' . $action);
    }

    private function getView($viewName, $values = array())
    {
        require_once App::getInstance()->getAppDir() . '/view/' . $viewName . 'Page.php';
    }

}
