<?php
	function strankovani($db, $ID){
		include_once "lib.php";

	//Total of contributions and distribution on pages
		$onPage = 2;

		$select = array(':uploader' => $ID, );

		$sql_All = "SELECT COUNT(*) FROM galery_photos WHERE uploader = :uploader";

		$sql_cmd_count = $db->prepare($sql_All);
		$sql_cmd_count->execute($select);
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

	//Downloading informations
		if ($getPage || $getPage == 0) {
			$onPageData = selectByUploader($db, $ID, $getPage, $onPage);
			imgEdit($onPageData);
		}

	//Links
		$onRow = 10;

		echo "<div class='numbers'><table class='middle'>";
		echo "<tr>";
		for ($i=0; $i < $pages; $i++) { 
			$a = $i + 1;
			if ($i % $onRow == 0) {
				echo "</tr>";
				echo "<tr>";
			}
			echo "<td class='href'>";
			echo "<a href='edit.php?page=".$i."' id='li".$i."nk'>".$a."</a>";
			echo "</td>";
		}
		echo "</tr>";
		echo "</table></div>";
	}
?>