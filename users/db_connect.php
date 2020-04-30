<?php
/* Database connection start */
$servername = "127.0.0.1:52590";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "alphabuild";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>