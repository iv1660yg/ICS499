<?php 
ob_start();
include('header.php');
include_once("db_connect.php");
session_start();
if(isset($_SESSION['user_id'])!="") {
	header("Location: index.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password). "'");
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['firstname'] = $row['firstname'];	
		$_SESSION['lastname'] = $row['lastname'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['title'] = $row['title'];
		$_SESSION['userType'] = $row['userType'];	
		header("Location: index.php");
	} else {
		$error_message = "Incorrect Email or Password!!!";
	}
}
?>

<head>
  <link rel="stylesheet" href="css/style.css">
</head>
<div class="login-page">
  <div class="form">
  	<fieldset>
	<legend>Employee Login</legend>	
    <form class="login-form" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
      <input type="text" name="email" placeholder="email" required class="form-control" />
      <input type="password" name="password" placeholder="password" required class="form-control" />
      <button type="submit" name="login">login</button>
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>
	  </fieldset>
    </form>
  </div>
</div>