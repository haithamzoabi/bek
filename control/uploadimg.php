
<html>

<head>
  <title>Hello!</title>
  <meta http-equiv="Content-Language" content="ar">

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<body style="font-family: tahoma; font-size: 10px">
 <script>
 function putimg(imgsrc,imgname) {
 //window.opener.document.getElementById('<?=$txtimgid?>').src=imgsrc;
if (window.opener.document.getElementById('imgid')){
window.opener.document.getElementById('imgid').src=imgsrc;
}

 window.opener.document.form1.<?=$txtimg?>.value=imgname;
 close();
 }

 </script>
<?php
include ('include/lang.php');
 define ("MAX_SIZE","100");

 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }


 $errors=0;

 if(isset($_POST['Submit']))
 {

 	$image=$_FILES['image']['name'];

 	if ($image)
 	{

 		$filename = stripslashes($_FILES['image']['name']);

  		$extension = getExtension($filename);
 		$extension = strtolower($extension);

 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
 		{

 			echo '<h1 style="color:red">Unknown extension!.. try to upload another file</h1>';
 			$errors=1;
 		}
 		else
 		{

 $size=filesize($_FILES['image']['tmp_name']);

if ($size > MAX_SIZE*1024)
{
	echo '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
}

$image_name=time().'.'.$extension;

$newname="../pics/".$image_name;

$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied)
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}}


 if(isset($_POST['Submit']) && !$errors)
 {
 	echo '<h1 style="color:green">'.$l_fileuploadedsucessfully.'!</h1><h3>'.$l_clickonimagetoinsertit.'</h3>';
 }

 ?>

 <form name="newad" method="post" enctype="multipart/form-data"  action="">
 <table>
 	<tr><td><input type="file" name="image"></td></tr>
 	<tr><td><input name="Submit" type="submit" value="Upload image"></td></tr>
    <?  if(isset($_POST['Submit']) && !$errors)
 { ?>
 	<tr><td><img style="cursor: pointer" src="<?=$newname?>" onclick="putimg('<?=$newname?>','<?=$image_name?>')"></td></tr>
    <?}?>
 </table>
 </form>
</body>

</html>
