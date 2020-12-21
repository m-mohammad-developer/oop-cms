<?php
namespace classes;


class User extends Db_object
{

    public static $db_table = "users";
    public static $db_fields = array(
        'username', 'password', 'email', 'password', 'first_name', 'last_name', 'role', 'about'
    );
    public static $auto_increment = "id";

    public $id;
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $role;
    public $about;



    // Upload User Image properaties
    public $upload_directory = "uploads".DS."posts";

    // End Upload User Image properaties


    // Password Encryption
    public $pass_randsalt = "IwillFuckYouIfyouTryto";
    public $pass_options = [
        'cost' => 12,
    ];


    public static $time_column = "register_date";


    // Helper Functions

    public function encrypt_pass()
    {
        if (isset($this->password)) {
            $this->password = password_hash($this->password,PASSWORD_DEFAULT, $this->pass_options);
        } else {
            return false;
        }
    }

    public function verify_pass($pass) {
        if (isset($this->id) && isset($this->password)) {
            return password_verify($pass, $this->password);
        }
    }

    private static function isUsernameExists($user) 
    {
        $users = static::find_all_where(['username' => $user]);
        if ($users) return true;
        return false;
    }

    private static function isEmailExists($email) 
    {
        $users = static::find_all_where(['email' => $email]);
        if ($users) return true;
        return false;
    }
    /*
    $id;
    public $username;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $role;
    public $about;
    */

    public function register(string $username, string $email, string $password = null, string $first_name = null, string $last_name = null, string $role = null, string $about = null)
    {

        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->encrypt_pass();
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->role = $role;
        $this->about = substr($about, 0, 255);

        if (static::isUsernameExists($this->username)) return false;
        if (static::isEmailExists($this->email)) return false;

        return ($this->save()) ? true : false;


    }














}











