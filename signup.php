<?php 
ob_start();
include('header.php');
include_once("db_connect.php");
session_start();

if(isset($_SESSION['user_id'])!="") {
	header("Location: index.php");
}
if (isset($_POST['signup'])) {

	//Escapes special characters in a string 
	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	

	//check for non alphabets characters
	if (!preg_match("/^[a-zA-Z ]+$/",$firstname)) {
		$error = true;
		$fname_error = "Name must contain only alphabets and space";
	}

	//check for non alphabets characters
	if (!preg_match("/^[a-zA-Z ]+$/",$lastname)) {
		$error = true;
		$lname_error = "Name must contain only alphabets and space";
	}
	//Check if the variable $email is a valid email address
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}

	//check to ensure Password is a minimum of 6 characters
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}

	//check to make sure password fields match
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}

	//check to ensure there are no errors
	if (!$error) {
		// create/insert account
		if(mysqli_query($conn, "INSERT INTO users(firstname, lastname, email, password) VALUES('" . $firstname . "','" . $lastname . "','" . $email . "', '" . md5($password) . "')")) {

			// direct to success page 
			header("Location:success.php");
			exit();

		} else {
			$error_message = "Error in registering...Please try again later!";
		}
	}

}
?>

<head>
  <link rel="stylesheet" href="css/style.css">
</head>
<div class="signup-page">
  <div class="form">
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Sign Up</legend>
				<table>
					<tr> 
					<div class="form-group">
					
						<td>
						<label for="firstname">First Name</label>
						</td>
						<td><input type="text" name="firstname" placeholder="Enter First Name" required value="<?php if($error) echo $firstname; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($fname_error)) echo $fname_error; ?></span>
						</td>
					</div>
					</tr>	

					<tr>
					<div class="form-group">
						<td>
						<label for="lastname">Last Name</label>
						</td>
						<td>
						<input type="text" name="lastname" placeholder="Enter Last Name" required value="<?php if($error) echo $lastname; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($lname_error)) echo $lname_error; ?></span>
						</td>
					</div>
					</tr>
					<tr>
					<div class="form-group">
						<td>
						<label for="email">Email</label>
						</td>
						<td>
						<input type="text" name="email" placeholder="Enter Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
						</td>
					</div>
					</tr>
					<tr>
					<div class="form-group">
						<td>
						<label for="password">Password</label>
						</td>
						<td>
						<input type="password" name="password" placeholder="Enter Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
						</td>
					</div>
					</tr>
					<tr>
					<div class="form-group">
						<td>
						<label for="password">Confirm Password</label>
						</td>
						<td>
						<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
						</td>
					</div>
					</tr>
					<tr>
					<div class="form-group">
						<td>
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
						</td>
					</div>
					</tr>
				</table>
				</fieldset>
			</form>
  </div>
</div>
