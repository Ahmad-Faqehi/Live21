<?php

require_once("Database.php");
class Links extends Db_Object
{

    protected static $db_table = "custom_links";
    protected static $db_table_fields = array('id', 'Link1','Link2','Link3','Type_Link1','Type_Link2','Type_Link3');
    public $id;
    public $Link1;
    public $Link2;
    public $Link3;
    public $Type_Link1;
    public $Type_Link2;
    public $Type_Link3;

//    public function getLinkById($id){
//
//        global $conn;
//        $stmt = $conn->prepare("SELECT * FROM custom_links WHERE id =:id ");
//        $stmt->bindValue(":id",$id);
//        $stmt->execute();
//        $result = $stmt->fetchAll();
//        return $result;
//
//    }
//
    public function setLink(){
        global $conn;
        $stmt = $conn->prepare("INSERT INTO `custom_links`(`Link1`, `Link2`, `Link3`, `Type_Link1`, `Type_Link2`, `Type_Link3`)
                                VALUES ('$this->Link1','$this->Link2','$this->Link3','$this->Type_Link1','$this->Type_Link2','$this->Type_Link3') ");
        if($stmt->execute()){
          return  $conn->lastInsertId();
        }
    }
}