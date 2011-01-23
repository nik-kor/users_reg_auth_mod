<?php
function my_autoload($className)
{
    if(is_file(dirname(__FILE__) . '/lib/' . $className . '.php')) {
        require_once dirname(__FILE__) . '/lib/' . $className . '.php';
    } 
 

}

spl_autoload_register("my_autoload");
