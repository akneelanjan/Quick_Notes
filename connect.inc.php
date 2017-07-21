<?php

if(!@mysql_connect('localhost', 'id2147674_root', 'password') || !@mysql_select_db('id2147674_database')){
	die(mysql_error());
}
	
?>