<div class="home" style="min-height:900px;">
<?
$categoryId = $_GET['Category'];
$videoId = $_GET['vid'];

if ( isset($categoryId) && !isset($videoId) ){



$res = query("select v_name from vid_cats where v_id='$categoryId'");
$firstRow = $res->fetch_row();

?>
	<div class="category_main" style="height:auto">
		<div class="title" ><?=$firstRow[0]?></div>
		
<?
$q= "select video.*,vid_cats.v_name from video,vid_cats where video.v_category=vid_cats.v_id and vid_cats.v_id='$categoryId' limit 20";
$res= query($q);
$i=0;
while ($row = $res->fetch_row()){
$i++;
$videoCode=  $row[5];
$videoLink  =  $domainName."/video?Category=".$categoryId."&vid=".$row[0];
?>	
	
	<? if ($i==1){?>
		<div class="items">
	<?}?>	
		<div class="row" style="margin-top:10px">
			<a href="<?=$videoLink?>">
				<img alt="Thumbnail" src="http://i1.ytimg.com/vi/<?=$videoCode?>/mqdefault.jpg" width="390">
				<span><?=$row[3]?> [<?=($i)?>]</span>
			</a>
		</div>
		
	<? if ($i==3){?>
		</div>
	<?
	$i=0;
	}	
}
?>
	</div>
<?

}

if (isset($categoryId) && isset($videoId)){

$q= "select video.*,vid_cats.v_name from video,vid_cats where video.v_category=vid_cats.v_id and video.v_id='$videoId' limit 1";
$res= query($q);
$row = $res->fetch_row();
$breadCrumb = $row[8]." - ".$row[3];
$videoCode = $row[5];
?>
	<div class="category_main" style="height:auto">
		<div class="title" style="margin:0"><?=$breadCrumb?></div>
	</div>

	
<div class="videoSide" style="float:right; width :860px;min-height:800px; overflow:hidden; background:#ffffff;padding : 10px; border-radius:3px ">

	
	<div>
		<object width="853" height="480">
		<param name="movie" value="//www.youtube.com/v/<?=$videoCode?>?version=3&amp;hl=en_US"></param>
		<param name="width" value="853">
		<param name="height" value="480">
		<param name="allowFullScreen" value="true"></param>
		<param name="allowscriptaccess" value="always"></param>
		<param name="wmode" value="opaque">
		<param name="allowFullScreen" value="true">
		<param name="salign" value="tl">
		<embed src="//www.youtube.com/v/<?=$videoCode?>?version=3&amp;hl=en_US" type="application/x-shockwave-flash" width="853" height="480" allowscriptaccess="always" allowfullscreen="true"></embed>
		</object>
	</div>

	<div style="padding-top:15px;font-size:1.3em">
		<?=nl2br($row[4])?>
	</div>

</div>
	
<div class="adsSide" style="" ></div>
	
<?}?>
</div>