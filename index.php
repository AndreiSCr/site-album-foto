<?php 
	session_start(); 
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}	
	if($_SESSION['con']==1)
		header('location: fetch.php');
	$_SESSION['con']=1;	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div class="header">
			<h2>Fakebook</h2>
			<div class="content">
				<?php  
				if (isset($_SESSION['username'])) : ?>
					<p>	Welcome <strong>
					<?php echo $_SESSION['username']; ?>
					</strong></p>
					<?php 
					if($_SESSION['view']==1):?>
						<form action="upload.php" method="post" enctype="multipart/form-data">
					        Select image to upload:
				        	<br>
				        	<input type="file" name="image"/>
				        	<input type="submit" name="submit" value="UPLOAD"/>
			    		</form>
			    	<?php endif ?>
					<p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
					<form action="select.php" method="post" enctype="multipart/form-data">
			        	<input type="submit" name="submit" value='Change view'/>
			    	</form>
				<?php endif ?>
			</div>
		</div>
		<?php
		include 'comments.php';
		include 'likes.php';
		for ($i=0; $i <$_SESSION['index'] ; $i++) { 
			$row=$_SESSION['array'][$i];?>
		<center><div class="username">
		<?php
		echo 'By:'.$row['username'].'';
		echo "<br>";?>
		</div></center>
			<center><div class="delete">
				<?php
				/*User*/
				if($_SESSION['view']==1):?>
					<form method="post" action="delete.php">
	    				<input type="hidden" name="ID" value="<?php echo $row['Id_Img'];?>">
	    				<input type="submit" name="submit" value='X'/>
					</form>
				<?php
				endif;
				if($_SESSION['view']==0)
					echo "<br>";?>
			</div></center>
			<div class="images">
				<?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($row['File'] ).'" class="img-thumnail" /></center>'; ?>
				<center><div class="comments">
					<form action= "like.php" method="post">
						<input type="hidden" name="Id_Img" value="<?php echo $row['Id_Img'];?>">
						<input name="form" type="submit" value="Like"/><br><br>
					</form>
					<?php
					likes($row["Id_Img"]);
					comments($row["Id_Img"]);?>
					<form action= "com.php" method="post">
						<label>Add comment:</label><input type="text" name="Text">
						<input type="hidden" name="Id_Img" value="<?php echo $row['Id_Img'];?>">
						<input name="form" type="submit" value="Add"/><br><br>
					</form>
				</div></center>
				<?php echo "<br><br>";}?>
			</div>
		</div>		
	</body>
</html>