<?php
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 define('DBHOST', 'localhost');
 define('DBUSER', 'username');
 define('DBPASS', 'password');
 define('DBNAME', 'Intranet');
 $conn = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
 if ( !$conn ) {
	echo "Failed to connect to MySQL: " . $conn -> connect_error;
 }
