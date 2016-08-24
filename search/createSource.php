<?php

include("../php/connect.php");
require_once("../php/common.php");

$query = 'select * from searchtable order by volume, part, page limit 50000';

$result = $db->query($query);
$num_rows = $result ? $result->num_rows : 0;

$jsonArray = [];

if($num_rows > 0)
{
	file_put_contents('source.json', "[\n");
	
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

		file_put_contents('source.json', $rowString, FILE_APPEND);
	}

	file_put_contents('source.json', "\n]", FILE_APPEND);
}

if($result){$result->free();}
$db->close();

?>
