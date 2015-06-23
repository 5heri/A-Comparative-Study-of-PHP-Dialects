<?php

function hash1($n) {
  for ($i = 1; $i <= $n; $i++) {
    $X[dechex($i)] = $i;
  }
  $c = 0;
  for ($i = $n; $i > 0; $i--) {
    if ($X[dechex($i)]) { $c++; }
  }
}

/////////////////////////////////

$time_before = microtime(true);
hash1(50000);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";


?>
