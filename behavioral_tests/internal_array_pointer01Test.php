<?php

$arrayOuter = array("key1", "key2");
$arrayInner = array("0", "1");

while (list(, $o) = each($arrayOuter)) {
	$placeholder = $arrayInner;

	while (list(,$i) = each($arrayInner)) {
		echo "$o, $i\n";
	}
}

?>
