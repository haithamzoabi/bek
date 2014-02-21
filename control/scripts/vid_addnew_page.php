<script>
    $(function() {

	var formId =  $('form').attr('id');
	FUNC.sendFormData(formId,'add');
	FUNC.configSelection('vidCategories_list','lstCategories');
	FUNC.configSelection('cities_list','lstCities');
    });
</script>

<div class="pagediv">
    <?
    $formTitle = $l_addNewVideo;
	$submitButtonText = $l_add;
    include("vid_formPage.php");
    ?>

</div>
