<?php

include("../php/connect.php");
require_once("../php/common.php");

$volumeQuery = 'select distinct volume from article order by volume';
$volumeResult = $db->query($volumeQuery);

while($volumeRow = $volumeResult->fetch_assoc()) {

	$volume = $volumeRow['volume'];
	var_dump($volume);

	$query = 'select * from searchtable where volume = ' . $volume;

	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;

	$jsonArray = [];

	$fileName = 'source/' . $volume . '.json';

	if($num_rows > 0)
	{
		file_put_contents($fileName, "[\n");
		
		for($i = 1; $i <= $num_rows; $i++) {

			$row = $result->fetch_assoc();
			unset($row['tnum']);
			unset($row['authid']);
			unset($row['featid']);
			unset($row['seriesid']);
			unset($row['page']);
			unset($row['page_end']);
			unset($row['cur_page']);
			unset($row['volume']);
			unset($row['part']);
			unset($row['year']);
			unset($row['month']);

			$rowString = ($i != $num_rows) ? json_encode($row) . ",\n" : json_encode($row);

			file_put_contents($fileName, $rowString, FILE_APPEND);
		}

		file_put_contents($fileName, "\n]", FILE_APPEND);
	}

}

$db->close();

?>
