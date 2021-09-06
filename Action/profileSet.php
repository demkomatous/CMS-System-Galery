<?php
	include_once "../Library/db.php";
	include_once "../Library/lib.php";

	session_start();
	verifyAccess($db, "Pro zobrazení Vašeho profilu se prosím přihlaste.");

//Setting and veryfying values from form
	$ID = $_SESSION["token"];
	$nickname = checkTextFormValues("nickname");
	$email = checkEmailFormValues("email");

	if (strlen($_POST["newPassword"]) > 6 && $_POST["newPassword"] == $_POST["chckNewPassword"]) {
		$password = hash("sha512", $_POST["newPassword"]);
	} else{
		$password = null;
	}

//Deleting profile
	if ($_GET["del"] == 1) {
	//Deleting files from server
		$remove = array(':ID' => $ID, );

		$sql_remove = "SELECT * FROM galery_photos WHERE uploader = :ID";
		$sql_remove_cmd = $db->prepare($sql_remove);
		$sql_remove_cmd->execute($remove);

		$removeImg = $sql_remove_cmd->fetchAll(PDO::FETCH_ASSOC);

		foreach ($removeImg as $key => $value) {
			if (strpos($value["URL"], "Media") !== false) {
				$file = "../".$value["URL"];
				if (!unlink($file)) {
					$stav = 0;
				}
			}
		}

	//Deleting records about contributions
		$delete = array(':ID' => $ID, );

		$sql_delete = "DELETE FROM galery_photos WHERE uploader = :ID";
		$sql_delete_cmd = $db->prepare($sql_delete);
		$stav = $sql_delete_cmd->execute($delete);

	//Deleting account
		$deleteUsr = array(':ID' => $ID, );

		$sql_deleteUsr = "DELETE FROM galery_users WHERE ID = :ID";
		$sql_deleteUsr_cmd = $db->prepare($sql_deleteUsr);
		$stav = $sql_deleteUsr_cmd->execute($deleteUsr);

	//Deleting personal table
		$sql = $db->prepare("DROP TABLE galery_personal_user".$ID);
		$sql->execute();

	//Logout
		session_destroy();

	//Redirect
		header("location: ../Login.php");
		exit();
	}

//Personal data change
	if (!empty($ID) && !empty($email) && !empty($nickname) && $_POST["val"] == "prsnl") {
		$edit = array(
			':ID' => $ID, 
			':email' => $email,
			':nickname' => $nickname,
		);

		$sql_edit = "UPDATE galery_users SET email = :email, nickname = :nickname WHERE ID = :ID";
		$sql_cmd_edit = $db->prepare($sql_edit);
		$sql_cmd_edit->execute($edit);

		$_SESSION["info"] = "<p>Aktualizace profilu proběhla úspěšně.</p>";
//Change password
	} elseif (!empty($password) && $_POST["val"] == "psswd") {
		$editPsswd = array(
			':ID' => $ID, 
			':password' => $password,
		);

		$sql_edit = "UPDATE galery_users SET password = :password WHERE ID = :ID";
		$sql_cmd_edit = $db->prepare($sql_edit);
		$sql_cmd_edit->execute($editPsswd);

		$_SESSION["info"] = "<p>Aktualizace profilu proběhla úspěšně.</p>";
	} else{
		$_SESSION["info"] = "<p>Aktualizace profilu se nezdařila.</p>";
	}

//Redirect
	header('location: ../profile.php');
?>