<br><br>
<h1 align="center">Lista Riparazioni</h1>
<br><br><br>
<?php
	$query="SELECT * FROM `riparazione`;";
		
	if(!($result=mysql_query($query,$connection))){
		echo "<br><br><br><p align=\"center\">ERRORE. Impossibile visualizzare la lista.</p><br>";
		echo "<p align=\"center\"><img src=\"images/errore.png\" height=\"80\" width=\"80\"></p>";
		die("");
	}

	echo "<table border=\"1\" width=\"99%\">";
		echo "<th>&nbsp;ID&nbsp;<th>Worker<th>Customer<th>Ricambio<th>DescrizioneLavoro<th>Note<th>Ref. Orologio<th>DescrizioneOrologio<th>Garanzia<th>Data Garanzia<th>Prev.<th>Stato<th>Data Entrata<th>Data Uscita<th>Sconto<th>Totale<th>Tot Finale";
		if(mysql_num_rows($result)>0){
			while($rs=mysql_fetch_row($result)){
				echo "<tr>";
				$indice=count($rs);
				for($i=0; $i<$indice; $i++){
					switch($i){
						case 1:		//worker
							$query="SELECT `name` FROM `worker` WHERE `id`=".$rs[$i].";";
							$res=mysql_query($query,$connection);
							while($a=mysql_fetch_row($res))	$rs[$i]=$a[0];
							break;
						case 2:		//nome,cognome cliente
							$query="SELECT `name`,`surname` FROM `customer` WHERE `id`=".$rs[$i].";";
							$res=mysql_query($query,$connection);
							while($a=mysql_fetch_row($res))	$rs[$i]=$a[0]."<br>".$a[1];
							break;
						case 8:		//garanzia
							if($rs[$i])	$rs[$i]="SI";
							else		$rs[$i]="NO";
							break;
						case 10:	//preventivo
							switch ($rs[$i]){
								case 1:		$rs[$i]="Da eseguire";	break;
								case 2:		$rs[$i]="Eseguito";		break;
								case 3:		$rs[$i]="Comunicato";	break;
								case 4:		$rs[$i]="Accettato";	break;
								case 5:		$rs[$i]="Rifiutato";	break;
								case 6:		$rs[$i]="Nessun Prev.";	break;
								default:	$rs[$i]="ERROR";
							}
							break;
						case 11:	//stato rip.
							switch ($rs[$i]){
								case 1:		$rs[$i]="Ricevuta";						break;
								case 2:		$rs[$i]="In lavorazione";				break;
								case 3:		$rs[$i]="Attesa Prev.";					break;
								case 4:		$rs[$i]="Attesa Ricambi";				break;
								case 5:		$rs[$i]="Rip. Completata";				break;
								case 6:		$rs[$i]="Comunic. Ritiro";				break;
								case 7:		$rs[$i]="Consegnato";					break;
								case 8:		$rs[$i]="Entrato (Pagato)";				break;
								case 9:		$rs[$i]="Non Entrato (NON Pagato)";		break;
								default:	$rs[$i]="ERROR";
							}
							break;
						case 14:	//sconto
							if($rs[$i]!=NULL)	$rs[$i]=$rs[$i]."%";
							break;
						case 15:	//tot
							if($rs[$i]!=NULL)	$rs[$i]="&euro; ".$rs[$i];
							break;
						case 16:	//tot finale
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