 <?php 
	include_once "Library/db.php";
	include_once "Library/lib.php";

	session_start();
	verifyAccess($db, "Pro nahrání obrázku se prosím přihlaste.");
?>

<!DOCTYPE html>
<html lang="cs">
<head>
	<title>Image Hub</title>
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
					<h1>Nahrát obrázek</h1>
					<form method="POST" action="Action/upload.php" enctype="multipart/form-data">
						<label for="Image">Obrázek</label><br>
						<input id="Image" type="file" name="Image"><br>
						
						<label for="imageName">Název obrázku</label><br>
						<input id="imageName" type="text" name="imageName" value='<?php refill("imageName") ?>' maxlength="50"><br>

						<label for="description">Popis</label><br>
						<textarea id="description" name="description" maxlength="500"><?php refill("description") ?></textarea><br>

						<label for="author">Autor</label><br>
						<input id="author" type="text" name="author" value='<?php refill("author") ?>' maxlength="50"><br>


						<input type="submit" name="submit" value="Nahrát">
					</form>
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
					<div id="genres"></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>