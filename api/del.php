<?php

include_once "../base.php";

$db=new DB('ord');
$db->del($_POST['id']);
print_r($_POST);

?>