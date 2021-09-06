<?php 
	include_once "../../../Library/db.php";
	include_once "../Library/lib.php";

	session_start();
	verifyAccess($db);

//Setting and veryfying values from form
	$name = checkTextFormValues("name");
	$surname = checkTextFormValues("surname");
	$username = checkTextFormValues("username");
	$email = checkEmailFormValues("email");

//Save into $_SESSION
	$_SESSION["name"] = $name;
	$_SESSION["surname"] = $surname;
	$_SESSION["username"] = $username;
	$_SESSION["email"] = $email;

//Password is out because fc for check ending script in fail
	$psswd = checkPsswdFormValues("psswd");

//Insert data
	if (!empty($name) && !empty($surname) && !empty($username) && !empty($email) && !empty($psswd)) {

	//Verify if user not exist
		$select = array(
			':username' => $username,
			':email' => $email,
		);

		$sql_regControl = "SELECT * FROM galery_superusers WHERE username = :username AND email = :email";
		$sql_regControl_cmd = $db->prepare($sql_regControl);
		$sql_regControl_cmd->execute($select);

		$user = $sql_regControl_cmd->fetchAll(PDO::FETCH_ASSOC);

	//If exist redirect
		if (count($user) != 0) {
			$_SESSION["info"] = "<p>Přihlášení již existuje.</p>";
			header('location: ../index.php');
			exit();
		}

	//Create new record if all right
		$insert = array(
			':name' => $name,
			':surname' => $surname,
			':username' => $username,
			':email' => $email,
			':psswd' => $psswd,
		);

		$sql_insert = "INSERT INTO galery_superusers (`name`, `surname`, `username`, `email`, `password`) VALUES (:name, :surname, :username, :email, :psswd)";

		$sql_insert_cmd = $db->prepare($sql_insert);
		$sql_insert_cmd->execute($insert);

		$_SESSION["info"] = "<p>vloženo</p>";
	} else {
		$_SESSION["info"] = "<p>Nebyly správně zadané hodnoty.</p>";
	}

//Redirect
	$href = $_SESSION["page"];
	header("location: ../admins.php?page=$href");
?> 