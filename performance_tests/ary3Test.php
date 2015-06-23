<?php

function ary3($n) {
  for ($i=0; $i<$n; $i++) {
    $X[$i] = $i + 1;
    $Y[$i] = 0;
  }
  for ($k=0; $k<1000; $k++) {
    for ($i=$n-1; $i>=0; $i--) {
      $Y[$i] += $X[$i];
    }
  }
  $last = $n-1;
}

/////////////////////////////////

$time_before = microtime(true);
ary3(50000);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";


?>
