<?php 
session_start();
if(!isset($_SESSION['username'])){
if (isset($_REQUEST['login_user'])) {
if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
$username=$_POST['username'];
$password=$_POST['password'];
$password = md5($password);
$db=mysqli_connect('localhost','root','','loginsystem') or die("could not connect to database");
$q = "SELECT * from user WHERE username='$username' AND password='$password'";

$result=mysqli_query($db,$q);
$num= mysqli_num_rows($result); 

if($num==true){
	$_SESSION['username'] =$username;
	$_SESSION['success'] ="you are sucessfully logged";  //sabi pages me access hoga session
	//agr user and pass mila toh ye apne home page pr jayega 
	header('location:welcome.php'); 
	//echo "<script> location.href = 'home.php'</script>";
      }
     }
    }
  }else{ 
	header('location:welcome.php');
 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
</head>
<body>
	<div class="container">
		<div class="header">
			<h2>Login</h2>
		</div>

<form action="" method="post" accept-charset="utf-8">		
	<div>
	  <label for="username">Username : </label>
		<input type="text" name="username" value="" required="required">
			</div>

			<div>
			<label for="password">Password : </label>
		<input type="password" name="password" value="" required="required">
			</div>

			<button type="submit" name="login_user" class="btn btn-success">Log in</button>
			<p>Not a user <a href="registration.php" title="register"><b>Register Here</b></a></p>
	</form>
	</div>

</body>
</html>