<?php 
session_start();
include('header.php');
include_once("db_connect.php");

if (empty($_SESSION['user_id'])){
header("Location: login.php");
}
?>


<?php if ((isset($_SESSION['user_id']) )) { ?>


<head>
  <link rel="stylesheet" href="css/style.css">
</head>
    <p><strong>Welcome!</strong> You are logged in as <strong><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></strong></p>
    
    <center>
                <h3>Menu</h3>
                    <ul>
                        <li><a href="addmovie.php">Add New Movie</a></li>
                        <li><a href="mymovies.php">My Movies</a></li>
                    </ul>
    </center
    
    <P>
    Click <a href="logout.php">here</a> to logout
    

    

 <?php } ?>