<?php 
	include_once "Library/db.php";
	include_once "Library/lib.php";
	include_once "Library/favStrankovani.php";

	session_start();
	verifyAccess($db, "Pro zobrazení oblíbených obrázků se prosím přihlaste.");

	if (!empty($_SESSION["token"])) {
		$userID = $_SESSION["token"];
	}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
	<title>Oblíbené obrázky</title>
	<meta charset="utf-8">
	<style>
		<?php 
			style();
		?>
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>
		<?php
			if (!empty($_SESSION["alert"])) {
			 	echo $_SESSION["alert"];
			 	unset($_SESSION["alert"]);
			} 
		?>
	</script>
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<link rel="stylesheet" type="text/css" href="CSS/strankovani.css">
</head>
<body>
	<div id="body">
		<div id="content">
			<div id="main">
				<?php 
					echo "<div class='headerOne'><h1>Oblíbené obrázky:</h1></div>";
					favStrankovani($db, $userID);
				?>
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