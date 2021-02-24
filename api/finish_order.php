<?php
print_r($_POST);
include_once "../base.php";
$sess = [
    1 => "14:00~16:00",
    2 => "16:00~18:00",
    3 => "18:00~20:00",
    4 => "20:00~22:00",
    5 => "22:00~24:00",

];
$data['movie'] = $Movie->find($_POST['movie'])['name'];
$data['date'] = $_POST['date'];
sort($_POST['seats']); //將seats排序
$data['seat'] = serialize($_POST['seats']);
$data['qt'] = count($_POST['seats']);
$data['session'] = $sess[$_POST['session']];
$n = $Orders->q('select max(`id`) from `ord`')[0][0] + 1;
$data['no'] = date("Ymd") . sprintf("%04d", $n);

$Orders->save($data);

?>
