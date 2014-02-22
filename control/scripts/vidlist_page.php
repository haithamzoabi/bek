<script>
$(function(){
    var vidCategory = getURLParameter('vidCategory');
   FUNC.configSelection('vidCategories_list','vidCategory' , vidCategory); 
   
   $('table .tr_caption td').attr('colspan',$('table .tr_title td').length);
   $('table tfoot td').attr('colspan',$('table .tr_title td').length);
   
   $('input[name="check_pinned"]').on('change', function(){
		var checkAll = $('input[name="check_pinned"]:checked');
		var checkAllCount = checkAll.length;
		var me = this;
		if (checkAllCount<=5 && checkAllCount>1){
			$.ajax(LOCALS.controlDomainName +'/include/response.php', {
			type: 'POST',
			data: {
				type: 'set',
				page : 'videoForm',
				action: 'pin',
				sid  : $(me).val(),
				value  : $(me).is(':checked') ? 1 : 0
			},
			success: function(data){
				console.log ('data' , data );
				if ( data.success === false ){
					alert (data.msg);
					if ($(me).is(':checked')) {
						$(me).removeAttr("checked");
					}else {
						$(me).attr("checked","checked");
					}					
					return false;
				}				
			},
			dataType: 'json'
			});
		}else{
			alert (LOCALS.l_errorMustUpTo5);
			if ($(me).is(':checked')) {
				$(me).removeAttr("checked");
			}else {
				$(me).attr("checked","checked");
			}
		}
		
   });
   
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
			<col span="2" class="side3 column-actions" />
			<col span="4" class="side2 column-details"/>
		</colgroup>

		<thead>
			<tr class="tr_caption">
				<td><span><?= $l_videoslist ?></span></td>
			</tr>
			<tr class="tr_title">
				<td>&nbsp;</td>
				<td>
					<img border="0" src="<?=$controlDomainName?>images/pin_blue1.png" width="15" height="15" style="vertical-align: inherit;">
				</td>				
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
		
		//$res=$conn->query($q);
		
		$i = 0;
		while ($row = $res->fetch_row() ) {
			$i++;
			?>

			<tr class="<?= ($row[6] == 0) ? 'new_tr' : '' ?> tr"  >
				<td align="center"><?= $i ?></td>				
				
				<td>
					<input type="checkbox" name="check_pinned" value="<?=$row[0]?>" id="check_pinned-<?=$row[0]?>" <?=($row[7]==1)?'checked="true"':''?> />
				</td>
				
				<td align="center">
					<a title="<?= $l_update ?>" href="<?=$controlDomainName?>/vid_update?menu=1&sid=<?=$row[0]?>">
					<img border="0" src="<?=$controlDomainName?>images/edit.png" width="13" height="13" alt="">
					</a>
				</td>		
			
				
				<td><?=$row[8]?></td>
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