<?php
include_once "../base.php";
$today = date("Y-m-d");
$startDate = date("Y-m-d", strtotime("-2 days"));

$movies = $Movie->all(['sh' => 1], " && `ondate` between '$startDate' and '$today' order by rank");
$id = isset($_GET['movie']) ? $_GET['movie'] : 'all';

foreach ($movies as $movie) {
    $selected = ($id == $movie['id']) ? "selected" : "";     
    echo "<option value='{$movie['id']}' $selected>{$movie['name']}</option>";
}
?>