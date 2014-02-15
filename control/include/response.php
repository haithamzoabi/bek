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
    case 'POST' :

	switch ($postType) {

	    case 'set':

		switch ($postPage) {

		    case 'categoriesForm':
			
			switch ($postAction) {

			    case 'add':
				$q = sprintf("insert into vid_cats (v_name,v_order,v_status) values ('%s','%s','%s')", 
				    mysql_real_escape_string($postFields['txtname']), 
				    mysql_real_escape_string($postFields['txtorder']), 
				    mysql_real_escape_string($postFields['lststatus'])
				);
				break;

			    case 'update':
				$sid = getPostInput('sid');
				$q=  sprintf("update vid_cats set v_name='%s', v_order='%s', v_status='%s' where v_id='$sid'",
				    mysql_real_escape_string($postFields['txtname']), 
				    mysql_real_escape_string($postFields['txtorder']), 
				    mysql_real_escape_string($postFields['lststatus'])					
				);
				break;
			}

			
			$res = query($q);
			if ($res) {
			    $arr = array('success' => true, 'msg' => $l_savesuccess, 'result' => $res, 'q'=>$q);
			} else {
			    $arr = array('success' => false, 'msg' => $l_errormessage);
			}

			echo json_encode($arr);


			break;

		    case 'addItem':
		    case 'updateItem':
			break;

		    case 'itemTypes':

			switch ($postAction) {

			    case 'add':


				break;

			    case 'update':


				break;
			}

			break;

		    case 'addCustomers':
		    case 'updateCustomer':



			break;

		    case 'customersTypes':

		

			break;

		    case 'order_details':
			break;
		}

		break;


	    case 'get':
		$sid = getPostInput('sid');
		switch ($postPage) {

		    case 'categoriesForm':
			$q = "select * from vid_cats where v_id='$sid'";
			$res = query($q);
			$row = mysql_fetch_row($res);
			$arr = array('success' => true, 'row' => array(
				'txtname' => $row[1],
				'txtorder' => $row[2],
				'lststatus' => $row[3]
			));
			echo json_encode($arr);
			break;

		    case 'updateItem':



			break;

		    case 'itemTypes':



			break;

		    case 'updateCustomer':



			break;

		    case 'customersTypes':




			break;

		    case 'order_details':



			break;
		}


		break;

	    case 'delete':
		$rowId = $_POST['rowId'];
		switch ($postPage) {

		    case 'updateItem':
			$q = "delete from items where item_id='$rowId'";
			break;

		    case 'updateCustomer':
			$q = "delete from customers where customer_id='$rowId'";
			break;

		    case 'customersTypes':
			$q = "delete from customers_types where cust_type_code='$rowId'";
			break;

		    case 'itemTypes':
			$q = "delete from item_types where item_type_code='$rowId'";
			break;

		    case 'order_details':
			$q = "delete from orders where order_id='$rowId'";
			break;
		}

		if (query($q)) {
		    $arr = array('success' => true, 'msg' => $l_deletesuccess);
		} else {
		    $arr = array('success' => false, 'msg' => $l_deleterror);
		}
		echo json_encode($arr);
		break;
	}
	break;
}


mysql_close($connect);
?>