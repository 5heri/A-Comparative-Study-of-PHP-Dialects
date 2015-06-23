<?hh

function simpleudcall() {
  for ($i = 0; $i < 1000000; $i++) 
    hallo2("hallo");
}
function hallo2($a) {
}

/////////////////////////////////

$time_before = microtime(true);
simpleudcall();

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";


