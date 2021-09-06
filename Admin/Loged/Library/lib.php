<?php
//Functions

	/*
	Functions:
		- Extraxting data from selected table

	Parameters:
		- $data -- including array with informations
		- $dtbs -- including name of table 
	*/
	function vypis($data, $dtbs){
		echo "<table class='DBdataTable'>";
		echo "<tr>";
		
		echo "<td class='tableHeader'>";
		echo "ID";
		echo "</td>";
		
		echo "<td class='tableHeader'>";
		echo "Jméno";
		echo "</td>";

		echo "<td class='tableHeader'>";
		echo "Příjmení";
		echo "</td>";

		echo "<td class='tableHeader'>";
		echo "Přezdívka";
		echo "</td>";

		echo "<td class='tableHeader'>";
		echo "Email";
		echo "</td>";

		echo "</tr>";
		
		if ($dtbs == "usrs") {
			foreach ($data as $key => $value) {
				echo "<tr>";
				echo "<td class='DBdata'>".$value["ID"]."</td>";
				echo "<td class='DBdata'>".$value["name"]."</td>";
				echo "<td class='DBdata'>".$value["surname"]."</td>";
				echo "<td class='DBdata'>".$value["nickname"]."</td>";
				echo "<td class='DBdata'>".$value["email"]."</td>";
				echo "<td class='DBdata'><a href='Action/deleter.php?ID=".$value["ID"]."&tbl=".$dtbs."' title='smazat'>Smazat</a></td>";
				echo "</tr>";
			}
		} elseif ($dtbs == "sprusrs") {
			foreach ($data as $key => $value) {
				echo "<tr>";
				echo "<td class='DBdata'>".$value["ID"]."</td>";
				echo "<td class='DBdata'>".$value["name"]."</td>";
				echo "<td class='DBdata'>".$value["surname"]."</td>";
				echo "<td class='DBdata'>".$value["username"]."</td>";
				echo "<td class='DBdata'>".$value["email"]."</td>";
				echo "<td class='DBdata'><a href='Action/deleter.php?ID=".$value["ID"]."&tbl=".$dtbs."' title='smazat'>Smazat</a></td>";
				echo "</tr>";
			}
		}
		echo "</table>";
	}

	/*
	Functions:
		- Generating navigation bar
		- If user logged, will generate login button and conversely
		- Generating search form

	Parameters:
		- $db -- including acces to db
	*/
	function adminMenu($db){
		$sql_menu = "SELECT * FROM galery_administration_menu";
		$sql_menu_cmd = $db->prepare($sql_menu);
		$sql_menu_cmd->execute();

		$menu = $sql_menu_cmd->fetchAll(PDO::FETCH_ASSOC);

		foreach ($menu as $key => $value) {
			echo "
				<p>
					<a href=".$value["URL"]." title=".$value["value"].">".$value["value"]."</a>
				</p>
			";
		}
	}

	/*
	Functions:
		- Generating table of contribution
			- Image
			- Header
			- Description
			- Upload date
			- Author
			- ID
			- Source image
			- Update date
			- Update count
			- Uploader ID

	Parameters:
		- $data -- including array with informations
		- $dtbs -- including name of table
	*/
	function imageCard($data, $dtbs){
		foreach ($data as $key => $value) {
			if (strpos($value["URL"], "Media") !== false) {
				$imgURL = "../../".$value["URL"];
				$source = str_replace("Media/", '', $value["URL"]);
			} else{
				$imgURL = $value["URL"];
				$source = "<a href='".$value["URL"]."' title='zdroj'>Zde</a>";
			}

			if (!empty($value["UpdateDate"])) {
				$UpdateDate = "<p>Aktualizováno: ".$value["UpdateDate"]."</p>";
			} else{
				$UpdateDate = null;
			}

			echo "<div class='card'>
					<p class='image center'><img src='".$imgURL."' title='".$value["header"]."'></p>
					<h2>Nadpis:<br>".$value["header"]."</h2>
					<p>Popis:<br>".$value["description"]."</p>
					<div class='information'>
						<p>Datum nahrání: ".$value["Date"]."</p>
						<p>Autor: ".$value["autor"]."</p>
						<p>ID: ".$value["ID"]."</p>
						<p>Zdrojový obrázek: ".$source."</p>
						".$UpdateDate."
						<p>Počet upravení: ".$value["UpdatedTimes"]."</p>
						<p>ID vkladatele: ".$value["uploader"]."</p>
					</div>
					<div class='clear'></div>
				</div>";
			echo "<p class='center setting'><a href='Action/deleter.php?ID=".$value["ID"]."&tbl=".$dtbs."' title='Smazat'>Smazat</a>";
			echo "<a href='edit.php?edit=".$value["ID"]."&tbl=".$dtbs."' title='Upravit'>Upravit</a></p>";
		}
	}

	/*
	Functions:
		- Generating form for editing contribution
			- Header
			- Description
			- Upload date
			- Author
			- Source image
			- Update date
			- Update count
			- Uploader ID

	Parameters:
		$img -- including array with img info
	*/
	function imgEdit($img){
		foreach ($img as $key => $value) {
			if (strpos($value["URL"], "Media") !== false) {
				$imgURL = "../../".$value["URL"];
				$source = str_replace("Media/", '', $value["URL"]);
			} else{
				$imgURL = $value["URL"];
				$source = "<a href='".$value["URL"]."' title='zdroj'>Zde</a>";
			}

			if (!empty($value["UpdateDate"])) {
				$UpdateDate = "<p>Aktualizováno: ".$value["UpdateDate"]."</p>";
			} else{
				$UpdateDate = null;
			}
			
			echo "
				<form method='POST' action='Action/imagesEditor.php'>
					<div class='card'>
						<p class='image center'><img src='".$imgURL."' title='".$value["header"]."'></p>
						
						<h2>Nadpis:<br>
						<input type='text' name='header' value='".$value["header"]."'></h2>

						
						<p class='leftText'>Popis:</p>
						<textarea id='description' name='description'>".$value["description"]."</textarea>
						
						<div class='information'>
							<p>Datum nahrání: ".$value["Date"]."</p>
							<p>Autor: </p>
							<input type='text' name='autor' value='".$value["autor"]."' class='rightInput'>
							
							<p>ID: ".$value["ID"]."</p>
							<input type='hidden' name='image' value='".$value["ID"]."'>
							<p>Zdrojový obrázek: ".$source."</p>
							".$UpdateDate."
							<p>Počet upravení: ".$value["UpdatedTimes"]."</p>
							<input type='hidden' name='updated' value='".$value["UpdatedTimes"]."'>
							<p>ID vkladatele: ".$value["uploader"]."</p>

							<input type='submit' name='submit' value='Upravit'>
							<p><a href='images.php' title='Zpět'>Zpět</a></p>
						</div>
						<div class='clear'></div>
					</div>
				</form>
			";
		}
	}

