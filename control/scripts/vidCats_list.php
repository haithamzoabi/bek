<br>
<table id="ntable"  >
    <colgroup>
	<col class="side1" />
        <col span="1" class="side3" />
	<col span="3" class="side2"/>

    </colgroup>

    <thead>
	<tr class="tr_caption">
	    <td colspan="5"><span><?= $l_cats ?></span></td>
	</tr>
	<tr class="tr_title">
	    <td >&nbsp;</td>
	    <td width="20"><?= $l_update ?></td>
	    <td> <?= $l_name ?></td>
	    <td> <?= $l_order ?></td>
	    <td><?= $l_status ?></td>
	</tr>
    </thead>


    <tbody>

	<?
	$q = "select * from vid_cats order by v_order asc";
	$res = query($q);
	$i = 0;
	while ($row = $res->fetch_row() ) {
	    $i++;
	    ?>

    	<tr class="<?= ($row[3] == 0) ? 'new_tr' : '' ?> tr"  >
    	    <td align="center"><?= $i ?></td>

    	    <td align="center">
		<a title="<?= $l_update ?>" href="?menu=<?=getGetInput('menu')?>&action=update&sid=<?=$row[0]?>">
		    <img border="0" src="<?=$controlDomainName?>images/edit.png" width="13" height="13" alt="">
		</a>
	    </td>

    	    <td><?= $row[1] ?></td>
    	    <td><?= $row[2] ?></td>
    	    <td><?= ($row[3] == 0) ? $l_notactive : $l_active ?></td>



    	</tr>


	<? }
	?>

    </tbody>

    <tfoot>
	<tr>
	    <td align="right" colspan="5">
		&nbsp;<?= $l_totoal . ': ' . $i ?>
	    </td>
	</tr>
    </tfoot>



</table>