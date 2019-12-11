<head>
	<script language="javascript">
		function checkNewRip(){
			var ref=/^.{4,15}$/;
			var price=/^([\d]+|\d+\.\d{2})$/;
			var disc=/^\d{0,2}$/;
			
			var idCustomer=formNewRepair.idCustomer.value;
			var workDescr=formNewRepair.workDescr.value;
			var refOrol=formNewRepair.refOrol.value;
			var warranty=formNewRepair.warranty.value;
			var dateWarranty=formNewRepair.dateWarranty.value;
			var amount=formNewRepair.amount.value;
			var discount=formNewRepair.discount.value;
			var tot=formNewRepair.tot.value;
			
			if(idCustomer=="NULL"){
				alert("Selezionare un cliente.");
				return false;
			}
			
			if(workDescr==""){
				alert("Descrizione lavoro obbligatoria.");
				return false;
			}
			
			if(!ref.test(refOrol)){
				alert("La referenza dell'orologio deve essere lunga almeno 4 caratteri.");
				return false;
			}
			
			if(warranty==1 && dateWarranty==""){
				alert("Inserire data della garanzia.");
				return false;
			}
			
			if(amount!="" && !price.test(amount)){
				alert("Prezzo errato.");
				return false;
			}
			
			if(discount!="" && !disc.test(discount)){
				alert("Sconto errato.");
				return false;
			}
			
			if(tot!="" && !price.test(tot)){
				alert("Totale errato.");
				return false;
			}
		}
	</script>
</head>

