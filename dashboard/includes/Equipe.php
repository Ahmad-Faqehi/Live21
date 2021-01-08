<?php

require_once ("DataBase1");

class Equipe extends Db_Object
{
    protected static $db_table = "equipe";
    protected static $db_table_fields = array('id', 'fullTeamName');
    public $id;
    public $fullTeamName;

}