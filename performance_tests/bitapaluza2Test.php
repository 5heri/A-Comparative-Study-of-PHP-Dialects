<?php

function bitapaluza2($x) {
    $a = 1;
    $b = 1 << 63;
    $c = 0;
    $d = 0;
    $e = 0;
    $f = 0;
    for ($i = 0; $i < (1 << $x); $i++) {
        $a <<= 1;
        $b >>= 1;
        $c = $a | $b;
        $d = $a ^ $b;
        $e = $a & $b;
        $f = ~$a;
        $l = 1 << 8;
        while ($l >>= 1) {
            $c = $d << $e;
            $d = $e >> $f;
            $e = $f << $c;
            $f = $c >> $d;
        }
    }
    return $a + $b + $c + $d;
}

/////////////////////////////////

$time_before = microtime(true);
bitapaluza2(18);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";

?>
