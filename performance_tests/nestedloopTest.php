<?php

function nestedloop($n) {
  $x = 0;
  for ($a=0; $a<$n; $a++)
    for ($b=0; $b<$n; $b++)
      for ($c=0; $c<$n; $c++)
        for ($d=0; $d<$n; $d++)
          for ($e=0; $e<$n; $e++)
            for ($f=0; $f<$n; $f++)
             $x++;
}

/////////////////////////////////

$time_before = microtime(true);
nestedloop(12);

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";

?>
