<?php

function mandel_typed()
{
  $w1=50.0;
  $h1=150.0;
  $recen=-.45;
  $imcen=0.0;
  $r=0.7;
  $s=0.0;  $rec=0;  $imc=0.0;  $re=0.0;  $im=0.0;  $re2=0.0;  $im2=0.0;
  $x=0.0;  $y=0.0;  $w2=0.0;  $h2=0.0;  $color=0;
  $s=2*$r/$w1;
  $w2=40.0;
  $h2=12.0;
  for ($y=0.0 ; $y<=$w1; $y=$y+1.0) {
    $imc=$s*($y-$h2)+$imcen;
    for ($x=0 ; $x<=$h1; $x=$x+1) {
      $rec=$s*($x-$w2)+$recen;
      $re=$rec;
      $im=$imc;
      $color=1000;
      $re2=$re*$re;
      $im2=$im*$im;
      while ( ((($re2+$im2)<1000000.0) && $color>0)) {
        $im=$re*$im*2+$imc;
        $re=$re2-$im2+$rec;
        $re2=$re*$re;
        $im2=$im*$im;
        $color=$color-1;
      }
    }
  }
}

/////////////////////////////////

$time_before = microtime(true);
mandel_typed();

$time_after = microtime(true);
printf('%.7f', $time_after - $time_before);
echo "\n";

?>
