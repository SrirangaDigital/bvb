<?php include("include_header.php");?>
<main class="cd-main-content">
		<div class="cd-scrolling-bg cd-color-2">
			<div class="cd-container">
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['series'])){$series_name = $_GET['series'];}else{$series_name = '';}
if(isset($_GET['seriesid'])){$seriesid = $_GET['seriesid'];}else{$seriesid = '';}

echo '<h1 class="clr1 gapBelowSmall">Archive &gt; Series &gt; ' . $series_name . '</h1>';

$series_name = entityReferenceReplace($series_name);

if(!(isValidSeries($series_name) && isValidSeriesid($seriesid)))
{
	echo '<span class="aFeature clr2">Invalid URL</span>';
	echo '</div> <!-- cd-container -->';
	echo '</div> <!-- cd-scrolling-bg -->';
	echo '</main> <!-- cd-main-content -->';
	include("include_footer.php");

    exit(1);
}

$query = 'select * from article where seriesid=\'' . $seriesid . '\' order by volume, part, page';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		
		$tit_num = preg_replace("/^0/", "", $row['tnum']);
		
		echo '<div class="article">';
		echo '	<div class="gapBelowSmall">';
		echo '		<span class="aIssue clr5"><a href="toc.php?vol=' . $row['volume'] . '&amp;part=' . $row['part'] . '">' . getMonth($row['month']) . ' ' . $row['year'] . '  (Volume ' . intval($row['volume']) . ', Issue ' . $dpart . ')</a></span>';
		echo '	</div>';
		if($row['tnum'] != '')
		{
			echo '	<span class="aTitle"><a target="_blank" href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">' . $tit_num . '.&nbsp;' .  $row['title'] . '</a></span><br />';
		}
		else
		{
			echo '	<span class="aTitle"><a target="_blank" href="../Volumes/' . $row['volume'] . '/' . $row['part'] . '/index.djvu?djvuopts&amp;page=' . $row['page'] . '.djvu&amp;zoom=page">' . $row['title'] . '</a></span><br />';
		}
		if($row['authid'] != 0)
		{
			echo '	<span class="aAuthor itl">by ';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid)
			{
				echo '<a href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">' . $authornames[$a] . '</a> ';
				$a++;
			}
			echo '	</span>';
		}
		echo '</div>';
	}
}

if($result){$result->free();}
$db->close();

?>
			</div> <!-- cd-container -->
		</div> <!-- cd-scrolling-bg -->
	</main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
