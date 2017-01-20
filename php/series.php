<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
				<h1 class="clr1 gapBelowSmall">Archive &gt; Series</h1>
<?php

include("connect.php");
require_once("common.php");

$query = "select * from series order by TRIM(BOTH '`' FROM TRIM(BOTH '``' FROM series_name))";

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		echo ($row['series_name'] == '') ? '' : '<div class="author"><span class="aAuthor"><a href="ser.php?series=' . urlencode($row['series_name']) . '&amp;seriesid=' . $row['seriesid'] . '">' . $row['series_name'] . '</a></div>';
	}
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
