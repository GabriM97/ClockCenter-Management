<?php
	if($iduser!=1){
		echo "<head><script language=\"javascript\">alert(\"ERRORE. Il tuo account non dispone delle autorizzazioni necessarie per visualizzare questa pagina.\")</script></head>";
	}else{
?>

<head>
	<script language="javascript">
		function checkUpdWork(){
			var name=/^[\w\d\u00E0\u00E8\u00EC\u00F2\u00F9\u0027\u0020]*$/i;
			var passw=/^.{6,30}$/i;
			
			var nm=formUpdateWork.name.value;
			var psw=formUpdateWork.psw.value;
			var psw2=formUpdateWork.psw2.value;
						
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
<br><br>
<h1 align="center">Modifica Lavoratore</h1>
<br><br>

<?php
	if(!isset($_POST["btnUpd"]) && !isset($_POST["btnFormUpd"])){
		$query="SELECT `id`,`username`,`name` FROM `worker`;";
			
		if(!($result=mysql_query($query,$connection))){
			echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
			echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
			die("");
		}
		echo "<table border=\"1\" width=\"40%\" class=\"tab\">";
			echo "<th>ID<th>Username<th>Name<th>Modifica";
			if(mysql_num_rows($result)>0){
				while($rsUpd=mysql_fetch_row($result)){
					echo "<tr>";
					echo "<form name=\"formListWorker\" method=\"POST\" action=\"clock.php?page=updateWorker\">";
					$indice=count($rsUpd);
					for($i=0; $i<$indice; $i++){					
						if($rsUpd[$i]!=NULL)
							echo "<td align=\"center\">&nbsp;".$rsUpd[$i]."&nbsp;</td>";
						else
							echo "<td align=\"center\">&nbsp;<strong>//</strong>&nbsp;</td>";
					}
					echo "<td align=\"center\"><input type=\"submit\" class=\"btnUpd\" value=\"&nbsp;Modifica&nbsp;\" name=\"btnUpd\"><input type=\"hidden\" name=\"idWork\" value=\"".$rsUpd[0]."\"></td>";
					echo "</form>";
					echo "</tr>";
				}
			}else{
				echo "<br><br>Nessun risultato trovato.";
			}
		echo "</table>";
	}else
		if(isset($_POST["btnUpd"])){
			$idWork=$_POST["idWork"];
			$resSelUpd=mysql_query("SELECT `id`,`username`,`name` FROM `worker` WHERE `id`=".$idWork.";",$connection);
			if(mysql_num_rows($resSelUpd)>0){
				while($rs2Upd=mysql_fetch_row($resSelUpd)){
?>

<form name="formUpdateWork" method="POST" onSubmit="return checkUpdWork();" action="clock.php?page=updateWorker">
	<table cellspacing="10" frame="box">
		<tr>
			<td><p class="pmenu" style="text-align:center;">Username*</p></td>
			<td><input type="text" name="username" size="16" value="<?php echo ($rs2Upd[1]); ?>" style="color: grey;" readonly></td>
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
			<td><input type="text" name="name" size="16" value="<?php echo ($rs2Upd[2]); ?>"></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" name="btnUpdWorker" value="Modifica Lavoratore" class="btn"></td>
			<td align="center"><input type="reset" value="Reset" class="btn"></td>
		</tr>
		<tr>
			<td><input type="hidden" name="idWork" value="<?php echo $idWork; ?>"></td>
		</tr>
	</table>
</form>

<?php			}
			}
		}
		
		if(isset($_POST["btnUpdWorker"])){
			$idWork=$_POST["idWork"];
			$psw=$_POST["psw"];		
			$name=$_POST["name"];		if($name=='')	$name="NULL"; else	$name="'".$name."'";
			
			$queryRip="UPDATE `worker` SET `password`='".$psw."', `name`=".$name." WHERE `id`=".$idWork.";";
			
			if(!(mysql_query($queryRip,$connection))){
				echo "<head><script language=\"javascript\">alert(\"ERRORE. Non è stato possibile modificare il cliente.\")</script></head>";
				die("");
			}else{	
				echo ("<head><script language=\"javascript\">alert(\"Cliente modificato correttamente.\")</script></head>");
			}
		}
	}
?>
