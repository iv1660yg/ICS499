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
		$error_message = "Invalid Email or Password!!!";
	}
}
?>

<head>
  <link rel="stylesheet" href="css/style.css">
</head>



<div class="login-page">
  <div class="form">
  	<fieldset>
	<legend>User Login</legend>	
	<table width=600px style="margin-left:auto;margin-right:auto;">
	<tr>
    <form class="login-form" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	 <td>
	  <input type="text" name="email" placeholder="email" required class="form-control" />
      <input type="password" name="password" placeholder="password" required class="form-control" />
	  <button type="submit" name="login">login</button>
	</td>
	<tr>
	</tr>	
	<td>
	  <font align="center" size="3" color="red"><strong><?php echo "<BR>" .$error_message ?></strong></font>
	  <p >Not registered? <a href="signup.php">Create an account</a></p>
	</td>
	  </tr>
		</table>
	  </fieldset>
    </form>
  </div>
</div>
