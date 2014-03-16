<?
	/*
	$fileName = $_FILES['filedata']['name'];
	$tmpName  = $_FILES['filedata']['tmp_name'];
	$fileSize = $_FILES['filedata']['size'];
	$fileType = $_FILES['filedata']['type'];
	*/
	$sCommand = $_GET['Command'];
	$sResourceType	= $_GET['Type'];
	$sCurrentFolder = $_GET['CurrentFolder'].'/';
	
	require('./config.php') ;
	require('./util.php') ;
	require('./io.php') ;
	
	if ( $sCommand == 'FileUpload' ){
		FileUpload( $sResourceType, $sCurrentFolder, $sCommand ) ;		
	}

	if ( $sCommand == 'CreateFolder' ){
		CreateFolder( $sResourceType, $sCurrentFolder ) ;		
	}	
	
	// Notice the last paramter added to pass the CKEditor callback function
	function FileUpload( $resourceType, $currentFolder, $sCommand, $CKEcallback = '' ){
		if (!isset($_FILES)) {
			global $_FILES;
		}
		$sErrorNumber = '0' ;
		$sFileName = '' ;
	 
			//PATCH to detect a quick file upload.
		if (( isset( $_FILES['filedata'] ) && !is_null( $_FILES['filedata']['tmp_name'] ) ) || (isset( $_FILES['upload'] ) && !is_null( $_FILES['upload']['tmp_name'] ) ))
		{
			global $Config ;
	 
					 //PATCH to detect a quick file upload.
			$oFile = isset($_FILES['filedata']) ? $_FILES['filedata'] : $_FILES['upload'];
	 
			// Map the virtual path to the local server path.
			$sServerDir = ServerMapFolder( $resourceType, $currentFolder, $sCommand ) ;
	 
			// Get the uploaded file name.
			$sFileName = $oFile['name'] ;
			$sFileName = SanitizeFileName( $sFileName ) ;
	 
			$sOriginalFileName = $sFileName ;
	 
			// Get the extension.
			$sExtension = substr( $sFileName, ( strrpos($sFileName, '.') + 1 ) ) ;
			$sExtension = strtolower( $sExtension ) ;
	 
			if ( isset( $Config['SecureImageUploads'] ) )
			{
				if ( ( $isImageValid = IsImageValid( $oFile['tmp_name'], $sExtension ) ) === false )
				{
					$sErrorNumber = '202' ;
				}
			}
	 
			if ( isset( $Config['HtmlExtensions'] ) )
			{
				if ( !IsHtmlExtension( $sExtension, $Config['HtmlExtensions'] ) &&
					( $detectHtml = DetectHtml( $oFile['tmp_name'] ) ) === true )
				{
					$sErrorNumber = '202' ;
				}
			}
	 
			// Check if it is an allowed extension.
			if ( !$sErrorNumber && IsAllowedExt( $sExtension, $resourceType ) )
			{
				$iCounter = 0 ;
	 
				while ( true )
				{
					//$sFilePath = $sServerDir . $sFileName ;					
					$sFilePath = $currentFolder . $sFileName ;
					
					if ( is_file( $sFilePath ) ){
						$iCounter++ ;
						$sFileName = RemoveExtension( $sOriginalFileName ) . '(' . $iCounter . ').' . $sExtension ;
						$sErrorNumber = '201' ;
					} else {
						move_uploaded_file( $oFile['tmp_name'], $sFilePath ) ;
	 
						if ( is_file( $sFilePath ) )
						{
							if ( isset( $Config['ChmodOnUpload'] ) && !$Config['ChmodOnUpload'] )
							{
								break ;
							}
	 
							$permissions = 0777;
	 
							if ( isset( $Config['ChmodOnUpload'] ) && $Config['ChmodOnUpload'] )
							{
								$permissions = $Config['ChmodOnUpload'] ;
							}
	 
							$oldumask = umask(0) ;
							chmod( $sFilePath, $permissions ) ;
							umask( $oldumask ) ;
						}
	 
						break ;
					}
				}
	 
				if ( file_exists( $sFilePath ) )
				{
					//previous checks failed, try once again
					if ( isset( $isImageValid ) && $isImageValid === -1 && IsImageValid( $sFilePath, $sExtension ) === false )
					{
						@unlink( $sFilePath ) ;
						$sErrorNumber = '202' ;
					}
					else if ( isset( $detectHtml ) && $detectHtml === -1 && DetectHtml( $sFilePath ) === true )
					{
						@unlink( $sFilePath ) ;
						$sErrorNumber = '202' ;
					}
				}
			}
			else
				$sErrorNumber = '202' ;
		}
		else
			$sErrorNumber = '202' ;
	 
		$sFileUrl = $currentFolder ;
		$sFileUrl = CombinePaths( $sFileUrl, $sFileName ) ;
	 
		if($CKEcallback == '')
		{
			SendUploadResults( $sErrorNumber, $sFileUrl, $sFileName ) ;
		}
		else
		{
			//issue the CKEditor Callback
			//SendCKEditorResults ($sErrorNumber, $CKEcallback, $sFileUrl, $sFileName);
			SendCKEditorResults ($CKEcallback, $sFileUrl, ($sErrorNumber != 0  ? 'Error '. $sErrorNumber. ' upload failed. '. $sErrorMsg : 'Upload Successful'));
		}
		exit ;
	}
	
	function SendUploadResults ($sErrorNumber, $sFileUrl, $sFileName ){
		$success=($sErrorNumber=='0')? 'true' : 'false';
		echo "{success:$success, file:'$sFileName' , sFileUrl:'$sFileUrl', sErrorNumber:'$sErrorNumber'}";
	}
	
	function SendCKEditorResults ($callback, $sFileUrl, $customMsg = ''){
		$success=($customMsg=='')?true : false;
		echo "{success:true, callback:'$callback' , sFileUrl:'$sFileUrl', customMsg:'$customMsg'}";
	/*
		  echo '<script type="text/javascript">';
		  $rpl = array( '\\' => '\\\\', '"' => '\\"' ) ;
		  echo 'window.parent.CKEDITOR.tools.callFunction("'. $callback. '","'.
			strtr($sFileUrl, $rpl). '", "'. strtr( $customMsg, $rpl). '");' ;
		  echo '</script>';
	*/
	}
	
	
	
	
