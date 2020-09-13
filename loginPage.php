<?php


//session_start();
require_once("config.php");

//$cookie_name="user";
if(!isset($cookie_value))$cookie_value="";

if(isset($_COOKIE[COOKIE_NAME]) && !empty(isset($_COOKIE[COOKIE_NAME])))
{
    header("Location: memberArea.php");
}

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
    //echo $datas["username"];
    $member=Members::getMember($datas["username"]);

    

   // echo "username " . $member->getValue("password");
   // echo "password " . $member->getValue("password");

    if($member!=null && $member->getValue("password")==$datas["password"]) 
    {
        //$_SESSION["user"]=Members::getMember($datas["username"]);
        $cookie_value=$datas["username"];
        setcookie(COOKIE_NAME,$cookie_value,time()+(60*60*24*30),"/");
        //header("Location: memberArea.php");
        header("Location: loginPage.php");
        //echo "login is successfull";
    }
    else echo '<p class="error">' . 'username or password is incorrect' . '</p>';
}

showForm($datas);



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