<?php
	include_once "../Library/db.php";
	include_once "../Library/lib.php";

	session_start();

//Setting and veryfying values from form
	$nickname = checkTextFormValues("nickname");
	$email = checkEmailFormValues("email");
	$password = checkTextFormValues("password");

	if (!empty($nickname) && !empty($email) && !empty($password)) {
	//hash password
		$hashPassword = hash("sha512", $password);

	//Searching and downloading user data
		$user = array(
			':nickname' => $nickname,
			':email' => $email,
			':password' => $hashPassword, 
		);

		$sql_user = "SELECT * FROM galery_users WHERE nickname = :nickname AND email = :email AND password = :password LIMIT 0,1";
		$sql_user_cmd = $db->prepare($sql_user);
		$sql_user_cmd->execute($user);

		$user = $sql_user_cmd->fetchAll(PDO::FETCH_ASSOC);

	//If downloaded save ID into $_SESSION["token"]
		if (!empty($user)) {
			foreach ($user as $key => $value) {
				$_SESSION["token"] = $value["ID"];
			}

			header("location: ../index.php");
			exit();
		} else{
			$_SESSION["error"] = "<p>Přihlášení se nezdařilo. Zkontrolujte údaje a zkuste to znovu.</p>";
		}
	} else{
		$_SESSION["error"] = "<p>Přihlášení se nezdařilo. Zkontrolujte údaje a zkuste to znovu.</p>";
	}

//Redirect
	header("location: ../Login.php");
?>