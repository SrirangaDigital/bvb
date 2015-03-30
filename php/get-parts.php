<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['volume'])){$volume = $_GET['volume'];}else{$volume = '';}

if(!(isValidVolume($volume)))
{
	exit(1);
}

$query = "select distinct part, month, date from article where volume='$volume' order by part";
$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
echo '<div id="issueHolder" class="issueHolder">';
$row_count = 14;
$count = 0;
$col = 1;

if($num_rows > 0)
{
	echo '<div class="issue">';
	while($row = $result->fetch_assoc())
	{
		$count++;
		if($count > $row_count)
		{
			echo '</div>';
			echo '<div class="issue">';
			$count = 1;
		}
		$ddate = preg_replace('/^0/', '', $row['date']);
		echo '<div class="aIssue"><a href="toc.php?vol=' . $volume . '&amp;part=' . $row['part'] . '">' .  getMonth($row['month']) . '&nbsp;' . $ddate . '</a></div>';
	}
	echo '</div>';
}

echo '</div>';

if($result){$result->free();}
$db->close();

?>
