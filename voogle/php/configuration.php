<?php
include_once '../include/dbconnect.php'
if (mysqli_connect_errno())
{
  trigger_error('Database connection failed: ');
}
else
{
  $sql="INSERT INTO Default_Locations (Path) VALUES ('".$location."')";
  mysqli_query($conn, $sql);
  echo "Database Updated";
}
echo "<br>";
echo "<a href='../html/configuration.html'>Back</a>"
?>
