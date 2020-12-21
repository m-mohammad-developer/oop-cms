<?php

function redirect($location)
{
    header("Location: ". $location);
}


function auto_loader($classname)
{

    // classes/classname

    $level1 = explode('\\', $classname);
    $level2 = implode('/', $level1);
    $level2 = strtolower($level2);

    $location = INCLUDES_PATH .DS. $level2 . ".php";

    if (is_file($location) && file_exists($location)) {
        require_once $location;
    } else {
        echo "Problem with loading : " . $classname;
    }




}


spl_autoload_register('auto_loader');
