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

$type      = validate($_POST['type']);
$year      = validate($_POST['year']);
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


if(empty($type))     {$type = "Unlabeled Record";} 

if(empty($year))     {
	header("Location: New-Record-Page.php?error=Year is required. Please try again.&type=$type&year=$year&january=$january&february=$february&march=$march&april=$april&may=$may&june=$june&july=$july&august=$august&september=$september&october=$october&november=$november&december=$december&notes=$notes");
	exit();
}
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


// echo $user_id, " ", $type, " ", $year, " ", $january, " ", $february, " ", $march, " ", $april, " ", $may, " ", $june, " ", $july, " ", $august, " ", $september, " ", $october, " ", $november, " ", $december, " ", $notes; 

$sql = "INSERT INTO `records`(`user_id`, `type`, `month`, `year`, `amount`) 
		VALUES('$user_id', '$type', 'January', '$year', '$january'),
		      ('$user_id', '$type', 'February', '$year', '$february'),
		      ('$user_id', '$type', 'March', '$year', '$march'),
		      ('$user_id', '$type', 'April', '$year', '$april'),
		      ('$user_id', '$type', 'May', '$year', '$may'),
		      ('$user_id', '$type', 'June', '$year', '$june'),
		      ('$user_id', '$type', 'July', '$year', '$july'),
		      ('$user_id', '$type', 'August', '$year', '$august'),
		      ('$user_id', '$type', 'September', '$year', '$september'),
		      ('$user_id', '$type', 'October', '$year', '$october'),
		      ('$user_id', '$type', 'November', '$year', '$november'),
		      ('$user_id', '$type', 'December', '$year', '$december');";
$result = mysqli_query($conn, $sql);

if(empty($notes)!==false) {
	$sql2 = "INSERT INTO `notes`(`user_id`, `type`, `year`, `note`) 
			 VALUES('$user_id', '$type', '$year', '$notes');";
	$result2 = mysqli_query($conn, $sql2); 
} else {
	$sql2 = "INSERT INTO `notes`(`user_id`, `type`, `year`, `note`) 
			 VALUES('$user_id', '$type', '$year', NULL);";
	$result2 = mysqli_query($conn, $sql2); 
}

if ($result && $result2) {
		header("Location: Records-Page-Chart.php?success=Your new record has been saved successfully!&type=$type&year=$year");
	exit();
}
else {
	header("Location: New-Record-Page.php?error=An unknown error occurred. Please try again.&type=$type&year=$year&january=$january&february=$february&march=$march&april=$april&may=$may&june=$june&july=$july&august=$august&september=$september&october=$october&november=$november&december=$december&notes=$notes");
	exit();
}