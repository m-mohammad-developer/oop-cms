<?php
namespace classes;
defined('SITE_ROOT') OR die("Access Denied!");
class Cat extends Db_object
{   
    /** Properties */
    public static $db_table = "categories";
    public static $db_fields = array(
        'title', 'description'
    );
    public static $auto_increment = "id";


    public $id;
    public $title;
    public $description;


}