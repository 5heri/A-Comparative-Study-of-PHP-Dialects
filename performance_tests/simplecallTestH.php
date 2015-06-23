<?hh

function simplecall() {
  for ($i = 0; $i < 1000000; $i++) 
    strlen("hallo");
}

////////

$time_before = microtime(true);
simplecall();

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";



