<?php
include 'JobsDB.php';


$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());
//}
/////////////////////////////////////
$uid = $_GET['sid'];
$jid = $_GET['jid'];



$query = "SELECT * FROM student where sid='$uid' ";
$result = mysqli_query($con, $query);

$result1 = mysqli_query($con, "UPDATE notification set nstatus='not show again' where jid='$jid' and sid='$uid'");

mysqli_close($con);

header("Location: notification.php?sid=$uid");
?>
