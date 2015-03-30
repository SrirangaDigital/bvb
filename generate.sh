#!/bin/sh

host="localhost"
db="bvb"
usr="root"
pwd="mysql"

echo "drop database if exists bvb; create database bvb;" | /usr/bin/mysql -uroot -pmysql

perl insert_author.pl $host $db $usr $pwd
perl insert_feat.pl $host $db $usr $pwd
perl insert_series.pl $host $db $usr $pwd
perl insert_articles.pl $host $db $usr $pwd
