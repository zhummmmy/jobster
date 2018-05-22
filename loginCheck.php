<?php
// Clean the data collected in the <form>
error_reporting(E_ALL | E_STRICT); 
ini_set("display_errors", "On"); 

include 'JobsDB.php'; 

$uid = $_GET['uid'];
$password = $_GET['password'];



session_start();

$isStudent = isset($_GET["student"]);

// Authenticate the user
if (authenticateUser($uid, $password, $isStudent))
{
  // Register the loginUsername
  $_SESSION["uid"] = $uid;

  // Register the IP address that started this session
 // $_SESSION["loginIP"] = $_SERVER["REMOTE_ADDR"];

  // Relocate back to the first page of the application
  if ($isStudent) {
      header("Location: student.php");
  } else {
      header("Location: company.php");
  }

  exit;
}
else
{
  // The authentication failed: setup a logout message
  $_SESSION["message"] = 
    "Could not connect to the application as '{$uid}'";
  
  echo 'Please check your memberID or password!';

  echo "<a href='index.php'>Back to the login Page</a>". "<br>";
  // Relocate to the logout page
  //header("Location: logout.php");
  exit;
}


?>