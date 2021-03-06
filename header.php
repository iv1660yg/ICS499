<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnavinfo {
 text-align: right;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
<!––if login user is admin-->
<?php if ((isset($_SESSION['user_id']) AND (($_SESSION['userType'])=="admin" ) )) { ?>

<div class="topnav">
  <a class="active" href="../index.php">Home</a>
  <a class="active" href="../users/index.php">Manage Users</a>
  <a class="active" href="../movies/index.php">Manage Movies</a>
  <a class="active" href="3">Manage Music</a>
  <a class="active" href="#">Manage TV Shows</a>

  <div class="topnavinfo">
  <p><strong>Welcome!</strong> You are logged in as <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong></p>
  </div> 
</div>



<!––if login user is enduser-->
<?php } elseif ((isset($_SESSION['user_id']) AND (($_SESSION['userType'])=="standard" ) )) { ?>

<div class="topnav">
  <a class="active" href="../index.php">Home</a>
  <a class="active" href="../scan.php">Scan a Movie</a>
  <a class="active" href="../mymovies.php">myMovies</a>

  <div class="topnavinfo">
  <p><strong>Welcome!</strong> You are logged in as <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong></p>
</div> 
</div>


<!––if no one logged in-->
<?php } else { ?>

<div class="topnav">
  <a class="active" href="../login.php">Login</a>
  <a class="active" href="../signup.php">Signup</a>
</div>


<?php } ?>

</body>
</html>