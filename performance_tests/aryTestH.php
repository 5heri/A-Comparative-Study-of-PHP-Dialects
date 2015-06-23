<?hh

function ary($n) {
  for ($i=0; $i<$n; $i++) {
    $X[$i] = $i;
  }
  for ($i=$n-1; $i>=0; $i--) {
    $Y[$i] = $X[$i];
  }
  $last = $n-1;
}

/////////////////////////////////

$time_before = microtime(true);
ary(50000);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";

