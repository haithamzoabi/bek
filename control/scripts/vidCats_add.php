<script>
    $(function() {
	var menu = getURLParameter('menu');
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
		    action: 'add',
		    fields: fields.fields
		},
		success: function(data) {
		    if (data.success) {
			$('form').find("input[type=text], textarea, select").val("");
		    }
		    $('form').prepend(msgBox(data.success, data));
		    $('#listdiv').empty();
		    $.get('<?= $controlDomainName ?>/includeThisFile.php',{
			path : '<?=$controlDomainName?>',
			file : 'scripts/vidCats_list.php',
			menu : menu
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
	    <div class="f_caption"><span><?= (isset($cid)) ? $l_updatecat : $l_addnewcat ?></span></div>

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
			<option value="0" <?= ($lststatus == 0) ? 'selected="selected"' : '' ?> ><?= $l_notactive ?></option>
			<option value="1" <?= ($lststatus == 1) ? 'selected="selected"' : '' ?> ><?= $l_active ?></option>
		    </select>
		</div>
	    </div>

	    <div class="f_row">
		<div class="f_cell1" ></div>
		<div class="f_cell2" >
		  <input type="submit" class="myButton" name="cmdadd" value="<?= $l_add ?>">

		</div>
	    </div>

	</div>


    </form>
