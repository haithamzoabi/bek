<?header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('Asia/Jerusalem');

$file = $_GET['file'];
$path = $_GET['path'];

include("./include/lang.php");
include("./include/general.php");
include("./include/connect.php");

if ($file){
    include($file);
}
?>