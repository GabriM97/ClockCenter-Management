<head>
	<script language="javascript">
		function checkUpdateRip(){
			var ref=/^.{4,15}$/;
			var price=/^([\d]+|\d+\.\d{2})$/;
			var disc=/^\d{0,2}$/;
			
			var idCustomer=updateRip.idCustomer.value;
			var workDescr=updateRip.workDescr.value;
			var refOrol=updateRip.refOrol.value;
			var warranty=updateRip.warranty.value;
			var dateWarranty=updateRip.dateWarranty.value;
			var amount=updateRip.amount.value;
			var discount=updateRip.discount.value;
			var tot=updateRip.tot.value;
			var dateRipIn=updateRip.dateRipIn.value;
			var dateRipOut=updateRip.dateRipOut.value;
			
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
			
			var arr1 = dateRipIn.split("-");
			var arr2 = dateRipOut.split("-");
			var d1 = new Date(arr1[0],arr1[1]-1,arr1[2]);
			var d2 = new Date(arr2[0],arr2[1]-1,arr2[2]);
			var r1 = d1.getTime();
			var r2 = d2.getTime();
			
			if(r2!="NaN" && r1>r2){
				alert("La data di Uscita deve essere dopo quella di Registrazione.");
				return false;
			}
		}
	</script>
</head>

<br><br>
<h1 align="center">Modifica riparazione</h1>

