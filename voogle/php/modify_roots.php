 <?php
 error_reporting(E_ERROR | E_PARSE);
include_once '../include/dbconnect.php';
$sql="Select * from Default_Locations";
$result=mysqli_query($conn, $sql);
     $id=array();
     $path=array();
  
    while($row=mysqli_fetch_array($result))
    {
      $a=$a+1;
      $path[$a]=$row["Path"];
      $id[$a]=$row["ID"];
    }
    ?>
  <form action="./delete.php" method="post"> 
      <?php
      $z=sizeof($path);
      //echo $z;
      for($i=1;$i<=$z;$i++)
      {
            echo "<input type='checkbox' name='paths[]' id='paths' value=".$id[$i].">".$path[$i]."<br>";
 
      }
      ?>
     <br><input type="submit">
       </form>
      
    </form>

 
