<?hh

function fibo_r($n){
    return(($n < 2) ? 1 : fibo_r($n - 2) + fibo_r($n - 1));
}
function fibo($n) {
  $r = fibo_r($n);
}

/////////////////////////////////

$time_before = microtime(true);
fibo(30);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";


