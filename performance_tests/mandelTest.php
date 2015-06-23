<?php

function mandel() {
        $w1 = 50; $w2 = 40; $h1 = 150; $h2 = 12;
        $recen = -.45; $imcen = 0.0;
        $r = 0.7; $s = 0; $x = 0; $y = 0;
        $rec = 0; $imc = 0; $re = 0;  $im = 0;  $re2 = 0;  $im2 = 0;
        $color = 0;
        $s = 2 * $r / $w1;
        for ($y = 0; $y <= $w1; $y++) {
                $imc = $s * ($y - $h2) + $imcen;
                for ($x = 0; $x <= $h1; $x++) {
                        $rec = $s * ($x - $w2) + $recen;
                        $re = $rec;
                        $im = $imc;
                        $color = 1000;
                        $re2 = $re * $re;
                        $im2 = $im * $im;
                        while(((($re2 + $im2) < 1000000) && $color>0)) {
                                $im = $re * $im * 2 + $imc;
                                $re = $re2 - $im2 + $rec;
                                $re2 = $re * $re;
                                $im2 = $im * $im;
                                $color = $color - 1;
                        }
                }
        }
}

/////////////////////////////////

$time_before = microtime(true);
mandel();

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";

?>
