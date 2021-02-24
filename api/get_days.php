<?php
    include_once "../base.php";
    $movie=$Movie->find($_GET['movie']);

    $today=strtotime(date("Y-m-d"));
    $startDay=strtotime($movie['ondate']);

    for($i=0;$i<3;$i++){
        $showDay=strtotime("+$i days",$startDay);
        if($showDay>=$today){
            echo "<option value='".date("Y-m-d",$showDay)."'>".date("m月d日l",$showDay)."</option>";
        }
    }
?>