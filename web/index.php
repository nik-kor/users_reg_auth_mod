<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once dirname(__FILE__) . '/../app/App.php';

try {
    App::getInstance()->init()->run($_REQUEST['action']);
} catch(Exception $e) {
    echo '<b>Something wrong: </b>';
    echo $e->getMessage();
}
