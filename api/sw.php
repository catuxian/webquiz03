<?php
    include_once "../base.php";

    print_r($_POST);
    $table=$_POST['table'];
    $db=new DB($table);

    $x=$db->find($_POST['x']);
    $y=$db->find($_POST['y']);
    $t=$x['rank'];
    $x['rank']=$y['rank'];
    $y['rank']=$t;

    $db->save($x);
    $db->save($y);
    
?>