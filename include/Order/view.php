<br><br>
<h1 align="center">Lista Ordini</h1>
<br><br><br>

<?php
	$query="SELECT * FROM `order`;";
		
	if(!($result=mysql_query($query,$connection))){
		echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
		echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
		die("");
	}

	echo "<table border=\"1\" width=\"70%\" class=\"tab\">";
		echo "<th>&nbsp;ID&nbsp;<th>Referenza<th>Fornitore<th>Lavoratore<th>Descrizione<th>Quantita'<th>Stato<th>Data Emissione<th>Data Ricezione<th>&nbsp;&nbsp;Totale&nbsp;&nbsp;";
		if(mysql_num_rows($result)>0){
			while($rs=mysql_fetch_row($result)){
				echo "<tr>";
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
				echo "</tr>";
			}
		}else{
			echo "<br><br>Nessun risultato trovato.";
		}
	echo "</table>";
?>