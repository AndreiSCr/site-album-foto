<?php
session_start();
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $dbHost     = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName     = 'user';
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        if($db->connect_error)
        	die("Connection failed: " . $db->connect_error);
        $dataTime = date("Y-m-d H:i:s");
        $Us=$_SESSION['username'];
        $insert = $db->query("insert into images (File, Date,Id_Usr) VALUES ('$imgContent', '$dataTime',(select id from users where username='$Us'))");
        if($insert)
        	header('location: index.php');
        else
            echo "File upload failed, please try again.";
    }
    else
    	echo "Please select an image file to upload.";
}?>