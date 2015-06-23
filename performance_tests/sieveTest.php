<?php

function sieve($n) {
  $count = 0;
  while ($n-- > 0) {
    $count = 0;
    $flags = range (0,8192);
    for ($i=2; $i<8193; $i++) {
      if ($flags[$i] > 0) {
        for ($k=$i+$i; $k <= 8192; $k+=$i) {
          $flags[$k] = 0;
        }
        $count++;
      }
    }
  }
}

/////////////////////////////////

$time_before = microtime(true);
sieve(30);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";


?>
