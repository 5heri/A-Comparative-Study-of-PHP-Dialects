<?php
	if(!empty($_POST['data'])){
		$data = $_POST['data'];
		$zend = $_POST['zend'];
		$hhvm = $_POST['hhvm'];
		$hippyvm = $_POST['hippyvm'];
		$hack = $_POST['hack'];

		$start_tag = $_POST['start'];

		$ip = getIP();

		$fname_top = $ip . "code.php";

		$data = addUtilCode($data, $ip);

		$zend_out = NULL;

		if ($zend == TRUE) {
			$fname = "tmp/zend/" . $fname_top;	
			$file = fopen($fname, 'w');
			fwrite($file, "<?php \n" . $data . " \n?>" );
			fclose($file);

			exec("php $fname", $out, $zend_exit_code);

			if ($zend_exit_code == 0) {
				for ($i = 0; $i < count($out) - 1; ++$i) {
					if ($i == 0) {
						$zend_out = $out[0];
					} else {
						$zend_out = $zend_out . "\n" . $out[$i];
					}
				}
				$zend_time = $out[count($out) - 1] . "s";
			} else {
				$zend_out = $out[count($out) - 1];
				$zend_time = NULL;
			}

			//`rm $fname`;
		}

		$hhvm_out = NULL;

		if ($hhvm == TRUE) {
			$fname = "tmp/hhvm/" . $fname_top;	
			$file = fopen($fname, 'w');
			fwrite($file, "<?php \n" . $data . " \n?>" );
			fclose($file);

			exec("hhvm $fname", $out, $hhvm_exit_code);

			if ($hhvm_exit_code == 0) {
				for ($i = 0; $i < count($out) - 1; ++$i) {
					if ($i == 0) {
						$hhvm_out = $out[0];
					} else {
						$hhvm_out = $hhvm_out . "\n" . $out[$i];
					}
				}
				$hhvm_time = $out[count($out) - 1] . "s";
			} else {
				$hhvm_out = $out[count($out) - 1] . "  " . $hhvm_exit_code;
				$hhvm_time = NULL;
			}

			//`rm $fname`;
		}

		$hippyvm_out = NULL;

		if ($hippyvm == TRUE) {
			$fname = "tmp/hippyvm/code.php";
			$file = fopen($fname, 'w');
			fwrite($file, "<?php " . $data . " ?>" );
			fclose($file);

			$hippyvm_time_before = microtime(true);
			$hippyvm_out = `/usr/src/hippyvm/hippy-c tmp/hippyvm/code.php`;
			$hippyvm_time_after = microtime(true);

			$hippyvm_time = round($hippyvm_time_after - $hippyvm_time_before, 5);

			`rm tmp/hippyvm/code.php`;
		}

		$hack_time_before;
		$hack_time_after;
		$hack_time;
		$hack_out = NULL;

		if ($hack == TRUE) {
			$fname = "tmp/hack/code.php";
			$file = fopen($fname, 'w');
			fwrite($file, "<?hh " . $data);
			/*fwrite($file, "<?php " . $data . " ?>" );*/   // until hhvm is not used
			fclose($file);

			$hack_time_before = microtime(true);
			$hack_out = `hhvm tmp/hack/code.php`;
			$hack_time_after = microtime(true);

			$hack_time = round($hack_time_after - $hack_time_before, 5);

			`rm tmp/hack/code.php`;
		}

		echo json_encode(array("zend_out"=>$zend_out, "zend_time"=>$zend_time,
							   "hhvm_out"=>$hhvm_out, "hhvm_time"=>$hhvm_time,
							   "hippyvm_out"=>$hippyvm_out, "hippyvm_time"=>$hippyvm_time,
							   "hack_out"=>$hack_out, "hack_time"=>$hack_time));

	}

	function getIP() {
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
 		   $ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
    		$ip = $_SERVER['REMOTE_ADDR'];
		}
		$ip = str_replace(":", "_", $ip);
		$ip = str_replace(".", "_", $ip);
		return $ip;
	}

	function addUtilCode($data, $ip) {
		$data = "$" . "time_before_$ip = microtime(true);\n" . $data;
		$data = "set_time_limit(3);\nini_set('memory_limit','64K');\n" . $data; 
		$data = $data . "\n$" . "time_after_$ip = microtime(true);\n"; 
		$data = $data . str_replace("n", "\n", "echo 'n';");
		$data = $data . "\necho printf('%.7f', " . "$" . "time_after_$ip - " . "$" . "time_before_$ip);\n";

		return $data;
	}

	function substring($str, $start, $end) {
		return substr($str, $start, $end - $start);
	}
?>
