<?php

//session_start();
//require_once("loginPage.php");



require_once("config.php");

session_start();
$IPv4=$_SERVER["REMOTE_ADDR"];
$_SESSION["username"]=$_COOKIE[COOKIE_NAME];
$_SESSION["IPv4"]=$IPv4;

if(!isset($_COOKIE[COOKIE_NAME]))
{
    header("Location: loginPage.php");
}

echo "Welcome, " . $_COOKIE[COOKIE_NAME];

if(isset($_POST["logout"]))
{
    //session_destroy();
    //header("Location: loginPage.php");
    session_destroy();
    setcookie(COOKIE_NAME);
?>




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
        <p>this is your area</p>
        <form action="memberArea.php" method="post">
            <a href="showMember.php?username=<?php echo $_COOKIE[COOKIE_NAME] ?>">your datas</a>
            <a href="clubInfo.php">club info</a>
            <input type="submit" name="logout" value="logout">
        </form>
    </body>
</html>