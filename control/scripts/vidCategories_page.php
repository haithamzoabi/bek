<div class="pagediv">
<?

if (getGetInput('action')==='update' ){
    include('vidCats_update.php');
}else{
    include('vidCats_add.php');
}

?>
    <div id="listdiv">
	<?include("scripts/vidCats_list.php") ?>
    </div>
    
</div>