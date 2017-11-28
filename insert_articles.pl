#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();
@ids=();

open(IN,"<:utf8","bvb.xml") or die "can't open bvb.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth_enc=$dbh->prepare("set names utf8");
$sth_enc->execute();
$sth_enc->finish();

#vnum, number, month, year, title, feature, authid, page, 

$sth11d=$dbh->prepare("DROP TABLE IF EXISTS article");
$sth11d->execute();
$sth11d->finish();

$sth11r=$dbh->prepare("CREATE TABLE article(title varchar(500),
tnum varchar(10),
authid varchar(200),
authorname varchar(1000),
feature varchar(500),
series varchar(500),
page varchar(10), 
page_end varchar(10), 
page_range varchar(100), 
volume varchar(3),
part varchar(10),
year varchar(10), 
month varchar(10),
date varchar(10),
titleid varchar(100), primary key(titleid)) ENGINE=MyISAM character set utf8 collate utf8_general_ci");
$sth11r->execute();
$sth11r->finish();

$line = <IN>;

while($line)
{
	if($line =~ /<volume vnum="(.*)">/)
	{
		$volume = $1;
		print $volume . "\n";
	}
	elsif($line =~ /<part pnum="(.*)" date="(.*)" month="(.*)" year="(.*)" cover="(.*)">/)
	{
		$part = $1;
		$date = $2;
		$month = $3;
		$year = $4;
		$count = 1;
		$prev_pages = "";
	}	
	elsif($line =~ /<title num="(.*)">(.*)<\/title>/)
	{
		$tnum = $1;
		$title = $2;
	}
	elsif($line =~ /<feature>(.*)<\/feature>/)
	{
		$feature = $1;
		$featid = get_featid($feature);
	}	
	elsif($line =~ /<series>(.*)<\/series>/)
	{
		$series = $1;
		$seriesid = get_seriesid($series);
	}	
	elsif($line =~ /<page>(.*)<\/page>/)
	{
		$page_range = $1;
		($page, $page_end) = split(/-/, $page_range);
		$id = "bvb_" . $volume . "_" . $part . "_" . $page_range . "_" . $count++; 
	}
	elsif($line =~ /<author type="(.*)">(.*)<\/author>/)
	{
		$authorname = $2;
		$authids = $authids . ";" . get_authid($authorname);
		$author_name = $author_name . ";" .$authorname;
	}
	elsif($line =~ /<allauthors \/>/)
	{
		$authids = "0";
		$author_name = "";
	}
	elsif($line =~ /<\/entry>/)
	{
		insert_article($title,$tnum,$authids,$author_name,$feature,$series,$page,$page_end,$page_range,$volume,$part,$year,$month,$date,$id);
		$authids = "";
		$feature = "";
		$series = "";
		$author_name = "";
		$id = "";
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();

sub insert_article()
{
	my($title,$tnum,$authids,$author_name,$feature,$series,$page,$page_end,$page_range,$volume,$part,$year,$month,$date,$id) = @_;
	my($sth1);

	$title =~ s/'/\\'/g;
	$feature =~ s/'/\\'/g;
	$series =~ s/'/\\'/g;
	$authids =~ s/^;//;
	$author_name =~ s/^;//;
	$author_name =~ s/'/\\'/g;
	
	$sth1=$dbh->prepare("insert into article values('$title','$tnum','$authids','$author_name','$feature','$series','$page','$page_end','$page_range','$volume','$part','$year','$month','$date','$id')");
	
	$sth1->execute();
	$sth1->finish();
}

sub get_authid()
{
	my($authorname) = @_;
	my($sth,$ref,$authid);

	$authorname =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select authid from author where authorname='$authorname'");
	$sth->execute();

	my $ref = $sth->fetchrow_hashref();
	$authid = $ref->{'authid'};
	$sth->finish();
	return($authid);
}

sub get_featid()
{
	my($feature) = @_;
	my($sth,$ref,$featid);

	$feature =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select featid from feature where feat_name='$feature'");
	$sth->execute();

	my $ref = $sth->fetchrow_hashref();
	$featid = $ref->{'featid'};
	$sth->finish();
	return($featid);
}

sub get_seriesid()
{
	my($series) = @_;
	my($sth,$ref,$seriesid);

	$series =~ s/'/\\'/g;
	
	$sth=$dbh->prepare("select seriesid from series where series_name='$series'");
	$sth->execute();

	my $ref = $sth->fetchrow_hashref();
	$seriesid = $ref->{'seriesid'};
	$sth->finish();
	return($seriesid);
}
