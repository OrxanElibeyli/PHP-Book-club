<?php

//common data class used for construct user datas and getting spesific field (username,age and etc)
class Data
{
    //array that contain user datas
    private $datas=array();

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
}

?>