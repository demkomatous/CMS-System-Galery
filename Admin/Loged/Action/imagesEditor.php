<?php
	include_once "../../../Library/db.php";
	include_once "../Library/lib.php";
	
	session_start();
	verifyAccess($db);

//Setting and veryfying values from form
	if (is_numeric($_POST["image"]) && $_POST["image"] >= 0) {
		$ID = $_POST["image"];
	} else{
		$ID = null;
	}

	if (is_numeric($_POST["updated"]) && $_POST["updated"] >= 0) {
		$UpdatedTimes = $_POST["updated"];
		$UpdatedTimes++;
	}

	$header = checkTextFormValues("header");
	$description = checkTextFormValues("description");
	$autor = checkTextFormValues("autor");
	$date = date("d.m.Y");

//Edit
	if (!empty($ID) && !empty($header) && !empty($description) && !empty($autor) && !empty($date) && !empty($UpdatedTimes)) {
		$edit = array(
			':ID' => $ID, 
			':header' => $header,
			':description' => $description,
			':autor' => $autor,
			':UpdateDate' => $date,
			':UpdatedTimes' => $UpdatedTimes,
		);

		$sql_edit = "UPDATE galery_photos SET header = :header, description = :description, autor = :autor, UpdateDate = :UpdateDate, UpdatedTimes = :UpdatedTimes WHERE ID = :ID";
		$sql_cmd_edit = $db->prepare($sql_edit);
		$sql_cmd_edit->execute($edit);

		$_SESSION["info"] = "<p>Upraveno</p>";
	} else {
		$_SESSION["info"] = "<p>Nebyly správně zadané hodnoty.</p>";
	}

//Redirect
	header('location: ../edit.php?tbl=phts&edit='.$ID);
?>