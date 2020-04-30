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
    
    <table width=600px style="margin-left:auto;margin-right:auto;">
    <th colspan=2><img src="img/menu.png" /></th>
    <tr>
    <td><img src="img/lib1.png" /></td>
    <td><a href="managemedia.php"><img src="img/mm.png" /></a></td>
  

    </tr>


    </table>

    
<br /><br />
    <p align="center">
    Click <a href="logout.php">here</a> to logout
    </p>
    

 <?php } ?>