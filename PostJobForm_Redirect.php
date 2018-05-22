<?php

include 'JobsDB.php';	

session_start();
$cid = $_SESSION["uid"];
if (isset($_POST['job_title'])) {
	$title=$_POST['job_title'];
}
if (isset($_POST['job_salary'])) {
	$salary=$_POST['job_salary'];
}
if (isset($_POST['job_desc'])) {
	$description=$_POST['job_desc'];
}
if (isset($_POST['job_req'])) {
	$requirements=$_POST['job_req'];
}

addjob ($cid, $title, $salary, $requirements, $description);
$returned = getJid($cid);
$job = mysqli_fetch_assoc($returned);
$jid = $job['jid'];

$students = getFollows($cid);
while($row = mysqli_fetch_assoc($students))
{
	postNotification($jid, $row['sid']);  
}
//echo "<script>alert('Notify all the relative students SUCCESSFULLY')</script>";
header("Location: company.php");
exit;
?>

