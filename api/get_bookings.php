<?php
include_once "../base.php";

$sess = [
    1 => "14:00~16:00",
    2 => "16:00~18:00",
    3 => "18:00~20:00",
    4 => "20:00~22:00",
    5 => "22:00~24:00",
];

$movie = $Movie->find($_GET['movie']);
$date = $_GET['date'];
$session = $_GET['session'];

$orders = $Orders->all(['movie' => $movie['name'], 'date' => $date, 'session' => $sess[$session]]);
$seats = [];
foreach ($orders as $order) {
    $tmp = unserialize($order['seat']);
    $seats = array_merge($seats, $tmp);
}
?>

<style>
    .seat-block {
        width: 315px;
        height: 340px;
        display: flex;
        flex-wrap: wrap;
    }

    .seat {
        width: 63px;
        height: 85px;
    }

    .booked {
        background: url('icon/03D03.png') center no-repeat;
    }

    .empty {
        background: url('icon/03D02.png') center no-repeat;
    }
</style>
<div class="seat-block">
    <?php
    for ($i = 0; $i < 20; $i++) {
        $status = (in_array($i, $seats)) ? 'booked' : 'empty';
    ?>
        <div class="seat <?= $status; ?>">
            <?= floor(($i / 5) + 1) ?>排<?= $i % 5 + 1; ?>號
            <?= (!in_array($i, $seats)) ? "<input type='checkbox' value='$i' class='chk'>" : ''; ?>
        </div>
    <?php
    }
    ?>
</div>
<div>您選擇的電影是：<?= $movie['name']; ?></div>
<div>您選擇的時刻是：<?= $date; ?> <?= $sess[$session]; ?></div>
<div>您已經勾選<span id='ticket'></span>張票，最多可以購買四張票</div>
<div class="ct">
    <button onclick="javascript:$('.order,.booking').toggle()">上一步</button><button onclick="finish()">訂購</button>
</div>

<script>
    let seats=new Array();

$('.chk').on("click",function(){
    let s=$(this).val();
    
    
    if($(this).prop('checked')){
        seats.push(s);

        if(seats.length>4){
            alert("最多只能購買四張票");
            seats.splice(seats.indexOf(s),1)//在seats陣列中，找出s的位置並移除
            $(this).prop('checked',false)
        }
        $("#ticket").text(seats.length)
    }else{
        seats.splice(seats.indexOf(s),1)
        $("#ticket").text(seats.length)
    }
})
function finish(){
    let movie=$("#movie").val();
    let date=$("#date").val();
    let session=$("#session").val();

    $.post("api/finish_order.php",{seats,movie,date,session},(num)=>{
        console.log(num)
        location.href="index.php?do=finish&num="+num;
    })
}
</script>