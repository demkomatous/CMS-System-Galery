<?php 
	function strankovani($db, $ret = null, $header = null){
		include_once "lib.php";

	//Download search string from GET
		$URL = checkTextFormValuesGet("search");

	//Total of contributions and distribution on pages
		$onPage = 5;

		$search = checkTextFormValuesGet("search");
		if ($ret == "again") {
			$search = null;
		}

		$sql_All = "SELECT COUNT(*) FROM `galery_photos` WHERE `autor` LIKE '%".$search."%' OR `header` LIKE '%".$search."%' OR `description` LIKE '%".$search."%'";

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

	//Downloading informations and fulltext searching
		if ($getPage || $getPage == 0) {
			$sql_select = "SELECT * FROM `galery_photos` WHERE `autor` LIKE '%".$search."%' OR `header` LIKE '%".$search."%' OR `description` LIKE '%".$search."%' ORDER BY ID DESC LIMIT ".$getPage.",".$onPage;

			$sql_select_cmd = $db->prepare($sql_select);
			$sql_select_cmd->execute();

			$onPageData = $sql_select_cmd->fetchAll(PDO::FETCH_ASSOC);

			if (empty($_GET["search"])) {
				echo "<div class='headerOne'><h1><h1>Všechny příspěvky</h1></div>";
			} elseif (is_null($ret) && !empty($onPageData) && !empty($_GET["search"])) {
				echo "<div class='headerOne'><h1><h1>Výsledky vyhledávání</h1></div>";
			} elseif (!is_null($ret)) {
				echo "<div class='headerOne'><h1><h1>Vašemu vyhledávání neodpovídají žádné příspěvky. Byly zobrazeny všechny.</h1></div>";
			}
			imageCard($onPageData);
		//If wasn't searched shows all contributions
			if (empty($onPageData)) {
				strankovani($db, "again", "again");
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
			echo "<a href='view.php?page=".$i."&search=".$URL."' id='li".$i."nk'>".$a."</a>";
			echo "</td>";
		}
		echo "</tr>";
		echo "</table></div>";

		$_SESSION["pages"] = $pages;
	}
?>