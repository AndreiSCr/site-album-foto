<?php
session_start();
if($_SESSION['view']==1)
	$_SESSION['view']=0;
else
	$_SESSION['view']=1;
header('location: index.php');
?>