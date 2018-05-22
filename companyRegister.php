<?php

include 'JobsDB.php';	


$companyid=$_GET['CompanyId'];
$password=$_GET['password'];
$cname=$_GET['CompanyName'];
$location =$_GET['Location'];
$industry = $_GET['Industry'];

if (addCompany ($companyid, $password, $cname, $location,  $industry) == false) {
	echo "This account has been registered<br>";
    echo "<a href='index.php'>Back to the login Page</a>". "<br>";
} else {
	header("Location: index.php");
}



?>