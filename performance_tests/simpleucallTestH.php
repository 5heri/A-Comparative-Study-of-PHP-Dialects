<?hh

function hallo($a) {
}
function simpleucall() {
  for ($i = 0; $i < 1000000; $i++) 
    hallo("hallo");
}

/////////////////////////////////

$time_before = microtime(true);
simpleucall();

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";
