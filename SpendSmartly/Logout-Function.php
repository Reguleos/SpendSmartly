<?php 
session_start();

session_unset();
session_destroy();

header("Location: Log-In-Page.php");
?>