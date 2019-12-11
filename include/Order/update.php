<head>
	<script language="javascript">
		function checkUpdateOrd(){
			var price=/^([\d]+|\d+\.\d{2})$/;
			
			var qnt=formUpdateOrd.qnt.value;
			var tot=formUpdateOrd.tot.value;
			var stato=formUpdateOrd.status.value;
			var dateOut=formUpdateOrd.dateOrdOut.value;
			var dateIn=formUpdateOrd.dateOrdIn.value;
			
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
			
			if((stato=="1" || stato=="3") && dateOut==""){
				alert("Inserire una data di Emissione.");
				return false;
			}
			
			if(stato=="3" && dateIn==""){
				alert("Inserire una data di Ricezione.");
				return false;
			}
			
			if(stato=="2" && (dateOut!="" || dateIn!="")){
				alert("Ordine In Attesa. Impossibile inserire data di Emissione e/o Ricezione.");
				return false;
			}
			
			var arr1 = dateOut.split("-");
			var arr2 = dateIn.split("-");
			var d1 = new Date(arr1[0],arr1[1]-1,arr1[2]);
			var d2 = new Date(arr2[0],arr2[1]-1,arr2[2]);
			var r1 = d1.getTime();
			var r2 = d2.getTime();
			
			if(r2!="NaN" && r1>r2){
				alert("La data di Ricezione deve essere dopo quella di Emissione.");
				return false;
			}
		}
	</script>
</head>

<br><br>
<h1 align="center">Modifica Ordine</h1>
<br><br>

