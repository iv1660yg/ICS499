<?php
session_start();
include_once("db_connect.php");

// set barcode
if (!empty($_GET['id'])) {

    $movie_ID=$_GET['id'];

    $sql2 = "DELETE FROM user_movie WHERE user_id = '" .$_SESSION['user_id']."' AND movie_id = '".$_GET['id']."' ";
    
    $result = mysqli_query($conn, $sql2);  
    
    mysqli_fetch_assoc($result);

    header("Location: removemovie.php");

}



?>