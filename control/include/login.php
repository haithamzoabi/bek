
<div id="logContainer">
	<div id="titleContainer" >
		<div>
			<img src="images/group_key.png" width="32" height="32" alt="" >
		</div>
		<div>
			<span><?=$l_entry?></span>
		</div>
	</div>

	<div>

	 <form method="POST" action="index.php" >
		<table align="center" cellpadding="0" cellspacing="0" style=" color: #660033 "  width="400px" dir="rtl" border="0">
		<tr><td colspan="2" align="center">&nbsp;<?=$err_msg?>&nbsp;</td></tr>
		<tr>
		<td align="left"  height="30px"><?=$l_username?>&nbsp;:  </td>
		<td><input class="txtbox" type="text" size="30" name="username"   > </td>
		</tr>
		<tr>
		<td align="left"   height="30px"><?=$l_password?>&nbsp;: </td>
		<td> <input class="txtbox" type="password" size="30" name="password"  > </td>
		</tr>

		<tr style="height: 30px" style="display: none">
		<td align="center"  colspan="2">
		<label><input type="checkbox" name="rememberme" ><?=$l_rememberme?></label>
		</td>
		</tr>

		<tr><td align="center"  colspan="2">
		<input class="myButton" type="submit" name="login" value="<?=$l_login?>">
		</td></tr>
		<tr><td>&nbsp;</td></tr>
		</table>
	 </form>

	</div>


</div>






