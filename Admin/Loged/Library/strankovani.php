<?php
	function strankovani($db, $type, $dtbs, $sortBy, $sortAs){
		include_once "lib.php";

	//Request from page and setting URL for return
		if ($dtbs == "usrs") {
			$URL = "index";
		} elseif ($dtbs == "phts") {
			$URL = "images";
		} elseif ($dtbs == "sprusrs") {
			$URL = "admins";
		}

	//Data from sorter
		if (empty($sortBy)) {
			$sortBy = "ID";
		} 

		if (empty($sortAs)) {
			$sortAs = "ASC";
		}

	//Total of contributions and distribution on pages
		if ($dtbs == "phts") {
			$onPage = 2;
		} else{
			$onPage = 10;
		}

		$sql_All = "SELECT COUNT(*) FROM ".$type." ";

		$sql_cmd_count = $db->prepare($sql_All);
		$sql_cmd_count->execute();
		$count = $sql_cmd_count->fetchColumn();
		
		$pages = ceil($count / $onPage);

	//Get from URL
		if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"] <= $pages && $_GET["page"] > 0) {
			$_SESSION["page"] = $_GET["page"];
			$getPage = $_GET["page"] * $onPage;
		} else {
			$getPage = 0;
			$_SESSION["page"] = $getPage;
		}

	//Download information
		if ($getPage || $getPage == 0) {
			$sql_select = "SELECT * FROM ".$type." ORDER BY ".$sortBy." ".$sortAs." LIMIT ".$getPage.",".$onPage;

			$sql_select_cmd = $db->prepare($sql_select);
			$sql_select_cmd->execute();

			$onPageData = $sql_select_cmd->fetchAll(PDO::FETCH_ASSOC);

			if ($dtbs == "phts") {
				imageCard($onPageData, $dtbs);
			} else {
				vypis($onPageData, $dtbs);
			}
		}

	//Links
		$onRow = 10;

		echo "<table class='middle'>";
		echo "<tr>";
		for ($i=0; $i < $pages; $i++) { 
			$a = $i + 1;
			if ($i % $onRow == 0) {
				echo "</tr>";
				echo "<tr>";
			}
			echo "<td class='href'>";
			echo "<a href='$URL.php?page=".$i."' id='li".$i."nk'>".$a."</a>";
			echo "</td>";
		}
		echo "</tr>";
		echo "</table>";
	}
?>