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
    
           

    <table width=600px style="margin-left:auto;margin-right:auto;">
    <th colspan=2><img src="img/libraryheader-icon.png" /></th>
    <tr>
    <td><a href="mymovies.php"><img src="img/managemovie-icon.png" /></a></td>
    <td><a href="mymuisc.php"><img src="img/managemusic-icon.png" /></a></td>
    </tr>


    </table>
    
<br /><br />
    <p align="center">
    Click <a href="logout.php">here</a> to logout
    </p>
    

 <?php } ?>