<?php
	if(!isset($_POST["btnUpd"]) && !isset($_POST["btnFormUpd"])){
		$queryList="SELECT `id_repair`,`id_customer`,`work_description`,`clock_reference`,`warranty`,`preventivo`,`repair_status`,`date_repair_in`,`date_repair_out` FROM `riparazione`;";
		if(!($resUpd=mysql_query($queryList,$connection))){
			echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
			echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
			die("");
		}
		echo "<table border=\"1\" width=\"80%\" class=\"tab\">";
			echo "<th>ID<th>Customer<th>Descrizione Lavoro<th>Ref. Orologio<th>Garanzia<th>Prev.<th>Stato<th>Data Entrata<th>Data Uscita<th>Update";
			if(mysql_num_rows($resUpd)>0){
				while($rsUpd=mysql_fetch_row($resUpd)){
					echo "<tr>";
					echo "<form name=\"formListRip\" method=\"POST\" action=\"clock.php?page=updateRepair\">";
					$indice=count($rsUpd);
					for($i=0; $i<$indice; $i++){
						switch($i){
							case 1:		//nome,cognome cliente
								$query="SELECT `name`,`surname` FROM `customer` WHERE `id`=".$rsUpd[$i].";";
								$res=mysql_query($query,$connection);
								while($a=mysql_fetch_row($res))	$rsUpd[$i]=$a[0]."<br>".$a[1];
								break;
							case 4:		//garanzia
								if($rsUpd[$i])	$rsUpd[$i]="SI";
								else			$rsUpd[$i]="NO";
								break;
							case 5:	//preventivo
								switch ($rsUpd[$i]){
									case 1:		$rsUpd[$i]="Da eseguire";	break;
									case 2:		$rsUpd[$i]="Eseguito";		break;
									case 3:		$rsUpd[$i]="Comunicato";	break;
									case 4:		$rsUpd[$i]="Accettato";		break;
									case 5:		$rsUpd[$i]="Rifiutato";		break;
									case 6:		$rsUpd[$i]="Nessun Prev.";	break;
									default:	$rsUpd[$i]="ERROR";
								}
								break;
							case 6:	//stato rip.
								switch ($rsUpd[$i]){
									case 1:		$rsUpd[$i]="Ricevuta";						break;
									case 2:		$rsUpd[$i]="In lavorazione";				break;
									case 3:		$rsUpd[$i]="Attesa Prev.";					break;
									case 4:		$rsUpd[$i]="Attesa Ricambi";				break;
									case 5:		$rsUpd[$i]="Rip. Completata";				break;
									case 6:		$rsUpd[$i]="Comunic. Ritiro";				break;
									case 7:		$rsUpd[$i]="Consegnato";					break;
									case 8:		$rsUpd[$i]="Entrato (Pagato)";				break;
									case 9:		$rsUpd[$i]="Non Entrato (NON Pagato)";		break;
									default:	$rsUpd[$i]="ERROR";
								}
								break;
						}
						if($rsUpd[$i]!=NULL)
							echo "<td align=\"center\">&nbsp;".$rsUpd[$i]."&nbsp;</td>";
						else
							echo "<td align=\"center\">&nbsp;<strong>//</strong> &nbsp;</td>";
					}
					echo "<td align=\"center\"><input type=\"submit\" class=\"btnUpd\" value=\"&nbsp;Modifica&nbsp;\" name=\"btnUpd\"><input type=\"hidden\" name=\"idRip\" value=\"".$rsUpd[0]."\"></td>";
					echo "</form>";
					echo "</tr>";
					echo "<tr><br></tr>";
				}
			}else{
				echo "<br><br>Nessun risultato trovato.";
			}
		echo "</table>";
	}else
		if(isset($_POST["btnUpd"])){
			$idRip=$_POST["idRip"];
			$resSelUpd=mysql_query("SELECT * FROM `riparazione` WHERE `id_repair`=".$idRip.";",$connection);
			if(mysql_num_rows($resSelUpd)>0){
				while($rs2Upd=mysql_fetch_row($resSelUpd)){
?>

<form name="updateRip" method="POST" onSubmit="return checkUpdateRip();" action="clock.php?page=updateRepair">
	<table cellspacing="40">
		<tr>
			<td>
				<p class="pmenu">Cliente*&nbsp;
					<?php
						$resCustomer=mysql_query("SELECT `id`,`name`,`surname` FROM `customer` WHERE id=".$rs2Upd[2].";",$connection); 
						if(mysql_num_rows($resCustomer)>0){
							while($rsCstm=mysql_fetch_row($resCustomer))	
								echo ("<input type=\"text\" value=\"(".$rsCstm[0].") - ".$rsCstm[1]." ".$rsCstm[2]."\" readonly><input type=\"hidden\" name=\"idCustomer\" value=\"".$rsCstm[0]."\"");
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
							if($rs2Upd[3]==NULL)	echo "<option value=\"\" selected=\"selected\"></option>";
							else	echo "<option value=\"\"></option>";
							while($rsRic=mysql_fetch_row($resRicamb)){
								if($rs2Upd[3]==$rsRic[0])	echo ("<option value=\"".$rsRic[0]."\" selected=\"selected\">".$rsRic[0]." - ".$rsRic[1]."</option>");
								else	echo ("<option value=\"".$rsRic[0]."\">".$rsRic[0]." - ".$rsRic[1]."</option>");
							}
							echo "</select>";
						}
					?>
				</p>
			</td>
			<td><p class="pmenu">Descrizione Lavoro*<br><textarea rows="5" cols="35" name="workDescr" maxlength="500"><?php echo ($rs2Upd[4]); ?></textarea></p></td>
		</tr>
		<tr>
			<td><p class="pmenu">Ref. Orologio*&nbsp;<input type="text" name="refOrol" value="<?php echo ($rs2Upd[6]); ?>"></p></td>
			<td><p style="font-size:16pt; text-align:center;">Descr. Orologio<br><textarea rows="5" cols="35" name="descOrol" maxlength="500"><?php echo ($rs2Upd[7]); ?></textarea></p></td>
			<td><p class="pmenu">Note<br><textarea rows="5" cols="35" name="note" maxlength="500"><?php echo ($rs2Upd[5]); ?></textarea></p></td>
		</tr>
		<tr>
			<td><p class="pmenu">Garanzia*</p>
				<input type="radio" name="warranty" value="1" <?php if($rs2Upd[8]==1) echo ("checked=\"checked\""); ?>>SI<br>
				<input type="radio" name="warranty" value="0" <?php if($rs2Upd[8]==0) echo ("checked=\"checked\""); ?>>NO
			</td>
			<td><p class="pmenu">Data Garanzia&nbsp;<input type="date" name="dateWarranty" value="<?php echo ($rs2Upd[9]); ?>"></p></td>
		</tr>
		<tr>
			<td>
				<table align="left">
					<tr><p class="pmenu">Preventivo*</p></tr>
					<tr>
						<td align="left">
							<input type="radio" name="prev" value="1" <?php if($rs2Upd[10]==1) echo ("checked=\"checked\""); ?>>Da eseguire&emsp;&emsp;<br>
							<input type="radio" name="prev" value="2" <?php if($rs2Upd[10]==2) echo ("checked=\"checked\""); ?>>Eseguito&emsp;&emsp;<br>
							<input type="radio" name="prev" value="3" <?php if($rs2Upd[10]==3) echo ("checked=\"checked\""); ?>>Comunicato&emsp;&emsp;<br>
						</td>
						<td align="left">
							<input type="radio" name="prev" value="4" <?php if($rs2Upd[10]==4) echo ("checked=\"checked\""); ?>>Accettato<br>
							<input type="radio" name="prev" value="5" <?php if($rs2Upd[10]==5) echo ("checked=\"checked\""); ?>>Rifiutato<br>
							<input type="radio" name="prev" value="6" <?php if($rs2Upd[10]==6) echo ("checked=\"checked\""); ?>>Nessun Prev.
						</td>
					</tr>
				</table>
			</td>
			<td>
				<table align="left">
					<tr><p class="pmenu">Stato Riparazione*</p></tr>
					<tr>
						<td>
							<input type="radio" name="status" value="1" <?php if($rs2Upd[11]==1) echo ("checked=\"checked\""); ?>>Ricevuta&emsp;&emsp;<br>
							<input type="radio" name="status" value="2" <?php if($rs2Upd[11]==2) echo ("checked=\"checked\""); ?>>In lavorazione&emsp;&emsp;<br>
							<input type="radio" name="status" value="3" <?php if($rs2Upd[11]==3) echo ("checked=\"checked\""); ?>>Attesa Preventivo&emsp;&emsp;<br>
						</td>
						<td>
							<input type="radio" name="status" value="4" <?php if($rs2Upd[11]==4) echo ("checked=\"checked\""); ?>>Attesa Ricambi&emsp;&emsp;<br>
							<input type="radio" name="status" value="5" <?php if($rs2Upd[11]==5) echo ("checked=\"checked\""); ?>>Riparazione completata&emsp;&emsp;<br>
							<input type="radio" name="status" value="6" <?php if($rs2Upd[11]==6) echo ("checked=\"checked\""); ?>>Comunicazione ritiro&emsp;&emsp;<br>
						</td>
						<td>
							<input type="radio" name="status" value="7" <?php if($rs2Upd[11]==7) echo ("checked=\"checked\""); ?>>Consegnato<br>
							<input type="radio" name="status" value="8" <?php if($rs2Upd[11]==8) echo ("checked=\"checked\""); ?>>Entrato (Pagato)<br>
							<input type="radio" name="status" value="9" <?php if($rs2Upd[11]==9) echo ("checked=\"checked\""); ?>>Non Entrato (Pagato)
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<p class="pmenu">Data Registrazione&nbsp;<input type="date" name="dateRipIn" value="<?php echo ($rs2Upd[12]); ?>"></p>
				<p class="pmenu">Data Uscita&emsp;<input type="date" name="dateRipOut" value="<?php echo ($rs2Upd[13]); ?>"></p>
			</td>
			<td>
				<p class="pmenu">
					Prezzo &euro;&nbsp;<input type="text" name="amount" size="5" value="<?php echo ($rs2Upd[15]); ?>">&emsp;&emsp;
					Sconto&nbsp;<input type="text" name="discount" size="2" value="<?php echo ($rs2Upd[14]); ?>">&nbsp;%<br>
				</p>
			</td>
			<td><p class="pmenu">Totale finale <br>&euro;&nbsp;<input type="text" name="tot" size="5" value="<?php echo ($rs2Upd[16]); ?>"></p></td>
		</tr>
		
		<tr>
			<td><input type="hidden" name="idRip" value="<?php echo $idRip; ?>"></td>
			<td align="center">
				<input type="submit" class="btn" value="Modifica Riparazione" name="btnFormUpd" style="margin-right:30px;">
				<input type="reset" class="btn" value="Reset" style="margin-left:30px;">
			</td>
			
		</tr>
	</table>
</form>

<?php			}
			}
		}
		
	if(isset($_POST["btnFormUpd"])){
		$idRip=$_POST["idRip"];
		$idCust=$_POST["idCustomer"];
		$idRic=$_POST["idRicambio"];		if($idRic=='')		$idRic="NULL"; 		else	$idRic="'".$idRic."'";
		$workDesc=$_POST["workDescr"];
		$note=$_POST["note"];				if($note=='')		$note="NULL"; 		else	$note="'".$note."'";
		$refOrol=$_POST["refOrol"];
		$descOrol=$_POST["descOrol"];		if($descOrol=='')	$descOrol="NULL"; 	else	$descOrol="'".$descOrol."'";
		$warranty=$_POST["warranty"];
		$dateWarr=$_POST["dateWarranty"];	if($dateWarr=='')	$dateWarr="NULL";	else	$dateWarr="'".$dateWarr."'";
		$prev=$_POST["prev"];
		$status=$_POST["status"];
		$dateIn=$_POST["dateRipIn"];
		$dateOut=$_POST["dateRipOut"];		if($dateOut=='')	$dateOut="NULL";	else	$dateOut="'".$dateOut."'";
		$disc=$_POST["discount"];			if($disc=='')		$disc="NULL"; 		else	$disc="'".$disc."'";
		$amount=$_POST["amount"];			if($amount=='')		$amount="NULL"; 	else	$amount="'".$amount."'";
		$total=$_POST["tot"];				if($total=='')		$total="NULL"; 		else	$total="'".$total."'";
		
		$queryRip="UPDATE `riparazione` SET `id_worker`='".$iduser."', `id_customer`='".$idCust."', `id_ricambio`=".$idRic.", `work_description`='".$workDesc."', `notes`=".$note.", `clock_reference`='".$refOrol."', `clock_description`=".$descOrol.", `warranty`='".$warranty."', `warranty_date`=".$dateWarr.", `preventivo`='".$prev."', `repair_status`='".$status."', `date_repair_in`='".$dateIn."', `date_repair_out`=".$dateOut.", `discount`=".$disc.", `amount`=".$amount.", `final_amount`=".$total." WHERE `id_repair`=".$idRip.";";
		
		if(!(mysql_query($queryRip,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non è stato possibile modificare la riparazione.\")</script></head>";
			die("");
		}else{	
			echo ("<head><script language=\"javascript\">alert(\"Riparazione modificata correttamente.\")</script></head>");
		}
	}
?>
