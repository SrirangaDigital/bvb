<?php

include("../php/connect.php");
require_once("../php/common.php");

$query = 'select * from searchtable order by volume, part, page limit 15000';

$result = $db->query($query);
$num_rows = $result ? $result->num_rows : 0;

$jsonArray = [];

if($num_rows > 0)
{
	while($row = $result->fetch_assoc()) {

		array_push($jsonArray, $row);
	}
}

if($result){$result->free();}
$db->close();

// var_dump(json_encode($jsonArray));

file_put_contents('source.json', json_encode($jsonArray));

?>
