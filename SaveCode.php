<?php
	if(!empty($_POST['data'])){
		$data = $_POST['data'];
		$zend = $_POST['zend'];
		$hhvm = $_POST['hhvm'];
		$hippyvm = $_POST['hippyvm'];
		$hack = $_POST['hack'];

		$fname = "code.php";

		$zend_time_before;
		$zend_time_after;
		$zend_time;
		$zend_out = NULL;

		if ($zend == TRUE) {
			$fname = "dialects/zend/code.php";
			$file = fopen($fname, 'w');
			fwrite($file, "<?php " . $data . " ?>" );
			fclose($file);

			$zend_time_before = microtime(true);
			$zend_out = `php dialects/zend/code.php`;
			$zend_time_after = microtime(true);

			$zend_time = round($zend_time_after - $zend_time_before, 5);

			`rm dialects/zend/code.php`;
		}

		$hhvm_time_before;
		$hhvm_time_after;
		$hhvm_time;
		$hhvm_out = NULL;

		if ($hhvm == TRUE) {
			$fname = "dialects/hhvm/code.php";
			$file = fopen($fname, 'w');
			fwrite($file, "<?php " . $data . " ?>" );
			fclose($file);

			$hhvm_time_before = microtime(true);
			$hhvm_out = `php dialects/hhvm/code.php`;
			$hhvm_time_after = microtime(true);

			$hhvm_time = round($hhvm_time_after - $hhvm_time_before, 5);

			`rm dialects/hhvm/code.php`;
		}

		$hippyvm_time_before;
		$hippyvm_time_after;
		$hippyvm_time;
		$hippyvm_out = NULL;

		if ($hippyvm == TRUE) {
			$fname = "dialects/hippyvm/code.php";
			$file = fopen($fname, 'w');
			fwrite($file, "<?php " . $data . " ?>" );
			fclose($file);

			$hippyvm_time_before = microtime(true);
			$hippyvm_out = `php dialects/hippyvm/code.php`;
			$hippyvm_time_after = microtime(true);

			$hippyvm_time = round($hippyvm_time_after - $hippyvm_time_before, 5);

			`rm dialects/hippyvm/code.php`;
		}

		$hack_time_before;
		$hack_time_after;
		$hack_time;
		$hack_out = NULL;

		if ($hack == TRUE) {
			$fname = "dialects/hack/code.php";
			$file = fopen($fname, 'w');
			/*fwrite($file, "<?hh " . $data . " ?>" );*/
			fwrite($file, "<?php " . $data . " ?>" );   // until hhvm is not used
			fclose($file);

			$hack_time_before = microtime(true);
			$hack_out = `php dialects/hack/code.php`;
			$hack_time_after = microtime(true);

			$hack_time = round($hack_time_after - $hack_time_before, 5);

			`rm dialects/hack/code.php`;
		}

		echo json_encode(array("zend_out"=>$zend_out, "zend_time"=>$zend_time,
							   "hhvm_out"=>$hhvm_out, "hhvm_time"=>$hhvm_time,
							   "hippyvm_out"=>$hippyvm_out, "hippyvm_time"=>$hippyvm_time,
							   "hack_out"=>$hack_out, "hack_time"=>$hack_time));
		//echo $zend_time . " " . $hhvm_time . " " . $hippyvm_time . " " . $hack_time;

	}
?>
