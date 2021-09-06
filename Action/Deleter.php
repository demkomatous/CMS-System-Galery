<?php 
	include_once "../Library/db.php";
	include_once "../Library/lib.php";

	session_start();
	verifyAccess($db, "Pro odstranění z oblíbených se prosím přihlaste.", "act");

//Setting and veryfying values from form
	$userID = $_SESSION["token"];
	$page = $_SESSION["page"];
	$error = 0;

//Veryfying validity of contribution ID
	if (!empty($_POST["img"]) && is_numeric($_POST["img"]) && $_POST["img"] >= 0) {
		$recivedID = $_POST["img"];

	//Deleting from personal table
		$imgSelect = array(':recivedID' => $recivedID, );

		$sql_imgSelect = "DELETE FROM `galery_personal_user".$userID."` WHERE ID_photo = :recivedID";

		$sql_imgSelect_cmd = $db->prepare($sql_imgSelect);
		$stav = $sql_imgSelect_cmd->execute($imgSelect);
	} else{
		$error++;
	}

//Redirect
	if ($error == 0) {
		$_SESSION["alert"] = "$(document).ready(function() {alert('Obrázek byl odstraněn.')});";
	} else{
		$_SESSION["alert"] = "$(document).ready(function() {alert('Je nám líto, ale něco se nepovedlo. Zkuste to prosím později.')});";
	}
	header("location: ../Favourite.php?page=$page");
?>