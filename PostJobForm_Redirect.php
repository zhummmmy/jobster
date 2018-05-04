<?php

include 'JobsDB.php';	


$title=$_GET['job_title'];
$salary=$_GET['job_salary'];
$description=$_GET['job_desc'];
$requirements=$_GET['job_req'];


addjob ($title, $salary, $requirements, $description);



?>

