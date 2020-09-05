<?php

if(isset($_GET["username"]))
{
    session_start();
    require_once("DataObject.php");

    //objects of Data class
    $members=unserialize($_SESSION["members"]);

    //used for finding wanted object
    foreach($members as $member)
    {
        if($_GET["username"]==$member->getValue("username"))
        {
            showMemberInfo($member);
        }
    }
}

?>
                             <!-- HTML for describing datas of wanted user -->
<table>   
    <?php
      function showMemberInfo($member)
      {?>
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