<?php

	$array_zend = array();
	for ($i = 0; $i < 5; ++$i) {
		$time = `php mandel_typedTest.php`;
		array_push($array_zend, $time);
	}

	$array_hhvm = array();
	for ($i = 0; $i < 5; ++$i) {
		$time = `hhvm mandel_typedTest.php`;
		array_push($array_hhvm, $time);
	}

	$array_hippyvm = array();
	for ($i = 0; $i < 5; ++$i) {
		$time = `/usr/src/hippyvm/hippy-c mandel_typedTest.php`;
		array_push($array_hippyvm, $time);
	}

	$array_hack = array();
	for ($i = 0; $i < 5; ++$i) {
		$time = `hhvm mandel_typedTestH.php`;
		array_push($array_hack, $time);
	}

	$zend_time = round(getBestTime($array_zend), 5);
	$hhvm_time = round(getBestTime($array_hhvm), 5);
	$hippyvm_time = round(getBestTime($array_hippyvm), 5);
	$hack_time = round(getBestTime($array_hack), 5);

	echo json_encode(array("zend_time"=>$zend_time . "s",
							"hhvm_time"=>$hhvm_time . "s",
							"hippyvm_time"=>$hippyvm_time . "s",
							"hack_time"=>$hack_time . "s"));

	function getBestTime($array) {
		sort($array);
		array_pop($array);
		array_pop($array);
		return array_sum($array) / count($array);
	}

?>
