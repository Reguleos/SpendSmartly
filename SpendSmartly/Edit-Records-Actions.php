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

$old_year  = $_SESSION['year'];
$new_year  = validate($_POST['year']);
$old_type  = $_SESSION['type'];
$new_type  = validate($_POST['type']);
$january   = validate($_POST['january']);
$february  = validate($_POST['february']);
$march     = validate($_POST['march']);
$april     = validate($_POST['april']);
$may       = validate($_POST['may']);
$june      = validate($_POST['june']);
$july      = validate($_POST['july']);
$august    = validate($_POST['august']);
$september = validate($_POST['september']);
$october   = validate($_POST['october']);
$november  = validate($_POST['november']);
$december  = validate($_POST['december']);
$notes     = validate($_POST['notes']);

if(empty($new_year))     {
	header("Location: Edit-Record-Page.php?error=Year is required. Please try again.&type=$old_type&year=$old_year&january=$january&february=$february&march=$march&april=$april&may=$may&june=$june&july=$july&august=$august&september=$september&october=$october&november=$november&december=$december&notes=$notes");
	exit();
} else {	
	if(empty($new_type)) {$new_type = $old_type;} 
	if(empty($january))  {$january = 0;}
	if(empty($february)) {$february = 0;}
	if(empty($march))    {$march = 0;}
	if(empty($april))    {$april = 0;}
	if(empty($may))      {$may = 0;}
	if(empty($june))     {$june = 0;}
	if(empty($july))     {$july = 0;}
	if(empty($august))   {$august = 0;}
	if(empty($september)){$september = 0;}
	if(empty($october))  {$october = 0;}
	if(empty($november)) {$november = 0;}
	if(empty($december)) {$december = 0;}
	if(empty($notes))    {$notes = null;}


	$update_jan_sql = "UPDATE `records` SET `amount` = $january, `year` = $new_year, `type` = '$new_type'
	                   WHERE (user_id, month, type, year) = ($user_id, 'January', '$old_type', $old_year);";
    $update_feb_sql = "UPDATE `records` SET `amount` = $february, `year` = $new_year, `type` = '$new_type'
                       WHERE (user_id, month, type, year) = ($user_id, 'February', '$old_type', $old_year);";
    $update_mar_sql = "UPDATE `records` SET `amount` = $march, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'March', '$old_type', $old_year);";
    $update_apr_sql = "UPDATE `records` SET `amount` = $april, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'April', '$old_type', $old_year);";
    $update_may_sql = "UPDATE `records` SET `amount` = $may, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'May', '$old_type', $old_year);";
    $update_jun_sql = "UPDATE `records` SET `amount` = $june, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'June', '$old_type', $old_year);";
    $update_jul_sql = "UPDATE `records` SET `amount` = $july, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'July', '$old_type', $old_year);";
    $update_aug_sql = "UPDATE `records` SET `amount` = $august, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'August', '$old_type', $old_year);";
    $update_sep_sql = "UPDATE `records` SET `amount` = $september, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'September', '$old_type', $old_year);";
    $update_oct_sql = "UPDATE `records` SET `amount` = $october, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'October', '$old_type', $old_year);";
    $update_nov_sql = "UPDATE `records` SET `amount` = $november, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'November', '$old_type', $old_year);";
    $update_dec_sql = "UPDATE `records` SET `amount` = $december, `year` = $new_year, `type` = '$new_type'
            	       WHERE (user_id, month, type, year) = ($user_id, 'December', '$old_type', $old_year);";
    
	$result_jan = mysqli_query($conn, $update_jan_sql);
	$result_feb = mysqli_query($conn, $update_feb_sql);
	$result_mar = mysqli_query($conn, $update_mar_sql);
	$result_apr = mysqli_query($conn, $update_apr_sql);
	$result_may = mysqli_query($conn, $update_may_sql);
	$result_jun = mysqli_query($conn, $update_jun_sql);
	$result_jul = mysqli_query($conn, $update_jul_sql);
	$result_aug = mysqli_query($conn, $update_aug_sql);
	$result_sep = mysqli_query($conn, $update_sep_sql);
	$result_oct = mysqli_query($conn, $update_oct_sql);
	$result_nov = mysqli_query($conn, $update_nov_sql);
	$result_dec = mysqli_query($conn, $update_dec_sql);
	

	if($notes!==null) {
		$update_note_sql = "INSERT INTO notes(user_id, type, year, note) 
			 	 VALUES();";
		$update_note_sql = "UPDATE `notes` SET `note`='$notes' WHERE (`user_id`, `type`, `year`) = ('$user_id', '$old_type', '$old_year');";
		$update_note_result = mysqli_query($conn, $update_note_sql);
	}
	
	if (($result_jan && $result_feb && $result_mar && $result_apr && $result_may && $result_jun && $result_jul && $result_aug && $result_sep && $result_oct && $result_nov && $result_dec) || ($result_jan && $result_feb && $result_mar && $result_apr && $result_may && $result_jun && $result_jul && $result_aug && $result_sep && $result_oct && $result_nov && $result_dec && $update_note_result)) {
		header("Location: Records-Page-Chart.php?success=Your record has been saved successfully!&type=$new_type&year=$new_year");
		exit();
	}
	else {
		header("Location: New-Record-Page.php?error=An unknown error occurred. Please try again.&type=$new_type&year=$year&january=$january&february=$february&march=$march&april=$april&may=$may&june=$june&july=$july&august=$august&september=$september&october=$october&november=$november&december=$december&notes=$notes");
		exit();
	}
}