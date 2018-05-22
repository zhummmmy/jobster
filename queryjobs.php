<?php
include 'JobsDB.php';


$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());
//}
/////////////////////////////////////
$uid = $_GET['sid'];
$keyword = $_POST['keyword'];


$query = "SELECT * FROM student where sid='$uid' ";
$result = mysqli_query($con, $query);
$query1 = "SELECT * FROM company natural join job where ((title like ?) or (requirements like ?) or (descriptions like ?))";
$keyword1 = "%{$keyword}%";
$stmt = $con->prepare($query1);
$stmt->bind_param('sss', $keyword1,$keyword1, $keyword1);  
$stmt->execute(); 
$result1 = $stmt->get_result();
$stmt->close(); 

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
   </div>
   <div class = "right">
    <a href="student.php?uid=<?php echo $uid ?>  " style="text-decoration: none; color: black;">
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
<?php  
     if (mysqli_num_rows($result1) > 0) {

        echo "<table border='1'>
        <tr>
        <th>Company name </th>
        <th>Job name</th>
        <th>Salary</th>
        <th>requirements</th>
        <th>descriptions</th>
        <th>apply</th>
        <th>foward</th>
        </tr>";
    while($row = mysqli_fetch_assoc($result1)){
              echo "<tr>";
              $jid=$row['jid'];
               echo "<td>" . htmlspecialchars($row['cname']) . "</td>";
               echo "<td>" . htmlspecialchars($row['title']) . "</td>";
               echo "<td>" . htmlspecialchars($row['salary']) . "</td>";
               echo "<td>" . htmlspecialchars($row['requirements']) . "</td>";
               echo "<td>" . htmlspecialchars($row['descriptions']) . "</td>";
               $count=isapply($uid,$jid);
               if($count==0){
               echo "<td>"."<a href='applyjob.php?sid=$uid&jid=$jid'>"."<button type='submit'>"."apply"."<value='apply'>"."</button>"."</a>"."</td>";
               }
               else{
                echo "<td>applied</td>";
               }
               echo "<td>"."<a href='fowardjob.php?sid=$uid&jid=$jid'>"."<button type='submit'>"."foward"."<value='foward'>"."</button>"."</a>"."</td>";
               echo "</tr>";
 
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
