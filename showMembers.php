<?php

require_once("config.php");
require_once("DataObject.php");
session_start();

//starting row of datas for locating in html table
$start=isset($_GET["start"])? $_GET["start"] : 0;

//order of rows (according username,firstName,lastName)
$order=isset($_GET["order"])? $_GET["order"] : "username";

$sql="SELECT *FROM " . DB_TABLE . " ORDER by " . $order . " LIMIT :start, :size;";

try
{
    $conn=new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_PERSISTENT,true);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $st=$conn->prepare($sql);
    $st->bindValue(":start",$start,PDO::PARAM_INT);
    $st->bindValue(":size",PAGE_SIZE,PDO::PARAM_INT);

    $st->execute();

    $data=$st->fetchAll();

    //initializing user datas with help of Data class`s constructor
    foreach($data as $row)
    {
        $members[]=new Data($row);
    }

    //used for passing objects of Data class to showMember script
    $_SESSION["members"]=serialize($members);    
}
catch(PDOException $e)
{
    $conn="";
    die("An error occured:   " . $e->getMessage());
}

?>


                               <!-- HTML for describing datas in web page -->
<html>
    <head>
        <title>test</title>
    </head>
    <body>
        <table>
            <th>ID</th>
            <th><a href="showMembers.php?start=<?php echo $start ?>&amp;order=username">username</a></th>
            <th><a href="showMembers.php?start=<?php echo $start ?>&amp;order=firstName">firstName</a></th>
            <th><a href="showMembers.php?start=<?php echo $start ?>&amp;order=lastName">lastName</a></th>
            <?php
            $count=$start+1;
                foreach($members as $member)
                { ?>
                    <tr>
                        <td><a href="showMember.php?username=<?php echo $member->getValue("username") ?>"><?php echo $count ?></a></td>
                        <td><?php echo $member->getValue("username") ?></td>
                        <td><?php echo $member->getValue("firstName") ?></td>
                        <td><?php echo $member->getValue("lastName") ?></td>
                    </tr>
                    
                   <?php 
                   $count++;
                }
            ?> 
        </table>
        <a href="showMembers.php?start=<?php echo $start+PAGE_SIZE ?>&amp;order=<?php echo $order ?>">next page</a>
        <a href="showMembers.php?start=<?php echo ($start>=PAGE_SIZE)? ($start-PAGE_SIZE) : 0 ?>&amp;order=<?php echo $order ?>">previous page</a>
    </body>
</html>