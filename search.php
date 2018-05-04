<?php
include 'JobsDB.php';	
$keywords =$_GET['keywords'];
$result = getRelatedStudents($keywords);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo  "Student Name: " . $row["sname"];
        echo "University:". $row["university"];
        echo "Major:". $row["major"];
        echo "Phone: ". $row["phone"]; 
        echo "Email: ". $row["email"];
        echo "Interests:". $row["interests"];
        echo "Qualification". $row["qualification"];
        echo "<br> <br> <br>";
    }
} else {
    echo "0 results";
}

?>


