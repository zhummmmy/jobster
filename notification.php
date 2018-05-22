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
$query1 ="SELECT S.sname,S.sid
FROM friend as F, student as S
where F.fid='$uid' and F.sid=S.sid and  fstatus='request'";
$result1 = mysqli_query($con, $query1);
$query2= "SELECT *
FROM job natural join notification natural join company
where sid='$uid' and nstatus='not viewed' order by ntime desc";
$result2 = mysqli_query($con, $query2);
$query3="SELECT S.sname, C.cname, J.title, J.salary, J.requirements, J.descriptions, J.jid
FROM forward as F, job as J, student as S,company as C
where F.receiver='$uid' and F.sender=S.sid and F.jid=J.jid and C.cid=J.cid and F.fostatus='not viewed'";
$result3 = mysqli_query($con, $query3);


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
<?php
  echo "friend request <br>"; 
  echo "<table border='1'>
        <tr>
        <th>Student's name </th>
        <th>Detail</th>
        <th>Accept</th>
        <th>decline</th>
        </tr>";
    while($row = mysqli_fetch_assoc($result1)){
              $fid=$row['sid'];
              echo "<tr>";
               echo "<td>" . htmlspecialchars($row['sname']) . "</td>";
               echo "<td>"."<a href='frienddetail.php?sid=$uid & fid=$fid'>"."<button type='submit'>"."detail"."<value='detail'>"."</button>"."</a>"."</td>";
               echo "<td>"."<a href='acceptrequest.php?sid=$uid & fid=$fid'>"."<button type='submit'>"."accept"."<value='accept'>"."</button>"."</a>"."</td>";
               echo "<td>"."<a href='declinerequest.php?sid=$uid & fid=$fid'>"."<button type='submit'>"."decline"."<value='decline'>"."</button>"."</a>"."</td>";
               echo "</tr>";
 
    }
 
  echo "</table>";


  echo "<br><br><br>Followed Companys' Post";
  echo "<table border='1'>
        <tr>
        <th>Company name </th>
        <th>Job name</th>
        <th>Salary</th>
        <th>requirements</th>
        <th>descriptions</th>
        <th>apply</th>
        <th>ignore</th>
        <th>Forward</th>
        </tr>";
    while($row = mysqli_fetch_assoc($result2)){
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
               echo "<td>"."<a href='declinejob.php?sid=$uid&jid=$jid'>"."<button type='submit'>"."ignore"."<value='ignore'>"."</button>"."</a>"."</td>";
               echo "<td>"."<a href='fowardjob.php?sid=$uid&jid=$jid'>"."<button type='submit'>"."foward"."<value='foward'>"."</button>"."</a>"."</td>";
               echo "</tr>";
 
    }
 
  echo "</table>";


   echo "</table>";


  echo "<br><br><br>Foward by friends' Post";
  echo "<table border='1'>
        <tr>
        <th>Friend's name </th>
        <th>Company name </th>
        <th>Job name</th>
        <th>Salary</th>
        <th>requirements</th>
        <th>descriptions</th>
        <th>apply</th>
        <th>ignore</th>
        <th>Forward</th>
        </tr>";
    while($row = mysqli_fetch_assoc($result3)){
              echo "<tr>";
              $jid=$row['jid'];
              echo "<td>" . htmlspecialchars($row['sname']) . "</td>";
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
                echo "<td>"."<a href='declinejob.php?sid=$uid&jid=$jid'>"."<button type='submit'>"."ignore"."<value='ignore'>"."</button>"."</a>"."</td>";
                echo "<td>"."<a href='fowardjob.php?sid=$uid&jid=$jid'>"."<button type='submit'>"."foward"."<value='foward'>"."</button>"."</a>"."</td>";
               echo "</tr>";
 
    }
 
  echo "</table>";

?>





   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>