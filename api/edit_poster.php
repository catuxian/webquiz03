<?php
    include_once "../base.php";

    foreach($_POST['id'] as $key=>$id){
        if(isset($_POST['del'])&&in_array($id,$_POST['del'])){
            $Poster->del($id);
        }else{
            $poster=$Poster->find($id);
            $poster['name']=$_POST['name'][$key];
            $poster['ani']=$_POST['ani'][$key];
            $poster['rank']=$_POST['rank'][$key];
            $poster['sh']=in_array($id,$_POST['sh'])?1:0;
            $Poster->save($poster);
        }
    }
    to("../admin.php?do=poster");
?>