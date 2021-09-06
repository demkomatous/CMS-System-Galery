<?php
	include_once "../Library/db.php";
	include_once "../Library/lib.php";

	session_start();

//Setting and veryfying values from form
	$name = checkTextFormValues("name");
	$surname = checkTextFormValues("surname");
	$nickname = checkTextFormValues("nickname");
	$email = checkEmailFormValues("email");
	$password = checkTextFormValues("password");
	$Chckpassword = checkTextFormValues("Chckpassword");

//Save valid values into SESSION
	$_SESSION["name"] = $name;
	$_SESSION["surname"] = $surname;
	$_SESSION["nickname"] = $nickname;
	$_SESSION["email"] = $email;

//If it's right
	if (!empty($name) && !empty($surname) && !empty($nickname) && !empty($email) && !empty($password) && !empty($Chckpassword) && $password == $Chckpassword) {
	//password minlenght
		if (strlen($password) < 7) {
			$_SESSION["error"] = "<p>Heslo musí mít nejméně 7 znaků</p>";
			header('location: ../Register.php');
			exit();
		}
	//hash password
		$hashPassword = hash("sha512", $password);
		$_SESSION["password"] = $hashPassword;

	//Verifying if user not exist
		$user = array(
			':nickname' => $nickname,
			':email' => $email,
		);

		$sql_regControl = "SELECT * FROM galery_users WHERE nickname = :nickname AND email = :email";
		$sql_regControl_cmd = $db->prepare($sql_regControl);
		$sql_regControl_cmd->execute($user);

		$user = $sql_regControl_cmd->fetchAll(PDO::FETCH_ASSOC);

		if (count($user) != 0) {
			$_SESSION["error"] = "<p>Přihlášení již existuje.</p>";
			header('location: ../Register.php');
			exit();
		}
	//If not exist create new record
		$insert = array(
			':name' => $name,
			':surname' => $surname,
			':nickname' => $nickname,
			':email' => $email,
			':password' => $hashPassword, 
		);

		$sql_insert = "INSERT INTO galery_users (`name`, `surname`, `nickname`, `email`, `password`) VALUES (:name, :surname, :nickname, :email, :password)";

		$sql_insert_cmd = $db->prepare($sql_insert);
		$sql_insert_cmd->execute($insert);

		$_SESSION["info"] = "<p>Registrace proběhla úspěšně.</p>";

	//Download new user data and login
		$select = array(
			':nickname' => $_SESSION["nickname"],
			':email' => $_SESSION["email"],
			':password' => $_SESSION["password"]
		);
		$sql_user = "SELECT * FROM `galery_users` WHERE nickname = :nickname AND email = :email AND password = :password LIMIT 0,1";
		$sql_user_cmd = $db->prepare($sql_user);
		$sql_user_cmd->execute($select);

		$user = $sql_user_cmd->fetchAll(PDO::FETCH_ASSOC);
		foreach ($user as $key => $value) {
			$_SESSION["token"] = $value["ID"];
			$ID = $value["ID"];
		}
	//Creating personal user table with his ID 
		$statements = [
			"CREATE TABLE galery_personal_user".$ID."( 
				ID   INT AUTO_INCREMENT,
				ID_photo  INT NOT NULL, 
				PRIMARY KEY(ID)
			)"];
		foreach ($statements as $statement) {
			$db->exec($statement);
		}
	} else{
		$_SESSION["error"] = "<p>Registrace se nezdařila. Zkontrolujte údaje a zkuste to znovu.</p>";
	}
//Redirect
	header("location: ../Register.php");
?>