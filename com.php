<?php
session_start();
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'user';
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if($db->connect_error)
    die("Connection failed: " . $db->connect_error);
$Id_Img=$_POST['Id_Img'];
$Text= $_POST['Text'];
$username=$_SESSION['username'];
$comms= $db->query("insert into comments (Comm,Id_Img,Id_Usr) values ('$Text','$Id_Img',(select id from users where username='$username'))");
header('location: index.php');?>
