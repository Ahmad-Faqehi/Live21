<?php

require_once("Database.php");

class Equipe extends Db_Object
{
    protected static $db_table = "equipe";
    protected static $db_table_fields = array('id', 'fullTeamName');
    public $id;
    public $fullTeamName;


    public function getByTeamName($f){
        global $conn;
        $stmt = $conn->prepare("SELECT id FROM equipe WHERE fullTeamName=:team ");
        $stmt->bindValue(":team",$f);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }

    }
    public function updateByid($id){
        global $conn;
        $stmt = $conn->prepare("UPDATE `equipe` SET `fullTeamName`=:teamName WHERE id=:id");
        $stmt->bindValue(":teamName",$this->fullTeamName);
        $stmt->bindValue(":id",$id);
        return  $stmt->execute();
    }

}