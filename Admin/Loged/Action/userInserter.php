<?php 
	include_once "../../../Library/db.php";
	include_once "../Library/lib.php";

	session_start();
	verifyAccess($db);
	
//Setting and veryfying values from form
	$name = checkTextFormValues("name");
	$surname = checkTextFormValues("surname");
	$nickname = checkTextFormValues("nickname");
	$email = checkEmailFormValues("email");
	$psswd = checkTextFormValues("psswd");

//Save into $_SESSION
	$_SESSION["name"] = $name;
	$_SESSION["surname"] = $surname;
	$_SESSION["nickname"] = $nickname;
	$_SESSION["email"] = $email;

//Insert data
	if (!empty($name) && !empty($surname) && !empty($nickname) && !empty($email) && !empty($psswd)) {

		$psswd = hash("sha512", $psswd);
	//Veryfy if user not exist
		$select = array(
			':nickname' => $nickname,
			':email' => $email,
		);

		$sql_regControl = "SELECT * FROM galery_users WHERE nickname = :nickname AND email = :email";
		$sql_regControl_cmd = $db->prepare($sql_regControl);
		$sql_regControl_cmd->execute($select);

		$user = $sql_regControl_cmd->fetchAll(PDO::FETCH_ASSOC);

		if (count($user) != 0) {
			$_SESSION["info"] = "<p>Přihlášení již existuje.</p>";
			header('location: ../index.php');
			exit();
		}

		$insert = array(
			':name' => $name,
			':surname' => $surname,
			':nickname' => $nickname,
			':email' => $email,
			':psswd' => $psswd,
		);

		$sql_insert = "INSERT INTO galery_users (`name`, `surname`, `nickname`, `email`, `password`) VALUES (:name, :surname, :nickname, :email, :psswd)";

		$sql_insert_cmd = $db->prepare($sql_insert);
		$sql_insert_cmd->execute($insert);

	//download data about new user
		$newUser = array(
			':nickname' => $nickname,
			':email' => $email,
			':psswd' => $psswd
		);

		$sql_user = "SELECT * FROM `galery_users` WHERE nickname = :nickname AND email = :email AND password = :psswd LIMIT 0,1";
		$sql_user_cmd = $db->prepare($sql_user);
		$sql_user_cmd->execute($newUser);

		$newUser = $sql_user_cmd->fetchAll(PDO::FETCH_ASSOC);

		foreach ($newUser as $key => $value) {
			$newID = $value["ID"];
		}

	//Create new personal user table with user ID in name 
		$statements = [
			"CREATE TABLE galery_personal_user".$newID."( 
				ID   INT AUTO_INCREMENT,
				ID_photo  INT NOT NULL, 
				PRIMARY KEY(ID)
			)"];
		foreach ($statements as $statement) {
			$db->exec($statement);
		}

		$_SESSION["info"] = "<p>vloženo</p>";
	} else {
		$_SESSION["info"] = "<p>Nebyly správně zadané hodnoty.</p>";
	}

//Redirect
	$href = $_SESSION["page"];
	header("location: ../index.php?page=$href");
?> 