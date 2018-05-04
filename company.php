<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'myzhu');
define('DB_NAME', 'jobster');

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());

//}
/////////////////////////////////////

$password = $_POST['password'];
$uid = $_POST['uid'];


$judge = "SELECT cid FROM company where cid='$uid' and cpassword='$password' ";
$result_judge = mysqli_query($con, $judge);
$row_judge = mysqli_fetch_array($result_judge);
$print =  $row_judge['cid'];



if ($print == '') {
  echo 'Please check your memberID or password!';
  $query = "SELECT * FROM company where cid='zzzzzzz' ";
  $result = mysqli_query($con, $query);

} else {

  $query = "SELECT * FROM company where cid='$uid' ";
  $result = mysqli_query($con, $query);

 

}
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
      echo "<div>" . $row['cname'] . "</div>" . "<br>";
      echo "Location"."<br>";
      echo "<div>" . $row['clocation'] . "</div>"."<br>";
      echo "Industry"."<br>";
      echo "<div>" . $row['industry'] . "</div>" ."<br>";
 
    }
  } else{
    echo "not enough information";
  }
  echo "</table>";
?>
   </div>
   <div class = "right">
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
      <table cellspacing="0">
          <tbody class="searchResultsJobs">
          <!-- Job Info Start -->
                <tr class="priorityListing">
      <td>
      <span class="priority"></span> <!-- update 13.08.15 for show priority   --> 
        <div class="listing-section">
          <div class="listing-title">
            <a name="listing_72166"></a>
            <div> Java Developer</div>
          </div>
          <div class="listing-info job_result_width">
            <div class="left-side">
              <span class="captions">Location:</span><span class="captions-field">Irving, TX</span><br/>
              <span class="captions">Posted:</span><span class="captions-field">04/30/2018</span><br/>
              <span class="captions">Company:</span><span class="captions-field">MicroSoft</span><br/>
            </div>
            
            <div class="clr"></div>
            <div class="show-brief">
               Microsoft Corporation is an American multinational technology company with headquarters in Redmond, Washington. It develops, manufactures, licenses, supports and sells computer software, consumer electronics, personal computers, and services          
             </div>
          </div>
         
          <div class="clr"></div>
        </div>
    </td>
    </tr>

   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>
