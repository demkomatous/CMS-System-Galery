<?php 
	include_once "../Library/db.php";
	include_once "Loged/Library/lib.php";

	session_start();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
	<title>Přihlášení</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="Loged/CSS/style.css">
	<link rel="stylesheet" type="text/css" href="Loged/CSS/login.css">
</head>
<body>
	<div id="body">
		<div id="content">
			<div id="main">
				<div id="login">
					<h1>Přihlásit se</h1>
					<form method="POST" action="Action/LoginVerify.php">
						<label for="name">Jméno</label><br>
						<input id="name" type="text" name="name" <?php inputControl("name");?>><br>

						<label for="surname">Příjmení:</label><br>
						<input id="surname" type="text" name="surname" <?php inputControl("surname");?>><br>

						<label for="username">Uživatelské jméno:</label><br>
						<input id="username" type="text" name="username" <?php inputControl("username");?>><br>

						<label for="email">Email:</label><br>
						<input id="email" type="email" name="email" value="@"><br>

						<label for="psswd">Heslo:</label><br>
						<input id="psswd" type="password" name="psswd" placeholder="Password"><br>

						<input type="submit" name="submit" value="Přihlásit se">
					</form>
					<div class="clear"></div>
					<?php
						if (!empty($_SESSION["error"])) {
							echo $_SESSION["error"];
							unset($_SESSION["error"]);
						}
					?>
					<p><a href="../index.php" title="Zpět na uživatelskou stránku">Zpět na uživatelskou stránku</a></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>