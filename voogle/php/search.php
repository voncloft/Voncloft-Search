<HTML>
<head>
<link rel="stylesheet" type="text/css" href="http://192.168.1.1:100/include/colors.css" />
    <script type="text/javascript">
    /*function setVolume()
    {
        mySound=document.getElementById("sound");
        mySound.volume=0.1;
    }
    window.onload=setVolume;
    */
    function init() { 
   var aud=document.getElementsByTagName('audio');
    for(var c=0;c<aud.length;c++) {
      aud[c].volume=0.7;      
    }
    
 }
 
function myFunction() {
    var x = document.getElementById("sound");
    //document.getElementById("mySpan").innerHTML=("Seeking: " + x.seeking);
    }
 window.onload=init;
    </script>
</head>
<?php


set_time_limit(0);
session_start();

//error_reporting(E_ERROR | E_PARSE);
//error_reporting(0);

include_once '../include/dbconnect.php';
$firsttime=$_SESSION["start"];
$page=$_GET['page'];
error_reporting(0);
$history_search=$_GET['history'];
  //echo $history_search;
//error_reporting(0);
 $_SESSION["user"]=1;
     $keyword_fsql="select value from special where expression = 'keywords'";
  $keyword_fexec=mysqli_query($conn,$keyword_fsql);
  $keyword_f=mysqli_fetch_array($keyword_fexec);
  $keyword_families=$keyword_f[0];
  
  $_SESSION['kfarray']=explode(' ',$keyword_families);
  //echo $keyword_families;
 // echo $keyword_fsql;
  if($firsttime == 0)
  {
     $_SESSION['name_first']=$_POST["name"];
  }
 // echo$_SESSION['name_first'];
if($firsttime == 0)
{
 // $page=0;

$conditions=$_POST["name"];
$what=$_POST["options"];
$type=$_POST["type"];


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    //echo $search_history;
  }
  $search_history="Insert into Search_History(Search_query) Values (\"$conditions\")";
  mysqli_query($conn,$search_history);
  //echo $search_history."<br><br>";  

  //echo $_SESSION['kfarray'];
    // Check connection
if ($history_search != "1")
{
	if ($type == "Any")
  	{
    		$_SESSION["additional"]="order by filename ASC";
  	}
  	else
  	{
    		//echo "testing";
    		$_SESSION["additional"]=" and type = '".$type."' order by filename ASC";
  	}
	if ($what == "Is Exactly")
  	{
    		$_SESSION["terms"]="where filename = '".$conditions.$additional."'";
  	}
  	else
  	{
    		$_SESSION["terms"]="where (filename like '%".$conditions."%' or description like '%".$conditions."%' or location like '%$conditions%')".$_SESSION["additional"];
  	}
  	$_SESSION["sql3"] = "SELECT * FROM Filenames ".$_SESSION["terms"];
 }
else
{
	//echo "you are here";
	$new_search=$_GET['newsql'];
 	$_SESSION["sql3"] = "SELECT * FROM Filenames where filename like '%".$new_search."%'";
}
  	$_SESSION["start"]="1";
  	$_SESSION["type"]=$type;
  	$_SESSION["contains"]=$conditions;
    	$image_fsql="select value from special where expression = 'image'";
  	$image_fexec=mysqli_query($conn,$image_fsql);
  	$image_f=mysqli_fetch_array($image_fexec);
  	$image_families=$image_f[0];
  	$_SESSION['ifarray']=explode(' ',$image_families);


}




if(in_array($_SESSION["type"],$_SESSION['ifarray'],true))
{
$_SESSION["sql2"]=" limit 20 offset ".(($page * 20)).";";//." limit 10 offset ".$page.";";
$page_counter=20;
}
else
{
$_SESSION["sql2"]=" limit 10 offset ".(($page * 10)).";";//." limit 10 offset ".$page.";";
$page_counter=10;
}

if(in_array($_SESSION['name_first'],$_SESSION['kfarray'],true))
{
    //echo "here";
    $new_sql="select command from keywords where keyword = '".$_SESSION['name_first']."'";
    //echo $new_sql;
    $new_command=mysqli_query($conn,$new_sql);
    $new_sql_array=mysqli_fetch_array($new_command);
    $final_new_sql=$new_sql_array[0];
    //echo $final_new_sql;
    $_SESSION["sql2"]=" limit 10 offset ".(($page * 10)).";";
    $_SESSION["sql"]=$final_new_sql.$_SESSION["sql2"];
    $_SESSION["sql3"]=$final_new_sql;
    $page_counter=10;
}
else
{
   $_SESSION["sql"]=$_SESSION["sql3"].$_SESSION["sql2"];
}

