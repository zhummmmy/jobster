<?php
session_start();
include 'JobsDB.php'; 
$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());

//}
/////////////////////////////////////
$uid = $_SESSION["uid"];
$jid = $_GET["jid"];
$query = "SELECT * FROM company where cid='$uid'";
$result = mysqli_query($con, $query);
mysqli_close($con);
?>


<!DOCTYPE html>
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

   </div>
   <div class = "middle">
     <?php

      $result1 = getCandidates($jid);
    
    

      if (mysqli_num_rows($result1) > 0) {
           echo "<table border='1'>
          <tr>
      <th>Student Name</th>
      <th>University</th>
      <th>Major</th>
      <th>Detail</th>
      <th>Accept</th>
      <th>Reject</th>
      </tr>";
        while($row = mysqli_fetch_assoc($result1)) {
          $sid = $row['sid'];
          echo "<tr>";
          echo "<td>" . htmlspecialchars($row['sname']) . "</td>";
          echo "<td>" . htmlspecialchars($row['university']) . "</td>";
          echo "<td>" . htmlspecialchars($row['major']) . "</td>";
          echo "<td>"."<a href='studentdetail.php?sid=$sid'>"."<button type='submit'>"."detail"."<value='detail'>"."</button>"."</a>"."</td>";
          echo "<td>"."<a href='accept.php?jid=$jid&sid=$sid'>"."<button type='submit'>"."accept"."<value='detail'>"."</button>"."</a>"."</td>";
          echo "<td>"."<a href='reject.php?jid=$jid&sid=$sid'>"."<button type='submit'>"."reject"."<value='detail'>"."</button>"."</a>"."</td>";

          echo "</tr>";
        }
      } else {
        echo "No candidate applies to this job now";
      }
      echo "</table>";


    ?> 

   </div>
   
   <div class = "clear"></div>
 </div>

</body>
</html>

