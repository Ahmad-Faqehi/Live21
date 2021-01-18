<?php

require_once("Database.php");
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


    public function getByEmail($f){
        global $conn;
        $stmt = $conn->prepare("SELECT id, password, Username FROM users WHERE email=:email_user ");
        $stmt->bindValue(":email_user",$f);
        $stmt->execute();
        $result = $stmt->fetch();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getByUsername($f){
        global $conn;
        $stmt = $conn->prepare("SELECT id, password, Username FROM users WHERE username=:email_user ");
        $stmt->bindValue(":email_user",$f);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }

    public function updateUserById($id){
        global $conn;
        $stmt = $conn->prepare("UPDATE `users` SET Username = :username, Email = :email, Roal = :roal WHERE id = :id");
        $stmt->bindValue(":username",$this->Username);
        $stmt->bindValue(":email",$this->Email);
        $stmt->bindValue(":roal",$this->Roal);
        $stmt->bindValue(":id",$id);
       return $stmt->execute();
    }

    public function updateUserWithPsssById($id){
        global $conn;
        $stmt = $conn->prepare("UPDATE `users` SET Username = :username, Email = :email, Roal = :roal, Password = :pass WHERE id = :id");
        $stmt->bindValue(":username",$this->Username);
        $stmt->bindValue(":email",$this->Email);
        $stmt->bindValue(":roal",$this->Roal);
        $stmt->bindValue(":pass",$this->Password);
        $stmt->bindValue(":id",$id);
        return$stmt->execute();
    }

}