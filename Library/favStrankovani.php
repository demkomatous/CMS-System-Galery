<?php 
	function favStrankovani($db, $userID){
		include_once "lib.php";

	//otal of contributions and distribution on pages
		$onPage = 5;

		$sql_All = "SELECT COUNT(*) FROM galery_personal_user".$userID." ORDER BY ID DESC";

		$sql_cmd_count = $db->prepare($sql_All);
		$sql_cmd_count->execute();

		$count = $sql_cmd_count->fetchColumn();
		
		$pages = ceil($count / $onPage);

	//Get from URL
		if (isset($_GET["page"])) {
			if (is_numeric($_GET["page"]) && $_GET["page"] <= $pages && $_GET["page"] > 0) {
				$_SESSION["page"] = $_GET["page"];
				$getPage = $_GET["page"] * $onPage;
			} else {
				$getPage = 0;
				$_SESSION["page"] = $getPage;
			}
		} else{
			$getPage = 0;
			$_SESSION["page"] = $getPage;
		}

	//Downloading informations
		if ($getPage || $getPage == 0) {
			$sql_selectID = "SELECT * FROM galery_personal_user".$userID." ORDER BY ID DESC LIMIT ".$getPage.",".$onPage;

			$sql_selectID_cmd = $db->prepare($sql_selectID);
			$sql_selectID_cmd->execute();

			$allData = $sql_selectID_cmd->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($allData as $key => $value) {
				$imgID = $value["ID_photo"];

				$selectImg = array(':ID' => $imgID, );

				$sql_select = "SELECT * FROM galery_photos WHERE ID = :ID";

				$sql_select_cmd = $db->prepare($sql_select);
				$sql_select_cmd->execute($selectImg);

				$onPageData = $sql_select_cmd->fetchAll(PDO::FETCH_ASSOC);

				favImageCard($onPageData);
			}
		}

	//Links
		$onRow = 10;

		echo "<div class='numbers'><table>";
		echo "<tr>";
		for ($i=0; $i < $pages; $i++) { 
			$a = $i + 1;
			if ($i % $onRow == 0) {
				echo "</tr>";
				echo "<tr>";
			}
			echo "<td class='href'>";
			echo "<a href='Favourite.php?page=".$i."' id='li".$i."nk'>".$a."</a>";
			echo "</td>";
		}
		echo "</tr>";
		echo "</table></div>";
	}
?>