<?php
	if(!isset($_POST["btnUpd"]) && !isset($_POST["btnFormUpd"])){
		$query="SELECT * FROM `order`;";
		if(!($result=mysql_query($query,$connection))){
			echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
			echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
			die("");
		}

		echo "<table border=\"1\" width=\"70%\" class=\"tab\">";
			echo "<th>&nbsp;ID&nbsp;<th>Referenza<th>Fornitore<th>Lavoratore<th>Descrizione<th>Quantita'<th>Stato<th>Data Emissione<th>Data Ricezione<th>&nbsp;&nbsp;Totale&nbsp;&nbsp;<th>Modifica";
			if(mysql_num_rows($result)>0){
				while($rs=mysql_fetch_row($result)){
					echo "<tr>";
					echo "<form name=\"formListOrd\" method=\"POST\" action=\"clock.php?page=updateOrder\">";
					$indice=count($rs);
					for($i=0; $i<$indice; $i++){
						switch($i){
							case 2:		//fornitore
								$query="SELECT `name` FROM `fornitore` WHERE `id`=".$rs[$i].";";
								$res=mysql_query($query,$connection);
								while($a=mysql_fetch_row($res))	$rs[$i]=$a[0];
								break;
							case 3:		//worker
								$query="SELECT `name` FROM `worker` WHERE `id`=".$rs[$i].";";
								$res=mysql_query($query,$connection);
								while($a=mysql_fetch_row($res))	$rs[$i]=$a[0];
								break;
							case 6:	//stato rip.
								switch ($rs[$i]){
									case 1:		$rs[$i]="Emesso";					break;
									case 2:		$rs[$i]="In attesa (NON emesso)";	break;
									case 3:		$rs[$i]="Ricevuto";					break;
									default:	$rs[$i]="ERROR";
								}
								break;
							case 9:	//tot
								if($rs[$i]!=NULL)	$rs[$i]="&euro; ".$rs[$i];
								break;
						}
						if($rs[$i]!=NULL)
							echo "<td align=\"center\">&nbsp;".$rs[$i]."&nbsp;</td>";
						else
							echo "<td align=\"center\">&nbsp;<strong>//</strong> &nbsp;</td>";
					}
					echo "<td align=\"center\"><input type=\"submit\" class=\"btnUpd\" value=\"&nbsp;Modifica&nbsp;\" name=\"btnUpd\"><input type=\"hidden\" name=\"idOrd\" value=\"".$rs[0]."\"></td>";
					echo "</form>";
					echo "</tr>";
				}
			}else{
				echo "<br><br>Nessun risultato trovato.";
			}
		echo "</table>";
	}else
		if(isset($_POST["btnUpd"])){
			$idOrd=$_POST["idOrd"];
			$resSelUpd=mysql_query("SELECT * FROM `order` WHERE `id_order`=".$idOrd.";",$connection);
			if(mysql_num_rows($resSelUpd)>0){
				while($rs2Upd=mysql_fetch_row($resSelUpd)){
?>

<form name="formUpdateOrd" method="POST" onSubmit="return checkUpdateOrd();" action="clock.php?page=updateOrder">
	<table cellspacing="20" frame="box">
		<tr>
			<td>
				<p class="pmenu">Ricambio*<br>
					<?php
						$resRicamb=mysql_query("SELECT `reference`,`description`,`purchase_price`,`quantity` FROM `magazzino`;",$connection); 		
						if(mysql_num_rows($resRicamb)>0){
							echo "<select name=\"idRicambio\">";
							while($rsRic=mysql_fetch_row($resRicamb)){
								if($rs2Upd[1]==$rsRic[0])
									echo ("<option value=\"".$rsRic[0]."\"; selected=\"selected\">[x".$rsRic[3]."] - &euro; ".$rsRic[2]." cad. - ".$rsRic[0]." - ".$rsRic[1]."</option>");
								else 
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
						$resOrd=mysql_query("SELECT `id`,`name`,`p_iva`,`type` FROM `fornitore`;",$connection); 		
						if(mysql_num_rows($resOrd)>0){
							echo "<select name=\"idFornitore\">";
							while($rsOrd=mysql_fetch_row($resOrd)){
								if($rs2Upd[2]==$rsOrd[0])
									echo ("<option value=\"".$rsOrd[0]."\" selected=\"selected\">".$rsOrd[2]." - ".$rsOrd[1]." - ".$rsOrd[3]."</option>");
								else
									echo ("<option value=\"".$rsOrd[0]."\">".$rsOrd[2]." - ".$rsOrd[1]." - ".$rsOrd[3]."</option>");
							}
							echo "</select>";
						}
					?>
				</p></td>
		</tr>
		<tr>
			<td align="center"><p class="pmenu" style="text-align: center;">Descrizione ordine</p>
				<textarea rows="7" cols="40" name="orderDesc" maxlength="500"><?php echo ($rs2Upd[4]); ?></textarea>
			</td>
		</tr>
		<tr>
			<td align="center"><p class="pmenu" style="text-align: center;">Quantita'*</p>
				<input type="number" name="qnt" min="1" max="1000" step="1" value="<?php echo ($rs2Upd[5]); ?>">
			</td>
		</tr>
		<tr>
			<td><p class="pmenu">Stato Ordine*</p>
				<input type="radio" name="status" value="2" <?php if($rs2Upd[6]==2) echo "checked=\"checked\""?>>In Attesa (NON Emesso)<br>
				<input type="radio" name="status" value="1" <?php if($rs2Upd[6]==1) echo "checked=\"checked\""?>>Emesso<br>
				<input type="radio" name="status" value="3" <?php if($rs2Upd[6]==3) echo "checked=\"checked\""?>>Ricevuto
			</td>
		</tr>
		<tr>
			<td>
				<p class="pmenu">Data Emissione&nbsp;<input type="date" name="dateOrdOut" value="<?php echo ($rs2Upd[7]); ?>"></p>
			</td>
		</tr>
		<tr>
			<td>
				<p class="pmenu">Data Ricezione&nbsp;<input type="date" name="dateOrdIn" value="<?php echo ($rs2Upd[8]); ?>"></p>
			</td>
		</tr>
		<tr>
			<td><p class="pmenu">Totale &euro;&nbsp;<input type="text" name="tot" size="5" value="<?php echo ($rs2Upd[9]); ?>"></p></td>
		</tr>
		<tr>
			<td align="center"><input type="submit" name="btnUpdOrd" value="Modifica Ordine" class="btn" style="margin-right:15px;">
							   <input type="reset" value="Reset" class="btn" style="margin-left:15px;">
			</td>
		</tr>
		<tr>
			<td><input type="hidden" name="idOrd" value="<?php echo $idOrd; ?>"></td>
		</tr>
	</table>
</form>

<?php			}
			}
		}
		
	if(isset($_POST["btnUpdOrd"])){
		$idOrd=$_POST["idOrd"];
		$ref=$_POST["idRicambio"];
		$fornit=$_POST["idFornitore"];		
		$descr=$_POST["orderDesc"];			if($descr=='')		$descr="NULL"; else	$descr="'".$descr."'";
		$qnt=$_POST["qnt"];
		$stato=$_POST["status"];
		$dateOut=$_POST["dateOrdOut"];		if($dateOut=='')	$dateOut="NULL"; else	$dateOut="'".$dateOut."'";
		$dateIn=$_POST["dateOrdIn"];		if($dateIn=='')		$dateIn="NULL";	 else	$dateIn="'".$dateIn."'";
		$tot=$_POST["tot"];
		
		$queryOrd="UPDATE `order` SET `reference`='".$ref."', `id_fornitore`='".$fornit."', `id_worker`='".$iduser."', `description`=".$descr.", `quantity`='".$qnt."', `status`='".$stato."', `data_emission`=".$dateOut.", `data_receipt`=".$dateIn.", `amount`='".$tot."' WHERE `id_order`=".$idOrd.";";
		
		if(!(mysql_query($queryOrd,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile modificare l'ordine.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Ordine modificato correttamente.\")</script></head>";
	}
?>
