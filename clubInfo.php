<?php
session_start();
require_once("config.php");
require_once("Members.php");

$member=Members::getMember($_SESSION["username"]);

$member->addLog(CLUBINFO_PAGE_ID,$_SESSION["IPv4"]);

?>

<html>
    <head>
        <title>Book club</title>
    </head>
    <body>
        <p>this is test page</p>
    </body>
</html>