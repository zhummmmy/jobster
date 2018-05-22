<?php
/*
$title=$_GET['job_title'];
$salary=$_GET['job_salary'];
$jobdesc=$_GET['job_desc'];
$location=$_GET['job_location'];
*/
error_reporting(E_ALL | E_STRICT); 
ini_set("display_errors", "On"); 

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'myzhu');
define('DB_NAME', 'jobster');
function dbopen ()
{
	$mysqli = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if (!$mysqli)
  	{
  		die('Could not connect: ' . mysql_error());
  	}
	return $mysqli;
}

function addjob ($cid, $title, $salary, $requirements, $description)
{
	
	$mysqli = dbopen();
	$sql1 = "INSERT into Job(cid, title, salary, requirements, descriptions, jdate, due) values (?,?,?,?,?,now(),date_add(now(), interval 3 month))";
	$stmt = $mysqli->prepare($sql1);
	$stmt->bind_param('sssss', $cid, $title, $salary, $requirements, $description);  
  	//$jdate = date('Y-m-d');
	//$due = date('Y-m-d');

    $stmt->execute();  

	//if() === TRUE) {
	//	echo "<script>alert('Post Job Successfully')</script>";
	//} else {
//		echo "<script>alert('Something WRONG')</script>". $mysqli->error;
//	}
	 $stmt->close();
	 mysqli_close($mysqli);

}

function isNotified($jid, $sid) {
	$mysqli = dbopen();
	$checkSql = "SELECT * From Notification where jid = ? AND sid = ?";
	$stmt = $mysqli->prepare($checkSql);
    $stmt->bind_param('ss', $jid, $sid);  
    $stmt->execute(); 
    $stmt->store_result();
	if ($stmt->num_rows  == 1)
    	return false;
    else {
    	return true;
    }
    mysqli_close($mysqli);

}


function postNotification($jid, $sid) {
	$mysqli = dbopen();
    if (isNotified($jid, $sid) == false)
    	return false;
	$sql2 = "INSERT into Notification values(?, ?, ?,now())";
	$status = "not viewed";
	$stmt = $mysqli->prepare($sql2);
    $stmt->bind_param('sss', $jid, $sid, $status);  
    $stmt->execute(); 
    $stmt->close(); 
	mysqli_close($mysqli);
	return true;
}


function getFollows($cid) {	
	$mysqli = dbopen();
	$sql3 = "SELECT sid FROM Follow Where cid = ?";
	$stmt = $mysqli->prepare($sql3);
	$stmt->bind_param('s', $cid);  
	$stmt->execute(); 
 	$result = $stmt->get_result();
 	$stmt->close(); 
    mysqli_close($mysqli);
	return $result;

}

function getJobs ($cid)
{
	$mysqli = dbopen();
	$sql4 = "SELECT * from Job where cid = ?";
	$stmt = $mysqli->prepare($sql4);
	$stmt->bind_param('s', $cid);  
	$stmt->execute(); 
 	$result = $stmt->get_result();
 	$stmt->close(); 
    mysqli_close($mysqli);
	return $result;

}

function getJid($cid) {
	
	$mysqli = dbopen();
	$sql5 = "SELECT Max(jid) as jid FROM Job Where cid = ?";
	$stmt = $mysqli->prepare($sql5);
	$stmt->bind_param('s', $cid);  
	$stmt->execute(); 
 	$result = $stmt->get_result();
 	$stmt->close(); 
    mysqli_close($mysqli);

	return $result;
}



function getRelatedStudents($keywords) {
	$mysqli = dbopen();
	$sql6 = "SELECT * FROM student 
	WHERE resume like ? or major like ? or university like ? or gpa > ? or interests like ? or qualification like ?";
	$keywords1 = "%{$keywords}%";
	$stmt = $mysqli->prepare($sql6);
    $stmt->bind_param('ssssss', $keywords1,$keywords1,$keywords1,$keywords,$keywords1,$keywords1);  
    $stmt->execute(); 
 	$result = $stmt->get_result();
 	$stmt->close(); 
    mysqli_close($mysqli);
	return $result;
}

