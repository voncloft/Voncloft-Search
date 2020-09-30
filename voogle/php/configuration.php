<?php
$location=$_POST["location"];
$servername = "localhost";
$username = "your_user_name";
$password = "password";
$dbname="Intranet";
$conn = new mysqli($servername, $username, $password, $dbname);

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
