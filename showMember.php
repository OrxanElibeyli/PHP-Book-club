<?php

//require_once("config.php");




if(isset($_GET["username"]))
{
    session_start();
    require_once("DataObject.php");

    $member=unserialize($_SESSION["member"]);
    //print_r($member);

    showMemberInfo($member);
}

?>

<table>
    
    <?php
      function showMemberInfo($member)
      {
        ?>
            <table>
                <tr>
                    
                    <th>username</th>
                    <th>firstName</th>
                    <th>lastName</th>
                    <th>password</th>
                    <th>age</th>
                    <th>specialty</th>
                </tr>
                <tr><td><?php echo $member->getValue("username") ?></td>
                <td><?php echo $member->getValue("firstName") ?></td>
                <td><?php echo $member->getValue("lastName") ?></td>
                <td><?php echo $member->getValue("password") ?></td>
                <td><?php echo $member->getValue("age") ?></td>
                <td><?php echo $member->getValue("specialty") ?></td></tr>
            </table>
            
            <?php
        
      }
      
    ?>

</table>