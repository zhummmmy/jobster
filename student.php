<?php
include 'JobsDB.php';
session_start();

$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());
//}
/////////////////////////////////////
if(!isset($_SESSION["uid"])){
  header("Location: index.php");
}


$uid = $_SESSION["uid"];

//$uid= $_GET['uid'];


/*
$judge = "SELECT sid FROM student where sid='$uid' and spassword='$password' ";
$result_judge = mysqli_query($con, $judge);
$row_judge = mysqli_fetch_array($result_judge);
$print =  $row_judge['sid'];


if ($print == '') {
  echo 'Please check your memberID or password!';
} else {
*/
$query = "SELECT * FROM student where sid='$uid' ";
$result = mysqli_query($con, $query);
$query1 = "SELECT cname, title, astatus FROM apply natural join job natural join company where sid='$uid' ";
$result1 = mysqli_query($con, $query1);



mysqli_close($con);
?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Student</title>
  <link rel="stylesheet" href="companystyle.css">
</head>

  
<body>
  
 <div class = "wrap" align="center">
   <div class = "left"> 
<?php


  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      echo "Student Name"."<br>"; 
      echo "<div>" . htmlspecialchars($row['sname']) . "</div>" . "<br>";
      echo "University"."<br>";
      echo "<div>" . htmlspecialchars($row['university']) . "</div>"."<br>";
      echo "Major"."<br>";
      echo "<div>" . htmlspecialchars($row['major']) . "</div>" ."<br>";
 
    }
  } else{
    echo "not enough information";
  }
  echo "</table>";
?>

 <a href="updateprofile.php?sid=<?php echo $uid ?>" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 60px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      update profile
      </p>
    </div>  
  </a>



   </div>
   <div class = "right">
   <a href="student.php?uid=<?php echo $uid ?> " style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 60px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      Home
      </p>
    </div>  
  </a>

       <a href="searchcompany.php?sid=<?php echo $uid ?>" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 60px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      search company
      </p>
    </div>  
  </a>

    <a href="searchstudent.php?sid=<?php echo $uid ?>" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 60px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      search student
      </p>
    </div>  
  </a>

   <a href="searchjobs.php?sid=<?php echo $uid ?>" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 30px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      search jobs
      </p>
    </div>  
  </a>

    <a href="friendlist.php?sid=<?php echo $uid ?>" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 30px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      friend list
      </p>
    </div>  
  </a>

    

  <a href="notification.php?sid=<?php echo $uid ?>" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 30px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      notification
      </p>
    </div>  
  </a>

<br><br><br><br><br><br><br>
<br><br><br><br><br><br><br>
  <a href="logout.php" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 30px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      Log out
      </p>
    </div>  
 </a>

   </div>
   <div class = "middle">
<?php
      if (mysqli_num_rows($result1) > 0) {
        echo "<h2>Applied Jobs</h2><br><br>";
        echo "<table border='1'>
        <tr>
        <th>Company name </th>
        <th>Job Title</th>
        <th>Status</th>
        </tr>";

        while($row = mysqli_fetch_assoc($result1))
           {
               echo "<tr>";
               echo "<td>" . htmlspecialchars($row['cname']) . "</td>";
               echo "<td>" . htmlspecialchars($row['title']) . "</td>";
               echo "<td>" . htmlspecialchars($row['astatus']) . "</td>";
               echo "</tr>";
            }
        echo "</table>";
      }
      else {
        echo "begin to apply your job!";
      }

?>
   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>
