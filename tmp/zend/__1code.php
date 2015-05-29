<?php 
set_time_limit(3);
ini_set('memory_limit','64K');
$time_before___1 = microtime(true);



<?php

    echo "helo";
?>

$time_after___1 = microtime(true);
echo '
';
echo printf('%.7f', $time_after___1 - $time_before___1);
 
?>