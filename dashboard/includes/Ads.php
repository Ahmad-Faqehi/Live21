<?php
require_once("Database.php");

class Ads extends Db_Object
{

    protected static $db_table = "ads";
    protected static $db_table_fields = array('id', 'Ads_Name','Ads_Code','Ads_Work');
    public $id;
    public $Ads_Name;
    public $Ads_Code;
    public $Ads_Work;

//    public function showAd($id){
//
//        global $conn;
//        $stmt = $conn->prepare("SELECT * FROM ads WHERE id=:id");
//        $stmt->bindValue(":id",$id);
//        $stmt->execute();
//        if ($stmt->rowCount() !== 0):
//            $row = $stmt->fetch();
//            $this->ads_code = $row["Ads_Code"];
//            $this->ads_name = $row["Ads_Name"];
//            $this->ads_work = $row["Ads_Work"];
//            $this->ads_id = $row["id"];
//
//            endif;
//    }

 //   public function editAd($id){
        //global $conn;
//        $stmt = $conn->prepare("SELECT * FROM ads WHERE id=:id");
//        $stmt->bindValue(":id",$id);
//        $stmt->execute();
//        return $this->ads_name;
//    }

//    public function getAllAds(){
//        global $conn;
//         $stmt = $conn->prepare("SELECT * FROM ads ");
//          $stmt->execute();
//         $result = $stmt->fetchAll();
//         return $result;
//    }
}