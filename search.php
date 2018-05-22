<?php


session_start();
include 'JobsDB.php';
$con = dbopen();

$uid = $_SESSION["uid"];
$keywords =$_GET['keywords'];

$query = "SELECT * FROM company where cid='$uid'";
$companyinfo = mysqli_query($con, $query);


$result = getRelatedStudents($keywords);
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

     if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
        <tr>
        <th>Student name </th>
        <th>University</th>
        <th>Major</th>
        <th>Show detail</th>
        <th>Notification</th>
        </tr>";
        while ($row = mysqli_fetch_assoc($result)){
              $sid = $row['sid'];
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['sname']) . "</td>";
              echo "<td>" . htmlspecialchars($row['university']) . "</td>";
              echo "<td>" . htmlspecialchars($row['major']). "</td>";
              echo "<td>"."<a href='studentdetail.php?sid=$sid'>"."<button type='submit'>"."detail"."<value='detail'>"."</button>"."</a>"."</td>";
              echo "<td>"."<a href='notifyJob.php?sid=$sid'>"."<button type='submit'>"."notify"."<value='detail'>"."</button>"."</a>"."</td>";

        }
        echo "</table>";
    }
    else {
        echo "no results";
    }

?>


   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>


