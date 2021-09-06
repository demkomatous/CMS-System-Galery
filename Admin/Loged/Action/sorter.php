<?php 
	include_once "../Library/lib.php";
	include_once "../../../Library/db.php";
	
	session_start();
	verifyAccess($db);

//Reset sorter
	if (isset($_POST["Reset"])) {
		unset($_SESSION["sortAs"]);
		unset($_SESSION["sortBy"]);
	}

//Getting data
//Sort by
	if (isset($_POST["radit"])) {
		if ($_POST["radit"] == "ID" || $_POST["radit"] == "name" || $_POST["radit"] == "surname" || $_POST["radit"] == "nickname" || $_POST["radit"] == "email" || $_POST["radit"] == "header" || $_POST["radit"] == "description" || $_POST["radit"] == "autor" || $_POST["radit"] == "Date" || $_POST["radit"] == "UpdateDate" || $_POST["radit"] == "username" || $_POST["radit"] == "UpdatedTimes" || $_POST["radit"] == "uploader") {
			$sortBy = $_POST["radit"];
		} else{
			$sortBy = "ID";
		}
	}
	else{
		$sortBy = "ID";
	}

//Sort as
	if (isset($_POST["jak"])) {
		if ($_POST["jak"] == "ASC" || $_POST["jak"] == "DESC") {
			$sortAs = $_POST["jak"];
		}
		else{
			$sortAs = $_POST["jak"];
		}
	}
	else{
		$sortAs = "ASC";
	}

//URL for redirect
	if ($_POST["url"] == "index") {
		$url = $_POST["url"];
	} elseif ($_POST["url"] == "admins") {
		$url = $_POST["url"];
	} elseif ($_POST["url"] == "images") {
		$url = "images";
	} else{
		$url = "index";
	}

//Link for redirect
	if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] <= $count && $_GET["page"] >= 0) {
		$getPage = $_GET["page"];
	}
	else{
		$getPage = 0;
	}

//Save into SESSION
	$_SESSION["sortBy"] = $sortBy;
	$_SESSION["sortAs"] = $sortAs;

//Redirect
	$href = $_SESSION["page"];
	header("location: ../$url.php?page=$href");
?>