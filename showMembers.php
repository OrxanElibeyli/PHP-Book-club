<?php

require_once("Members.php");

//$specialty=isset($_POST["specialty"])? $_POST["specialty"] : "";

//starting row of datas for locating in html table
$start=isset($_GET["start"])? $_GET["start"] : 0;

//order of rows (according username,firstName,lastName)
$order=isset($_GET["order"])? $_GET["order"] : "username";

$specialty=isset($_GET["specialty"]) ? $_GET["specialty"] : "";


$members=Members::getMembers($start,$order,$specialty);

?>
<html>
    <head>
        <title>test</title>
    </head>
    <body>
        <table>
            <th>ID</th>
            <th><a href="showMembers.php?start=<?php echo $start ?>&amp;specialty=<?php echo $specialty ?>&amp;order=username">username</a></th>
            <th><a href="showMembers.php?start=<?php echo $start ?>&amp;specialty=<?php echo $specialty ?>&amp;order=firstName">firstName</a></th>
            <th><a href="showMembers.php?start=<?php echo $start ?>&amp;specialty=<?php echo $specialty ?>&amp;order=lastName">lastName</a></th>
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
        <a href="showMembers.php?start=<?php echo $start+PAGE_SIZE ?>&amp;specialty=<?php echo $specialty ?>&amp;order=<?php echo $order ?>">next page</a>
        <a href="showMembers.php?start=<?php echo ($start>=PAGE_SIZE)? ($start-PAGE_SIZE) : 0 ?>&amp;specialty=<?php echo $specialty ?>&amp;order=<?php echo $order ?>">previous page</a>
        <br><br>
        <form action="showMembers.php?specialty=<?php echo $specialty ?>" method="get">

            <label>Enter interest</label>
            <input type="text" name="specialty">
            <input type="submit" name="submit" value="search">
            
        </form>
    </body>
</html>