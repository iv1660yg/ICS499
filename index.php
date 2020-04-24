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
    
    <table width=600px>
    <th><img src="img/menu.png" /></th>
    <tr>
    <td><img src="img/lib1.png" /></td>
    <td><a href="managemedia.php"><img src="img/mm.png" /></a></td>
    <td><a href="addmovie.php"><img src="img/add1.png" /></a></td>

    </tr>


    </table>

    
<br /><br />
    <p align="center">
    Click <a href="logout.php">here</a> to logout
    </p>
    

 <?php } ?>