<?php
	if(isset($_POST["btnFormNew"])){
		$idCust=$_POST["idCustomer"];
		$idRic=$_POST["idRicambio"];		if($idRic=='')	$idRic="NULL"; else	$idRic="'".$idRic."'";
		$workDesc=$_POST["workDescr"];
		$note=$_POST["note"];				if($note=='')	$note="NULL"; else	$note="'".$note."'";
		$refOrol=$_POST["refOrol"];
		$descOrol=$_POST["descOrol"];		if($descOrol=='')	$descOrol="NULL"; else	$descOrol="'".$descOrol."'";
		$warranty=$_POST["warranty"];
		$dateWarr=$_POST["dateWarranty"];	if($dateWarr=='')	$dateWarr="NULL"; else	$dateWarr="'".$dateWarr."'";
		$prev=$_POST["prev"];
		$status=$_POST["status"];
		$dateIn=$_POST["dateRipIn"];
		$disc=$_POST["discount"];			if($disc=='')	$disc="NULL"; else	$disc="'".$disc."'";
		$amount=$_POST["amount"];			if($amount=='')	$amount="NULL"; else	$amount="'".$amount."'";
		$total=$_POST["tot"];				if($total=='')	$total="NULL"; else	$total="'".$total."'";
		
		$queryRip="INSERT INTO `riparazione` (`id_worker`, `id_customer`, `id_ricambio`, `work_description`, `notes`, `clock_reference`, `clock_description`, `warranty`, `warranty_date`, `preventivo`, `repair_status`, `date_repair_in`, `date_repair_out`, `discount`, `amount`, `final_amount`) VALUES ('".$iduser."', '".$idCust."', ".$idRic.", '".$workDesc."', ".$note.", '".$refOrol."', ".$descOrol.", '".$warranty."', ".$dateWarr.", '".$prev."', '".$status."', '".$dateIn."', NULL,".$disc.", ".$amount.", ".$total.")";
		
		if(!(mysql_query($queryRip,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non è stato possibile creare la riparazione.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Riparazione creata correttamente.\")</script></head>";
	}
?>

<br><br><h1 align="center">Nuova Riparazione</h1>
<form name="formNewRepair" method="POST" onSubmit="return checkNewRip();" action="clock.php?page=newRepair">
	<table cellspacing="40">
		<tr>
			<td>
				<p class="pmenu">Cliente*&nbsp;
					<?php
						$resCustomer=mysql_query("SELECT `id`,`name`,`surname` FROM `customer`;",$connection); 		
						if(mysql_num_rows($resCustomer)>0){
							echo "<select name=\"idCustomer\">";
							echo "<option value=\"NULL\" selected=\"selected\"></option>";
							while($rsCus=mysql_fetch_row($resCustomer)){
									echo ("<option value=\"".$rsCus[0]."\">(".$rsCus[0].") - ".$rsCus[1]." ".$rsCus[2]."</option>");
							}
							echo "</select>";
						}
					?>
				</p>
			</td>
			<td>
				<p class="pmenu">Ricambio&nbsp;
					<?php
						$resRicamb=mysql_query("SELECT `reference`,`description` FROM `magazzino`;",$connection); 		
						if(mysql_num_rows($resRicamb)>0){
							echo "<select name=\"idRicambio\">";
							echo "<option value=\"\" selected=\"selected\"></option>";
							while($rsRic=mysql_fetch_row($resRicamb)){
									echo ("<option value=\"".$rsRic[0]."\";>".$rsRic[0]." - ".$rsRic[1]."</option>");
							}
							echo "</select>";
						}
					?>
				</p>
			</td>
			<td><p class="pmenu">Descrizione Lavoro*<br><textarea rows="5" cols="35" name="workDescr" maxlength="500"></textarea></p></td>
		</tr>
		<tr>
			<td><p class="pmenu">Ref. Orologio*&nbsp;<input type="text" name="refOrol"></p></td>
			<td><p style="font-size:16pt; text-align:center;">Descr. Orologio<br><textarea rows="5" cols="35" name="descOrol" maxlength="500"></textarea></p></td>
			<td><p class="pmenu">Note<br><textarea rows="5" cols="35" name="note" maxlength="500"></textarea></p></td>
		</tr>
		<tr>
			<td><p class="pmenu">Garanzia*</p>
				<input type="radio" name="warranty" value="1">SI<br>
				<input type="radio" name="warranty" value="0" checked="checked">NO
			</td>
			<td><p class="pmenu">Data Garanzia&nbsp;<input type="date" name="dateWarranty"></p></td>
		</tr>
		<tr>
			<td>
				<table align="left">
					<tr><p class="pmenu">Preventivo*</p></tr>
					<tr>
						<td align="left">
							<input type="radio" name="prev" value="1">Da eseguire&emsp;&emsp;<br>
							<input type="radio" name="prev" value="2">Eseguito&emsp;&emsp;<br>
							<input type="radio" name="prev" value="3">Comunicato&emsp;&emsp;<br>
						</td>
						<td align="left">
							<input type="radio" name="prev" value="4">Accettato<br>
							<input type="radio" name="prev" value="5">Rifiutato<br>
							<input type="radio" name="prev" value="6" checked="checked">Nessun Prev.
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table align="left">
					<tr><p class="pmenu">Stato Riparazione*</p></tr>
					<tr>
						<td>
							<input type="radio" name="status" value="1" checked="checked">Ricevuta&emsp;&emsp;<br>
							<input type="radio" name="status" value="2">In lavorazione&emsp;&emsp;<br>
							<input type="radio" name="status" value="3">Attesa Preventivo&emsp;&emsp;<br>
						</td>
						<td>
							<input type="radio" name="status" value="4">Attesa Ricambi&emsp;&emsp;<br>
							<input type="radio" name="status" value="5">Riparazione completata&emsp;&emsp;<br>
							<input type="radio" name="status" value="6">Comunicazione ritiro&emsp;&emsp;<br>
						</td>
						<td>
							<input type="radio" name="status" value="7">Consegnato<br>
							<input type="radio" name="status" value="8">Entrato (Pagato)<br>
							<input type="radio" name="status" value="9">Non Entrato (Pagato)
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<p class="pmenu">Data Registrazione&nbsp;<input type="date" name="dateRipIn" value="<?php echo date("Y-m-d");?>" readonly></p>
			</td>
			<td>
				<p class="pmenu">
					Prezzo &euro;&nbsp;<input type="text" name="amount" size="5">&emsp;&emsp;
					Sconto&nbsp;<input type="text" name="discount" size="2">&nbsp;%<br>
				</p>
			</td>
			<td><p class="pmenu">Totale finale <br>&euro;&nbsp;<input type="text" name="tot" size="5"></p></td>
		</tr>
		
		<tr><td></td>
			<td align="center">
				<input type="submit" class="btn" value="Genera Riparazione" name="btnFormNew" style="margin-right:30px;">
				<input type="reset" class="btn" value="Reset" "margin-left:30px;">
			</td>
		</tr>
	</table>
</form>