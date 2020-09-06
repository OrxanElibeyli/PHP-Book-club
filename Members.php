<?php


require_once("DataObject.php");
class Members extends Data
{
    
    //hold objects of itself
    private $members=array();

    //return wanted members(object)

    private function getDatas($order)
    {

    }

    public static function getMembers($start,$order,$specialty)
    {
        global $members;
        $conn=parent::connectDataBase();

        if($specialty!="") $sql='SELECT * FROM ' . DB_TABLE . ' WHERE specialty="' . $specialty . '" ORDER by ' . $order . ' LIMIT :start, :size;';
        else $sql='SELECT *FROM ' . DB_TABLE . ' ORDER by ' . $order . ' LIMIT :start, :size;';
        //echo $sql;
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

