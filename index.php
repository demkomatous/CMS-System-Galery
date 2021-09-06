<?php 
	include_once "Library/db.php";
	include_once "Library/lib.php";

	session_start();
?>

<!DOCTYPE html>
<html lang="cs">
<head>
	<title>Galery</title>
	<meta charset="utf-8">
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
</head>
<body>
	<div id="body">
		<div id="content">
			<div id="main">
				<?php 
					echo "<div class='headerOne'><h1>Nejnovější obrázky</h1></div>";
					newstImages($db);
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