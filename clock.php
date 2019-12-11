<?php 
	session_start(); 
	//collegamento database
	error_reporting(E_ALL ^ E_DEPRECATED);
	if(!($connection=mysql_connect("localhost","root","")))
		die ("ERRORE. Non riesco a contattare il server DBMS");
				
	if(!mysql_select_db("clockcenter",$connection))
		die("ERRORE. Non riesco a selezionare il DB");
	//fine collegamento database
	
	
	if(!isset($_SESSION["id_utente"])){
		$page="index.php";
		header('Refresh: 3; url=' . $page);
		echo "<br><br>Errore. Effettuare prima il login!<br>Attendi...";
		echo "<br><br>Clicca <a href=\"index.php\">qui</a> se non vieni reindirizzato automaticamente.";
	}else{
		//acquisizione username
		$iduser=$_SESSION["id_utente"];
		$query="SELECT `name`,`username` FROM worker ".
				"WHERE \"$iduser\"=`id`;";
				
		if(!($result=mysql_query($query,$connection)))
			die("ERRORE. Query non eseguita");
		
		if(mysql_num_rows($result)>0){
			$rs=mysql_fetch_row($result);
			if($rs[0]=="")	$user=$rs[1];	else	$user=$rs[0];
		}else{
			echo "ERRORE!";
		}
		//fine acquisizione username
		
?>
<html>
	<head>
		<title>Clock Center - Main Page</title>
		<link rel="icon" href="images\icon.png" type="image/png">
		<link rel="Stylesheet" href="style.css" type="text/css">
		<link rel="Stylesheet" href="menu.css" type="text/css">
	</head>
	
	<body class="bodycss" background="images\background.png">
		<a href="index.php"><img src="images\logo.png" align="left" height="7%" width="8%"></a>
		<div class="container">
			<!-------- INTESTAZIONE ------->
			<div class="clocktop">	
				<br>
				<p align="center"><img src="images/welcome.png"; width="80%"; height="50%"></p>
				<br><br><br>
				<?php 
					echo "<p class=\"plogout\" align=\"right\">Benvenuto <strong>".$user."</strong><br><a href=\"logout.php\">Logout</a></p>";	
				?>
			</div>
			
			<!-----------   MENU'  ------------>
			<div <?php if($iduser!=1){ ?> class="divmenu" <?php }else{ ?> class="divmenuAdmin" <?php } ?> >
				
				<?php include 'include/menu.php'; ?>
			</div>
			<div style="clear: both;"></div>
				
			<!-------- CONTENUTO ---------->
			<div class="clockbottom">				
				<?php include 'include/IFmenu.php';	?>
			</div>
		</div>
	</body>
</html>
<?php } //chiusura else iniziale ?>