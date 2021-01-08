<?php

require_once ("DataBase1");
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











}