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
    
    <table>
    <th><img src="img/menu.png" /></th>
    <tr>
    <td><img src="img/lib1.png" /></td>
    <td><img src="img/mm.png" /></td>
    <td><img src="img/add1.png" /></td>

    </tr>


    </table>


    <center>
                <h3>Menu</h3>
                    <ul>
                        <li><a href="managemedia.php">Manage Media</a></li>
                    </ul>
    </center


    
<br /><br />
    <p align="center">
    Click <a href="logout.php">here</a> to logout
    </p>
    

 <?php } ?>