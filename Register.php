<?php 
	include_once "Library/db.php";
	include_once "Library/lib.php";

	session_start();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
	<title>Registrace</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<link rel="stylesheet" type="text/css" href="CSS/login.css">
</head>
<body>
	<div id="body">
		<div id="content">
			<div id="main">
				<div id="login">
					<h1>Registrovat se</h1>
					<form method="POST" action="Action/Register.php">
							<label for="name">Jméno</label><br>
							<input id="name" type="text" name="name" value='<?php refill("name") ?>'><br>

							<label for="surname">Příjmení:</label><br>
							<input id="surname" type="text" name="surname"  value='<?php refill("surname") ?>'><br>

							<label for="nickname">Přezdívka:</label><br>
							<input id="nickname" type="text" name="nickname" value='<?php refill("nickname") ?>'><br>

							<label for="email">Email:</label><br>
							<input id="email" type="email" name="email" value='<?php refill("email") ?>'><br>

							<label for="password">Heslo:</label><br>
							<input id="password" type="password" name="password"><br>

							<label for="password">Zopakujte heslo:</label><br>
							<input id="chckPassword" type="password" name="Chckpassword"><br>

						<input type="submit" name="submit" value="Registrovat se">
					</form>
					<div class="clear"></div>
					<p>
						<a href="Login.php" title="Přihlášení">
							Již máte učet?<br> 
							Přihlaste se.
						</a></p>
					<?php
						if (!empty($_SESSION["error"])) {
							echo $_SESSION["error"];
							unset($_SESSION["error"]);
						}

						if (!empty($_SESSION["info"])) {
							echo $_SESSION["info"];
							unset($_SESSION["info"]);
						}
					?>
				</div>
			</div>
			<div id="sideBar">
				<div class="sticky">
					<div id="logo"></div>
					<div id="menu">
						<?php
							menuGen($db);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>