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
$username=$_SESSION['username'];
$rez= $db->query("select count(*) as marcare from likes join users on users.id=likes.Id_Usr where likes.Id_Img='$Id_Img' and users.username='$username'");
$row =mysqli_fetch_array($rez);
if($row['marcare']==0)
    $comms= $db->query("insert into likes (Id_Img,Id_Usr) values ('$Id_Img',(select id from users where username='$username'))");
else
    $comms= $db->query("delete from likes where Id_Img='$Id_Img' and Id_Usr=(select id from users where username='$username')");
header('location: index.php');?>
