<?php
echo "testing";



$link = mysql_connect('localhost', 'rockaway_2013', 'R@ck#20!3');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_close($link);

