<?php
function comments($id){
	$dbHost     = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName     = 'user';
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if($db->connect_error)
        die("Connection failed: " . $db->connect_error);
    $comms= $db->query("select users.username, comments.Comm from comments join users on comments.Id_Usr=users.id WHERE comments.Id_Img='$id' order by Date");
    while($row =mysqli_fetch_array($comms)){
        echo $row["username"].": ".$row["Comm"];
        echo '<br>';
    }
}?>