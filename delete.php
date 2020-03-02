<?php
session_start();
$id= $_POST['ID'];
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'user';
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if($db->connect_error)
    die("Connection failed: " . $db->connect_error);
$_SESSION['fetch']= $db->query("delete from images where Id_Img='$id'");
header('location: index.php');?>