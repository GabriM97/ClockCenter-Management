<?php
	$query="SELECT COUNT(*) FROM `riparazione` WHERE `repair_status`='8' AND MONTH(`date_repair_out`)=".date("n")." AND YEAR(`date_repair_out`)=".date("Y").";";
	$result=mysql_query($query,$connection);
	$rs=mysql_fetch_row($result);

	$queryTot="SELECT SUM(`final_amount`) FROM `riparazione` WHERE `repair_status`='8' AND MONTH(`date_repair_out`)=".date("n")." AND YEAR(`date_repair_out`)=".date("Y").";";
	$resultTot=mysql_query($queryTot,$connection);
	$rsTot=mysql_fetch_row($resultTot);		if($rsTot[0]=="")	$rsTot[0]=0;
?>



<br><br>
<h1 align="center">Prospetto Mensile Riparazioni Entrate (mese attuale)</h1>
<br><br><br>

<table frame="box" width="40%" class="tab" cellspacing="15">
	<tr>
		<td><p class="pmenu">Riparazioni Entrate: <?php echo $rs[0]; ?></p></td>
		<td align="center"><p class="pmenu">Totale incassato: &euro; <?php echo $rsTot[0]; ?></p></td>
	</tr>
</table>
