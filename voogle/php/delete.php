<?php
 error_reporting(E_ERROR | E_PARSE);
  $servername = "localhost";
$username = "your_username";
$password = "password";
$dbname="Intranet";
$conn = new mysqli($servername, $username, $password, $dbname);
$test=$_POST['paths'];
$opts=array();
foreach ($test as $path)
{
$a=$a+1;
$opts[$a]=$path;
}
//echo $opts[2];
//echo $a;
$sql="Delete from Default_Locations where ";
for($z=1;$z<=$a;$z++)
{
    if($z==1)
    {
      $strings .= " id = ". $opts[$z];
    }
    else
    {
      $strings .= " or id = ". $opts[$z];
    }
}
$result = $sql .= $strings .= ";";
//echo $result;
$command=mysqli_query($conn, $sql);
if(!command)
{
  echo "Error Occured";
}
else
{
  echo "Values have been deleted";
}
echo "<br>";
echo "<a href='../html/configuration.html'>Back</a>"
?>
