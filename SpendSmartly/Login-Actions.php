<?php 
session_start(); 
include "Database-Connector.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)){
		header("Location: Log-In-Page.php?error=Please enter username.");
	    exit();
	}
	else if(empty($pass)){
        header("Location: Log-In-Page.php?error=Please enter password.");
	    exit();
	}
	else{
		$sql = "SELECT * FROM user_profile WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['first_name'] = $row['first_name'];
            	$_SESSION['user_id'] = $row['user_id'];
            	header("Location: Home-Page.php");
		        exit();
            }else{
				header("Location: Log-In-Page.php?error=The username and password combination you entered does not match our records.");
		        exit();
			}
		}else{
			header("Location: Log-In-Page.php?error=The username and password combination you entered does not match our records.");
	        exit();
		}
	}
	
}
else{
	header("Location: Log-In-Page.php");
	exit();
}