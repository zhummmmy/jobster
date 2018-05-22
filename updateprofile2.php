<?php
include 'JobsDB.php';


$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());
//}
/////////////////////////////////////
$uid = $_POST['sid'];
$gpa = $_POST['gpa'];
$university = $_POST['university'];
$major= $_POST['major'];
$phone= $_POST['phone'];
$email= $_POST['email'];
$interests= $_POST['interests'];
$qualifications= $_POST['qualifications'];
$resume= $_POST['resume'];




$query = "SELECT * FROM student where sid='$uid' ";
$result = mysqli_query($con, $query);


if(isset($_POST['security'])){

$sql = "UPDATE student set gpa=?, university=?, major=?, phone=?, email=?, interests=?, qualification=?, resume=?, security=? where sid=?";
$security = "allow";
$stmt = $con->prepare($sql);
$stmt->bind_param('ssssssssss', $gpa, $university, $major, $phone, $email, $interests, $qualifications, $resume, $security, $uid);  
$stmt->execute();  

}
else {
$sql = "UPDATE student set gpa=? , university=?, major=?, phone=?, email=?, interests=?, qualification=?, resume=?, security=? where sid=?";
$security = "not allow";
$stmt = $con->prepare($sql);
$stmt->bind_param('ssssssssss', $gpa, $university, $major, $phone, $email, $interests, $qualifications, $resume, $security, $uid);  
$stmt->execute();  
	

}
$stmt->close();
mysqli_close($con);

header("Location: student.php?uid=$uid");
?>