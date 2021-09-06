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
	<title>Správa adminů</title>
	<meta charset="utf-8">
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
				<h1>Správa adminů</h1>
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
					$count = dataCount($db, "galery_superusers");
					echo "<p>Celkový počet záznamů: ".$count."</p>";
				?>
				<div id="sorter">
					<form method="POST" action="Action/sorter.php">
						<div>
							<label for="radit">Řadit podle:</label>
							<select name="radit" id="radit">
								<option value="ID">ID</option>
								<option value="name">Jméno</option>
								<option value="surname">Příjmení</option>
								<option value="username">Uživatelské jméno</option>
								<option value="email">Email</option>
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
							<input type="hidden" name="url" value="admins">
							<input type="submit" name="Hledat" value="Hledat">
						</div>
					</form>

					<form method="POST" action="Action/sorter.php">
						<input type="hidden" name="url" value="admins">
						<input type="submit" name="Reset" value="Reset">
					</form>
				</div>
				<div id="upload">
					<h2>Přidávání záznamů</h2>
					<form method="POST" action="Action/superuserInserter.php">
						<div>
							<label for="name">Jméno</label>
							<input type="text" name="name" <?php inputControl("name");?>>
						</div>
						<div>
							<label for="surname">Příjmení</label>
							<input type="text" name="surname" <?php inputControl("surname");?>>
						</div>
						<div>
							<label for="username">Uživatelské jméno</label>
							<input type="text" name="username" <?php inputControl("username");?>>
						</div>
						<div>
							<label for="Email">Email</label>
							<input type="email" name="email" <?php inputControl("email");?>>
						</div>
						<div>
							<label for="password">Heslo</label>
							<input type="text" name="psswd" <?php inputControl("psswd");?>>
						</div>
						<div>
							<input type="hidden" name="tbl" value="sprusrs">
							<input type="submit" name="Vložit" value="Vložit">
						</div>
					</form>
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
					strankovani($db, "galery_superusers", "sprusrs", $_SESSION["sortBy"], $_SESSION["sortAs"]);
				?>
				
			</div>
		</div>
	</div>
</body>
</html>