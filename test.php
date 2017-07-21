<?php 

require 'core.inc.php';
require 'connect.inc.php';

$name = $_POST['name'];
$id = $_POST['id'];

$delete = "DELETE FROM `$name` WHERE `id`='$id' ";
$delete_run = mysql_query($delete);


var_dump($delete);
?>
