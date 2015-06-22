<?php

	$array_zend = array();
	for ($i = 0; $i < 5; ++$i) {
		$time = `php php01Test.php`;
		array_push($array_zend, $time);
	}

	$array_hhvm = array();
	for ($i = 0; $i < 5; ++$i) {
		$time = `hhvm php01Test.php`;
		array_push($array_hhvm, $time);
	}

	$array_hippyvm = array();
	for ($i = 0; $i < 5; ++$i) {
		$time = `/usr/src/hippyvm/hippy-c php01Test.php`;
		array_push($array_hippyvm, $time);
	}

	$array_hack = array();
	for ($i = 0; $i < 5; ++$i) {
		$time = `hhvm php01TestH.php`;
		array_push($array_hack, $time);
	}

	$zend_time = getBestTime($array_zend);
	$hhvm_time = getBestTime($array_hhvm);
	$hippyvm_time = getBestTime($array_hippyvm);
	$hack_time = getBestTime($array_hack);

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
