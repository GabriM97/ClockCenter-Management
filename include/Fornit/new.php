<head>
	<script language="javascript">
		function checkNewForn(){
			var str=/^[A-Z\u00E0\u00E8\u00EC\u00F2\u00F9\u0027\u0020]+$/i;
			var eml=/^.+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/i;
			var num=/^\d{8,13}$/;
			var piva=/^\d{11}$/;
			var codf=/^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/i;
			
			var cf=formNewFornit.cf.value;
			var pi=formNewFornit.piva.value;
			var name=formNewFornit.name.value;
			var email=formNewFornit.email.value;
			var tel=formNewFornit.telephone.value;
			var tipo=formNewFornit.type.value;
			
			if(!codf.test(cf)){
				alert("Inserire un Codice Fiscale valido.");
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

<?php
	if(isset($_POST["btnNewFornit"])){
		$cf=$_POST["cf"];
		$piva=$_POST["piva"];		
		$name=$_POST["name"];
		$email=$_POST["email"];
		$tel=$_POST["telephone"];
		$type=$_POST["type"];
	
		$queryFornit="INSERT INTO `fornitore` (`cod_f`, `p_iva`, `name`, `email`, `telephone`,`type`) VALUES ('".$cf."', '".$piva."', '".$name."', '".$email."', '".$tel."', '".$type."');";
		
		if(!(mysql_query($queryFornit,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile inserire il fornitore. Controlla che non sia gia' presente nel sistema.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Fornitore creato correttamente.\")</script></head>";
	}
?>

<br><br><h1 align="center">Nuovo Fornitore</h1><br><br>
<form name="formNewFornit" method="POST" onSubmit="return checkNewForn();" action="clock.php?page=newFornit">
	<table cellspacing="10" frame="box">
		<tr>
			<td><p class="pmenu">Cod. Fiscale*</p></td>
			<td><input type="text" name="cf" size="25"></td>
		</tr>
		<tr>
			<td><p class="pmenu">P.IVA*</p></td>
			<td><input type="text" name="piva" size="25"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Nome e Cognome*</p></td>
			<td><input type="text" name="name" size="25"></td>
		</tr>
		<tr>
			<td><p class="pmenu">E-mail*</p></td>
			<td><input type="text" name="email" size="25"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Telefono*</p></td>
			<td><input type="text" name="telephone" size="25"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Tipo merce*</p></td>
			<td><input type="text" name="type" size="25"></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" name="btnNewFornit" value="Crea Fornitore" class="btn"></td>
			<td align="center"><input type="reset" value="Reset" class="btn"></td>
		</tr>
	</table>
</form>