<?php 
	include_once "Library/db.php";
	include_once "Library/lib.php";

	session_start();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
	<title>Přihlášení</title>
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
					<h1>Přihlásit se</h1>
					<form method="POST" action="Action/LoginVerif.php">
						<label for="nickname">Přezdívka</label><br>
						<input id="nickname" type="text" name="nickname"><br>

						<label for="email">Email:</label><br>
						<input id="email" type="email" name="email" value="@"><br>

						<label for="password">Heslo:</label><br>
						<input id="password" type="password" name="password"><br>

						<input type="submit" name="submit" value="Přihlásit se">
					</form>
					<div class="clear"></div>
					<p>
						<a href="Register.php" title="Registrace">
							Ještě nemáte učet?<br> 
							Zaregistrujte se.
						</a></p>
					<?php
						if (!empty($_SESSION["error"])) {
							echo $_SESSION["error"];
							unset($_SESSION["error"]);
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