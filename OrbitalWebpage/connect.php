
<?php
require_once 'config.php'; // your PHP script(s) can access this file
$db = new mysqli(db_host, db_uid, db_pwd, db_name, 3306); // it is built-in
if ($db->connect_errno) {
	  exit("Failed to connect to MySQL, exiting this script");
} // are we connected properly?

$dbhandle = @mysql_connect(db_host, db_uid, db_pwd, 3306) or die("Could not connect");
$selected = mysql_select_db(db_name, $dbhandle) or die("Could not find db");

?>