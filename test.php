<?php
$con = mysql_connect("localhost", "mwe", "Lut0nT0wn2012");
if (!$con) {
	echo 'Could not connect: ' . mysql_error();
}
else {
	echo 'connected!';
}
?>