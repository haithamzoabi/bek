<?

/*
$mysql_host = "mysql13.000webhost.com";
$mysql_database = "a3477376_bek";
$mysql_user = "a3477376_bek";
$mysql_password = "a3477376_bek";
*/

$mysql_host = "localhost";
$mysql_database = "bek";
$mysql_user = "root";
$mysql_password = "";


$conn = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
if ($conn->connect_error) {
	trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}
$conn ->query("SET NAMES 'utf8'");

function query($q ) {
	$conn = $GLOBALS['conn'];
    if ($res = $conn->query($q)) {
		return $res;
    } else {
		print('Wrong SQL: ' . $sql . ' Error: ' . $conn->error);
		//return false;
    }
}

function multiQuery($q , $conn){
	if ($res = $conn->multi_query($q)) {
		while ($conn->next_result()) {;} // flush multi_queries
		return $res;
    } else {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		//return false;
    }
}



?>