<?php

class App 
{
    protected static $instance;
    protected $config;
    protected $appDir;
    protected $db;

    private function __construct() 
    {
    
    }

    private function __clone(){}

    public function getInstance()
    {
        return (self::$instance === null) ? 
                                        self::$instance = new self() :
                                        self::$instance;
    }



    public function init() 
    {
        session_start();
        if(!$this) {
            throw new Exception('App: Invalid usage');
        }

        require_once dirname(__FILE__) . '/../config/config.php';
        $this->config = $configParams;

        require_once dirname(__FILE__) . '/autoloader.php';
        require_once dirname(__FILE__) . '/lib/rfc822.php';
        
        $this->appDir = dirname(__FILE__);
        $this->db = new DBConnection($this->config['db']);

        $this->user = new User;

        return $this;
    }

    public function run($action = '')
    {
        if(!$this) {
            throw new Exception('App: Invalid usage');
        }

        if(!$action) {
            $action = $this->config['default_action'];
        }

        if(!in_array($action, $this->config['actions'])) {
            throw new Exception('App: action  ' . $action . ' does not exist');
        }

        $controller = new ActionController();
        $controller->$action();

    }

    public function getAppDir() 
    {
        return $this->appDir;
    }

    public function getDbConnection()
    {
        return $this->db;
    }

    public function getUser()
    {
        return $this->user;
    }
}
