<?php
	if($iduser!=1){
		echo "<head><script language=\"javascript\">alert(\"ERRORE. Il tuo account non dispone delle autorizzazioni necessarie per visualizzare questa pagina.\")</script></head>";
	}else{
?>

<br><br>
<h1 align="center">Query SQL</h1>
<br><br><br>

<form method="POST" action="clock.php?page=esegui">
	<table frame="box" width="40%" class="tab" cellspacing="15">
		<tr>
			<td><p class="pmenu">Inserisci la Query</p></td>
		</tr>
		<tr>
			<td colspan="2">
				<textarea rows="15" cols="100" name="query" ></textarea>
			</td>
		</tr>
		<tr>
			<td align="center"><input type="submit" value="Esegui" class="btn" name="btn_exe"></td>
			<td align="left"><input type="reset" value="Reset" class="btn"></td>
		</tr>
	</table>
</form>

<?php
	}
?>