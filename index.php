<?php session_start(); session_destroy(); ?>
<html>
	<head>
		<title>Clock Center - Laboratorio Orologeria</title>
		<link rel="icon" href="images\icon.png" type="image/png">
		<link rel="Stylesheet" href="style.css" type="text/css">
		<script language="javascript">
			function checkInfo(){
				var usr=/^[\w\u00E0\u00E8\u00EC\u00F2\u00F9]{2,15}$/i;  // \à\è\ì\ò\ù\
				var psw=/^.{6,20}$/;
				
				var user=login.username.value;
				var passw=login.password.value;
				
				if(!usr.test(user)){
					alert("Formato username errato.");
					return false;
				}
				
				if(!psw.test(passw)){
					alert("La password deve essere lunga almeno 6 caratteri.");
					return false;
				}
			}
		</script>
	</head>
	
	<body background="images/background.png" class="bodycss">
		<table align="center" border="0">
			<th><a href="index.php"><img src="images\logo.png" align="center"></a></th>
			<tr>
				<td>
					<br><br><br><br>
					<div class="divhome">
						<div align="center"><img src="images\login.png"></div>
						<br>
						<br>
						<form name="login" method="POST" onSubmit="return checkInfo();" action="login.php" align="center">
							<table align="center" cellspacing="10">
								<tr>
									<td><p class="plogin">Username</p></td>
									<td><input type="text" name="username"></td>
								</tr>
								<tr>
									<td><p class="plogin">Password</p></td>
									<td><input type="password" name="password"></td>
								</tr>
								</table>
								<div style="float: center; margin-top:10px;">
									<input type="submit" value="Accedi">
									<input type="reset" value="Reset">
								</div>
							<br><br>
						</form>
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>