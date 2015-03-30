#!/usr/bin/perl

$host = $ARGV[0];
$db = $ARGV[1];
$usr = $ARGV[2];
$pwd = $ARGV[3];

use DBI();

open(IN,"bvb.xml") or die "can't open bvb.xml\n";

my $dbh=DBI->connect("DBI:mysql:database=$db;host=$host","$usr","$pwd");

$sth11d=$dbh->prepare("DROP TABLE IF EXISTS series");
$sth11d->execute();
$sth11d->finish();

$sth11=$dbh->prepare("CREATE TABLE series(series_name varchar(200), seriesid int(6) auto_increment, primary key(seriesid))auto_increment=10001 ENGINE=MyISAM;");
$sth11->execute();
$sth11->finish(); 

$line = <IN>;

while($line)
{
	if($line =~ /<series>(.*)<\/series>/)
	{
		$series_name = $1;
		insert_series($series_name);
	}
	$line = <IN>;
}

close(IN);
$dbh->disconnect();


sub insert_series()
{
	my($series_name) = @_;

	$series_name =~ s/'/\\'/g;
	
	my($sth,$ref,$sth1);
	$sth = $dbh->prepare("select seriesid from series where series_name='$series_name'");
	$sth->execute();
	$ref=$sth->fetchrow_hashref();
	if($sth->rows()==0)
	{
		$sth1=$dbh->prepare("insert into series values('$series_name',null)");
		$sth1->execute();
		$sth1->finish();
	}
	$sth->finish();	
}
