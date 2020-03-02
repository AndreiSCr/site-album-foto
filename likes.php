<?php
function likes($id){
	$dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'user';
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($db->connect_error)
        die("Connection failed: " . $db->connect_error);
    $username=$_SESSION['username'];
    $rez= $db->query("select count(*) as marcare from likes join users on users.id=likes.Id_Usr where likes.Id_Img='$id' and users.username='$username'");
    $row =mysqli_fetch_array($rez);
    if($row['marcare']==1)
        echo '(Liked) ';
    $comms= $db->query("select count(*) as numar from likes where likes.Id_Img='$id'");     
    if($row =mysqli_fetch_array($comms)){
        echo $row["numar"]." likes";
        echo '<br>';
    }
}?>