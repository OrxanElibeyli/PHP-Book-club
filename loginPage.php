<?php



$missingFields=array();
$datas=array();

if(isset($_POST["submit"]))
{
    if(isset($_POST["username"]) && $_POST["username"]!="") $datas["username"]=$_POST["username"];
    else $missingFields["username"]="username";

    if(isset($_POST["password"]) && $_POST["password"]!="") $datas["password"]=$_POST["password"];
    else $missingFields["password"]="password";
}




function validate($field)
{
    global $missingFields;

    foreach($missingFields as $missingField)
    {
        if($missingFields[$field]==$field)
        {
            echo " error";
        }
    }

    
}

require_once("Members.php");
//print_r($datas);

//write a function
if(count($missingFields)==0 && isset($_POST["submit"]))
{
   // echo "test";
    $member=Members::getMember($datas["username"]);

   // echo "username " . $member->getValue("password");
   // echo "password " . $member->getValue("password");

    if($member!=null && $member->getValue("password")==$datas["password"]) 
    {
        header("Location: memberArea.php");
    }
    else echo "username or password is incorrect";
}showForm($datas);



function showForm($datas)
{
  ?>

    <html>
        <head>
            <title>login</title>
            <style>
                .error
                {
                    background-color: red;
                }
            </style>
        </head>
        <body>
            <form action="loginPage.php" method="post">
                <label for="username" class="<?php validate("username") ?>">username</label>
                <input type="text" name="username" value="<?php echo $datas["username"]; ?>">
                <br>
                <label for="password" class="<?php validate("password") ?>">password</label>
                <input type="password" name="password">
                <br>
                <input type="submit" name="submit" value="submit">
            </form>
        </body>
    </html>

  <?php
}
  ?>