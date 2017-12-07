<?php

include("php/connect.php");
require_once("php/common.php");

// Write bvb.json
writeMetadataJson($db);

// Write authors.json
writeAuthorJson($db);

// // Write source for text search
// writeTextJson($db);


// Functions

function writeMetadataJson($db) {

	$query = "SELECT * FROM article ORDER BY titleid";
	$result = $db->query($query); 
	$num_rows = $result ? $result->num_rows : 0;

	$data = [];
	if($num_rows > 0) {

		while($row = $result->fetch_assoc()) {

			unset($row['authid']);
			$row['authornames'] = explode(';', $row['authorname']);
			unset($row['authorname']);
			$row['date'] = $row['year'] . '-' . $row['month'] . '-' . $row['date'];
			unset($row['month']);

			$row['page'] = getRelativePage($row['volume'], $row['part'], $row['page']);
			unset($row['page_end']);
			unset($row['page_range']);

			array_push($data, $row);
		}
	}

	$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	$json = str_replace('&amp;', '&', $json);

	echo (file_put_contents('/home/sriranga/Documents/node/bvb/public/data/bvb.json', $json)) ? 'bvb.json written' . "\n" : 'Error in writing bvb.json' . "\n";
}

function writeAuthorJson($db) {

	$query = "SELECT * FROM author ORDER BY authorname";
	$result = $db->query($query); 
	$num_rows = $result ? $result->num_rows : 0;

	$authors = [];
	if($num_rows > 0) {

		while($row = $result->fetch_assoc()) {

			unset($row['authid']);
			$row['author'] = $row['authorname'];
			unset($row['authorname']);
			array_push($authors, $row);
		}
	}

	$json = json_encode($authors, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

	echo (file_put_contents('/home/sriranga/Documents/node/bvb/public/data/authors.json', $json)) ? 'authors.json written' . "\n" : 'Error in writing authors.json' . "\n";
}

function writeTextJson($db) {

	$queryVol = "SELECT DISTINCT volume FROM article ORDER BY volume";
	$resultVol = $db->query($queryVol); 

	while($rowVol = $resultVol->fetch_assoc()) {

		$volumeData = [];
		$volume = $rowVol['volume'];

		echo 'Processing Volume ' . $volume . ': Issues - ';;

		$queryPart = "SELECT DISTINCT part FROM article WHERE volume='" . $volume . "' ORDER BY part";
		$resultPart = $db->query($queryPart); 

		while($rowPart = $resultPart->fetch_assoc()) {

			$part = $rowPart['part'];

			echo  $part . " ";

			$query = "SELECT * FROM article WHERE volume='" . $volume . "' and part='" . $part . "' ORDER BY titleid";
			$result = $db->query($query); 

			while($row = $result->fetch_assoc()) {

				$queryText = "SELECT * FROM testocr WHERE volume='" . $volume . "' AND part='" . $part . "' AND cur_page BETWEEN '" . $row['page'] . "' AND '" . $row['page_end'] . "'";
				$resultText = $db->query($queryText); 

				$text = [];
				while($rowText = $resultText->fetch_assoc()) {

					$text['pageid'] = $row['titleid'] . '|' . $rowText['relative_page'];
					$text['text'] = $rowText['text'];

					array_push($volumeData, $text);
				}
			}
		}

		echo "\n";

		$json = json_encode($volumeData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		echo (file_put_contents('/var/www/html/bvb/source/' . $volume . '.json', $json)) ? 'source/' . $volume . '.json written' . "\n" : 'Error in writing source/' . $volume . '.json' . "\n";
	}
}

function getRelativePage($volume, $part, $page) {

	$path = 'Text/' . $volume . '/' . $part . '/';
	$pages = glob($path . '*.txt');

	sort($pages, SORT_STRING);
	$relativePage = array_search('Text/' . $volume . '/' . $part . '/' . $page . '.txt', $pages);

	$relativePage = ($relativePage) ? $relativePage + 1 : intval($page);

	return $relativePage;
}


?>