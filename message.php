<?php
include 'JobsDB.php';


$con = dbopen();
//$db_selected=mysql_select_db('library', $con);
//if (!$db_selected) {
//    die ('Can\'t use library : ' . mysql_error());
//}
/////////////////////////////////////

$uid = $_GET['sid'];
$fid = $_GET['fid'];


$query = "SELECT * FROM student where sid='$uid' ";
$result = mysqli_query($con, $query);
$query1 = "SELECT * from message where (sender='$uid' and receiver = '$fid') or (sender='$fid' and receiver = '$uid') order by mtime ";
$result1 = mysqli_query($con, $query1);


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
    while($row = mysqli_fetch_assoc($result1)){
      $sender=$row['sender'];
      
      if($sender==$uid){
        echo htmlspecialchars($sender);
        echo " : ";
        echo htmlspecialchars($row['contents']);
        echo "<br>";
      }
      else{
        echo htmlspecialchars($sender);
        echo " : ";
        echo htmlspecialchars($row['contents']);
        echo "<br>";
      }
    }


  ?>
<!--
  <div class="input" align="center">
      <form method="POST" action="messageupdate.php" > 
      <input name="content" type="text" placeholder="contents">
      <input name="sid" type="hidden" value="<?php //echo $uid;?>">
      <input name="fid" type="hidden" value="<?php //echo $fid;?>">
     <input type="submit" value="enter" >
     
    </form>
  </div>
-->

<form action="messageupdate.php" method="post">  
<input name="content" type="text" placeholder="contents">
<input name="sid" type="hidden" value="<?php echo $uid;?>">
<input name="fid" type="hidden" value="<?php echo $fid;?>">
<input name="submit"   type="submit" value="enter">  
</form>





        <?php
//        if($_POST['submit']){
//        $content=$_POST['content'];
//        $con = dbopen();
//        $result4=mysqli_query($con,"INSERT INTO message values(now(), '$uid', '$fid', '$content')");
//        mysqli_close($con);
//        }
//        else{
//          echo "error";
 //       }
        ?>

   </div>
   
   <div class = "clear"></div>
 </div>




</body>
</html>




<!--
<script>  

    var _clearText=document.getElementById("clearText");  
    _clearText.onclick=function(){  

        var _elements=document.getElementById("clearFrom").elements,  
                _elementsLen=_elements.length,  
                _ei=null,  
                i=0;  
        for(;i<_elementsLen;i++){  
            _ei=_elements[i];  
            //如果是文本类型，将其修改为空  
            (_ei.type=="text"||_ei.type=="textarea")&&(_ei.value="");  
        }  
    }  

</script>  