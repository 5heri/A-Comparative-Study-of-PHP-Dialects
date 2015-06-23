<?hh

function jumpapaluza($x, $y) {
    $result = 1.0;
    for ($i = 0; $i < $x; $i++) {
        for ($j = 0; $j < $y; $j++) {
            for ($k = 0; $k < $x; $k++) {
                for ($m = 0; $m < $y; $m++) {
                    $result = $result * 1.0001;
                }
            }
        }
    }

    return $result;
}

/////////////////////////////////

$time_before = microtime(true);
jumpapaluza(50, 50);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";
