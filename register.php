<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("font.php"); ?>
	<meta charset="utf-8"> 
	<title> Registration</title>
	<link rel="stylesheet" href="css/base.css">
	<?php require_once("connect.php"); ?>
</head>
<body>
	<div class="divbg">
		<div class="regform">
			<h2>Registration</h2>
			<form action="register.php" id="registerform" method="post"name="registerform">
				<p><label for="user_login">Fullname<br>
					<input class="input" id="full_name" name="full_name"size="32"  type="text" value=""></label></p>
				<p><label for="user_pass">E-mail<br>
					<input class="input" id="email" name="email" size="32"type="email" value=""></label></p>
				<p><label for="user_pass">Username<br>
					<input class="input" id="username" name="username"size="20" type="text" value=""></label></p>
				<p><label for="user_pass">Password<br>
					<input class="input" id="password" name="password"size="32"   type="password" value=""></label></p>
				<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Registration"></p>
				<p class="regtext">Already registered? <a href= "login.php">Log in here</a>!</p>
			</form>
		</div>
	</div>
</body>
</html>
				<?php
				if(isset($_POST["register"])){
					if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
						$full_name = htmlspecialchars($_POST['full_name']);
						$email = htmlspecialchars($_POST['email']);
						$username = htmlspecialchars($_POST['username']);
						$password = htmlspecialchars($_POST['password']);
						$query = mysqli_query($conn, "SELECT * FROM usertbl WHERE username='".$username."'");
						$numrows = mysqli_num_rows($query);
						if($numrows == 0)
						{
							$sql = "INSERT INTO usertbl
							(full_name, email, username,password)
							VALUES('$full_name','$email', '$username', '$password')";
							$result=mysqli_query($conn, $sql);
							if($result){
								$message = "Account Successfully Created";
							} else {
								$message = "Failed to insert data information!";
							}
						} else {
							$message = "That username already exists! Please try another one!";
						}
					} else {
						$message = "All fields are required!";
					}
				}
				?>

				<?php if (!empty($message)) {echo "<p class=`error`>" . "MESSAGE: ". $message . "</p>";} ?>

