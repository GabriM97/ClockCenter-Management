<?php
	if($iduser!=1){
		echo "<head><script language=\"javascript\">alert(\"ERRORE. Il tuo account non dispone delle autorizzazioni necessarie per visualizzare questa pagina.\")</script></head>";
	}else{
?>

<head>
	<script language="javascript">
		function checkNewWork(){
			var name=/^[\w\d\u00E0\u00E8\u00EC\u00F2\u00F9\u0027\u0020]*$/i;
			var passw=/^.{6,30}$/i;
			var username=/^\w{3,15}$/i;
			
			var nm=formNewWorker.name.value;
			var user=formNewWorker.username.value;
			var psw=formNewWorker.psw.value;
			var psw2=formNewWorker.psw2.value;
			
			if(!username.test(user)){
				alert("Formato username errato. [Inserire solo lettere e/o numeri]\nCaratteri: Min 3 - Max 15");
				return false;
			}
			
			if(!name.test(nm)){
				alert("Formato Nome errato.");
				return false;
			}
			
			if(!passw.test(psw)){
				alert("Caratteri Password: Min 6 - Max 30");
				return false;
			}
			
			if(psw2!=psw){
				alert("Le due password non corrispondono.");
				return false;
			}
		}
	</script>
</head>

<?php
	if(isset($_POST["btnNewWorker"])){
		$user=$_POST["username"];
		$psw=$_POST["psw"];		
		$name=$_POST["name"];		if($name=='')	$name="NULL"; else	$name="'".$name."'";
		
		$queryWork="INSERT INTO `worker` (`username`, `password`, `name`) VALUES ('".$user."', '".$psw."', ".$name.");";
		
		if(!(mysql_query($queryWork,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile inserire il Lavoratore. Controlla che l'username non sia gia' presente nel sistema.\")</script></head>";
			die("");
		}else	echo "<head><script language=\"javascript\">alert(\"Lavoratore creato correttamente.\")</script></head>";
	}
?>

<br><br><h1 align="center">Nuovo Lavoratore</h1><br><br>
<form name="formNewWorker" method="POST" onSubmit="return checkNewWork();" action="clock.php?page=newWorker">
	<table cellspacing="10" frame="box">
		<tr>
			<td><p class="pmenu" style="text-align:center;">Username*</p></td>
			<td><input type="text" name="username" size="16"></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align:center;">Password*</p></td>
			<td><input type="password" name="psw" size="16"></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align:center;">Ripeti Password*</p></td>
			<td><input type="password" name="psw2" size="16"></td>
		</tr>
		<tr>
			<td><p class="pmenu" style="text-align:center;">Nome</p></td>
			<td><input type="text" name="name" size="16"></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" name="btnNewWorker" value="Crea Lavoratore" class="btn"></td>
			<td align="center"><input type="reset" value="Reset" class="btn"></td>
		</tr>
	</table>
</form>

<?php }	?>