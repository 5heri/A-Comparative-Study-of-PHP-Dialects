<?hh

function Ack($m, $n){
  if($m == 0) return $n+1;
  if($n == 0) return Ack($m-1, 1);
  return Ack($m - 1, Ack($m, ($n - 1)));
}
function ackermann($n) {
  $r = Ack(3,$n);
}

$time_before = microtime(true);
ackermann(7);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";

