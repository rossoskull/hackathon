<?php
if(isset($_GET['q'])){
	session_start();
	unset($_SESSION['eid']);
	unset($_SESSION['pass']);
	unset($_SESSION['fname']);
	unset($_SESSION['lname']);
	
	header("Location: index.php");
	exit();
	
} else {
	header("Location: index.php");
	exit();
	
}


?>