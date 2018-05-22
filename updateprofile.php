<?php
include 'JobsDB.php';


$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());
//}
/////////////////////////////////////
$uid = $_GET['sid'];



$query = "SELECT * FROM student where sid='$uid' ";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);


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
    
      echo "Student Name"."<br>"; 
      echo "<div>" . htmlspecialchars($row['sname']) . "</div>" . "<br>";
      echo "University"."<br>";
      echo "<div>" . htmlspecialchars($row['university']) . "</div>"."<br>";
      echo "Major"."<br>";
      echo "<div>" . htmlspecialchars($row['major']) . "</div>" ."<br>";
 
    
  } else{
    echo "not enough information";
  }
  echo "</table>";
?>
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

   </div>
   <div class = "middle">


<body style = "background-color : #336666;">

<!--Form Begins-->
<form method="POST" action='updateprofile2.php'>
<input name="sid" type="hidden" value="<?php echo $uid;?>">

<!--Table Begins-->
<div align = "center">
<table>
  <tr>
    <td width="200">
      <h4 class= "form_sections"  style="display: inline;"> <font color="Green"> GPA</h4>
    </td>
    <td>
      <input type= "text" placeholder="GPA" name="gpa" value=<?php echo $row['gpa']?> ></tr>
    </td>
  </tr>
  <tr>
    <td>  
      <h4 class= "form_sections" style="display: inline;"><font color="Green"> University</h4>
    </td>
    <td>  
      <input type= "text" placeholder="university" name="university" value="<?php echo $row['university']?>" >
    </td>
  </tr>

<tr>
    <td>  
      <h4 class= "form_sections" style="display: inline;"><font color="Green"> Major</h4>
    </td>
    <td>  
      <input type= "text" placeholder="major" name="major" value="<?php echo $row['major']?>" >
    </td>
  </tr>

<tr>
    <td>  
      <h4 class= "form_sections" style="display: inline;"><font color="Green"> Phone</h4>
    </td>
    <td>  
      <input type= "text" placeholder="phone" name="phone" value=<?php echo $row['phone']?> >
    </td>
  </tr>

  <tr>
    <td>  
      <h4 class= "form_sections" style="display: inline;"><font color="Green"> Email</h4>
    </td>
    <td>  
      <input type= "text" placeholder="emial" name="email" value=<?php echo $row['email']?> > 
    </td>
  </tr>

 
  <tr>
    <td>    
      <h4 class= "form_sections" style="display: inline;"><font color="Green">Interests</h4>
    </td>
    <td>  
      <input type= "text" placeholder="interests" name="interests"  value="<?php echo $row['interests']?>" style="height:100px; width:400px;"><br />
    </td>
  </tr>

  <tr>
    <td>    
      <h4 class= "form_sections" style="display: inline;"><font color="Green">qualifications</h4>
    </td>
    <td>  
      <input type= "text" placeholder="qualifications" name="qualifications"  value="<?php echo $row['qualification']?>" style="height:100px; width:400px;"><br />
    </td>
  </tr>



  <tr>
    <td>  
      <h4 class= "form_sections" style="display: inline;"><font color="Green">  Resume</h4>
    </td>
    <td>  
      <input type= "text" placeholder="resume" name="resume"  value="<?php echo $row['resume']?>" style="height:300px; width:400px;">
    </td>
  </tr>


  <tr>
    <td>  
      <h4 class= "form_sections" style="display: inline;"><font color="Green">  Security</h4>
    </td>
    <td>  
       <input type="checkbox" name="security" value="security" /> show other people your detail information
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
</body>



   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>
