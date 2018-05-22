<?php

include 'JobsDB.php';	


$studentid=$_GET['studentid'];
$password=$_GET['password'];
$sname=$_GET['studentname'];


if (addStudent ($studentid, $password, $sname) == false) {
	echo "This account has been registered <br>";
    echo "<a href='index.php'> Back to the login Page</a>". "<br>";
} else {
	header("Location: index.php");
}

?>