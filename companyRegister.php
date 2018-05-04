<?php

include 'JobsDB.php';	


$companyid=$_GET['CompanyId'];
$password=$_GET['password'];
$cname=$_GET['CompanyName'];
$location =$_GET['Location'];
$industry = $_GET['Industry'];

addCompany ($companyid, $password, $cname, $location,  $industry);



?>