echo $_SESSION["sql"]."<br>";
$result = mysqli_query($conn, $_SESSION["sql"]);
$counts=mysqli_query($conn,$_SESSION["sql3"]);
$files=array();
$files2=array();
$files3=array();
$fukes4=array();
$sizes=array();

function formatSize( $bytes )
{
        $types = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
                return( round( $bytes, 2 ) . " " . $types[$i] );
}

//$z=sizeof($_SESSION['files']);
$z=count((array)$_SESSION['files']);
//echo $sql; 
$count=mysqli_num_rows($counts);
if(in_array($_SESSION["type"],$_SESSION['ifarray'],true))
{
echo "<center>".$count." Results <br>";
$pages=$count/$page_counter;
echo "Page ".($page+1)." of ".$pages."<br></center>";
}
else
{
echo $count." Results <br>";
$pages=$count/$page_counter;
echo "Page ".($page+1)." of ".$pages."<br>";
}


if(in_array($_SESSION["type"],$_SESSION['ifarray'],true))//image
{
$row=0;
echo "<center><table border = 2>";


while ($row = mysqli_fetch_array($result))
{
        
        $rows=$rows+1;
        $url2=$row["location"];
        $url=str_replace("'", "%27", $url2);
        $url=str_replace("(", "%28", $url);
        $url=str_replace(")", "%29", $url);
        $url=str_replace("-", "%2D", $url);
        $url=str_replace(" ", "%20", $url);
        if (str_contains($url2, '192.168.1.1'))
        {
                $file2=str_replace("http://192.168.1.1:90/all","",$row["location"]);
        }
        else
        {
                $file2=str_replace("http://voncloft.com:90/all","",$row["location"]);
        }

        //$file2=str_replace("http://192.168.1.1:90/all","",$row["location"]);
	//$file2=str_replace("http://voncloft.com:90/all","",$row["location"]);
	//$file2=$row["location"];
        //$reformated="'".$row["location"]."'";
        //list($width, $height) = getimagesize($row["location"]);
        list($width, $height) = getimagesize($url);
        $start_val=($page*20);
            $counter=$counter+1;
    $id=$start_val+$counter;
    if($rows % 4 == 0)
    {
        echo "<td><center><br>".$id."<br>";
        echo "<b>".substr($row["filename"],0,20)."</b><br>";
        echo "<a target='_blank' a href='".$row["location"]."'><img border='5' alt='../images/nope.jpeg' src='".$row["location"]."' width='150' height='150' onError=\"this.src='http://192.168.1.1:100/images/nope.jpeg';\"/></a>";
        echo "<br><center><div class='sizes'>".$width." x ".$height."</div></center>";
        echo "Date last modified ".date("F d Y H:i:s.", filemtime($file2));
        echo "</center></td>";   
        echo "</tr><tr>";
        //$row=0;
    }
    else
    {
        

        echo "<td><center><br>".$id."<br>";
        echo "<b>".substr($row["filename"],0,20)."</b><br>";
       echo "<a target='_blank' a href='".$row["location"]."'><img border='5' alt='../images/nope.jpeg' src='".$row["location"]."' width='150' height='150' onError=\"this.src='http://192.168.1.1:100/images/nope.jpeg';\"/></a>";
        echo "<br><center><div class='sizes'>".$width." x ".$height."</div></center>";
        echo "Date last modified ".date("F d Y H:i:s.", filemtime($file2));
        echo "</center></td>";        
    }

    
}
echo "</table></center><center>";
        //echo $id;
        //$count=mysqli_num_rows($counts);

}

