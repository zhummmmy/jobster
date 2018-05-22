<?php



session_start();

if(!isset($_SESSION["uid"])){
  header("Location: index.php");
}
include 'JobsDB.php'; 
$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());

//}
/////////////////////////////////////
$uid = $_SESSION["uid"];

$query = "SELECT * FROM company where cid='$uid'";
$result = mysqli_query($con, $query);
mysqli_close($con);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Job Post</title>
  <link rel="stylesheet" href="companystyle.css">
</head>

  
<body>


 <div class = "wrap" align="center">
   <div class = "left"> 
<?php


  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
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
  echo "</table>";
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

      $result1 = getJobs($uid);
      
    

      if (mysqli_num_rows($result1) > 0) {
        echo "<h2>Job Announcements</h2><br><br>";
         echo "<table border='1'>
      <tr>
      <th>title</th>
      <th>salary</th>
      <th>requirements</th>
      <th>descriptions</th>
      <th>Post Date</th>
      <th>Due Date </th>
      <th>Candidate Status</th>
      </tr>";
        while($row = mysqli_fetch_assoc($result1)) {
          $jid = $row['jid'];
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['title']) . "</td>";
          echo "<td>" . htmlspecialchars($row['salary']) . "</td>";
          echo "<td>" . htmlspecialchars($row['requirements']) . "</td>";
          echo "<td>" . htmlspecialchars($row['descriptions']) . "</td>";
          echo "<td>" . htmlspecialchars($row['jdate']) . "</td>";
          echo "<td>" . htmlspecialchars($row['due']) . "</td>";
          echo "<td>"."<a href='candidateList.php?jid=$jid'>"."<button type='submit'>"."candidate list"."<value='detail'>"."</button>"."</a>"."</td>";
          echo "</tr>";
        }
      } else {
        echo "No Job Announcements";
      }
      echo "</table>";


    ?> 

   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>
