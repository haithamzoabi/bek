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

$requestMethod = $_SERVER['REQUEST_METHOD'];
$postPage = $_POST['page'];
$postType = $_POST['type'];
$postAction = $_POST['action'];
$postFields = $_POST['fields'];

switch ($requestMethod) {
	case 'GET' :

$postPage = $_GET['page'];
$postType = $_GET['type'];
$postAction = $_GET['action'];
$postFields = $_GET['fields'];


	
		switch ($postPage) {
			case 'slider':
			
				$q= "select * from video where v_status='1' and v_pin='1' order by v_id desc limit 5";
				$res= query($q);
				$dataArray = array();
				while ($row = $res->fetch_row()){
					array_push($dataArray , array(
						'id'=>$row[0],
						'category'=>$row[1],
						'title'=>$row[3],
						'description'=>$row[4],
						'link'=>$row[5]
					));
				}
				if ($res){
					$arr= array('success' => true , 'errorMessage'=>null , 'data'=>$dataArray);
				}else{
					$arr= array('success' => false , 'errorMessage'=>'no data' , 'data'=>$dataArray);
				}
				echo json_encode($arr);
			break;
		}
	
	break;

}

?>