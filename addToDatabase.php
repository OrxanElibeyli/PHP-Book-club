<?php

//this script is used for adding members to database

require_once("config.php");

$datas=array(
    "username"   => "",
    "firstName"  => "",
    "lastName"   => "",
    "password"   => "",
    "age"        => "",
    "specialty"  => ""
);

foreach($datas as $key=>$value)
{
    $datas[$key]=readline();
}

$sql="INSERT INTO ". DB_TABLE . " (username,firstName,lastName,password,age,specialty) VALUES(:username,:firstName,:lastName,:password,:age,:specialty)";

try
{
    $conn=new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_PERSISTENT,true);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $ss=$conn->prepare($sql);
    $ss->bindValue(":username",$datas["username"]);
    $ss->bindValue(":firstName",$datas["firstName"]);
    $ss->bindValue(":lastName",$datas["lastName"]);
    $ss->bindValue(":password",$datas["password"]);
    $ss->bindValue(":age",$datas["age"]);
    $ss->bindValue(":specialty",$datas["specialty"]);

    $ss->execute();
}
catch(PDOException $e)
{
    if($conn) $conn="";
    die("an error occured: " . $e->getMessage());
}

?>