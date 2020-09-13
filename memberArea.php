<?php

//session_start();
//require_once("loginPage.php");



require_once("config.php");

if(!isset($_COOKIE[COOKIE_NAME]))
{
    header("Location: loginPage.php");
}

if(isset($_POST["logout"]))
{
    //session_destroy();
    //header("Location: loginPage.php");
    setcookie(COOKIE_NAME);
?>

<script type = "text/javascript" > 
    function preventBack(){window.history.forward();} 
    setTimeout("preventBack()", 0); 
    window.onunload=function(){null}; 
    </script>



    <script>
        location.replace("loginPage.php");
    </script>

<?php
}

?>

<html>
    <head>
        <title>member area</title>
    </head>
    <body>
        <p>this is test</p>
        <form action="memberArea.php" method="post">
            <input type="submit" name="logout" value="logout">
        </form>
    </body>
</html>