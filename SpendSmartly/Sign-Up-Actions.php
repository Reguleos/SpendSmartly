<?php 
session_start(); 
include "Database-Connector.php";

if (isset($_POST['uname']) && 
	isset($_POST['password']) && 
	isset($_POST['re_password']) && 
	isset($_POST['first_name']) && 
	isset($_POST['last_name']) && 
	isset($_POST['birthday']) && 
	isset($_POST['age']) && 
	isset($_POST['gender']) && 
	isset($_POST['address']) && 
	isset($_POST['e_mail']) && 
	isset($_POST['mobile_number'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	$re_password = validate($_POST['re_password']);
	$first_name = validate($_POST['first_name']);
	$last_name = validate($_POST['last_name']);
	$birthday = validate($_POST['birthday']);
	$age = validate($_POST['age']);
	$gender = validate($_POST['gender']);
	$address = validate($_POST['address']);
	$e_mail = validate($_POST['e_mail']);
	$mobile_number = validate($_POST['mobile_number']);

	$user_data = '&uname='. $uname. '&first_name='. $first_name. '&last_name='. $last_name. '&birthday='. $birthday. '&age='. $age. '&gender='. $gender. '&address='. $address. '&e_mail='. $e_mail. '&mobile_number='. $mobile_number;

	if (empty($uname)){
		header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($pass)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($re_password)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($first_name)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($last_name)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($birthday)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($age)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($gender)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($address)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($e_mail)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if(empty($mobile_number)){
        header("Location: Sign-Up-Page.php?error=All fields are required. $user_data");
	    exit();
	}
	else if($pass!==$re_password){
        header("Location: Sign-Up-Page.php?error=Password do not match. $user_data");
	    exit();
	}
	else{
		$sql = "SELECT * FROM user_profile WHERE username='$uname'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: Sign-Up-Page.php?error=The username is already taken. Try another one. $user_data");
			exit(); 
		}
		else{
			$sql2 = "INSERT INTO user_profile(`username`, `password`, `first_name`, `last_name`, `birthday`, `age`, `gender`, `address`, `e_mail`, `mobile_number`) 

			VALUES('$uname', '$pass', '$first_name', '$last_name', '$birthday', '$age', '$gender', '$address', '$e_mail', '$mobile_number')";
        	$result2 = mysqli_query($conn, $sql2);

        	if ($result2) {
           		header("Location: Log-In-Page.php?success=Your account has been created successfully! Log in here.");
	        	exit();
        	}
        	else {
	        	header("Location: Sign-Up-Page.php?error=An unknown error occurred. Please try again.&$user_data");
		    	exit();
        	}
		}
	}
	
}
else{
	header("Location: Sign-Up-Page.php");
	exit();
}