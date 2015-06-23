<?php

function strcat($n) {
  $str = "";
  while ($n-- > 0) {
    $str .= "hello\n";
  }
  $len = strlen($str);
}

/////////////////////////////////

$time_before = microtime(true);
strcat(200000);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";

?>
