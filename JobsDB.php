<?php
/*
$title=$_GET['job_title'];
$salary=$_GET['job_salary'];
$jobdesc=$_GET['job_desc'];
$location=$_GET['job_location'];
*/
function dbopen ()
{
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'myzhu');
	define('DB_NAME', 'jobster');

	$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	if (!$con)
  	{
  		die('Could not connect: ' . mysql_error());
  	}
	return $con;
}

function addjob ($title, $salary, $requirements, $description)
{

	$mysqli = dbopen();
	$jid = "101";
	$cid = "001";
	$jdate = date("Y/m/d");
	$due = date("Y/m/d");
	$sql1= "INSERT into Job values('{$jid}','{$cid}','{$title}','{$salary}','{$requirements}','{$description}', '{$jdate}', '{$due}')";
	
	if($mysqli->query($sql1) === TRUE) {
		echo "Post SUCCESSFULLY," . $cid . "<br>";
	} else {
		echo "SOMETHING WRONG". "<br>". $mysqli->error;
	}


}


function getjobs ()
{
	$db=dbopen ();
	$sql2="select * from jobs";
	$result = mysql_query($sql2);
	return $result;

}

function getRelatedStudents($keywords) {
	$mysqli = dbopen();
	$sql3 = "SELECT * FROM student WHERE resume like '%{$keywords}%' ";
	$result = $mysqli->query($sql3);
	return $result;
}

function addCompany($companyid, $password, $cname, $location, $industry) {
	$mysqli = dbopen();
	$sql4= "INSERT into Company values('{$companyid}','{$password}','{$cname}','{$location}','{$industry}'";
	if($mysqli->query($sql4) === TRUE) {
		echo "Register SUCCESSFULLY," . $cname. "<br>";
	} else {
		echo "SOMETHING WRONG". "<br>". $mysqli->error;
	}
}


function adduser($username, $password)
{
	dbopen();
	$sql4="INSERT into users (username, password) values('$username','$password')";
	$result = mysql_query($sql4);
	return $result;
}
// adduser('user4','pass4');


function confirmuser( $username, $password)
{
	dbopen();
	$sql5="Select id from users where username='$username' and password='$password'";
	$result= mysql_query($sql5);
	$count= mysql_num_rows($result);
	//echo $count;
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