<?php
session_start();
echo "<!DOCTYPE html>\n<html><head>";
require_once 'functions.php';

if (isset($_SESSION['user']))
{
$user = $_SESSION['user'];
$loggedin = TRUE;
$userstr = " ($user)";
}
else $loggedin = FALSE;
echo "<title>$appname</title><link rel='stylesheet' " .
"href='style.css' type='text/css'>" .
"</head><body bgcolor = 'maroon'>" .
"" .
"<script src='javascript.js'></script>";


?>