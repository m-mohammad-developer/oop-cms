<?php
namespace classes;

use PDOException;

require_once(INCLUDES_PATH .DS. 'configuration' .DS. "config.php");

class Database
{
    /** Properties */
    private $db_user;
    private $db_pass;
    private $db_host;
    private $db_name;
    private $options;
    public $pdo;


    /** Methods */
    public function __construct()
    {
        $this->db_user = DATABASE_INFO['USER'];
        $this->db_pass = DATABASE_INFO['PASS'];
        $this->db_host = DATABASE_INFO['HOST'];
        $this->db_name = DATABASE_INFO['NAME'];
        $this->options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING
        );
        try {
            $this->pdo = new \PDO("mysql:host=".$this->db_host.";db_name=".$this->db_name.";", $this->db_user,$this->db_pass, $this->options);
        } catch (\PDOException $e) {
            die("Database Conection Failed :: " . $e->getMessage());
        }
    }

    public function do($sql, $values = [], $type = "insert")
    {
        $result = $this->pdo->prepare($sql);
        foreach ($values as $key => $value) {
            $result->bindValue($key + 1, $value);
        }
        $result->execute();
        if($type == "insert")
        {
            return $result ? true : false;
        } else {
            return $result->rowCount() >= 1;
        }

    }

    public function select($sql, $values =[], $type = "fetchAll")
    {
        $result = $this->pdo->prepare($sql);
        foreach ($values as $key => $value) {
            $result->bindValue($key + 1, $value);
        }
        $result->execute();
        if ($result) {
            if ($type == "fetchAll") {
                return $result->fetchAll(\PDO::FETCH_ASSOC);
            } else {
                return $result->fetch(\PDO::FETCH_ASSOC);
            }
        } else {
            return false;
        }


    }


    public function the_insert_id()
    {
        return $this->pdo->lastInsertId();
    }


    public function escape($item)
    {

        return (htmlspecialchars(htmlentities(trim($item))));


    }

}
