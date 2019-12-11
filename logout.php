<?php session_start(); ?>
<html>
	<head>
		<title>Clock Center - Logout</title>
		<link rel="icon" href="images\icon.png" type="image/png">
		<link rel="Stylesheet" href="style.css" type="text/css">
	</head>
	
	<body class="bodycss" background="images\background.png">
		<table align="center">
			<th><a href="index.php"><img src="images\logo.png" align="center"></a></th>
			<tr>
				<td>
					<br><br><br><br>
					<?php
		
						$page="index.php";
						if(isset($_SESSION["id_utente"])){
							header('Refresh: 0; url=' . $page);
							session_destroy();
							echo "<head><script language=\"javascript\">alert(\"Logout effettuato correttamente.\")</script></head>";
						}else{
							header('Refresh: 0; url=' . $page);
							echo "<head><script language=\"javascript\">alert(\"Errore!\")</script></head>";
							
						}
					?>
				</td>
			</tr>
		</table>
	</body>
</html>