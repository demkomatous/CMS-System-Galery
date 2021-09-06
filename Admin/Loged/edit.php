<?php
	include_once "Library/lib.php";
	include_once "../../Library/db.php";

	session_start();
	verifyAccess($db);

	$tbl = $_GET["tbl"];

	if (is_numeric($_GET["edit"])) {
		$ID = $_GET["edit"];
	} else{
		if ($tbl == "phts") {
			$url = "images";
		} elseif ($tbl == "usrs") {
			$url = "index";
		}
		elseif ($tbl == "sprusrs") {
			$url = "admins";
		}
		header("location: $url.php");
		exit();
	}

	if ($tbl == "phts") {
		$dtbs = "galery_photos";
	} elseif ($tbl == "usr") {
		$dtbs = "galery_users";
	} elseif ($tbl == "sprusrs") {
		$dtbs = "galery_superusers";
	} else{
		header("location: index.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head lang="cs">
	<title>Edit záznamu</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<link rel="stylesheet" type="text/css" href="CSS/Card.css">
	<link rel="stylesheet" type="text/css" href="CSS/edit.css">
</head>
<body>
	<div id="body">
		<div id="content">
			<div id="main">
				<h1>Editování záznamu</h1>
				<?php
					if ($tbl == "phts") {
						$img = selectByID($db, $ID, $dtbs);
						if (!empty($img)) {
							imgEdit($img);
						} else{
							echo "
								<p>
									Záznam pro editaci nenalezen. <br>
									Vraťte se prosím <a href='images.php' title='Zpět'>Zpět</a>
								</p>
							";
						}
					} else{
						echo "
							<p>
								Záznam pro editaci nenalezen. <br>
								Vraťte se prosím <a href='index.php' title='Domů'>Domů</a>
							</p>
						";
					}
					echo "<div id='errors'>";

					if (!empty($_SESSION["info"])) {
						echo $_SESSION["info"];
						unset($_SESSION["info"]);
					}
					echo "</div>";
				?>
			</div>
		</div>
	</div>
</body>
</html>