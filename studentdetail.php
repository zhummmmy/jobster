<?php




include 'JobsDB.php';

session_start();
$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());
//}
/////////////////////////////////////
$uid = $_SESSION["uid"];
$sid = $_GET['sid'];

$query = "SELECT * FROM company where cid='$uid'";
$companyinfo = mysqli_query($con, $query);


$query1 = "SELECT *
FROM student
where sid='{$sid}' and (security='allow' or sid in (select sid from apply natural join job where cid='$uid'))";

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


  if (mysqli_num_rows($companyinfo) > 0) {
    while($row = mysqli_fetch_assoc($companyinfo)) {
      echo "Company Name"."<br>"; 
      echo "<div>" . htmlspecialchars($row['cname']) . "</div>" . "<br>";
      echo "Location"."<br>";
      echo "<div>" . htmlspecialchars($row['clocation']) . "</div>"."<br>";
      echo "Industry"."<br>";
      echo "<div>" . htmlspecialchars($row['industry']) . "</div>" ."<br>";
    }
  } else{
    echo "not enough information";
  }


?>
   </div>
   <div class = "right">

     <a href="company.php" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 30px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      Home
      </p>
    </div>  
  </a>
        <a href="postJob.php" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 30px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      Post a Job
      </p>
    </div>  
  </a>

    <a href="broadcast.php" style="text-decoration: none; color: black;">
    <div style="width: 120px;  height: 30px; background-color: orange; border: solid red 1px; border-radius: 10px; text-align: center; margin-top: 1%; margin-left: 5%;">
      <p style="font-size:18px; font-family: cursive; margin: 2px auto;"> 
      broadcast
      </p>
    </div>  
  </a>
   </div>
   <div class = "middle">
<?php  
    if (mysqli_num_rows($result1) > 0) {


        echo "<table border='2'>
        <tr>
        <th>Friend's name </th>
        <th>GPA</th>
        <th>University</th>
        <th>Major</th>
        <th>Phone</th>
        <th>Email</th>
        <th>interests</th>
        <th>qualification</th>
        <th>Resume</th>
        </tr>";
    while($row = mysqli_fetch_assoc($result1)){

              echo "<tr>";
               echo "<td>" . htmlspecialchars($row['sname']) . "</td>";
               echo "<td>" . htmlspecialchars($row['gpa']) . "</td>";
               echo "<td>" . htmlspecialchars($row['university']) . "</td>";
               echo "<td>" . htmlspecialchars($row['major']) . "</td>";
               echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
               echo "<td>" . htmlspecialchars($row['email']) . "</td>";
               echo "<td>" . htmlspecialchars($row['interests']) . "</td>";
               echo "<td>" . htmlspecialchars($row['qualification']) . "</td>";
               echo "<td>" . htmlspecialchars($row['resume']). "</td>";
               echo "</tr>";
 
    }
 
  echo "</table>";
}

else {
    echo "This person doesn't share his personal information";
}



?>
   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>
