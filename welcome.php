<?php 
session_start(); 
if(!isset($_SESSION['username'])){
header('location:http://localhost/final/login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome To You</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div> 
		<h3>Hello<?php echo $_SESSION['username'];
			echo $_SESSION['success']; ?></h3><br>
		<h4><a href="logout.php" title="Logout">Logout</a></h4>
	</div>
</html>
</body>