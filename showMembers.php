<?php


echo session_id();

require_once("config.php");
require_once("DataObject.php");
session_start();




if(isset($_GET["start"]))
{
    $start=$_GET["start"];
}
else
{
    $start=0;
}


if(isset($_GET["order"]))
{
    $order=$_GET["order"];
}
else
{
    $order="username";
}

$sql="SELECT *FROM " . DB_TABLE . " ORDER by " . $order . " LIMIT :start, :size;";

try
{
    $conn=new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_PERSISTENT,true);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $st=$conn->prepare($sql);
    //$st->bindValue(":order",$order,PDO::PARAM_STR);
    $st->bindValue(":start",$start,PDO::PARAM_INT);
    $st->bindValue(":size",PAGE_SIZE,PDO::PARAM_INT);

    $st->execute();

    $data=$st->fetchAll();

    foreach($data as $row)
    {
        global$members;
        $members[]=new Data($row);
    }

    //$_SESSION["members"]=array();
    //$_SESSION["members"]=serialize($members);
    //print_r($_SESSION["members"]);
    //session_write_close();
    
}
catch(PDOException $e)
{
    $conn="";
    die("An error occured:   " . $e->getMessage());
}

function passData($member)
{
    $_SESSION["member"]=serialize($member);
    //session_write_close();
    return $member->getValue("username");
}


?>

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
                        <td><a href="showMember.php?username=<?php echo passData($member) ?>"><?php echo $count ?></a></td>
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