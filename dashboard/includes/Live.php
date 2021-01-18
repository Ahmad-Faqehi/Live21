<?php

require_once("Database.php");
class Live extends Db_Object
{

    protected static $db_table = "matches";
    public static $db_table_fields = array('id', 'Channel_Name','Custom_Link','KS_URL','GA_URL','Team_Host','Team_Gust','Time_OFF','State_Match','Center_Ad');
    public $id;
    public $Channel_Name;
    public $Custom_Link;
    public $KS_URL;
    public $GA_URL;
    public $Team_Host;
    public $Team_Gust;
    public $Time_OFF;
    public $State_Match;
    public $Center_Ad;


    public function getMatchesOn(){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM matches WHERE State_Match = 1 ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function stopLive($id){
        global $conn;
        $stmt = $conn->prepare("UPDATE `matches` SET `State_Match`= 0 WHERE id = :id");
        $stmt->bindValue(":id",$id);
      return  $stmt->execute();
    }

    public function runLive($id){
        global $conn;
        $stmt = $conn->prepare("UPDATE `matches` SET `State_Match`= 1 WHERE id = :id");
        $stmt->bindValue(":id",$id);
      return  $stmt->execute();
    }

    public function updateTimeById($id){
        global $conn;
        $stmt = $conn->prepare("UPDATE `matches` SET `Time_OFF`= :time_off WHERE id = :id");
        $stmt->bindValue(":time_off",$this->Time_OFF);
        $stmt->bindValue(":id",$id);
      return  $stmt->execute();
    }









}