<?php
ob_start();
session_start();
if(isset($_SESSION['user_id'])) {
    session_unset();
    session_destroy();
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>