<?php
namespace classes;
defined('SITE_ROOT') OR die("Access Denied!");
class Comment extends Db_object
{
    public static $db_table = "comments";
    public static $db_fields = array(
        'author', 'email', 'body', 'creation_date', 'post_id', 'status'
    );
    public static $auto_increment = "id";

    public $id;
    public $author;
    public $email;
    public $body;
    public $post_id;
    public $status;
    // Upload User Image properties
    //    public $upload_directory = "uploads".DS."posts";

    // End Upload User Image properties

    public static $time_column = "creation_date";
    // Helper Functions change_status
    public static function change_status ($id, $status) {
        global $database;
        return $database->do("update oop.".static::$db_table ." set status = ? where id = ?", [$status, $id]);
    }
    public static function find_all_approved_comments_by_post_id($post_id)
    {
        global $database;
        $sql = "select * from oop.". static::$db_table . " where post_id = ? and status = ?";
        return static::find_the_query($sql, [$post_id, 1]);
    }

}











