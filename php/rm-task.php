<?php

require_once('util.php');

$remove = $_GET["remove"] ?? null;
if ($remove === null) {
  $json = json_encode(['status' => 'Tarefa não removida!']);
} else {
  rmTask($remove);
  $json = json_encode(['status' => 'Tarefa removida com sucesso!']);
}
header('Content-type: application/json; charset=UTF-8');
echo $json;