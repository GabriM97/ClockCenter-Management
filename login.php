<?php session_start(); ?>
<html>
	<head>
		<title>Clock Center - Login</title>
		<link rel="icon" href="images\icon.png" type="image/png">
	</head>
	
	<body>
		<?php
			$user=$_POST["username"];
			$passw=$_POST["password"];
			$query="SELECT `id` FROM worker ".
					"WHERE \"$user\"=`username` and \"$passw\"=`password`;";
			
			error_reporting(E_ALL ^ E_DEPRECATED);
			if(!($connection=mysql_connect("localhost","root","")))
				die ("ERRORE. Non riesco a contattare il server DBMS");
				
			if(!mysql_select_db("clockcenter",$connection))
				die("ERRORE. Non riesco a selezionare il DB");
				
			if(!($result=mysql_query($query,$connection)))
				die("ERRORE. Query non eseguita");
		
			if(mysql_num_rows($result)>0){
				$rs=mysql_fetch_row($result);
				$_SESSION["id_utente"]=$rs[0];
				$page="clock.php";
				header('Refresh: 1; url=' . $page);
				echo "<br><br>Login effettuato correttamente. Verrai reindirizzato alla pagina principale.";
				echo "<br><br>Caricamento in corso...";
				echo "<br><br>Clicca <a href=\"clock.php\">qui</a> se non vieni reindirizzato automaticamente.";
			}else{
				echo "<br><br>Attenzione, dati errati! ";
				echo "Clicca <a href=\"index.php\">qui</a> per tornare indietro.";
			}
		?>
	</body>
</html>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	
	
	
	</body>
</html>