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

   </div>
   <div class = "middle">
    
<form method="Post" action='PostJobForm_Redirect.php'>

<!--Table Begins-->
<div align = "center">
<table>
	<tr>
		<td width="200">
			<h4 class= "form_sections"  style="display: inline;"> <font color="Green"> Job Title</h4>
		</td>
		<td>
			<input type= "text" placeholder="Job title" name="job_title"></tr>
		</td>
	</tr>
	<tr>
		<td>	
			<h4 class= "form_sections" style="display: inline;"><font color="Green">  Salary</h4>
		</td>
		<td>	
			<input type= "text" placeholder="annual salary(in $)" name="job_salary">
		</td>
	</tr>
	<tr>
		<td>		
			<h4 class= "form_sections" style="display: inline;"><font color="Green">Qualifications</h4>
		</td>
		<td>	
			<input type= "text" placeholder="Minimum Qualification required" name="job_req" style="height:100px; width:400px;"><br />
		</td>
	</tr>
	<tr>
		<td>	
			<h4 class= "form_sections" style="display: inline;"><font color="Green">  Job Description</h4>
		</td>
		<td>	
			<input type= "text" placeholder="Describe Job roles and responsibilities" name="job_desc" style="height:300px; width:400px;">
		</td>
	</tr>
	

	
</table>
<div>
<!--Table ends-->

<input type="submit">
<style>
input[type=submit] {
    width: 20%;
    background-color: #3366FF;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
<style>
</form>



   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>

