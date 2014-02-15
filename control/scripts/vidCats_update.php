<script>
$(function() {

    var sid = getURLParameter('sid');
    var menu = getURLParameter('menu');
    if (sid) {
	$.ajax({
	    type: "POST",
	    url: '<?= $controlDomainName ?>/include/response.php',
	    data: {
		type: 'get',
		page: $('form').attr('id'),
		sid: sid
	    },
	    success: function(data) {
		var row = data.row;
		$.each(row , function(key, value){
		    $('#'+key).val(value);
		});
	    },
	    dataType: 'json'
	});
    }


    $('form').submit(function() {
	
	var fields = getFormFields('categoriesForm');
	if (fields.emptyFields > 0) {
	    var data = new Object();
	    data.msg = LOCALS['l_fillEmptyFields'];
	    $('form').prepend(msgBox(false, data));
	    return false;
	}
	$.ajax({
	    type: "POST",
	    url: '<?= $controlDomainName ?>/include/response.php',
	    data: {
		type: 'set',
		page: $('form').attr('id'),
		action: 'update',
		sid: sid,
		fields: fields.fields
	    },
	    success: function(data) {
		$('form').prepend(msgBox(data.success, data));
		$('#listdiv').empty();
		$.get('<?= $controlDomainName ?>/includeThisFile.php',{
		    path : '<?=$controlDomainName?>',
		    file : 'scripts/vidCats_list.php'
		},function(data){
		    $('#listdiv').html(data);
		});
	    },
	    dataType: 'json'
	});
	return false;
    });
});
</script>

<form method="post" action="#" name="form1" id="categoriesForm" >


    <div class="f_table">
	<div class="f_caption"><span><?= $l_updatecat ?></span></div>

	<div class="f_row">
	    <div class="f_cell1" ><b><?= $l_catname ?> : </b></div>
	    <div class="f_cell2" ><input type="text" name="txtname" id="txtname" size="30" value="<?= $txtname ?>" ></div>
	</div>


	<div class="f_row">
	    <div class="f_cell1" ><b><?= $l_order ?> : </b></div>
	    <div class="f_cell2" ><input type="text" name="txtorder" id="txtorder" size="10" value="<?= $txtorder ?>" ></div>
	</div>


	<div class="f_row">
	    <div class="f_cell1" ><b><?= $l_status ?> : </b></div>
	    <div class="f_cell2" >
		<select name="lststatus" id="lststatus">
		    <option value="0"><?= $l_notactive ?></option>
		    <option value="1"><?= $l_active ?></option>
		</select>
	    </div>
	</div>

	<div class="f_row">
	    <div class="f_cell1" ></div>
	    <div class="f_cell2" >
		<button class="myButton" type="submit" name="cmdsave" id="cmdsave"> 
		    <img src="<?= $controlDomainName ?>images/ico_save.png" width="16" height="16" align="top"> 
		    <span><?= $l_save ?></span> 
		</button>
		<button class="myButton" type="submit" name="cmdDelete" id="cmdDelete">
		    <img src="<?= $controlDomainName ?>images/delete_no.gif" width="16" height="16" align="top"> 
		    <span><?= $l_delete ?></span> 
		</button>
		
		<button type="button" class="Imgbutton" name="OpenFormBtn" onclick="document.location.replace('?menu=<?=  getGetInput('menu')?>')" id="OpenFormBtn">
		    <img src="images/minus-icon.png" width="16" height="16" align="top"> 
		    <span><?=$l_close?></span> 
		</button>

	    </div>
	</div>

    </div>

</form>
