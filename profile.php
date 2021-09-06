<?php 
	include_once "Library/db.php";
	include_once "Library/lib.php";

	session_start();
	verifyAccess($db, "Pro zobrazení Vašeho profilu se prosím přihlaste.");

	if (!empty($_SESSION["token"])) {
		$userID = $_SESSION["token"];
	}
	
	$userInfo = selectByID($db, $userID, "galery_users");
	for ($i=0; $i < 1; $i++) { 
		$user = $userInfo[0];
	}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
	<title>Můj profil</title>
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
	<link rel="stylesheet" type="text/css" href="CSS/profile.css">
</head>
<body>
	<div id="body">
		<div id="content">
			<div id="main">
				<div id="forms">
					<h1>Můj profil</h1>
					<form method="POST" action="Action/profileSet.php">
						<p>Jméno: <?php echo $user["name"]; ?></p>
						<p>Příjmení: <?php echo $user["surname"]; ?></p>
						<div>
							<label for="nickname">Přezdívka:</label>
							<input id="nickname" type="text" name="nickname" value="<?php echo $user['nickname']; ?>">
						</div>
						<div class="clear"></div>
						<div>
							<label for="email">Email:</label>
							<input id="email" type="email" name="email" value="<?php echo $user['email']; ?>">
						</div>
						<div class="clear"></div>
						<input type="submit" name="submit" value="Upravit">
						<div class="clear"></div>
						<input type="hidden" name="val" value="prsnl">
					</form>
					<div id="form">
						<form method="POST" action="Action/profileSet.php">
							<div>
								<label>Nové heslo:</label>
								<input type="password" name="newPassword">
							</div>
							<div class="clear"></div>
							<div>
								<label>Zopakujte nové heslo:</label>
								<input type="password" name="chckNewPassword">
							</div>
							<div class="clear"></div>
							<input type="submit" name="submit" value="Změnit">
							<div class="clear"></div>
							<input type="hidden" name="val" value="psswd">
						</form>
					</div>
					<p><a href="Action/profileSet.php?del=1">Smazat účet i se všemy záznamy</a></p>
					<div id="errors">
						<?php  
							if (isset($_SESSION["info"])) {
								echo $_SESSION["info"];
								unset($_SESSION["info"]);
							}
						?>
					</div>
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