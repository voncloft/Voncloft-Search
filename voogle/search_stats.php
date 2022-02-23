<?php
include_once 'include/dbconnect.php';
if (!$conn) {
die("Connection failed: " . mysqli_connect_error()); 
}
echo "<table border = 2 height = '550px'><tr><td>";
 $sql="select count(*) as num,Search_query from Search_History group by Search_query order by count(*) DESC;";
 $result=mysqli_query($conn, $sql);
$values=array();
$rows=array();
$i=0;


while($row=mysqli_fetch_array($result))
    {
	$i=$i+1;
        $values[$i]=$row['Search_query'];
        $rows[$i]=$row['num'];
    }	

$sql = "select count(*),Search_query from Search_History group by Search_query order by count(*);";
$result = mysqli_query($conn, $sql);
$rowcount=mysqli_num_rows($result);
echo "Total Records</td><td>";
echo $rowcount."</td></tr>";
?>
<form action="php/search.php?page=0" method="post">
<?php
	for ($c=1;$c<=$i;$c++)
	{
		//echo "<tr><td><a href='".ucwords($values[$c])."'>".ucwords($values[$c])."</a></td><td>";
		echo "<tr><td><a href='php/search.php?page=0&history=1&newsql=".ucwords($values[$c])."'>".ucwords($values[$c])."</a></td><td>";
		echo $rows[$c]."</td></tr>";
	}
echo "</table>";
?>
</form>
