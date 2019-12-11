<head>
	<script language="javascript">
		function checkNewRic(){
			var refer=/^.{4,20}$/i;
			var str=/^[A-Z\u00E0\u00E8\u00EC\u00F2\u00F9\u0027\u0020]+$/i;
			var price=/^([\d]+|\d+\.\d{2})$/;
			
			var ref=formNewRic.ref.value;
			var name=formNewRic.name.value;
			var qnt=formNewRic.qnt.value;
			var type=formNewRic.type.value;
			var selPrice=formNewRic.selPrice.value;
			var purchPrice=formNewRic.purchPrice.value;
			
			if(!refer.test(ref)){
				alert("Inserire una Referenza valida. (Caratteri: Min 4 - Max 20)");
				return false;
			}
			
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

<?php
	if(isset($_POST["btnNewRic"])){
		$ref=$_POST["ref"];		
		$name=$_POST["name"];
		$descr=$_POST["descr"];		if($descr=='')		$descr="NULL"; else	$descr="'".$descr."'";
		$qnt=$_POST["qnt"];
		$type=$_POST["type"];
		$selPrice=$_POST["selPrice"];
		$purchPrice=$_POST["purchPrice"];
	
		$queryRic="INSERT INTO `magazzino` (`reference`, `name`, `description`, `quantity`, `type`, `selling_price`, `purchase_price`) VALUES ('".$ref."', '".$name."', ".$descr.", '".$qnt."', '".$type."', '".$selPrice."', '".$purchPrice."');";
		
		if(!(mysql_query($queryRic,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile inserire il Ricambio. Controlla che non sia gia' presente nel sistema.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Ricambio creato correttamente.\")</script></head>";
	}
?>

<br><br><h1 align="center">Nuovo Ricambio</h1><br><br>
<form name="formNewRic" method="POST" onSubmit="return checkNewRic();" action="clock.php?page=newStock">
	<table cellspacing="20" frame="box">
		<tr>
			<td><p class="pmenu">Referenza*</p></td>
			<td><input type="text" name="ref" size="25"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Nome Oggetto*</p></td>
			<td><input type="text" name="name" size="25"></td>
		</tr>
		<tr>
			<td colspan="2"><p class="pmenu" style="text-align: center;">Descrizione</p>
			<textarea rows="7" cols="50" name="descr" maxlength="500"></textarea></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align: right;">Quantita'*</p></td>
			<td><input type="number" name="qnt" min="0" max="10000" step="1" value="0"></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align: right;">Tipo merce*</p></td>
			<td><input type="text" name="type" size="25"></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align: center;">Prezzo Vendita*<br>&euro;&nbsp;<input type="text" name="selPrice" size="5"></p></td>
			<td><p class="pmenu" style="text-align: center;">Prezzo Acquisto*<br>&euro;&nbsp;<input type="text" name="purchPrice" size="5"></p></td>
		</tr>
		
		<tr>
			<td align="right"><input type="submit" name="btnNewRic" value="Crea Fornitore" class="btn"></td>
			<td align="center"><input type="reset" value="Reset" class="btn"></td>
		</tr>
	</table>
</form>