else //none-images
{
$id=(($page*10)+1);
if (mysqli_num_rows($result) > 0) 
{
//echo "<br>".$page;
//$count=mysqli_num_rows($counts);
//echo $count." Results";
while ($row = mysqli_fetch_array($result))
{
        //echo $id;
        
        $url2=$row["location"];
        $url=str_replace("'", "%27", $url2);
        $url=str_replace("(", "%28", $url);
        $url=str_replace(")", "%29", $url);
        $url=str_replace("-", "%2D", $url);
        $url=str_replace(" ", "%20", $url);
	if (str_contains($url2, '192.168.1.1'))
	{
        	$file2=str_replace("http://192.168.1.1:90/all","",$row["location"]);
	}
	else
	{
		$file2=str_replace("http://voncloft.com:90/all","",$row["location"]);
	}
        if($row["Type"]=="text" || $row["Type"]=="command")
        {
        //$count = $row[0];

            echo "<table><tr class='header'><td>".$id." - ".ucfirst($row["Type"])." File - ".formatSize($row["sizeinbytes"])."</td></tr><tr class='filename'><td><a target='_blank' a href='".$url."'>".$row["filename"]."</a></td></tr><tr class='grep'><td>".substr($row["description"],$j,100)."</td></tr><tr class='url'><td>".$row["location"]."</td></tr></tr><tr><td>Date last modified ".date("F d Y H:i:s.", filemtime($file2))."</td></tr></table><br>";
        }
        elseif($row["Type"]=="audio")
        {
        echo "<table><tr class='header'><td>".$id." - ".ucfirst($row["Type"])." File - ".formatSize($row["sizeinbytes"])."</td></tr>";
        echo "<tr class='filename'><td>".$row["filename"]."</a></td>";
//echo "<tr><td><audio controls><source src='".$_SESSION['files'][$a]." type='audio/mpeg'></audio></td></tr>";
        echo '<tr><td><span id="mySpan"></span><audio preload=auto id="sound" controls onseeking="myFunction()" onseeked="myFunction()"><source src="'.$url.'"type="audio/mpeg"></audio></td></tr>';
        echo "<tr class='url'><td>".$url."</tr></td><tr><td>Date last modified ".date("F d Y H:i:s.", filemtime($file2))."</td></tr></table><br>";
	//echo $file2;
        }
        elseif(in_array($row["Type"],$_SESSION['ifarray'],true))
        {
        echo "<table><tr class='header'><td>".$id." - ".ucfirst($row["Type"])." File - ".formatSize($row["sizeinbytes"])."</td></tr>";
        list($width, $height) = getimagesize($url);
        echo "<tr class='filename'><td>";
        echo "<b><u>".substr($row["filename"],0,20)."</u></b><br>";
        echo "<a target='_blank' a href='".$url."'><img border='5' alt='../images/nope.jpeg' src='".$url."' width='150' height='150' onError=\"this.src='http://192.168.1.1:100/images/nope.jpeg';\"/>";
        echo "<br>".$width." x ".$height;
        echo "</td></tr><tr><tr class='url'><td>".$url."</tr></td><tr><td>Date last modified ".date("F d Y H:i:s.", filemtime($file2))."</td></tr></table>";
      
        }
        else
        {
                    echo "<table><tr class='header'><td>".$id." - ".ucfirst($row["Type"])." File - ".formatSize($row["sizeinbytes"])."</td></tr><tr class='filename'><td><a target='_blank' a href='".$row["location"]."'>".$row["filename"]."</a></td></tr><tr class='url'><td>".$row["location"]."</td></tr><tr><td>Date last modified ".date("F d Y H:i:s.", filemtime($file2))."</td></tr></table><br>";
 
        }
        
        $id=$id+1;
        
}
}

}

; //10 results to a page = number of pages
echo "<center>";
//$c=$page;
if($page<=0)
{

}
else
{
    echo "<a href=search.php?page=".($page-1).">".($page)."</a> ";
}
if(($page+10)<=$pages)
{
  //echo "<a href=search.php?page=".($i).">".($i)."</a> ";
  //echo "<a href=search.php?page=".$i.">".($page)."</a> ";
  for ($i=$page;$i<=$page+10;$i++)
    {
        if($i==$page)
        {
        echo ($i+1)." ";
        }
        else
        {
        echo "<a href=search.php?page=".$i.">".($i+1)."</a> ";
        }
    }
    
}
else
{
 //echo "<a href=search.php?page=".($i-1).">".($i-1)."</a> ";   
    for ($i=$page;$i<=($pages);$i++)
    {
        if($i==$page)
        {
        echo ($i+1)." ";
        }
        else
        {
        echo "<a href=search.php?page=".$i.">".($i+1)."</a> ";
        }
    }
    

    }

echo "</center>";
echo "<center><a href=../index.php>Home</a>";
//echo $count;
