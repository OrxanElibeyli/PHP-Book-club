<?php


require_once("DataObject.php");
class Members extends Data
{
    
    //hold objects of itself
    private $members=array();

    //return wanted members(object)
    public static function getMembers($start,$order)
    {
        global $members;
        $conn=parent::connectDataBase();
        $sql="SELECT *FROM " . DB_TABLE . " ORDER by " . $order . " LIMIT :start, :size;";
        try
        {
            $st=$conn->prepare($sql);
            $st->bindValue(":start",$start,PDO::PARAM_INT);
            $st->bindValue(":size",PAGE_SIZE,PDO::PARAM_INT);

            $st->execute();

            $data=$st->fetchAll();

            //initializing user datas with help of Data class`s constructor
            foreach($data as $row)
            {
                $members[]=new Members($row);
            }

            parent::disconnect();

            return $members;
        }
        catch(PDOException $e)
        {
            parent::disconnect();
            die("An error occured:  " . $e->getMessage());
        }

        
    }

    //return wanted member(object)
    public static function getMember($username)
    {
        $conn=parent::connectDataBase();

        $sql="SELECT *FROM " . DB_TABLE . ";";

        try
        {
            $st=$conn->prepare($sql);
            $st->execute();

            $data=$st->fetchAll();

            foreach($data as $row)
            {
                $members[]=new Members($row);
            }

            parent::disconnect();

            
        }
        catch(PDOException $e)
        {
            parent::disconnect();
            die("An error occured:  " . $e->getMessage());
        }

        foreach($members as $member)
        {
            if($member->getValue("username")==$username) return $member;
        }
    }
}




?>

