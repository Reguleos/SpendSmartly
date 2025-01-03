<?php 
session_start(); 
include "Database-Connector.php";

$user_id = $_SESSION['user_id'];

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$verif_password    = validate($_POST['verif_password']);
$new_password    = validate($_POST['new_password']);
$new_re_password = validate($_POST['new_re_password']);

$password_sql = "SELECT `password` FROM `user_profile` WHERE `user_id`='$user_id';";
$password_result = mysqli_query($conn, $password_sql);
while($row = mysqli_fetch_array($password_result)){
    $old_password = $row['password']; 
}
if(empty($verif_password)){
	header("Location: Profile-Page.php?pass_result=Please enter your current password.");
		    exit();
} else {
	if ($verif_password==$old_password) {
		if(empty($new_password)) {
			header("Location: Profile-Page.php?pass_result=Please enter password.");
		    exit();
		} else if (empty($new_re_password)) {
			header("Location: Profile-Page.php?pass_result=Please re-enter password for verification.");
		    exit();
		} else {
			if($new_password==$new_re_password) {
				$update_pass_sql = "UPDATE `user_profile` SET `password` = '$new_password' WHERE `user_id` = '$user_id';";
				$update_pass_result = mysqli_query($conn, $update_pass_sql);
				if($update_pass_result) {
					header("Location: Profile-Page.php?pass_result=Your password has been changed successfully!");
		    		exit();
				} else {
					header("Location: Profile-Page.php?pass_result=An unknown error has occured. Please try again.");
		    		exit();
				}
			} else {
				header("Location: Profile-Page.php?pass_result=Password do not match. Please try again.");
		    	exit();
			}
		}
	} else {
		header("Location: Profile-Page.php?pass_result=The password you entered do not match <br> your current password. Please try again.");
		    exit();
	}
}

// $update_sql = "";
			// $update_result = mysqli_query($conn, $update_sql);
			// if ($update_result) {
			// 	header("Location: Profile-Page.php?profile_result=Your profile has been updated successfully!");
		    // 	exit();
			// }