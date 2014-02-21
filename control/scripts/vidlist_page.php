<script>
$(function(){
    var vidCategory = getURLParameter('vidCategory');
   FUNC.configSelection('vidCategories_list','vidCategory' , vidCategory); 
   
   $('table .tr_caption td').attr('colspan',$('table tbody td').length);
   $('table tfoot td').attr('colspan',$('table tbody td').length);
});
</script>
<div class="pagediv">

    <form method="GET" >
		<label for="vidCategory" ><?=$l_category?></label>
		<select name="vidCategory" id="vidCategory" onchange="submit()">
			<option value="0"><?=$l_latestVideo?></option>
		</select>	
		<input type="hidden" name="menu" value="<?=getGetInput('menu')?>" />
    </form>
    <br>
	<table id="ntable"  >
		<colgroup>
			<col class="side1 column-index" />
			<col span="1" class="side3 column-actions" />
			<col span="4" class="side2 column-details"/>
		</colgroup>

		<thead>
			<tr class="tr_caption">
				<td colspan="6"><span><?= $l_cats ?></span></td>
			</tr>
			<tr class="tr_title">
				<td>&nbsp;</td>
				<td width="20"><?= $l_update ?></td>
				<td ><?= $l_category ?></td>
				<td> <?= $l_videoTitle ?></td>
				<td> <?= $l_link ?></td>
				<td><?= $l_status ?></td>
			</tr>
		</thead>


		<tbody>

		<?
		$vidCategory  = getGetInput('vidCategory');
		$whereQ = ( isset($vidCategory) && $vidCategory!=0 ) ? " and v_category='$vidCategory' "  : "";
		$q = "select video.*,vid_cats.v_name from video,vid_cats where video.v_category=vid_cats.v_id $whereQ order by v_id desc limit 100";
		$res = query($q);
		$i = 0;
		while ($row = mysql_fetch_row($res)) {
			$i++;
			?>

			<tr class="<?= ($row[6] == 0) ? 'new_tr' : '' ?> tr"  >
				<td align="center"><?= $i ?></td>

				<td align="center">
					<a title="<?= $l_update ?>" href="<?=$controlDomainName?>/vid_update?menu=1&sid=<?=$row[0]?>">
					<img border="0" src="<?=$controlDomainName?>images/edit.png" width="13" height="13" alt="">
					</a>
				</td>
				
				<td><?=$row[7]?></td>
				<td><?= $row[3] ?></td>
				<td> <a target="_blank" href="http://www.youtube.com/watch?v=<?= $row[5] ?>"><?= $row[5] ?></a> </td>
				<td><?= ($row[6] == 0) ? $l_notactive : $l_active ?></td>

			</tr>


		<? }
		?>

		</tbody>

		<tfoot>
			<tr>
				<td align="right" >
				&nbsp;<?= $l_totoal . ': ' . $i ?>
				</td>
			</tr>
		</tfoot>



	</table>

</div>