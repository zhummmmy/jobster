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
$query1 = "SELECT sid, sname, university, major FROM student where ((sname like ?) or (major like ?)) and sid<>?";
$keyword1 = "%{$keyword}%";
$stmt = $con->prepare($query1);
$stmt->bind_param('sss', $keyword1,$keyword1, $uid);  
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
     if (mysqli_num_rows($result1) > 0) {

        echo "<table border='1'>
        <tr>
        <th>Student name </th>
        <th>University</th>
        <th>Major</th>
        <th>Show detail</th>
        <th>Add friend</th>
        </tr>";
    while($row = mysqli_fetch_assoc($result1)){
              echo "<tr>";
              $fid=$row['sid'];
               echo "<td>" . htmlspecialchars($row['sname']) . "</td>";
               echo "<td>" . htmlspecialchars($row['university']) . "</td>";
               echo "<td>" . htmlspecialchars($row['major']) . "</td>";
               $result4=isfriend($uid,$fid);
               
               echo "<td>"."<a href='frienddetail.php?sid=$uid & fid=$fid'>"."<button type='submit'>"."detail"."<value='detail'>"."</button>"."</a>"."</td>";
                
              if(mysqli_num_rows($result4)==0){
                echo "<td>"."<a href='addfriend.php?sid=$uid & fid=$fid'>"."<button type='submit'>"."add"."<value='add'>"."</button>"."</a>"."</td>";
              }

                else{
                    $row1 = mysqli_fetch_assoc($result4);
                    if($row1['fstatus']=='request'){
                      echo "<td>requested</td>";
                    }
                    else{
                  echo "<td>added</td>";
                } }
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
