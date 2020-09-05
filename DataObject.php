<?php

class Data
{
    private $datas=array();

    public function __construct($datas)
    {
        foreach($datas as $key=>$value)
        {
            $this->datas[$key]=$value;
        }
    }

    public function getValue($field)
    {
        return $this->datas[$field];
    }



}

?>