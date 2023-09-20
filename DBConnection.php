<!--
    create database connection classs
    check current folder
    set host username pwd and database
-->
<?php
date_default_timezone_set('Asia/Manila');
if(!is_dir(__DIR__.'./db'))
    mkdir(__DIR__.'./db');
if(!defined('host')) define('host','localhost');
if(!defined('username')) define('username','root');
if(!defined('password')) define('password','');
if(!defined('database')) define('database','messaging_db');

// create a databse connection class and functions
// contains fxn is MobileDevice to determine device type
// function __Destruct to close connection
Class DBConnection {
    public $conn; // public variable connection
    function __construct(){
        $this->conn = new mysqli(host,username,password,database);
        if(!$this->conn){
            die("Database Connection Failed. Error: ".$this->conn->error);
        }

    }

    function isMobileDevice(){
        $aMobileUA = array(
            '/iphone/i' => 'iPhone', 
            '/ipod/i' => 'iPod', 
            '/ipad/i' => 'iPad', 
            '/android/i' => 'Android', 
            '/blackberry/i' => 'BlackBerry', 
            '/webos/i' => 'Mobile'
        );
    
        //Return true if Mobile User Agent is detected
        foreach($aMobileUA as $sMobileKey => $sMobileOS){
            if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
                return true;
            }
        }
        //Otherwise return false..  
        return false;
    }
    function __destruct(){
         $this->conn->close();
    }
}
//new instance of databse
$mydb = new DBConnection();
//connection variable
$conn = $mydb->conn;