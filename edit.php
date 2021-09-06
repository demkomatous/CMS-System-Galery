<?php
	include_once "Library/db.php";
	include_once "Library/lib.php";
	include_once "Library/myStrankovani.php";

	session_start();
	verifyAccess($db, "Pro zobrazení vašich příspěvků se prosím přihlaste.");

	$ID = $_SESSION["token"];
?>

<!DOCTYPE html>
<html>
<head lang="cs">
	<title>Moje příspěvky</title><meta charset="utf-8">
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
	<link rel="stylesheet" type="text/css" href="CSS/Card.css">
	<link rel="stylesheet" type="text/css" href="CSS/edit.css">
	<link rel="stylesheet" type="text/css" href="CSS/strankovani.css">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>
	<div id="body">
		<div id="content">
			<div id="main">
				<div class='headerOne'><h1>Moje příspěvky</h1></div>
				<?php
					$img = strankovani($db, $ID);
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