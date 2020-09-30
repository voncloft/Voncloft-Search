<?php

$servername = "127.0.0.1";
$username = "your_username";

$password = "password";

$dbname = "Intranet";

$conn = mysqli_connect($servername, $username, $password, $dbname); 

if (!$conn) {

die("Connection failed: " . mysqli_connect_error()); 

 }


 $sql="select Distinct Type from Filenames order by Type ASC";
 $result=mysqli_query($conn, $sql);
$values=array();
$i=0;
while($row=mysqli_fetch_array($result))
    {
	$i=$i+1;
        $values[$i]=$row['Type'];
    }	

$sql = "Select * from Filenames";
$result = mysqli_query($conn, $sql);
$rowcount=mysqli_num_rows($result);
echo "Total Records<br>";
echo $rowcount."<br><br>";


for ($c=1;$c<=$i;$c++)
{

$sql2="Select * from Filenames where type = '".$values[$c]."'";	
$result = mysqli_query($conn, $sql2);
$rowcount=mysqli_num_rows($result);
echo ucwords($values[$c])."<br>";
echo $rowcount."<br><br>";
}


$sql="SELECT max(id) as mx from Updates";
$result_date=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result_date);$maxid=$row['mx'];
//echo $maxid;
$sql="Select date from Updates where id =".$maxid;
$abc=mysqli_query($conn, $sql);
//echo $sql;
$final=mysqli_fetch_row($abc);
echo "Last update was: ".$final[0];


mysqli_close($conn);
?>
