
<?
$res = query("select v_name from vid_cats where v_id='$categoryId'");
$firstRow = $res->fetch_row();

?>
	<div class="inner_category_main" >
		<div class="title" ><?=$firstRow[0]?></div>
		
<div class="items">
		
<?
$q= "select video.*,vid_cats.v_name from video,vid_cats where video.v_category=vid_cats.v_id and vid_cats.v_id='$categoryId' order by video.v_id  desc";


$query1 =$q;
$queryres = query($query1);
$adjacents =10;
$targetpage = $domainName."/video?Category=".$categoryId;
$total_pages = $queryres->num_rows ;
$limit =(isset($lstpages))?$lstpages:20;
$pg = $_GET['pg'];
if($pg)
$start = ($pg - 1) * $limit; 			//first item to display on this pg
else
$start = 0;								//if no pg var is given, set start to 0
$mone=0;
include("paging.php");

$res = query ($query1." limit $start, $limit");

//$res= query($q);
$i=0;
while ($row = $res->fetch_row()){
$i++;
$videoCode=  $row[5];
$videoLink  =  $domainName."/video?Category=".$categoryId."&vid=".$row[0];
?>	
		
		<div class="row" >
			<a href="<?=$videoLink?>">
				<img alt="Thumbnail" src="http://i1.ytimg.com/vi/<?=$videoCode?>/mqdefault.jpg" width="300" height="169">
				<span><?=$row[3]?> [<?=getDuration($videoCode)?>]</span>
			</a>
		</div>
		
	<?}?>
	</div>

	</div>

	
	
	
<div style="display: block; clear: both; overflow: hidden; text-align: center; margin-top: 40px ; float: left; width: 100%;">
<?=$pagination?>
</div>