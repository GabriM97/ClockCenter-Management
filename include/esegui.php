<?php
	if(!isset($_POST["btn_exe"])){
		echo "ERRORE! Nessuna query eseguita.";
	}else{
		$query=$_POST["query"];
		if(!($result=mysql_query($query,$connection))){
			echo "<head><script language=\"javascript\">alert(\"ERRORE. Non e' stato possibile eseguire la seguente Query:\\n".$query."\")</script></head>";
			$page="clock.php?page=querySQL";
			header('Refresh: 1; url=' . $page);
			die("");
		}else{
			echo "<head><script language=\"javascript\">alert(\"Query eseguita correttamente\")</script></head>";
			if(!(mysql_num_rows($result)>0)){
				$page="clock.php?page=querySQL";
				header('Refresh: 1; url=' . $page);
			}
		}
		
		if(mysql_num_rows($result)>0){
			echo "<br><br><p class=\"pmenu\" style=\"text-align: center;\">Query: ".$query."</p><br><br>";
			echo "<table border=\"1\" class=\"tab\">";
			while($rs=mysql_fetch_row($result)){
				echo "<tr>";
				$indice=count($rs);
				for($i=0; $i<$indice; $i++){
					echo "<td align=\"center\" >".$rs[$i]."</td>";
				}
				echo "</tr>";
			}
		}
	}
					
?>