//Functions

	/*
	Functions:
		- Generating CSS form mark current page
	*/
	function style(){
		if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
			$getPage = $_GET["page"];
		}
		else {
			$getPage = 0;
		}
		echo "#li".$getPage."nk{color: #3e8958; text-decoration: underline;}";
	}

	/*
	Functions:
		- Making refill/prefill of inputs

	Parameters:
		- $input -- Including name of $_SESSION[""]
			- $_SESSION[""] was named as well as input
	*/
	function inputControl($input){
		if (!empty($_SESSION[$input])) {
			echo "value='".$_SESSION[$input]."'";
			unset($_SESSION[$input]);
		} else {
			echo "placeholder=".$input;
		}
	}

	/*
	Functions:
		- Checking if user was logged
	*/
	function verifyAccess($db) {
		if (empty($_SESSION["token"]) || !is_numeric($_SESSION["token"])) {
			$_SESSION["info"] = "<p>Přístup odepřen</p>";
			header("location: ../index.php");
			exit();
		} elseif (!empty($_SESSION["token"])) {
			$select = array(':ID' => $_SESSION["token"], );

			$sql_select = "SELECT * FROM galery_superusers WHERE ID = :ID";
			$sql_select_cmd = $db->prepare($sql_select);
			$sql_select_cmd->execute($select);

			$user = $sql_select_cmd->fetchAll(PDO::FETCH_ASSOC);
		}

		if (empty($user)) {
			$_SESSION["info"] = "<p>Přístup odepřen</p>";
			header("location: ../index.php");
			exit();
		}
	}

	/*
	Functions:
		- Checking text values from POST
			- string lenght
			- if string not including SQL cmds or names of tables

	Parameters:
		- $session -- including name of POST variable
	*/
	function checkTextFormValues($session){
		if (isset($_POST[$session]) && is_string($_POST[$session]) && !preg_match( '/(galery_users|galery_photos|galery_superusers|DELETE|DROP|TABLE)/', $_POST[$session])) {
			$return = $_POST[$session];
		} else {
			$return = null;
		}

		return $return;
	}

	/*
	Functions:
		- Checking password 
			- string lenght
		- Hashing password
			- sha512

	Parameters:
		- $post -- including name of POST variable
		- $error -- including error text
	*/
	function checkPsswdFormValues($post, $error){
		if (strlen($post) > 7) {
			$return = hash("sha512", $post);
		} else{
			$_SESSION["info"] = "<p>".$error."</p>";
			header('location: ../index.php');
			exit();
		}


		return $return;
	}

	/*
	Functions:
		- Checking email values from POST
			- string lenght
			- if string not including SQL cmds or names of tables

	Parameters:
		- $session -- including name of POST variable
	*/
	function checkEmailFormValues($session){
		if (isset($_POST[$session]) && !preg_match( '/(galery_users|galery_photos|galery_superusers|DELETE|DROP|TABLE)/', $_POST[$session]) && filter_var($_POST[$session], FILTER_VALIDATE_EMAIL)) {
			$return = $_POST[$session];
		} else {
			$return = null;
		}

		return $return;
	}

	/*
	Functions:
		- Selecting everything from selected table by ID

	Parameters:
		- $db -- including access to db
		- $ID -- including ID
		- $tbl -- including name of table 
	*/
	function selectByID($db, $ID, $tbl){
		$select = array(':ID' => $ID, );

		$sql_select = "SELECT * FROM ".$tbl." WHERE ID = :ID";
		$sql_select_cmd = $db->prepare($sql_select);
		$sql_select_cmd->execute($select);

		$select = $sql_select_cmd->fetchAll(PDO::FETCH_ASSOC);

		return $select;
	}

	/*
	Functions:
		- Making timestamp created from 13 numbers of date and time
	*/
	function timestamp(){
		$timestamp = round(microtime(1) * 1000);

		return $timestamp;
	}

	/*
	Functions:
		- Counting all records from selected table

	Parameters:
		- $db -- including db access
		- $type -- includig name of table
	*/
	function dataCount($db, $type){
		$sql_All = "SELECT COUNT(*) FROM ".$type;

		$sql_cmd_count = $db->prepare($sql_All);
		$sql_cmd_count->execute();
		$count = $sql_cmd_count->fetchColumn();

		return $count;
	}

	/*
	Functions:
		- Checking if extension of file is correct

	Parameters:
		- $ext -- extension of file
	*/
	function extension($ext){
		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			$ret = 1;
		} else{
			$ret = 0;
		}

		return $ret;
	}
?>