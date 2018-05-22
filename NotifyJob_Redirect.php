<?php
//error_reporting(E_ALL | E_STRICT); 
//ini_set("display_errors", "On"); 

include 'JobsDB.php';	

session_start();
$sid = $_GET['sid'];
$jid = $_GET['jid'];
postNotification($jid, $sid);
//if ( == false) {
//	echo "This student has been notified before";
//} else { 
//	echo "Notify this Student Successfulyly"; 
//}

header("Location: notifyJob.php?sid=$sid");
exit;

?>