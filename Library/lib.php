<?php
//Procedures

	/*
	Functions:
		- Generating navigation bar
		- If user logged, will generate login button and conversely
		- Generating search form

	Parameters:
		- $db -- including acces to db
	*/
	function menuGen($db){
	//Changing text and link on loging/logout button
		if (!empty($_SESSION["token"]) && is_numeric($_SESSION["token"])) {
			$button = "Odhlásit se";
			$href = "Action/Logout.php";
			echo '<p><a href="profile.php" title="Přihlásit se" class="ClickButton">Můj profil</a></p>';
		} else{
			$button = "Přihlásit se";
			$href = "Login.php";
		}

	//Getting menu information from db
		$sql_menu = "SELECT * FROM galery_frontpage_menu";
		$sql_menu_cmd = $db->prepare($sql_menu);
		$sql_menu_cmd->execute();

		$menu = $sql_menu_cmd->fetchAll(PDO::FETCH_ASSOC);

	//Generating all menu links
		foreach ($menu as $key => $value) {
			echo "
				<p>
					<a href='".$value["URL"]."' title='".$value["value"]."' class='ClickButton'>".$value["value"]."</a>
				</p>
			";
		}

		echo '
			<p><a href="'.$href.'" title="Přihlásit se" class="ClickButton">'.$button.'</a></p>
			<form id="searchForm" action="view.php">
				<div>
					<input type="text" name="search" placeholder="Zadejte hledaný řetězec">
					<input type="submit" name="submit" value="Hledat">
				</div>
			</form>
		';
	}

	/*
	Funkctions:
		- Generating table of contribution
			- Image
			- Header
			- Description
			- Upload date
			- Author
			- Edit date
			- Form for adding to favourite and return on current page
				- ID of contribution
				- Current search string
				- Current page

	Parameters:
		- $data -- including array with img info
	*/
	function imageCard($data){
		foreach ($data as $key => $value) {
			$URL = checkTextFormValuesGet("search");

		//Chencking if contribution was update 
			if (!empty($value["UpdateDate"])) {
				$UpdateDate = "<p>Aktualizováno: ".$value["UpdateDate"]."</p>";
			} else{
				$UpdateDate = null;
			}
		
		//Setting current page
			if (!empty($_SESSION["pages"])) {
				$pages = $_SESSION["pages"];
			} else{
				$pages = 0;
			}

			if (!empty($_GET["page"])) {
				if (is_numeric($_GET["page"]) && $_GET["page"] <= $pages) {
					$page = $_GET["page"];
				} else{
					$page = 0;
				}
			} else{
				$page = 0;
			}

		//Generating card
			echo "<div class='card'>
					<p class='image'><img src='".$value["URL"]."' title='".$value["header"]."'></p>
					<h2>".$value["header"]."</h2>
					<p>".$value["description"]."</p>
					<div class='information'>
						<p>Nahráno: ".$value["Date"]."</p>
						<p>Autor: ".$value["autor"]."</p>
						".$UpdateDate."
					</div>
					<form class='favourite' method='POST' action='Action/Favourite.php'>
						<input type='submit' name='submit' value='Do oblíbených'>
						<input type='hidden' name='img' value='".$value["ID"]."'>
						<input type='hidden' name='search' value='".$URL."'>
						<input type='hidden' name='page' value='".$page."'>
					</form>
					<div class='clear'></div>
				</div>";
		}
	}

	/*
	Functions:
		- Generating table of favourite contribution
			- Image
			- Header
			- Description
			- Upload date
			- Author
			- From for delet from favourite and return on current page
				- Contribution ID

	Parameters:
		- $data -- including array with img info
	*/

	function favImageCard($data = null){
	//Checking if not empty
		if (!empty($data)) {
		//Setting variables
			foreach ($data as $key => $value) {
				$ID = $value["ID"];
				$header = $value["header"];
				$description = $value["description"];
				$autor = $value["autor"];
				$Date = $value["Date"];
				$URL = $value["URL"];
			}
		//Generating card
			echo "<div class='card'>
					<p class='image'><img src='".$URL."' title='".$header."'></p>
					<h2>".$header."</h2>
					<p>".$description."</p>
					<div class='information'>
						<p>Nahráno: ".$Date."</p>
						<p>Autor: ".$autor."</p>
					</div>
					<form class='favourite' method='POST' action='Action/Deleter.php'>
						<input type='submit' name='submit' value='Odstranit z oblíbených'>
						<input type='hidden' name='img' value='".$ID."'>
					</form>
					<div class='clear'></div>
				</div>";
		}
	}

	/*
	Functions:
		- Generating form for editing user-uploaded contributions
			- Header
			- Description
			- Upload date
			- Author

	Parameters:
		$img -- including array with img info
	*/
	function imgEdit($img){
		foreach ($img as $key => $value) {
		//Cheking if was updated
			if (!empty($value["UpdateDate"])) {
				$UpdateDate = "<p>Aktualizováno: ".$value["UpdateDate"]."</p>";
			} else{
				$UpdateDate = null;
			}
		//Generating form for editing
			echo "
				<form method='POST' action='Action/imagesEditor.php'>
					<div class='card'>
						<p class='image center'><img src='".$value["URL"]."' title='".$value["header"]."'></p>
						
						<h2>Nadpis:<br>
						<input type='text' name='header' value='".$value["header"]."'></h2>

						
						<p class='leftText'>Popis:</p>
						<textarea id='description' name='description'>".$value["description"]."</textarea>
						
						<div class='information'>
							<p>Datum nahrání: ".$value["Date"]."</p>
							<p>Autor: </p>
							<input type='text' name='autor' value='".$value["autor"]."' class='rightInput'>
						</div>
						<div class='clear'></div>
						<input type='hidden' name='img' value='".$value["ID"]."'>
						<input type='hidden' name='updated' value='".$value["UpdatedTimes"]."'>
						<div class='editBtn'>
							<input type='submit' name='submit' value='Upravit'>
						</div>
					</div>
					";
					if (!empty($_SESSION["info"])) {
					 	echo $_SESSION["info"];
					 	unset($_SESSION["info"]);
					}
			echo "</form>";
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
		-$session -- Including name of $_SESSION[""]
			- $_SESSION[""] was named as well as input
	*/
	function refill($session){
		if (!empty($_SESSION[$session])) {
			echo $_SESSION[$session];
			unset($_SESSION[$session]);
		}
	}

	/*
	Functions:
		- Select 5 newst contributions and send them to procedure for extract

	Parameters:
		- $db -- including access to db
	*/
	function newstImages($db){
		$sql_newstImages = "SELECT * FROM galery_photos ORDER BY ID DESC LIMIT 0,5";
		$sql_newstImages_cmd = $db->prepare($sql_newstImages);
		$sql_newstImages_cmd->execute();

		$newstImages = $sql_newstImages_cmd->fetchAll(PDO::FETCH_ASSOC);

		imageCard($newstImages);
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
		if ($session == "imageName" && strlen($_POST[$session]) > 50) {
			$_POST[$session] = null;
		} elseif ($session == "description" && strlen($_POST[$session]) > 500) {
			$_POST[$session] = null;
		} elseif ($session == "author" && strlen($_POST[$session]) > 50) {
			$_POST[$session] = null;
		}

		if (!empty($_POST[$session]) && is_string($_POST[$session]) && !preg_match( '/(galery_users|galery_photos|galery_superusers|DELETE|DROP|TABLE)/', $_POST[$session])) {
			$return = $_POST[$session];
		} else {
			$return = null;
		}

		return $return;
	}

	/*
	Functions:
		- Checking text values from GET
			- if string not including SQL cmds or names of tables

	Parameters:
		- $session -- including name of GET variable
	*/
	function checkTextFormValuesGet($session){
		if (!empty($_GET[$session]) && is_string($_GET[$session]) && !preg_match( '/(galery_users|galery_photos|galery_superusers|DELETE|DROP|TABLE)/', $_GET[$session])) {
			$return = $_GET[$session];
		} else {
			$return = null;
		}

		return $return;
	}

	/*
	Functions:
		- Checking email values from POST
			- if string not including SQL cmds or names of tables

	Parameters:
		- $session -- including name of POST variable
	*/
	function checkEmailFormValues($session){
		if (!empty($_POST[$session]) && !preg_match( '/(galery_users|galery_photos|galery_superusers|DELETE|DROP|TABLE)/', $_POST[$session]) && filter_var($_POST[$session], FILTER_VALIDATE_EMAIL)) {
			$return = $_POST[$session];
		} else {
			$return = null;
		}

		return $return;
	}

	/*
	Functions:
		- Checking if user was logged

	Parameters:
		- $error -- including message for user if not logged
		- $url -- distinguishes the file level
			- act == 1 back
			- normal == deafult value - 0 back
	*/
	function verifyAccess($db, $error, $url = "normal") {
		if ($url == "act") {
			$url = "../index.php";
		} else{
			$url = "index.php";
		}
		
		if (empty($_SESSION["token"]) || !is_numeric($_SESSION["token"])) {
			$_SESSION["alert"] = "$(document).ready(function() {alert('".$error."')});";
			header("location: $url");
			exit();
		} elseif (!empty($_SESSION["token"])) {
			$select = array(':ID' => $_SESSION["token"], );

			$sql_select = "SELECT * FROM galery_users WHERE ID = :ID";
			$sql_select_cmd = $db->prepare($sql_select);
			$sql_select_cmd->execute($select);

			$user = $sql_select_cmd->fetchAll(PDO::FETCH_ASSOC);
		}

		if (empty($user)) {
			$_SESSION["alert"] = "$(document).ready(function() {alert('".$error."')});";
			header("location: $url");
			exit();
		}
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
		- Selecting contributions by uploader ID with LIMIT

	Parameters:
		- $db -- including access to db
		- $ID -- including user ID
		- $start -- including number of LIMIT start
		- $end -- including number of LIMIT end 
	*/
	function selectByUploader($db, $ID, $start, $end){
		$select = array(':ID' => $ID, );

		$sql_select = "SELECT * FROM galery_photos WHERE uploader = :ID LIMIT ".$start.",".$end;
		$sql_select_cmd = $db->prepare($sql_select);
		$sql_select_cmd->execute($select);

		$select = $sql_select_cmd->fetchAll(PDO::FETCH_ASSOC);

		return $select;
	}

	/*
	Functions:
		- Selecting everything from selected table by ID

	Parameters:
		- $db -- including access to db
		- $ID -- including ID
		- $table -- including name of table 
	*/
	function selectByID($db, $ID, $table){
		$select = array(':ID' => $ID, );

		$sql_select = "SELECT * FROM ".$table." WHERE ID = :ID";
		$sql_select_cmd = $db->prepare($sql_select);
		$sql_select_cmd->execute($select);

		$select = $sql_select_cmd->fetchAll(PDO::FETCH_ASSOC);
		return $select;
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