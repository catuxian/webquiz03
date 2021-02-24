<?php
    include_once "../base.php";

    $sess=[
        1=>"14:00~16:00",
        2=>"16:00~18:00",
        3=>"18:00~20:00",
        4=>"20:00~22:00",
        5=>"22:00~24:00",
    ];

    $movie=$Movie->find($_GET['movie']);
    $date=$_GET['date'];
    $now=date("G");

    if($now<=13){
        $startSess=1;
    }else{
        $startSess=ceil(($now-13)/2)+1;
    }
    
    $start=($date==date("Y-m-d"))?$startSess:1;

    for($i=$start;$i<=5;$i++){
        $sum=$Orders->q("select sum(`qt`) from `ord` where `movie`={$movie['name']} && `date`=$date && `session`='{$sess[$i]}'")[0][0];
        $last=20-$sum;
        echo "<option value='$i'>{$sess[$i]} 剩餘座位 $last</option>";
    }
?>