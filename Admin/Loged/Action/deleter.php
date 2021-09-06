<?php 
	include_once "../../../Library/db.php";
	include_once "../Library/lib.php";

	session_start();
	verifyAccess($db);

//Tabel indetification
	if ($_GET["tbl"] == "usrs") {
		$dtbs = "galery_users";
		$url = "index";
	} elseif ($_GET["tbl"] == "phts") {
		$dtbs = "galery_photos";
		$url = "images";
	} elseif ($_GET["tbl"] == "sprusrs") {
		$dtbs = "galery_superusers";
		$url = "admins";
	} else{
		$dtbs = null;
		$url = "index";
	}

//Validity of ID
	if (isset($_GET["ID"]) && is_numeric($_GET["ID"])) {
		$getID = $_GET["ID"];
	} else {
		$getID = null;
	}

//Search, delete, verify delete
	if (!empty($getID)) {
	//First data count
		$sql_count_before = "SELECT COUNT(*) FROM ".$dtbs."";

		$sql_cmd_count_before = $db->prepare($sql_count_before);
		$sql_cmd_count_before->execute();
		$countBefore = $sql_cmd_count_before->fetchColumn();

	//If it's image download information about store and delete
		if ($dtbs == "galery_photos") {
			$remove = array(':getID' => $getID, );
			
			$sql_remove = "SELECT * FROM galery_photos WHERE ID = :getID";
			$sql_remove_cmd = $db->prepare($sql_remove);
			$sql_remove_cmd->execute($remove);

			$removeImg = $sql_remove_cmd->fetchAll(PDO::FETCH_ASSOC);

			foreach ($removeImg as $key => $value) {
				if (strpos($value["URL"], "Media") !== false) {
					$file = "../../../".$value["URL"];
					if (!unlink($file)) {
						$stav = 0;
					}
				}
			}

		}

	//Deleting
		$delete = array(':getID' => $getID,);

		$sql_delete = "DELETE FROM ".$dtbs." WHERE ID = :getID";

		$sql_cmd_delete = $db->prepare($sql_delete);
		$stav = $sql_cmd_delete->execute($delete);

	//Deleting personal table
		$sql = $db->prepare("DROP TABLE galery_personal_user".$getID);
		$sql->execute();

	//Second datacount
		$sql_count_after = "SELECT COUNT(*) FROM ".$dtbs."";

		$sql_cmd_count_after = $db->prepare($sql_count_after);
		$sql_cmd_count_after->execute();
		$countafter = $sql_cmd_count_after->fetchColumn();

	//Verify about delete
		if ($countBefore == $countafter) {
			$stav = 0;
		} else{
			$stav = 1;
		}
	} else {
		$stav = 0;
	}

	if ($stav) {
		$_SESSION["info"] = "<p>Smazáno</p>";
	} else {
		$_SESSION["info"] = "<p>Daný záznam nenalezen.</p>";
	}

//Redirect
	$href = $_SESSION["page"];
	header("location: ../$url.php?page=$href");
?>