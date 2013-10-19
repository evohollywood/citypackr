<?php
$link = mysql_connect('localhost', 'root', 'tyfoid40');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$q1 = 'USE pievscake_db';

$r1 = mysql_query($q1);


?>