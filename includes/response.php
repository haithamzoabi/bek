<?
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

function customError($errno, $errstr, $path, $line) {
    if ($errno !== 8) {//if error not un undefined variable
	//echo "Error:  $errstr ... in Line $line <br>";
    }
}

set_error_handler("customError");
include("lang.php");
include("general.php");
include("connect.php");

$requestMethod = getServerInput('REQUEST_METHOD');
$postPage = getPostInput('page');
$postType = getPostInput('type');
$postAction = getPostInput('action');
$postFields = $_POST['fields'];

switch ($requestMethod) {
	case 'GET' :
	break;

}

?>