<?php
session_start();
$Us=$_SESSION['username'];
$_SESSION['index']=0;
$_SESSION['con']=0;
$_SESSION['array']= array();
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'user';
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if($db->connect_error)
	die("Connection failed: " . $db->connect_error);
if($_SESSION['view']==1)
	$_SESSION['fetch']= $db->query("select images.Id_Img, images.File,images.Id_Usr,users.username, COUNT(likes.ID) as Likes from images left join likes on images.Id_Img=likes.Id_Img join users on users.id=images.Id_Usr where images.Id_Usr=(select id from users where username='$Us') group by images.Id_Img Order by Likes DESC, images.Date");
else
	$_SESSION['fetch']= $db->query("select images.Id_Img, images.File,images.Id_Usr,users.username, COUNT(likes.ID) as Likes from images left join likes on images.Id_Img=likes.Id_Img join users on users.id=images.Id_Usr group by images.Id_Img Order by Likes DESC, images.Date");
while($row =mysqli_fetch_array($_SESSION['fetch'] )){
    $_SESSION['array'][$_SESSION['index']] = $row;
    $_SESSION['index']++;
}
header('location: index.php');?>