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
    
           

<table class="nav">
<tr class="navcontent">
<td colspan=3"><h3>Menu</h3></td>
</tr>
<tr class="navcontent">
<td class="navimg"><img src="img/lib.png" /></td>
<td class="navspacer"></td>
<td class="navimg"><img src="img/add.png" /></td>
</tr>
<tr class="navcontent">
<td class="navlink"><a href="addmovie.php">Add New Movie</a></td>
<td class="navspacer"></td>
<td class="navlink"><a href="mymovies.php">My Movies</a></td>
</tr>

</table>
    
<br /><br />
    <p align="center">
    Click <a href="logout.php">here</a> to logout
    </p>
    

 <?php } ?>