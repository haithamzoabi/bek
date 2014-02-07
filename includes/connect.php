<?
$mysql_host = "localhost";
$mysql_database = "bek";
$mysql_user = "zoabi";
$mysql_password = "zoabi";

$connect = mysql_connect("$mysql_host" , "$mysql_user" ,"$mysql_password") or die ("Connnection Failed");
$link = mysql_select_db( "$mysql_database" )or die ("the DataBase does'nt exist") ;

?>
