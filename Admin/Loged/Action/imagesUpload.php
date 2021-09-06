<?php 
	include_once "../../../Library/db.php";
	include_once "../Library/lib.php";

	session_start();
	verifyAccess($db);

//Setting and veryfying values from form
	$imageName = checkTextFormValues("imageName");
	$description = checkTextFormValues("description");
	$author = checkTextFormValues("author");

	if (!isset($_FILES["Image"]["name"])) {
		$_FILES["Image"]["name"] = null;
	}

//If thy are right check and prepare file
	if (($_FILES["Image"]["name"]!="" && !empty($imageName) && !empty($description) && !empty($author))){
	//Path for file save
		$targetDir = "../../../Media/";
	//Name of file
		$file = $_FILES["Image"]["name"];
	//All about file
		$path = pathinfo($file);
	//Filename
		$timestamp = timestamp();
		$originalFilename = $path["filename"];
		$filename = $originalFilename.$timestamp;
	//extension of file
		$ext = strtolower($path["extension"]);
	//Validity of extension
		$truth = extension($ext);
		if (!$truth) {
			$_SESSION["error"] = "<p>Pokoušíte se nahrát nepodporovaný typ souboru.<br>Podporované typy souborů: JPG, PNG, JPEG.</p>";
			header("location: ../Upload.php");
			exit();
		}
	//Temp on server
		$tempName = $_FILES["Image"]["tmp_name"];
	//Path + filename + extension
		$pathFilenameExt = $targetDir.$filename.".".$ext;

	//Checking if file not exist
		//If exist hard name changing using timestamp until name not exist 
		if (file_exists($pathFilenameExt)) {
			for ($i=0; $i < 0; $i--) { 
				$timestamp = timestamp();
				$filename = $filename = $originalFilename.$timestamp;
				$pathFilenameExt = $targetDir.$filename.".".$ext;
				if (!file_exists($pathFilenameExt)) {
					$i = 1;
				}
			}
		}
	//Move
		move_uploaded_file($tempName,$pathFilenameExt);

	//Variables for saving into db table
		$URL = "Media/".$filename.".".$ext;
		$Date = date("d.m.Y");

	//Insert into db table
		$insert = array(
			':header' => $imageName,
			':description' => $description,
			':autor' => $author,
			':Date' => $Date,
			':URL' => $URL, 
		);

		$sql_insert = "INSERT INTO galery_photos (`header`, `description`, `autor`, `Date`, `URL`) VALUES (:header, :description, :autor, :Date, :URL)";

		$sql_insert_cmd = $db->prepare($sql_insert);
		$sql_insert_cmd->execute($insert);

		$_SESSION["error"] = "<p>Soubor byl úspěšně uložen</p>";
	} else{
		$_SESSION["error"] = "<p>Soubor nenahrán. Zkontrolujte, zda bylo vše vyplněno.</p>";
	}

//Redirect
	header("location: ../images.php");
?>