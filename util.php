<?php

function getTasks() {
  $cronsContent = shell_exec('crontab -l');
  $cronsArray = [];
  foreach (explode("\n", $cronsContent) as $cronLine) {
     preg_match('/([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) ([^ ]+) (.+)/', $cronLine, $in);
     if(isset($in[6])){
       $cronsArray[] = [
         "minute" => $in[1],
         "hour" => $in[2],
         "day" => $in[3],
         "month" => $in[4],
         "weekDay" => $in[5],
         "task" => $in[6],
       ];
     }
  }
  return $cronsArray;
}

function addTask($minute, $hour, $day, $month, $weekDay, $task) {
  $crontab = "$minute $hour $day $month $weekDay $task";
  $crontabContent = shell_exec('crontab -l');

  shell_exec("crontab <<EOF
${crontabContent}${crontab}
EOF");

}

function rmTask($remove) {
  $crontabContent = shell_exec('crontab -l');
  $crontabContent = explode("\n", $crontabContent);
  foreach($crontabContent as $lineNumber => $line) {
    if($lineNumber === intval($remove))
      unset($crontabContent[$lineNumber]);
  }
  $crontabContent = implode("\n", $crontabContent);
  shell_exec("crontab <<EOF
${crontabContent}
EOF");
}
?>