<?php

require_once("Members.php");

if(isset($_GET["username"]))
{
    $member=Members::getMember($_GET["username"]);
    
    showMemberInfo($member);
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