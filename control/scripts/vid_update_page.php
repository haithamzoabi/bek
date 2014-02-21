<script>
	$(function() {

	
	var formId =  $('form').attr('id');
	FUNC.fetchData(formId , function(formData){
		FUNC.configSelection('vidCategories_list','lstCategories', formData.lstCategories );
		FUNC.configSelection('cities_list','lstCities' , formData.lstCities);
	});
	
	FUNC.sendFormData(formId,'update');
	
    });
</script>

<div class="pagediv">
    <?
    $formTitle = $l_updateVideo;
    $submitButtonText = $l_update;
    $sid = getGetInput('sid');
    include("vid_formPage.php");
    ?>

</div>    
