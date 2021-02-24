<?php include_once "../base.php";



$Orders->del([$_POST['type']=>$_POST['value']]);

?>