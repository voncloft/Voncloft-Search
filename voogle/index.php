<html>
<head>
<link rel="stylesheet" type="text/css" href="http://192.168.1.1:100/include/colors.css" />
<script type="text/javascript" src="include/jquery/jquery.js"></script>
<script type="text/javascript" src="include/jquery/jquery.autocomplete.js"></script>
<script>
 $(document).ready(function(){
  $("#name").autocomplete("php/autocomplete.php", {
        selectFirst: true
  });
 });
</script>
</head>
<body>
<title>Voncloft Search</title>
<center>
<form action="php/search.php?page=0" method="post">
<input type="hidden" name="update" value="<?php echo $stat;?>">
<img src="images/logo.png" height="300" width="300">
<br>
<br>

Random quote:
<?php 

$output = shell_exec('fortune');
echo "$output";
?>
<br>
<br>
<?php
session_start();

$sql2="testing what what";

$servername = "localhost";
$username = "your_username";
$password = "password";
$dbname="Intranet";
$conn = new mysqli($servername, $username, $password, $dbname);


if (mysqli_connect_errno())
{
  trigger_error('Database connection failed: ');
}
else
{
    $sql="select * from options order by search_term ASC";
    $result=mysqli_query($conn, $sql);
    $options='<select name="options">';
    while($row=mysqli_fetch_array($result))
    {
      $options .= '<option value="'.$row['search_term'].'">'.$row['search_term'].'</option>';
     }
    $options .= '</select>';
    $options .= '<input type="text" name="name" id="name">';
    echo $options;
    //$sql="select * from types order by type";
    $sql="select distinct Type from Filenames order by Type ASC";
    $result=mysqli_query($conn, $sql);

    $options='Type: <select name="type">';
    $options.='<option value=Any>Any</option>';
    while($row=mysqli_fetch_array($result))
    {
      $options .= '<option value="'.$row['Type'].'">'.ucwords($row['Type']).'</option>';
     }
    $options .= '</select>';
    echo $options;
    
$_SESSION["start"] = "0";
$_SESSION["phpvar"] = "1as";
}

?>

<input type="submit">
<br>

<a href = "html/configuration.html">Configuration</a>


</center>
</form>
<center>
<?php
$sql="SELECT max(id) as mx from Updates";

$result_date=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result_date);
$maxid=$row['mx'];
//echo $maxid;
$sql="Select date from Updates where id =".$maxid;
$abc=mysqli_query($conn, $sql);
//echo $sql;
$final=mysqli_fetch_row($abc);
echo "Last update was: ".$final[0];
//$output = shell_exec('fortune | cowsay -f tux');
//echo "<pre>$output</pre>";


echo "<br><a href=search_stats.php>Search Statistics</a>";


echo "<br><br>Version 3.3<br>Last Update Applied: 08-02-2019 02:50:00 AM";
?>
</center>
</body>
</html> 
