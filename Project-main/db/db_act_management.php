<?php
$actServername = "localhost";
$actUsername = "root";
$actPassword = ".p@ssw0rd";
$actDbname = "act_management";

// Create connection
$actConn = new mysqli($actServername, $actUsername, $actPassword, $actDbname);

// Check connection
if ($actConn->connect_error) {
    die("Act Management Connection failed: " . $actConn->connect_error);
}
?>
