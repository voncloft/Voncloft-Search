 
<?php
//error_reporting(0);
 $q=$_GET['q'];
 //echo $q;
include_once '../include/dbconnect.php';
 $my_data=mysqli_real_escape_string($conn,$q);
 //echo $my_data;
 //$sql="SELECT distinct Search_query FROM Search_History WHERE Search_query LIKE '%$my_data%' ORDER BY Search_query";
 $sql="SELECT distinct filename FROM Filenames WHERE filename LIKE '%$my_data%' or description like '%$my_data%' ORDER BY filename";
//echo $sql; 
 $result = mysqli_query($conn,$sql) or die(mysqli_error());

 if($result)
 {
  while($row=mysqli_fetch_array($result))
  {
   echo $row['filename']."\n";
  }
 }
?>
