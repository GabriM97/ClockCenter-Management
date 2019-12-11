<?php
	if($iduser!=1){
		echo "<head><script language=\"javascript\">alert(\"ERRORE. Il tuo account non dispone delle autorizzazioni necessarie per visualizzare questa pagina.\")</script></head>";
	}else{
?>

<br><br>
<h1 align="center">Lista Lavoratori</h1>
<br><br><br>

<?php
		$query="SELECT `id`,`username`,`name` FROM `worker`;";
			
		if(!($result=mysql_query($query,$connection))){
			echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
			echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
			die("");
		}

		echo "<table border=\"1\" width=\"40%\" class=\"tab\">";
			echo "<th>ID<th>Username<th>Name";
			if(mysql_num_rows($result)>0){
				while($rs=mysql_fetch_row($result)){
					echo "<tr>";
					$indice=count($rs);
					for($i=0; $i<$indice; $i++){
						if($rs[$i]!=NULL)
							echo "<td align=\"center\">&nbsp;".$rs[$i]."&nbsp;</td>";
						else
							echo "<td align=\"center\">&nbsp;<strong>//</strong> &nbsp;</td>";
					}
					echo "</tr>";
				}
			}else{
				echo "<br><br>Nessun risultato trovato.";
			}
		echo "</table>";
	}
?>