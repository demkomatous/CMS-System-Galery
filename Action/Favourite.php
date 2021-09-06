<?php 
	include_once "../Library/db.php";
	include_once "../Library/lib.php";

	session_start();
	verifyAccess($db, "Pro uložení do oblíbených se prosím přihlaste.", "act");

//Setting and veryfying values from form
	$userID = $_SESSION["token"];
	$URL = checkTextFormValues("search");
	$pages = $_SESSION["pages"];
	$error = 0;
	if (is_numeric($_POST["page"]) && $_POST["page"] <= $pages) {
		$page = $_POST["page"];
	} else{
		$page = 0;
	}

//Veryfying validity of contribution ID
	if (!empty($_POST["img"]) && is_numeric($_POST["img"]) && $_POST["img"] >= 0) {
		$recivedID = $_POST["img"];

	//Downloading informations about contribution
		$imgSelect = array(':recivedID' => $recivedID, );

		$sql_imgSelect = "SELECT * FROM `galery_photos` WHERE ID = :recivedID";

		$sql_imgSelect_cmd = $db->prepare($sql_imgSelect);
		$sql_imgSelect_cmd->execute($imgSelect);

		$imgData = $sql_imgSelect_cmd->fetchAll(PDO::FETCH_ASSOC);

	//Veryfying if not saved
		$imgSelectChck = array(':recivedID' => $recivedID, );

		$sql_imgSelectChck = "SELECT * FROM galery_personal_user".$userID." WHERE ID_photo = :recivedID";

		$sql_imgSelectChck_cmd = $db->prepare($sql_imgSelectChck);
		$sql_imgSelectChck_cmd->execute($imgSelectChck);

		$imgDataChck = $sql_imgSelectChck_cmd->fetchAll(PDO::FETCH_ASSOC);

	//If all valid and wasn't saved, save into personal table
		if (!empty($imgData) && empty($imgDataChck)) {
			$insertFav = array(':ID_photo' => $recivedID, );

			$sql_insertFav = "INSERT INTO galery_personal_user".$userID." (`ID_photo`) VALUES (:ID_photo)";

			$sql_insertFav_cmd = $db->prepare($sql_insertFav);
			$sql_insertFav_cmd->execute($insertFav);

		} else{
			$error++;
		}
	} else{
		$error++;
	}

//Redirect
	if ($error == 0) {
		$_SESSION["alert"] = "$(document).ready(function() {alert('Obrázek byl uložen.')});";
		header("location: ../view.php?search=$URL&page=$page");
	} else{
		$_SESSION["alert"] = "$(document).ready(function() {alert('Obrázek již máte uložený.')});";
		header("location: ../view.php?search=$URL&page=$page");
	}
?>