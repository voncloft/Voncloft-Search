<?php
$servername = "localhost";
$username = "your_username";
$password = "password";
$dbname = "Intranet";

$conn = mysqli_connect($servername, $username, $password, $dbname); 
include "include/libchart/classes/libchart.php";
if (!$conn) {die("Connection failed: " . mysqli_connect_error()); }
echo "<center><table border = 2><tr><td>";
echo "<table border = 2 height = '550px'><tr><td>";
$sql="Select count(*) as num,Type from Filenames group by Type order by count(*) DESC;";
$result=mysqli_query($conn, $sql);
$values=array();
$rows=array();
$i=0;
$chart = new PieChart(800,550);
$dataSet = new XYDataSet();
$rowcount=0;
while($row=mysqli_fetch_array($result))
    {
	$i=$i+1;
        $values[$i]=$row['Type'];
        $rows[$i]=$row['num'];
	$rowcount+=$row['num'];
    }	
echo "Total Records</td><td>";
echo $rowcount."</td></tr>";
for ($c=1;$c<=$i;$c++)
{
$rowcount=$rows[$c];
echo "<tr><td>".ucwords($values[$c])."</td><td>";
echo $rowcount."</td></tr>";
$dataSet->addPoint(new Point("{$values[$c]}", $rows[$c]));
}
echo "</table>";
echo "</td><td>";

$chart->setDataSet($dataSet);
 
//set chart title
$chart->setTitle("Latest Stats of Database");
        
//render as an image and store under "generated" folder
$chart->render("1.png");
    
//pull the generated chart where it was stored
echo "<img alt='Pie chart'  src='1.png' style='border: 1px solid gray;'/>";
    
echo "</td></tr></table>";
$sql="SELECT max(id) as mx from Updates";
$result_date=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result_date);$maxid=$row['mx'];
//echo $maxid;
$sql="Select date from Updates where id =".$maxid;
$abc=mysqli_query($conn, $sql);
//echo $sql;
$final=mysqli_fetch_row($abc);
echo "Last update was: ".$final[0];

echo "<br><a href='http://192.168.1.1:100/index.php'>Voogle</a>";
mysqli_close($conn);
    
?>
