<?php
	include_once "../../Library/db.php";
	include_once "../Loged/Library/lib.php";

	session_start();

//Setting and veryfying values from form
	$name = checkTextFormValues("name");
	$surname = checkTextFormValues("surname");
	$username = checkTextFormValues("username");
	$email = checkEmailFormValues("email");
	$psswd = checkTextFormValues("psswd");

//Save into $_SESSION for refill
	$_SESSION["name"] = $name;
	$_SESSION["surname"] = $surname;
	$_SESSION["username"] = $username;
	$_SESSION["email"] = $email;

	if (!empty($name) && !empty($surname) && !empty($username) && !empty($email) && !empty($psswd)) {
	//Hash
		$password = hash("sha512", $psswd);
	//Searching user
		$user = array(
			':name' => $name,
			':surname' => $surname,
			':username' => $username, 
			':email' => $email,
			':password' => $password, 
		);

		$sql_user = "SELECT * FROM galery_superusers WHERE name = :name AND surname = :surname AND username = :username AND email = :email AND password = :password LIMIT 0,1";
		$sql_user_cmd = $db->prepare($sql_user);
		$sql_user_cmd->execute($user);

		$token = $sql_user_cmd->fetchAll(PDO::FETCH_ASSOC);

	//If downloaded, save user ID into $_SESSION["token"]
		if (!empty($token)) {
			foreach ($token as $key => $value) {
				$_SESSION["token"] = $value["ID"];
			}

			header("location: ../Loged/index.php");
			exit();
		} else{
			$_SESSION["error"] = "<p>Přihlášení se nezdařilo. Zkontrolujte údaje a zkuste to znovu.1</p>";
		}
	} else{
		$_SESSION["error"] = "<p>Přihlášení se nezdařilo. Zkontrolujte údaje a zkuste to znovu.2</p>";
	}
	
//Redirect
	header("location: ../index.php");
?>