<?php

require_once("config.php");

//common data class used for construct user datas and getting spesific field (username,age and etc)
abstract class Data
{
    //array that contain user datas
    protected $datas=array();

    //constructor for initializing user datas to array
    public function __construct($datas)
    {
        foreach($datas as $key=>$value)
        {
            $this->datas[$key]=$value;
        }
    }

    //function for getting spesific user data
    public function getValue($field)
    {
        return $this->datas[$field];
    }

    //connecting to database
    protected function connectDataBase()
    {
        try
        {
            $conn=new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
            $conn->setAttribute(PDO::ATTR_PERSISTENT,true);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e)
        {
            $conn="";
            die("An error occured:   " . $e->getMessage());
        }

        
    }

    protected function disconnect()
    {
        $conn="";        //?????????????
    }
}

?>