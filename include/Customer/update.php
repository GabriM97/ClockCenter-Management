<head>
	<script language="javascript">
		function checkUpdateCust(){
			var str=/^[a-zA-Z\u00E0\u00E8\u00EC\u00F2\u00F9\u0027\u0020]+$/i;
			var eml=/^.+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/i;
			var num=/^[0-9]{8,13}$/;
			
			var name=formUpdateRip.name.value;
			var surname=formUpdateRip.surname.value;
			var city=formUpdateRip.city.value;
			var tel=formUpdateRip.telephone.value;
			var email=formUpdateRip.email.value;
			
			if(!str.test(name)){
				alert("Formato Nome errato.");
				return false;
			}
			
			if(!str.test(surname)){
				alert("Formato Cognome errato.");
				return false;
			}
			
			if(!str.test(city)){
				alert("Inserire una citta' valida.");
				return false;
			}
			
			if(!num.test(tel)){
				alert("Inserire un numero di Telefono valido.");
				return false;
			}
			
			if(email!="" && !eml.test(email)){
				alert("Inserire una E-mail valida.");
				return false;
			}
		}
	</script>
</head>

<br><br>
<h1 align="center">Modifica Cliente</h1>
<br><br>

<?php
	if(!isset($_POST["btnUpd"]) && !isset($_POST["btnFormUpd"])){
		$queryList="SELECT `id`,`name`,`surname`,`birthday`,`city`,`telephone`,`email` FROM `customer`;";
		if(!($resUpd=mysql_query($queryList,$connection))){
			echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
			echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
			die("");
		}
		echo "<table border=\"1\" width=\"70%\" class=\"tab\">";
			echo "<th>ID<th>Name<th>Surname<th>Birthday<th>Citta'<th>Telefono<th>E-mail<th>Modifica";
			if(mysql_num_rows($resUpd)>0){
				while($rsUpd=mysql_fetch_row($resUpd)){
					echo "<tr>";
					echo "<form name=\"formListCust\" method=\"POST\" action=\"clock.php?page=updateCustomer\">";
					$indice=count($rsUpd);
					for($i=0; $i<$indice; $i++){					
						if($rsUpd[$i]!=NULL)
							echo "<td align=\"center\">&nbsp;".$rsUpd[$i]."&nbsp;</td>";
						else
							echo "<td align=\"center\">&nbsp;<strong>//</strong>&nbsp;</td>";
					}
					echo "<td align=\"center\"><input type=\"submit\" class=\"btnUpd\" value=\"&nbsp;Modifica&nbsp;\" name=\"btnUpd\"><input type=\"hidden\" name=\"idCust\" value=\"".$rsUpd[0]."\"></td>";
					echo "</form>";
					echo "</tr>";
				}
			}else{
				echo "<br><br>Nessun risultato trovato.";
			}
		echo "</table>";
	}else
		if(isset($_POST["btnUpd"])){
			$idCust=$_POST["idCust"];
			$resSelUpd=mysql_query("SELECT * FROM `customer` WHERE `id`=".$idCust.";",$connection);
			if(mysql_num_rows($resSelUpd)>0){
				while($rs2Upd=mysql_fetch_row($resSelUpd)){
?>

<form name="formUpdateRip" method="POST" onSubmit="return checkUpdateCust();" action="clock.php?page=updateCustomer">
	<table cellspacing="10" frame="box">
		<tr>
			<td><p class="pmenu">Nome*</p></td>
			<td><input type="text" name="name" size="16" value="<?php echo ($rs2Upd[1]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Cognome*</p></td>
			<td><input type="text" name="surname" size="16" value="<?php echo ($rs2Upd[2]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Data di Nascita*</p></td>
			<td><input type="date" name="bday" value="<?php echo ($rs2Upd[3]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Citta'*</p></td>
			<td><input type="text" name="city" size="16" value="<?php echo ($rs2Upd[4]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Telefono*</p></td>
			<td><input type="text" name="telephone" size="16" value="<?php echo ($rs2Upd[5]); ?>"></td>
		</tr>
		<tr>
			<td><p class="pmenu">E-mail</p></td>
			<td><input type="text" name="email" size="25" value="<?php echo ($rs2Upd[6]); ?>"></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" name="btnUpdCust" value="Modifica Cliente" class="btn"></td>
			<td align="center"><input type="reset" value="Reset" class="btn"></td>
		</tr>
		<tr>
			<td><input type="hidden" name="idCust" value="<?php echo $idCust; ?>"></td>
		</tr>
	</table>
</form>

<?php			}
			}
		}
		
	if(isset($_POST["btnUpdCust"])){
		$idCust=$_POST["idCust"];
		$name=$_POST["name"];
		$surname=$_POST["surname"];
		$bday=$_POST["bday"];
		$city=$_POST["city"];
		$tel=$_POST["telephone"];
		$email=$_POST["email"];		if($email=='')	$email="NULL"; 	else	$email="'".$email."'";
		
		$queryRip="UPDATE `customer` SET `name`='".$name."', `surname`='".$surname."', `birthday`='".$bday."', `city`='".$city."', `telephone`='".$tel."', `email`=".$email." WHERE `id`=".$idCust.";";
		
		if(!(mysql_query($queryRip,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non è stato possibile modificare il cliente.\")</script></head>";
			die("");
		}else{	
			echo ("<head><script language=\"javascript\">alert(\"Cliente modificato correttamente.\")</script></head>");
		}
	}
?>
