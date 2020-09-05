<?php

require_once("Members.php");


//starting row of datas for locating in html table
$start=isset($_GET["start"])? $_GET["start"] : 0;

//order of rows (according username,firstName,lastName)
$order=isset($_GET["order"])? $_GET["order"] : "username";


$members=Members::getMembers($start,$order);

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