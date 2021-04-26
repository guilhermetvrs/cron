<?php

require_once('util.php');
require_once('inserir.php');

$minute = $_GET["minute"] ?? null;
$hour = $_GET["hour"] ?? null;
$day = $_GET["day"] ?? null;
$month = $_GET["month"] ?? null ;
$weekDay = $_GET["weekDay"] ?? null;
$task = $_GET['task'] ?? null;

ins($minute, $hour, $day, $month, $weekDay, $task);

addTask($minute, $hour, $day, $month, $weekDay, $task);

header('Content-type: application/json; charset=UTF-8');
echo $json;
