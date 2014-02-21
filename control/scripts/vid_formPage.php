
<form method="post" action="#" name="form1" id="videoForm" >


    <div class="f_table">
	<div class="f_caption"><span><?=$formTitle?></span></div>

	<div class="f_row">
	    <div class="f_cell1" ><b><?= $l_category ?> : </b></div>
	    <div class="f_cell2" >
		<select name="lstCategories" id="lstCategories">
		    <option value=""></option>			    
		</select>
	    </div>
	</div>

	<div class="f_row">
	    <div class="f_cell1" ><b><?= $l_city ?> : </b></div>
	    <div class="f_cell2" >
		<select name="lstCities" id="lstCities">
		    <option value=""></option>		    
		</select>
	    </div>
	</div>
	
	<div class="f_row">
	    <div class="f_cell1" ><b><?= $l_videoTitle ?> : </b></div>
	    <div class="f_cell2" >
		<input type="text" name="txtTitle" id="txtTitle">
	    </div>
	</div>
	
	
	<div class="f_row">
	    <div class="f_cell1" ><b><?= $l_videoDetails ?> : </b></div>
	    <div class="f_cell2" >
		<textarea name="txtDetails" id="txtDetails" ></textarea>
	    </div>
	</div>

	
	<div class="f_row">
	    <div class="f_cell1" ><b><?= $l_link ?> : </b></div>
	    <div class="f_cell2" >
		<input type="text" name="txtLink" id="txtLink" maxlength="11">
	    </div>
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
		
		<button class="myButton" type="submit" name="cmdsave" id="cmdsave"> 
		    <img src="<?= $controlDomainName ?>images/ico_save.png" width="16" height="16" align="top"> 
		    <span><?= $submitButtonText ?></span> 
		</button>
		<? if (isset($sid)){?>
		<button class="myButton" type="button" name="cmdDelete" id="cmdDelete" onclick="check_delete('videoForm', LOCALS.controlDomainName+'vidlist?menu=<?=getGetInput('menu')?>')">
		    <img src="<?= $controlDomainName ?>images/delete_no.gif" width="16" height="16" align="top"> 
		    <span><?= $l_delete ?></span> 
		</button>
		<?}?>
		

	    </div>
	</div>

    </div>


</form>


