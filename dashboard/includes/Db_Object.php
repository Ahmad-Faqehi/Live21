<?php


class Db_Object
{
    public function properties(){

        $prperties = array();
        foreach (static::$db_table_fields as $db_fields){

            if(property_exists($this,$db_fields )){

                $prperties[$db_fields] = $this->$db_fields;

            }

        }
        return $prperties;
    }

    protected function clean_properties() {
        global $conn;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
//            if($value || $value == "0")
                $clean_properties[$key] = $value;
        }
        return $clean_properties;
    }



    public function getById($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM " . static::$db_table . " WHERE id =:id ");
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getAll(){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM " . static::$db_table . " ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // Create new Row
    public function create(){

        $prperties= $this->clean_properties();
        $prperties_paris = array();

        foreach ($prperties as $key => $value){
//            if($value || $value == "0"):
//                if($key == "id"){continue;}
                $prperties_paris[] = ":$key";
//            endif;
        }


        global $conn;
        $stmt = $conn->prepare("INSERT INTO " . static::$db_table . " (" . implode(",",array_keys($prperties)) .  ") VALUES (" . implode(", " , $prperties_paris) . ")");
        foreach ($prperties as $key => $val){
//            if($key == "id"){continue;}
            $stmt->bindValue(':'.$key.'', $val);
        }
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    // Update the row
    public function update(){



        $prperties= $this->clean_properties();
        $prperties_paris = array();

        foreach ($prperties as $key => $value){

            if($key == "id"){continue;}
            $prperties_paris[] = "{$key} = :$key";

        }

        global $conn;
        $stmt = $conn->prepare("UPDATE " . static::$db_table . " SET " . implode(", ", $prperties_paris) . " WHERE id=:id ");
        foreach ($prperties as $key => $val){
            $stmt->bindValue(':'.$key.'', $val);
        }


        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function deleteById($id){
        global $conn;
        $stmt = $conn->prepare("DELETE FROM " . static::$db_table . " WHERE id =:id ");
        $stmt->bindValue(":id",$id);
        return $stmt->execute();
    }

}