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
		
		
			case 'simpleContentForm':
				if ($postAction=='update'){
					$sid = getPostInput('sid');
					$q= sprintf("update simple_content set c_text='%s' where c_id='$sid' "  , 
						$postFields['txtcontent']
					);
					
					$res = query($q);
					if ($res) {
						$arr = array('success' => true, 'msg' => $l_savesuccess, 'result' => $res);
					} else {
						$arr = array('success' => false, 'msg' => $l_errormessage);
					}

					echo json_encode($arr);
				}
			break;

		    case 'categoriesForm':
			
				switch ($postAction) {

					case 'add':
					$q = sprintf("insert into vid_cats (v_name,v_order,v_status) values ('%s','%s','%s')", 
						mysqli_real_escape_string($conn,$postFields['txtname']), 
						mysqli_real_escape_string($conn,$postFields['txtorder']), 
						mysqli_real_escape_string($conn,$postFields['lststatus'])
					);
					break;

					case 'update':
					$sid = getPostInput('sid');
					$q=  sprintf("update vid_cats set v_name='%s', v_order='%s', v_status='%s' where v_id='$sid'",
						mysqli_real_escape_string($conn,$postFields['txtname']), 
						mysqli_real_escape_string($conn,$postFields['txtorder']), 
						mysqli_real_escape_string($conn,$postFields['lststatus'])					
					);
					break;
				}

				
				$res = query($q);
				if ($res) {
					$arr = array('success' => true, 'msg' => $l_savesuccess, 'result' => $res);
				} else {
					$arr = array('success' => false, 'msg' => $l_errormessage);
				}

				echo json_encode($arr);


			break;

		    case 'videoForm':
				switch ($postAction){
					case 'add':
					$q= sprintf("insert into video (v_category,v_city,v_title,v_description,v_link,v_status) values ('%s','%s','%s','%s','%s','%s')",
						mysqli_real_escape_string($conn,$postFields['lstCategories']), 
						mysqli_real_escape_string($conn,$postFields['lstCities']), 
						mysqli_real_escape_string($conn,$postFields['txtTitle']), 
						mysqli_real_escape_string($conn,$postFields['txtDetails']), 
						mysqli_real_escape_string($conn,$postFields['txtLink']), 
						mysqli_real_escape_string($conn,$postFields['lststatus']) 
					);
					break;
					
					case 'update':
						$sid = getPostInput('sid');
						$q=  sprintf("update video set v_category='%s', v_city='%s', v_title='%s' , v_description='%s' , v_link='%s' , v_status='%s' where v_id='$sid'",
							mysqli_real_escape_string($conn,$postFields['lstCategories']), 
							mysqli_real_escape_string($conn,$postFields['lstCities']), 
							mysqli_real_escape_string($conn,$postFields['txtTitle']), 
							mysqli_real_escape_string($conn,$postFields['txtDetails']), 
							mysqli_real_escape_string($conn,$postFields['txtLink']), 
							mysqli_real_escape_string($conn,$postFields['lststatus']) 				
						);
					break;
					
					case 'pin':
						$sid = getPostInput('sid');
						$value = getPostInput('value');
						if ($value==1){						
							$q="SELECT COUNT(*) FROM video where v_pin='1' GROUP BY v_pin INTO @count; 
								UPDATE video set v_pin='1' where v_id='$sid' and  @count < 5 ";
						}else{
							$q =  "SELECT COUNT(*) FROM video where v_pin='1' GROUP BY v_pin INTO @count;
							update video set v_pin='0' where v_id='$sid' and @count > 1";
						}
					break;
				}
				
				$res = multiQuery($q , $conn);
				$numRows= $conn->affected_rows;
				if ($res && $numRows > 0) {
					$arr = array('success' => true, 'msg' => $l_savesuccess, 'result' => $res , 'rows' => $numRows);
				} else {
					$arr = array('success' => false, 'msg' => $l_errorMustUpTo5  , 'rows' => $numRows);
				}

				echo json_encode($arr);
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
				$row = $res->fetch_row();
				$arr = array('success' => true, 'row' => array(
					'txtname' => $row[1],
					'txtorder' => $row[2],
					'lststatus' => $row[3]
				));
				echo json_encode($arr);
			break;

			case 'videoForm':
				$q="select * from video where v_id='$sid' ";
				$res= query($q);
				$row = $res->fetch_row();
				$arr = array('success' => true, 'row' => array(
					'lstCategories' => $row[1],
					'lstCities' => $row[2],
					'txtTitle' => $row[3],
					'txtDetails' => $row[4],
					'txtLink' => $row[5],
					'lststatus' => $row[6]
				));
				echo json_encode($arr);
			break;
			
		    case 'vidCategories_list':
				$selectValues = array();
				$q="select v_id,v_name from vid_cats order by v_order limit 100";
				$res = query($q);
				while ($row = $res->fetch_row()){
					
					$object = array(
						 'value' => $row[0],
						 'text' => $row[1] 
					);				
					array_push($selectValues , $object);
				}
				
				$arr = array('success'=>true , 'selectValues' => $selectValues);				
				echo json_encode($arr);
			break;
			
			case 'cities_list':
				$selectValues = array();
				$q="select c_id,c_name from cities order by c_name limit 100";
				$res = query($q);
				while ($row = $res->fetch_row()){
					
					$object = array(
						 'value' => $row[0],
						 'text' => $row[1] 
					);				
					array_push($selectValues , $object);
				}
				
				$arr = array('success'=>true , 'selectValues' => $selectValues);				
				echo json_encode($arr);
			break;
			
			
			case 'simpleContentForm':
				$q="select c_text from simple_content where c_id='$sid' ";
				$res= query($q);
				$row = $res->fetch_row();
				$arr = array('success' => true, 'row' => array(
					'txtcontent' => $row[0]					
				));
				echo json_encode($arr);
			break;

		}


		break;

	    case 'delete':
		$sid = $_POST['sid'];
		switch ($postPage) {

		    case 'videoForm':
				$q = "delete from video where v_id='$sid'";
			break;
			
			case 'categoriesForm':
				$q = "delete from vid_cats where v_id='$sid'";
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