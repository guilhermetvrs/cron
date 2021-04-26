<?php

require_once(__DIR__.'/../database/config.php');

function ins($minute, $hour, $day, $month, $weekDay, $task){

try {
  $schema = file_get_contents('../database/schema.sql');
  $connection = new PDO(DB.":host=".DBHOST, DBUSER, DBPWD);
  $connection->exec($schema);
  echo "Database installed!";
  // header('Location: home.php');;
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

$sql = "INSERT INTO `bkp` (`minute`, `hour`, `day`, `month`, `weekDay`, `task`)
VALUES ($minute, $hour, $day, $month, $weekDay, $task)";

$connection->exec($sql);
}