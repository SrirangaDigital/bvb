#!/bin/sh

host="localhost"
db="bvb"
usr="root"
pwd="mysql"

echo "drop database if exists bvb; create database bvb;" | /usr/bin/mysql -uroot -p$pwd

perl insert_author.pl $host $db $usr $pwd
perl insert_feat.pl $host $db $usr $pwd
perl insert_series.pl $host $db $usr $pwd
perl insert_articles.pl $host $db $usr $pwd
perl ocr.pl $host $db $usr $pwd
perl searchtable.pl $host $db $usr $pwd

echo "create fulltext index text_index on searchtable (text);" | /usr/bin/mysql -uroot -pmysql $db
