<?php 
session_start();
//initializing variables
$username = "";
$email ="";
$errors = array();
//connect db
$db=mysqli_connect('localhost','root','','loginsystem') or die("could not connect to database");

//REGISTER USERS
if(isset($_POST['reg_user'])){
//receive all inputs values from the form
$username = mysqli_real_escape_string($db,$_POST['username']);
$email = mysqli_real_escape_string($db,$_POST['email']);
$password_1 = mysqli_real_escape_string($db,$_POST['password_1']);
$password_2 = mysqli_real_escape_string($db,$_POST['password_2']);

//form validation: ensure that the form is correctly filled....
//by adding(array()) corresponding errors into $errors array
if(empty($username)){array_push($errors,"Username is required");}
if(empty($email)){array_push($errors,"Email is required");}
if(empty($password_1)){array_push($errors,"Password is required");}
if($password_1 != $password_2){
	array_push($errors,"Password do not match");
}

//first check the database to make sure
//a user does not already exists with same username and/or email
$user_check_query ="SELECT * from user WHERE username='$username' OR email='$email' LIMIT 1";
$result= mysqli_query($db,$user_check_query);
$user =mysqli_fetch_assoc($result);
//echo"<pre>";
//print_r($user);	
//echo "</pre>";
if($user){ //if user exists

if($user['username'] === $username)
	{array_push($errors,"username already exists");
}
if($user['email'] === $email){
	array_push($errors,"email already exists");
	echo "email already exists";
 }		
}

 //Finally,register user if there are no errors in the form
 if (count($errors) == 0){
	$password = md5($password_1); //encrypt the password before saving in the database
	//print $password;
	$query = "INSERT INTO user (username,email,password) 
	VALUES ('$username','$email','$password')";
	mysqli_query($db,$query);
	$_SESSION['username']= $username;
	$_SESSION['success']= "you are now logged in";
	header('location: welcome.php');
 }
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="header">
			<h2>Registration</h2>
		</div>
<form action="" method="post" accept-charset="utf-8">
	<?php include 'errors.php'; ?>		
	<div>
	  <label for="username">Username : </label>
		<input type="text" name="username" value="" required="required">
			</div>

			<div>
	  <label for="email">Email : </label>
		<input type="email" name="email" value="" required="required">
			</div>

			<div>
			<label for="password">Password : </label>
		<input type="password" name="password_1" value="" required="required">
			</div>

            <div>
			<label for="password">Confirm Password : </label>
		<input type="password" name="password_2" value="" required="required">
			</div>

			<button type="submit" name="reg_user" class="btn btn-success">Register</button>
			<p>Already a user <a href="login.php" title="login"><b>Log in</b></a></p>
	</form>
	</div>
</body>
</html>