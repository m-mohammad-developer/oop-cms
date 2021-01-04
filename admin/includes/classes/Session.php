<?php
namespace classes;

class Session  {

    public $user_info = array();





    public function login ($username, $password) {

        global $database;

        $sql = 'select * from oop.users where username = ? limit 1';

        $user = $database->pdo->prepare($sql);
        $user->bindValue(1, $database->escape($username));

        $user->execute();

        $user = $user->fetch(\PDO::FETCH_OBJ);

        if ($user) {
            if (password_verify($password, $user->password)) {

                $this->user_info = [
                    'id' => $user->id ,
                    'first_name' => $user->first_name ,
                    'last_name' => $user->last_name ,
                    'username' => $user->username ,
                    'email' => $user->email ,
                    'access' => $user->role
                ];

                $_SESSION['user_info'] = $this->user_info;
                return true;

            } else {
                return false;
            }
        }

        return false;

    }



    public function set_message(string $name, string $message)
    {
        global $database;
        $_SESSION['messages'][$name] = $database->escape($message);
        if ($_SESSION['messages'][$name]) return true;
        return false;
    }



    public function check_for_message(string $name)
    {
        //session_start();
        return @$_SESSION['messages'][$name];
        
    }
    // public function get_message($name) {
    //     if ($_SESSION['m'])
    // }
    public function have_any_message()
    {
        return @$_SESSION['messages'] ? true : false;
    }

    public function remove_message(string $name) {

        if (isset($_SESSION['messages'][$name])) 
        {
            unset($_SESSION['messages'][$name]);
        }
    }

    public function get_all_meassges()
    {
        return @$_SESSION['messages'];
    }



    // setting costume messages by SESSION

    public function set_custom_msg($name, $msg)
    {
        global $database;
        $_SESSION[$name] = $database->escape($msg);
    }

    public function check_for_custom_message(string $name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
    }

    

    public function remove_custom_message(string $name) {

        if (isset($_SESSION['messages'][$name])) 
        {
            unset($_SESSION['messages'][$name]);
        }
    }



}

