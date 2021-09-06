<?php
	include_once "Library/strankovani.php";
	include_once "Library/lib.php";
	include_once "../../Library/db.php";

	session_start();
	verifyAccess($db);

	//Sorteru default
	if (!isset($_SESSION["sortBy"])) {
		$_SESSION["sortBy"] = "ID";
	} 

	if (!isset($_SESSION["sortAs"])) {
		$_SESSION["sortAs"] = "ASC";
	}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
	<title>Správa obrázků</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="CSS/Card.css">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<style>
		<?php 
			style();
		?>
	</style>
</head>
<body>
	<div id="body">
		<div id="content">
			<div id="main">
				<h1>Správa obrázků</h1>
				<div id="menu">
					<form method="POST" action="Action/logout.php">
						<input type="submit" name="submit" value="Odhlásit">
					</form>
					<?php
						adminMenu($db);
					?>
				</div>
				<h2>Řazení záznamů</h2>
				<?php  
					$count = dataCount($db, "galery_photos");
					echo "<p>Celkový počet záznamů: ".$count."</p>";
				?>
				<div id="sorter">
					<form method="POST" action="Action/sorter.php">
						<div>
							<label for="radit">Řadit podle:</label>
							<select name="radit" id="radit">
								<option value="ID">ID</option>
								<option value="header">Nadpis</option>
								<option value="description">Popis</option>
								<option value="autor">Autor</option>
								<option value="Time">Datum přidání</option>
								<option value="UpdateTime">Datum aktualizace</option>
								<option value="UpdatedTimes">Počet upravení</option>
								<option value="uploader">ID vkladatele</option>
							</select>
						</div>
						<div>
							<label for="jak">Jak:</label>
							<select name="jak" id="jak">
								<option value="ASC">Vzestupně</option>
								<option value="DESC">Sestupně</option>
							</select>
						</div>
						<div>
							<input type="hidden" name="url" value="images">
							<input type="submit" name="Hledat" value="Hledat">
						</div>
					</form>

					<form method="POST" action="Action/sorter.php">
						<input type="hidden" name="url" value="images">
						<input type="submit" name="Reset" value="Reset">
					</form>
				</div>

				<div id="upload">
					<h2>Přidávání záznamů</h2>
					<form method="POST" action="Action/imagesUpload.php" enctype="multipart/form-data"  class="resetDisplay">
						<label for="imageName">Název obrázku</label><br>
						<input id="imageName" type="text" name="imageName"><br>

						<label for="description">Popis</label><br>
						<textarea id="description" name="description"></textarea><br>

						<label for="author">Autor</label><br>
						<input id="author" type="text" name="author"><br>

						<label for="Image">Obrázek</label><br>
						<input id="Image" type="file" name="Image"><br>

						<input type="submit" name="submit" value="Nahrát">
					</form>
					<div class="clear"></div>
				</div>
				<div id="errors">
					<?php
						if (!empty($_SESSION["error"])) {
						 	echo $_SESSION["error"];
						 	unset($_SESSION["error"]);
						}

						if (isset($_SESSION["info"])) {
							echo $_SESSION["info"];
						}
						unset($_SESSION["info"]);
					?>
				</div>
				<?php
					// usrs == galery_users 
					// phts == galery_photos
					// sprusrs == galery_superusers
					strankovani($db, "galery_photos", "phts", $_SESSION["sortBy"], $_SESSION["sortAs"]);
				?>
			</div>
		</div>
	</div>
</body>
</html>