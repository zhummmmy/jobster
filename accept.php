<?php
include 'JobsDB.php';


$mysqli = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());
//}
/////////////////////////////////////
$uid = $_GET['sid'];
$jid = $_GET['jid'];







$result1 = mysqli_query($mysqli, "UPDATE Apply set astatus='accepted' where jid='$jid' and sid='$uid'");
mysqli_close($mysqli);

header("Location: candidateList.php?jid=$jid");
?>