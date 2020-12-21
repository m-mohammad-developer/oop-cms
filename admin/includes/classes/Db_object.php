<?php
namespace classes;


class Db_object
{

    public static $db_table = "users";
    public static $db_fields = array(
        'username', 'password', 'email', 'password', 'first_name', 'last_name', 'role', 'about'
    );
    public static $auto_increment = "id";



    // To save and read date in database
    public static $time_column = "register_date";




    // Upload Photo section properties


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




    // End Upload Photo section properties

























    // Helper Functions

    public function creation_date()
    {
        global $database;

        $sql = "SELECT ". static::$time_column ." FROM oop.". static::$db_table ." WHERE ". static::$auto_increment ." = ?";

        $time = $database->select($sql, [$this->id], 'fetch');

        return array_shift($time);

    }



    // End Helper Functions



    public static function find_all() {
        $sql = "SELECT * FROM oop.". static::$db_table;
        return static::find_the_query($sql);
    }

    public static function find_all_where(array $arr) {
        $array = [];
        foreach ($arr as $key => $val) {
            $array[] = "$key = ?";
        }
        $sql = "SELECT * FROM oop.". static::$db_table . " WHERE " . implode(" and ", array_values($array)) ;
        return static::find_the_query($sql, array_values($arr));
    }



    public static function find_by_id($id)
    {
        $sql = "SELECT * FROM oop.". static::$db_table ." WHERE ". static::$auto_increment ." = ? LIMIT 1";
        $result = static::find_the_query($sql, [$id], 'fetch');
        return !empty($result) ? array_shift($result) : false;
    }

    public static function find_the_query($sql, $values = [], $type = "fetchAll")
    {
        global $database;

        $result_set = $database->select($sql, $values, $type);
        $the_object_array = [];
        if ($result_set) {
            if ($type == "fetchAll") {
                foreach ($result_set as $row) {
                    $the_object_array[] = static::instanstation($row);
                }
            } else {
                $the_object_array[] = static::instanstation($result_set);
            }
            return $the_object_array;

        }
        return false;

    }


    protected function instanstation($db_row)
    {
        $calling_class = get_called_class();
        $object = new $calling_class;
        foreach ($db_row as $attribute => $value) {

            if($object->has_the_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;

    }

    public function has_the_attribute($attribute)
    {
        $properties = get_object_vars($this);
        return array_key_exists($attribute, $properties);
    }




    protected function properties()
    {
        global $database;
        $properties = array();
        foreach (static::$db_fields as $db_field) {

            if(property_exists($this, $db_field)) {
                $properties[$db_field] = $database->escape($this->$db_field);
            }
        }
        return $properties;
    }





    public function create()
    {
        global $database;
        $sql = "INSERT INTO oop.". static::$db_table ." SET ";
        $sql .= implode('=?,', array_keys($this->properties())) ."=?";
        $result = $database->do($sql, array_values($this->properties()));
        if ($result) {
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $values_array = array_values($this->properties());
        array_push($values_array, $this->id);
        $sql = "UPDATE oop.". static::$db_table ." SET ";
        $sql .= implode('=?,', array_keys($this->properties())) ."=? WHERE " . static::$auto_increment . "=?";
        $result = $database->do($sql, $values_array, 'update');
        if($result)
        {
            return true;
        } else {
            return  false;
        }
    }


    public function delete()
    {
        global $database;
        $sql = "DELETE FROM oop.". static::$db_table. " WHERE ". static::$auto_increment ." =?";
        $result = $database->do($sql, [$this->id], 'delete');
        return $result;
    }




    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }





    // Photo Uploading methods

    public function get_photo_path()
    {
        return $this->upload_directory. DS .$this->photo;
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


    // End Photo uploading methods










}











