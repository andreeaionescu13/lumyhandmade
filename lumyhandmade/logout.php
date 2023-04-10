<?php

if ( !isset($_SESSION) ) {
	session_start();
}

$_SESSION["loggedin"] = false;
unset($_SESSION["id"]);
unset($_SESSION["username"]);

header("location: index.php");
exit;