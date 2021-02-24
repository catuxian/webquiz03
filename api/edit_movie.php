<?php
include_once "../base.php";


    echo $_FILES['trailer']['tmp_name'];

    if(!empty($_FILES['trailer']['tmp_name'])){
        move_uploaded_file($_FILES['trailer']['tmp_name'],"../img".$_FILES['trailer']['name']);
        $_POST['trailer']=$_FILES['trailer']['name'];
    }
    
    if(!empty($_FILES['poster']['tmp_name'])){
        move_uploaded_file($_FILES['poster']['tmp_name'],"../img".$_FILES['poster']['name']);
        $_POST['poster']=$_FILES['poster']['name'];
    }

    $Movie->save($_POST);

    to("../admin.php?do=movie");

?>