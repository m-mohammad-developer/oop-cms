<?php
namespace classes;
defined('SITE_ROOT') OR die("Access Denied!");
class Post extends Db_object
{
    /** Properties */
    public static $db_table = "posts";
    public static $db_fields = array(
        'title', 'content', 'photo', 'status', 'user_id', 'cat_id', 'tags', 'description'
    );
    public static $auto_increment = "id";

    public $id;
    public $title;
    public $content;
    public $photo;
    public $status;
    public $user_id;
    public $cat_id;
    public $tags;
    public $description;
    // To save and read date in database
    public static $time_column = "creation_date";
    // Setting properties for moving file
    public $file_name;
    public $file_size;
    public $file_type;
    public $file_tmp_path;

    // Uploading Errors

    public $upload_directory = "uploads".DS."posts";

    public $errors = array();
    public $upload_errors = array(

        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "File size is too bigger than upload_max_filesize ",
        UPLOAD_ERR_FORM_SIZE => "File size is too bigger than max_file_size",
        UPLOAD_ERR_PARTIAL => "File was only partialy uploaded",
        UPLOAD_ERR_NO_FILE => "No File was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temparory folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write on disk",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"

    );

    /** Methods */
    public function creation_date()
    {
        global $database;
        $sql = "SELECT ". static::$time_column ." FROM oop.". static::$db_table ." WHERE ". static::$auto_increment ." = ?";
        $time = $database->select($sql, [$this->id], 'fetch');
        return array_shift($time);

    }

    public static function change_status ($id, $status) {
        global $database;
        return $database->do("update oop.".static::$db_table ." set status = ? where id = ?", [$status, $id]);
    }

    public function get_photo_path()
    {
        return $this->upload_directory. DS .$this->photo;
    }

    public function have_photo() {

        return isset($this->photo);
    }

    public function post_user()
    {
        return User::find_by_id($this->user_id);
    }

    public function set_post_photo($photo) {
        // $photo : $_FILES['name']
        if (empty($photo) || !is_array($photo) || !$photo) {

            $this->errors[] = "No file was uploaded";
            return false;

        } else if($photo['error'] != 0) {
            $this->errors[] = $this->upload_errors[$photo['error']];
            return false;
        } else {

            $this->file_name = $photo['name'];
            $this->file_size = $photo['size'];
            $this->file_type = $photo['type'];
            $this->file_tmp_path = $photo['tmp_name'];

            $this->photo = $this->file_name;

            return true;
        }

    }


    public function save_with_photo()
    {

//        if ($this->file_type != "image/jpeg") {
//            $this->errors[] = "You can just upload photo with JPG Extension";
//            return false;
//        }

        $target_path = SITE_ROOT . DS . $this->upload_directory;

//        $file_name = rand(1,1000) . "_" . rand(1000, 2000) . ""



        if (!isset($this->id)) {

            if (!isset($this->file_name) || !isset($this->file_tmp_path)) {
                $this->errors[] = "The Photo is not available";
                return false;
            }

            if (!empty($this->errors)) {
                return false;
            }

            if (move_uploaded_file($this->file_tmp_path, $target_path . DS . $this->file_name)) {

                if ($this->create()) {
                    unset($this->file_tmp_path);
                    return true;
                }

            } else {
                $this->errors[] = "The file directory probably does not have permissions";
                return false;
            }

        } else {
            if (isset($this->file_name)  && isset($this->file_tmp_path)) {

                move_uploaded_file($this->file_tmp_path, $target_path . DS . $this->file_name);
            }

            if ($this->update()) {
                unset($this->file_tmp_path);
                return true;
            }

        }
    }

    public function delete_photo()
    {
        $target_path = SITE_ROOT . DS . $this->upload_directory . DS . $this->photo;

        if (unlink($target_path)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_with_photo()
    {
        $this->delete_photo();
        $this->delete();
    }

}