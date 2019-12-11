<head>
	<script language="javascript">
		function checkUpdateForn(){
			var str=/^[A-Z\u00E0\u00E8\u00EC\u00F2\u00F9\u0027\u0020]+$/i;
			var eml=/^.+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/i;
			var num=/^\d{8,13}$/;
			var piva=/^\d{11}$/;
			var codf=/^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/i;
			
			var cf=formUpdateForn.cf.value;
			var pi=formUpdateForn.piva.value;
			var name=formUpdateForn.name.value;
			var email=formUpdateForn.email.value;
			var tel=formUpdateForn.telephone.value;
			var tipo=formUpdateForn.type.value;
			
			if(!codf.test(cf)){
				alert("Inserire una Codice Fiscale valido.");
				return false;
			}
			
			if(!piva.test(pi)){
				alert("P.Iva non valida.");
				return false;
			}
			
			if(!str.test(name)){
				alert("Formato Nome errato.");
				return false;
			}
			
			if(!eml.test(email)){
				alert("Inserire una E-mail valida.");
				return false;
			}
			
			if(!num.test(tel)){
				alert("Inserire un numero di Telefono valido.");
				return false;
			}
			
			if(!str.test(tipo)){
				alert("Inserire un Tipo di Merce valido.");
				return false;
			}
		}
	</script>
</head>

<br><br>
<h1 align="center">Modifica Fornitore</h1>
<br><br>

<?php
	if(!isset($_POST["btnUpd"]) && !isset($_POST["btnFormUpd"])){
		$query="SELECT * FROM `fornitore`;";	
		if(!($result=mysql_query($query,$connection))){
			echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
			echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
			die("");
		}
		echo "<table border=\"1\" width=\"70%\" class=\"tab\">";
			echo "<th>&nbsp;ID&nbsp;<th>Cod. Fiscale<th>P. IVA<th>Nome<th>E-mail<th>Telephone<th>Tipo Merce<th>Modifica";
			if(mysql_num_rows($result)>0){
				while($rs=mysql_fetch_row($result)){
					echo "<tr>";
					echo "<form name=\"formListFornit\" method=\"POST\" action=\"clock.php?page=updateFornit\">";
					$indice=count($rs);
					for($i=0; $i<$indice; $i++){
						if($rs[$i]!=NULL)
							echo "<td align=\"center\">&nbsp;".$rs[$i]."&nbsp;</td>";
						else
							echo "<td align=\"center\">&nbsp;<strong>//</strong> &nbsp;</td>";
					}
					echo "<td align=\"center\"><input type=\"submit\" class=\"btnUpd\" value=\"&nbsp;Modifica&nbsp;\" name=\"btnUpd\"><input type=\"hidden\" name=\"idForn\" value=\"".$rs[0]."\"></td>";
					echo "</form>";
					echo "</tr>";
				}
			}else{
				echo "<br><br>Nessun risultato trovato.";
			}
		echo "</table>";
	}else
		if(isset($_POST["btnUpd"])){
			$idForn=$_POST["idForn"];
			$resSelUpd=mysql_query("SELECT * FROM `fornitore` WHERE `id`=".$idForn.";",$connection);
			if(mysql_num_rows($resSelUpd)>0){
				while($rs2Upd=mysql_fetch_row($resSelUpd)){
?>

<form name="formUpdateForn" method="POST" onSubmit="return checkUpdateForn();" action="clock.php?page=updateFornit">
	<table cellspacing="10" frame="box">
		<tr>
			<td><p class="pmenu">Cod. Fiscale*</p></td>
			<td><input type="text" name="cf" size="25" value="<?php echo ($rs2Upd[1]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">P.IVA*</p></td>
			<td><input type="text" name="piva" size="25" value="<?php echo ($rs2Upd[2]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Nome e Cognome*</p></td>
			<td><input type="text" name="name" size="25" value="<?php echo ($rs2Upd[3]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">E-mail*</p></td>
			<td><input type="text" name="email" size="25" value="<?php echo ($rs2Upd[4]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Telefono*</p></td>
			<td><input type="text" name="telephone" size="25" value="<?php echo ($rs2Upd[5]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Tipo merce*</p></td>
			<td><input type="text" name="type" size="25" value="<?php echo ($rs2Upd[6]); ?>"></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" name="btnUpdFornit" value="Modifica Fornitore" class="btn"></td>
			<td align="center"><input type="reset" value="Reset" class="btn"></td>
		</tr>
		<tr>
			<td><input type="hidden" name="idForn" value="<?php echo $idForn; ?>"></td>
		</tr>
	</table>
</form>

<?php			}
			}
		}
		
	if(isset($_POST["btnUpdFornit"])){
		$cf=$_POST["cf"];
		$piva=$_POST["piva"];		
		$name=$_POST["name"];
		$email=$_POST["email"];
		$tel=$_POST["telephone"];
		$type=$_POST["type"];
		$idForn=$_POST["idForn"];
	
		$queryFornit="UPDATE `fornitore` SET `cod_f`='".$cf."', `p_iva`='".$piva."', `name`='".$name."', `email`='".$email."', `telephone`='".$tel."',`type`='".$type."' WHERE `id`=".$idForn.";";
		
		if(!(mysql_query($queryFornit,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile modificare il fornitore.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Fornitore modificato correttamente.\")</script></head>";
	}
?>
