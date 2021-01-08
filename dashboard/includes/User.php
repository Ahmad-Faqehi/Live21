<?php

require_once ("DataBase1");
class User extends Db_Object
{
    protected static $db_table = "users";
    protected static $db_table_fields = array('id', 'Username','Password','Roal','Email','Time_Registered');
    public $id;
    public $Username;
    public $Password;
    public $Roal;
    public $Email;
    public $Time_Registered;


    public function getByUsername($f){
        global $conn;
        $stmt = $conn->prepare("SELECT id, password, Username FROM users WHERE email=:email_user ");
        $stmt->bindValue(":email_user",$f);
        $stmt->execute();
        $result = $stmt->fetch();
        if($stmt->rowCount() > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getByEmail($f){
        global $conn;
        $stmt = $conn->prepare("SELECT id, password, Username FROM users WHERE username=:email_user ");
        $stmt->bindValue(":email_user",$f);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($stmt->rowCount() > 0){
            return $result;
        }else{
            return false;
        }

    }

}