function CreateFolder( $resourceType, $currentFolder )
{
	if (!isset($_GET)) {
		global $_GET;
	}	
	if (!isset($_POST)) {
		global $_POST;
	}
	
	$sErrorNumber	= '0' ;
	$sErrorMsg		= '' ;
	
	if ( isset( $_POST['NewFolderName'] ) )
	{
		$sNewFolderName = $_POST['NewFolderName'] ;
		$sNewFolderName = SanitizeFolderName( $sNewFolderName ) ;

		if ( strpos( $sNewFolderName, '..' ) !== FALSE )
			$sErrorNumber = '102' ;		// Invalid folder name.
		else
		{
			// Map the virtual path to the local server path of the current folder.
			//$sServerDir = ServerMapFolder( $resourceType, $currentFolder, 'CreateFolder' ) ;
			$sServerDir = $currentFolder;
			if ( is_writable( $sServerDir ) )
			{
				$sServerDir .= $sNewFolderName ;

				$sErrorMsg = CreateServerFolder( $sServerDir ) ;

				switch ( $sErrorMsg )
				{
					case '' :
						$sErrorNumber = '0' ;
						break ;
					case 'Invalid argument' :
					case 'No such file or directory' :
						$sErrorNumber = '102' ;		// Path too long.
						break ;
					default :
						$sErrorNumber = '110' ;
						break ;
				}
			}
			else
				$sErrorNumber = '103' ;
		}
	}
	else
		$sErrorNumber = '102' ;

	// Create the "Error" node.
	//echo '<Error number="' . $sErrorNumber . '" />' ;
	$success=($sErrorNumber=='0')? 'true' : 'false';
	echo "{success:$success, folder:'$sNewFolderName' , parent:'$currentFolder', sErrorNumber:'$sErrorNumber' , sServerDir:'$sServerDir'}";
}	
	
	
	
?>