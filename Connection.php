<?php
	$conn = pg_connect("postgres://ovspvcwyuvnndd:fb6dde992449fd3e0a0c3aa5fbfa59064663feb2f69a44ae841232790e462a6f@ec2-3-227-149-67.compute-1.amazonaws.com:5432/d3ebce9jtal3sh")
	or die ("can not connect database".pg_connect_error());
?>