<?php
ob_start();
session_start();
// Define directory separator
defined("DS") ? : define("DS", DIRECTORY_SEPARATOR);
// Define site root
//C:\xampp\htdocs\oop-cms
// defined("SITE_ROOT") ? : define("SITE_ROOT", "C:" .DS. "xampp" .DS. 'htdocs' .DS. "oop-cms");
defined("SITE_ROOT") ? : define("SITE_ROOT", "C:" .DS. "xampp" .DS. 'htdocs' .DS. "oop-cms");
// Define includes path
defined("INCLUDES_PATH") ? : define("INCLUDES_PATH", SITE_ROOT.DS."admin".DS."includes");
// define sub files of view part
defined("VIEW_PATH") ? : define("VIEW_PATH", INCLUDES_PATH . DS . 'view');
// define hostname to use
defined("HOST_NAME") ? : define("HOST_NAME", 'localhost');
// define upload directory
defined("UPLOAD_DIR") ? : define("UPLOAD_DIR", SITE_ROOT.DS."uploads");




require_once INCLUDES_PATH . DS . 'functions.php';
//require_once "vendor/autoload.php";
require_once INCLUDES_PATH . DS . 'classes' . DS . 'Database.php';

// require_once INCLUDES_PATH . DS . 'classes' . DS . 'Db_object.php';
// require_once INCLUDES_PATH . DS . 'classes' . DS . 'User.php';
// require_once INCLUDES_PATH . DS . 'classes' . DS . 'Session.php';







