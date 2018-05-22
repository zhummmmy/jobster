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
$fid = $_GET['fid'];



$query = "SELECT * FROM student where sid='$uid' ";
$result = mysqli_query($con, $query);

$result1 = mysqli_query($con, "INSERT INTO forward values('$jid','$uid','$fid','not viewed')");

mysqli_close($con);

header("Location: student.php?uid=$uid");
?>
