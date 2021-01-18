<?php

require_once("Database.php");

class ProLinks extends Db_Object
{
    protected static $db_table = "links";
    protected static $db_table_fields = array('id', 'url', 'channel');
    public $id;
    public $url;
    public $channel;

    public function getAllChannel(){
            global $conn;
            $stmt = $conn->prepare("SELECT * FROM " . self::$db_table . " ORDER BY `links`.`channel` ASC ");
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
    }

}