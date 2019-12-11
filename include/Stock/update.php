<head>
	<script language="javascript">
		function checkUpdateRic(){
			var str=/^[A-Z\u00E0\u00E8\u00EC\u00F2\u00F9\u0027\u0020]+$/i;
			var price=/^([\d]+|\d+\.\d{2})$/;

			var name=formUpdateRic.name.value;
			var qnt=formUpdateRic.qnt.value;
			var type=formUpdateRic.type.value;
			var selPrice=formUpdateRic.selPrice.value;
			var purchPrice=formUpdateRic.purchPrice.value;
			
			if(!str.test(name)){
				alert("Formato Nome Oggetto errato.");
				return false;
			}
			
			if(qnt==""){
				alert("Inserire una quantita'.");
				return false;
			}
			
			if(!str.test(type)){
				alert("Inserire Tipo di Merce valido.");
				return false;
			}
			
			if(!price.test(selPrice)){
				alert("Inserire Prezzo Vendita valido.");
				return false;
			}
			
			if(!price.test(purchPrice)){
				alert("Inserire Prezzo Acquisto valido.");
				return false;
			}
		}
	</script>
</head>

<br><br>
<h1 align="center">Modifica Ricambio</h1>
<br><br>

<?php
	if(!isset($_POST["btnUpd"]) && !isset($_POST["btnFormUpd"])){
		$query="SELECT * FROM `magazzino`;";	
		if(!($result=mysql_query($query,$connection))){
			echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
			echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
			die("");
		}
		echo "<table border=\"1\" width=\"70%\" class=\"tab\">";
			echo "<th>Reference<th>Nome<th>Descrizione<th>Quantita'<th>Tipo<th>Prezzo Vendita<th>Prezzo Acquisto<th>Modifica";
			if(mysql_num_rows($result)>0){
				while($rs=mysql_fetch_row($result)){
					echo "<tr>";
					echo "<form name=\"formListRic\" method=\"POST\" action=\"clock.php?page=updateStock\">";
					$indice=count($rs);
					for($i=0; $i<$indice; $i++){
						if($i==5 || $i==6)	$rs[$i]="&euro; ".$rs[$i];
						if($rs[$i]!=NULL)
							echo "<td align=\"center\">&nbsp;".$rs[$i]."&nbsp;</td>";
						else
							echo "<td align=\"center\">&nbsp;<strong>//</strong> &nbsp;</td>";
					}
					echo "<td align=\"center\"><input type=\"submit\" class=\"btnUpd\" value=\"&nbsp;Modifica&nbsp;\" name=\"btnUpd\"><input type=\"hidden\" name=\"refer\" value=\"".$rs[0]."\"></td>";
					echo "</form>";
					echo "</tr>";
				}
			}else{
				echo "<br><br>Nessun risultato trovato.";
			}
		echo "</table>";
	}else
		if(isset($_POST["btnUpd"])){
			$refer=$_POST["refer"];
			$resSelUpd=mysql_query("SELECT * FROM `magazzino` WHERE `reference`='".$refer."';",$connection);
			if(mysql_num_rows($resSelUpd)>0){
				while($rs2Upd=mysql_fetch_row($resSelUpd)){
?>

<form name="formUpdateRic" method="POST" onSubmit="return checkUpdateRic();" action="clock.php?page=updateStock">
	<table cellspacing="20" frame="box">
		<tr>
			<td><p class="pmenu">Referenza*</p></td>
			<td><input type="text" name="ref" size="25" value="<?php echo ($rs2Upd[0]); ?>" style="color: grey;" readonly></td>
		</tr>
		<tr>
			<td><p class="pmenu">Nome Oggetto*</p></td>
			<td><input type="text" name="name" size="25" value="<?php echo ($rs2Upd[1]); ?>"></td>
		</tr>
		<tr>
			<td colspan="2"><p class="pmenu" style="text-align: center;">Descrizione</p>
			<textarea rows="7" cols="50" name="descr" maxlength="500"><?php echo ($rs2Upd[2]); ?></textarea></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align: right;">Quantita'*</p></td>
			<td><input type="number" name="qnt" min="0" max="10000" step="1" value="<?php echo ($rs2Upd[3]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align: right;">Tipo merce*</p></td>
			<td><input type="text" name="type" size="25" value="<?php echo ($rs2Upd[4]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align: center;">Prezzo Vendita*<br>&euro;&nbsp;<input type="text" name="selPrice" size="5" value="<?php echo ($rs2Upd[5]); ?>"></p></td>
			<td><p class="pmenu" style="text-align: center;">Prezzo Acquisto*<br>&euro;&nbsp;<input type="text" name="purchPrice" size="5" value="<?php echo ($rs2Upd[6]); ?>"></p></td>
		</tr>
		
		<tr>
			<td align="right"><input type="submit" name="btnUpdRic" value="Modifica Ricambio" class="btn"></td>
			<td align="center"><input type="reset" value="Reset" class="btn"></td>
		</tr>
	</table>
</form>

<?php			}
			}
		}
		
	if(isset($_POST["btnUpdRic"])){
		$ref=$_POST["ref"];
		$name=$_POST["name"];		
		$descr=$_POST["descr"];		if($descr=='')		$descr="NULL"; else	$descr="'".$descr."'";
		$qnt=$_POST["qnt"];
		$type=$_POST["type"];
		$selPrice=$_POST["selPrice"];
		$purchPrice=$_POST["purchPrice"];
	
		$queryRic="UPDATE `magazzino` SET `name`='".$name."', `description`=".$descr.", `quantity`='".$qnt."', `type`='".$type."', `selling_price`='".$selPrice."',`purchase_price`='".$purchPrice."' WHERE `reference`='".$ref."';";
		
		if(!(mysql_query($queryRic,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile modificare il ricambio.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Ricambio modificato correttamente.\")</script></head>";
	}
?>
