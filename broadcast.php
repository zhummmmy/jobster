

<?php
session_start();
include 'JobsDB.php'; 
$con = dbopen();

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
  <link rel="stylesheet" type="text/css" href="broadcaststyle.css">
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
     


    <form action = 'search.php'>

      <input name = "keywords" class="search" placeholder="Search..." required>
      <span class="arrow">
        <input type="submit" class="button" value="Search">
      </span>
    </form>

    <br><br>


   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>





    