function addCompany($companyid, $password, $cname, $location, $industry) {

	$mysqli = dbopen();

	$query = "SELECT cid From Company Where cid = ?";
	$stmt1 = $mysqli->prepare($query);
	$stmt1->bind_param('s', $companyid);
	$stmt1->execute(); 
	$stmt1->store_result();
	if ($stmt1->num_rows > 0) {
  		$stmt1->close(); 
    	return false;
  	}
  	$stmt1->close(); 
	$sql7 = "INSERT into Company values(?,?,?,?,?)";
	$stmt = $mysqli->prepare($sql7);
	$stmt->bind_param('sssss', $companyid, $password, $cname, $location, $industry);  
	$stmt->execute(); 
	$stmt->close(); 
    mysqli_close($mysqli);
    return true;
}


function addStudent($studentid, $password, $sname) {
	$mysqli = dbopen();
	
	$query = "SELECT sid From Student Where sid = ?";
	$stmt1 = $mysqli->prepare($query);
	$stmt1->bind_param('s', $studentid);
	$stmt1->execute(); 
	$stmt1->store_result();
	if ($stmt1->num_rows > 0) {
  		$stmt1->close(); 
    	return false;
  	}
  	$stmt1->close(); 
	$sql8 = "INSERT into Student(sid, sname, spassword) values(?,?,?)";
	$stmt = $mysqli->prepare($sql8);
	$stmt->bind_param('sss', $studentid, $sname, $password);  
	$stmt->execute(); 
	$stmt->close(); 
    mysqli_close($mysqli);
    return true;
}

function getCandidates($jid) {
	$mysqli = dbopen();
	$sql8 = "SELECT * FROM Apply Natural Join Student Where jid = '{$jid}' AND astatus = 'pending'";
	$result =  mysqli_query($mysqli, $sql8);
	mysqli_close($mysqli);
	return $result;

}


function authenticateUser($uid, $password, $isStudent)
{

  $mysqli = dbopen();
  $query = "";
  if ($isStudent == true) {
     $query = "SELECT spassword FROM Student WHERE (sid = ?)
            AND (spassword = ?)";
  } else {
     $query = "SELECT cpassword FROM Company WHERE (cid = ?)
            AND (cpassword = ?)";
  }

  $stmt = $mysqli->prepare($query);
  $stmt->bind_param('ss', $uid, $password);  
  $stmt->execute(); 
  $stmt->store_result();
  mysqli_close($mysqli);

 

  // exactly one row? then we have found the user
  if ($stmt->num_rows != 1) {
  	$stmt->close(); 
    return false;
  }
  	
  else {
    $stmt->close(); 
    return true;
  }
  

}

function showerror()
{
      die("Error " . mysql_errno() . " : " . mysql_error());
}

function isfriend($uid, $fid)
{
	$con=dbopen();
	$sql6= "select * from friend where sid=? and fid =?";
    $stmt = $con->prepare($sql6);
    $stmt->bind_param('ss', $uid,$fid);  
    $stmt->execute(); 
 	$result = $stmt->get_result();
 	$stmt->close(); 
 	mysqli_close($con);
	return $result;
}

function isfollow($uid, $cid)
{
	$con=dbopen();
	$sql6="select * from follow where sid='$uid' and cid ='$cid' ";
	$result= mysqli_query($con,$sql6);
	$count=mysqli_num_rows($result);
	mysqli_close($con);
	return $count;
}

function isapply($uid,$jid)
{
	$con=dbopen();
	$sql6="select * from apply where sid='$uid' and jid ='$jid' ";
	$result= mysqli_query($con,$sql6);
	$count=mysqli_num_rows($result);
	mysqli_close($con);
	return $count;
}

function isforward($uid,$fid,$jid)
{
	$con=dbopen();
	$sql6="select * from forward where sender='$uid' and jid ='$jid' and receiver='$fid' ";
	$result= mysqli_query($con,$sql6);
	$count=mysqli_num_rows($result);
	mysqli_close($con);
	return $count;
}
//confirmuser( 'user2', 'pass2');
//addjob('developer','20000', 'good', 'home', 'none', 'google','googlejobs.com');
/*
$result = getjobs ();
while($row = mysql_fetch_assoc($result))
{
	echo $row['Title']."&nbsp&nbsp";
	echo $row['Salary']."&nbsp&nbsp";
	echo $row['Job_Description']."&nbsp&nbsp";
	echo $row['Location']."&nbsp&nbsp";
	echo $row['Qualifications']."&nbsp&nbsp";
	echo $row['Employer']."&nbsp&nbsp";
	echo $row['website']."<br>";
}
*/
?>