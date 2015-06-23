<?php

$arr = [1, 2, 3, 4, 5];
$obj = (object) [6, 7, 8, 9, 10];

$ref = &$arr;
foreach ($ref as $val) {
	echo "$val\n";
	if ($val === 3) {
		$ref = $obj;
	}
}

?>
