<?php

function foo($a) {
	$a = 5;
	return func_get_arg(0);
}

echo foo(2) . "\n";

?>
