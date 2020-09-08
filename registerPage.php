<?php

require_once("addToDatabase.php");

$datas=array(
    "username"   => "",
    "firstName"  => "",
    "lastName"   => "",
    "password"   => "",
    "age"        => null,
    "specialty"  => ""
);


$missingFields=array();



if(isset($_POST["submit"]))
{
    echo "submitted";
    if(isset($_POST["username"]) && $_POST["username"]!="") {$datas["username"]=$_POST["username"];}
    else {$missingFields[]="username"; }

    if(isset($_POST["firstName"]) && $_POST["firstName"]!="") {$datas["firstName"]=$_POST["firstName"];}
    else $missingFields[]="firstName";

    if(isset($_POST["lastName"]) && $_POST["lastName"]!="") {$datas["lastName"]=$_POST["lastName"];}
    else $missingFields[]="lastName";

    if(isset($_POST["password"]) && $_POST["password"]!="") {$datas["password"]=$_POST["password"]; }
    else $missingFields[]="password";

    if(isset($_POST["age"]) && $_POST["age"]!="") {$datas["age"]=(int)$_POST["age"]; }
    else $missingFields[]="age";

    if(isset($_POST["specialty"]) && $_POST["specialty"]!="") {$datas["specialty"]=$_POST["specialty"];}
    else $missingFields[]="specialty";
}




if($datas["username"]!="" && count($missingFields)==0)
{
    addToDatabase($datas);
}

showRegisterForm($datas);

function checkValidation($field)
{
    
    global $missingFields;

    if(empty($missingFields)==false)
    {
        foreach($missingFields as $missingField)
        {
            if($missingField==$field)
            {
                return "error";
            }
        }   
    }

    return "a";
}

?>


<?php
function showRegisterForm($datas)
{ ?>
<html>
    <head>
        <title>REGISTER</title>
        <style>
            .error
            {
                background-color: red;
            }
        </style>
    </head>
    <body>
        
            <form action="registerPage.php" method="post">
                <label for="username" class="<?php echo checkValidation("username"); ?>">username</label>
                <input type="text" name="username" value="<?php echo $datas["username"] ?>"/>
                
                <br>
                <label for="firstName" class="<?php echo checkValidation("firstName"); ?>">firstName</label>
                <input type="text" name="firstName" value="<?php echo $datas["firstName"] ?>"/>
                <br>
                <label for="lastName" class="<?php echo checkValidation("lastName"); ?>">lastName</label>
                <input type="text" name="lastName" value="<?php echo $datas["lastName"] ?>"/>
                <br>
                <label for="password" class="<?php echo checkValidation("password"); ?>">password</label>
                <input type="password" name="password" value="<?php echo $datas["password"] ?>"/>
                <br>
                <label for="age" class="<?php echo checkValidation("age"); ?>">age</label>
                <input type="text" name="age" value="<?php echo $datas["age"] ?>"/>
                <br>
                <label for="specialty" class="<?php echo checkValidation("specialty"); ?>">specialty</label>
                <input type="text" name="specialty" value="<?php echo $datas["specialty"] ?>"/>
                <br>
                <input type="submit" name="submit" value="submit"/>
        </form>
<?php
} ?>
        
    </body>
</html>