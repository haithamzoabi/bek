<div class="innerPage">
<?
$categoryId = $_GET['Category'];
$videoId = $_GET['vid'];

if (isset($categoryId)){
	if ( isset($videoId) ){
		include("video_page_one.php");
	}else{
		include("video_page_category.php");
	}
}else{
	include("video_page_all.php");
}

?>
</div>