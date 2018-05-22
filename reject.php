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





$result1 = mysqli_query($con, "UPDATE Apply set astatus='reject' where jid='$jid' and sid='$uid'");

mysqli_close($con);

header("Location: candidateList.php?jid=$jid");
?>