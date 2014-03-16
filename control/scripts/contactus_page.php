<script>
    $(function() {
		var formId =  $('form').attr('id');
		var callBackFunction = function(data){
			 if ($('#txtcontent').is(':visible')) {
				createEditor('ar' , 'txtcontent');
				FUNC.sendFormData(formId,'update' , 1, editor);	
			}
		};
		FUNC.fetchData(formId , callBackFunction , 1 );
    });
</script>

<div class="pagediv">

	<form method="POST" action="#" name="simpleContentForm" id="simpleContentForm" >

		<div class="f_table">
			<div class="f_caption"><span><?=$l_contactus?></span></div>
			<div class="f_row">
				<div class="f_cell1" style="vertical-align: top" ><b><?=$l_description?> : </b></div>
				<div class="f_cell2" >
				<textarea name="txtcontent" id="txtcontent"  ><?=$txtaddress?></textarea>
				</div>
			</div>

			<div class="f_row">
				<div class="f_cell1" ></div>
				<div class="f_cell2" >
					<input type="submit" class="myButton" name="cmdsave" value="<?=$l_save?>">
				</div>
			</div>

		</div>

	</form>

</div>