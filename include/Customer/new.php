<head>
	<script language="javascript">
		function checkNewCust(){
			var str=/^[a-zA-Z\u00E0\u00E8\u00EC\u00F2\u00F9\u0027\u0020]+$/i;
			var eml=/^.+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/i;
			var num=/^[0-9]{8,13}$/;
			
			var name=formNewCustomer.name.value;
			var surname=formNewCustomer.surname.value;
			var city=formNewCustomer.city.value;
			var tel=formNewCustomer.telephone.value;
			var email=formNewCustomer.email.value;
			
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

<?php
	if(isset($_POST["btnNewCust"])){
		$name=$_POST["name"];
		$surname=$_POST["surname"];		
		$bday=$_POST["bday"];
		$city=$_POST["city"];
		$tel=$_POST["telephone"];
		$email=$_POST["email"];		if($email=='')	$email="NULL"; else	$email="'".$email."'";
		
		$queryCust="INSERT INTO `customer` (`name`, `surname`, `birthday`, `city`, `telephone`,`email`) VALUES ('".$name."', '".$surname."', '".$bday."', '".$city."', '".$tel."', ".$email.");";
		
		if(!(mysql_query($queryCust,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile inserire il cliente. Controlla che non sia gia' presente nel sistema.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Cliente creato correttamente.\")</script></head>";
	}
?>

<br><br><h1 align="center">Nuovo Cliente</h1><br><br>
<form name="formNewCustomer" method="POST" onSubmit="return checkNewCust();" action="clock.php?page=newCustomer">
	<table cellspacing="10" frame="box">
		<tr>
			<td><p class="pmenu">Nome*</p></td>
			<td><input type="text" name="name" size="16"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Cognome*</p></td>
			<td><input type="text" name="surname" size="16"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Data di Nascita*</p></td>
			<td><input type="date" name="bday"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Citta'*</p></td>
			<td><input type="text" name="city" size="16"></td>
		</tr>
		<tr>
			<td><p class="pmenu">Telefono*</p></td>
			<td><input type="text" name="telephone" size="16"></td>
		</tr>
		<tr>
			<td><p class="pmenu">E-mail</p></td>
			<td><input type="text" name="email" size="25"></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" name="btnNewCust" value="Crea Cliente" class="btn"></td>
			<td align="center"><input type="reset" value="Reset" class="btn"></td>
		</tr>
	</table>
</form>