<head>
	<script language="javascript">
		function checkNewOrder(){
			var price=/^([\d]+|\d+\.\d{2})$/;
			
			var ref=formNewOrder.idRicambio.value;
			var fornit=formNewOrder.idFornitore.value;
			var qnt=formNewOrder.qnt.value;
			var tot=formNewOrder.tot.value;
			
			if(ref==""){
				alert("Selezionare un Ricambio.");
				return false;
			}
			
			if(fornit==""){
				alert("Selezionare un Fornitore.");
				return false;
			}
			
			if(qnt==""){
				alert("Inserisci quantita' ricambio.");
				return false;
			}
			
			if(tot==""){
				alert("Inserisci totale valido.");
				return false;
			}
			
			if(tot=="" || !price.test(tot)){
				alert("Totale errato.");
				return false;
			}
		}
	</script>
</head>

<?php
	if(isset($_POST["btnNewOrd"])){
		$ref=$_POST["idRicambio"];
		$fornit=$_POST["idFornitore"];		
		$descr=$_POST["orderDesc"];			if($descr=='')		$descr="NULL"; else	$descr="'".$descr."'";
		$qnt=$_POST["qnt"];
		$stato=$_POST["status"];
		$dateOut=$_POST["dateOrdOut"];		if($dateOut=='')	$dateOut="NULL"; else	$dateOut="'".$dateOut."'";
		$tot=$_POST["tot"];
		
		$queryOrd="INSERT INTO `order` (`reference`, `id_fornitore`, `id_worker`, `description`, `quantity`, `status`, `data_emission`, `data_receipt`, `amount`) VALUES ('".$ref."', '".$fornit."', '".$iduser."', ".$descr.", '".$qnt."', '".$stato."', ".$dateOut.", NULL, '".$tot."');";
		
		if(!(mysql_query($queryOrd,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile creare l'ordine.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Ordine creato correttamente.\")</script></head>";
	}
?>

<br><br><h1 align="center">Nuovo Ordine</h1><br><br>
<form name="formNewOrder" method="POST" onSubmit="return checkNewOrder();" action="clock.php?page=newOrder">
	<table cellspacing="20" frame="box">
		<tr>
			<td>
				<p class="pmenu">Ricambio*<br>
					<?php
						$resRicamb=mysql_query("SELECT `reference`,`description`,`purchase_price`,`quantity` FROM `magazzino`;",$connection); 		
						if(mysql_num_rows($resRicamb)>0){
							echo "<select name=\"idRicambio\">";
							echo "<option value=\"\" selected=\"selected\"></option>";
							while($rsRic=mysql_fetch_row($resRicamb)){
									echo ("<option value=\"".$rsRic[0]."\";>[x".$rsRic[3]."] - &euro; ".$rsRic[2]." cad. - ".$rsRic[0]." - ".$rsRic[1]."</option>");
							}
							echo "</select>";
						}
					?>
			</td>
		</tr>
		<tr>
			<td><p class="pmenu">Fornitore*<br>
					<?php
						$resCustomer=mysql_query("SELECT `id`,`name`,`p_iva`,`type` FROM `fornitore`;",$connection); 		
						if(mysql_num_rows($resCustomer)>0){
							echo "<select name=\"idFornitore\">";
							echo "<option value=\"\" selected=\"selected\"></option>";
							while($rsCus=mysql_fetch_row($resCustomer)){
									echo ("<option value=\"".$rsCus[0]."\">".$rsCus[2]." - ".$rsCus[1]." - ".$rsCus[3]."</option>");
							}
							echo "</select>";
						}
					?>
				</p></td>
		</tr>
		<tr>
			<td align="center"><p class="pmenu" style="text-align: center;">Descrizione ordine</p>
				<textarea rows="7" cols="40" name="orderDesc" maxlength="500"></textarea>
			</td>
		</tr>
		<tr>
			<td align="center"><p class="pmenu" style="text-align: center;">Quantita'*</p>
				<input type="number" name="qnt" min="1" max="1000" step="1" value="1">
			</td>
		</tr>
		<tr>
			<td><p class="pmenu">Stato Ordine*</p>
				<input type="radio" name="status" value="2" checked="checked">In Attesa (NON Emesso)<br>
				<input type="radio" name="status" value="1">Emesso<br>
				<input type="radio" name="status" value="3" disabled>Ricevuto
			</td>
		</tr>
		<tr>
			<td>
				<p class="pmenu">Data Emissione&nbsp;<input type="date" name="dateOrdOut" value="<?php echo date("Y-m-d");?>"></p>
			</td>
		</tr>
		<tr>
			<td><p class="pmenu">Totale &euro;&nbsp;<input type="text" name="tot" size="5"></p></td>
		</tr>
		<tr>
			<td align="center"><input type="submit" name="btnNewOrd" value="Crea Ordine" class="btn" style="margin-right:15px;">
							   <input type="reset" value="Reset" class="btn" style="margin-left:15px;">
			</td>
		</tr>
	</table>
</form>