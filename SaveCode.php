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

			exec("php $fname 2>&1", $exec_out_zend, $zend_exit_code);

			if ($zend_exit_code == 0) {
				for ($i = 0; $i < count($exec_out_zend) - 1; ++$i) {
					if ($i == 0) {
						$zend_out = $exec_out_zend[0];
					} else {
						$zend_out = $zend_out . "\n" . $exec_out_zend[$i];
					}
				}
				$zend_time = $exec_out_zend[count($exec_out_zend) - 1] . "s";
			} else {
				$zend_out = $exec_out_zend[count($exec_out_zend) - 1];
				$zend_time = NULL;
			}

			$zend_out = $exec_out_zend;

			//`rm $fname`;
		}

		$hhvm_out = NULL;

		if ($hhvm == TRUE) {
			$fname = "tmp/hhvm/" . $fname_top;	
			$file = fopen($fname, 'w');
			fwrite($file, "<?php \n" . $data . " \n?>" );
			fclose($file);

			exec("hhvm $fname 2>&1", $exec_out_hhvm, $hhvm_exit_code);

			if ($hhvm_exit_code == 0) {
				for ($i = 0; $i < count($exec_out_hhvm) - 1; ++$i) {
					if ($i == 0) {
						$hhvm_out = $exec_out_hhvm[0];
					} else {
						$hhvm_out = $hhvm_out . "\n" . $exec_out_hhvm[$i];
					}
				}
				$hhvm_time = $exec_out_hhvm[count($exec_out_hhvm) - 1] . "s";
			} else {
				$hhvm_out = $exec_out_hhvm[count($exec_out_hhvm) - 1];
				$hhvm_time = NULL;
			}

			//$hhvm_out = $exec_out_hhvm;

			//`rm $fname`;
		}

		$hippyvm_out = NULL;

		if ($hippyvm == TRUE) {
			$fname = "tmp/hippyvm/" . $fname_top;	
			$file = fopen($fname, 'w');
			fwrite($file, "<?php \n" . $data . " \n?>" );
			fclose($file);

			exec("/usr/src/hippyvm/hippy-c $fnamem 2>&1", $exec_out_hippyvm, $hippyvm_exit_code);

			if ($hippyvm_exit_code == 0) {
				for ($i = 0; $i < count($exec_out_hippyvm) - 1; ++$i) {
					if ($i == 0) {
						$hippyvm_out = $exec_out_hippyvm[0];
					} else {
						$hippyvm_out = $hippyvm_out . "\n" . $exec_out_hippyvm[$i];
					}
				}
				$hippyvm_time = $exec_out_hippyvm[count($exec_out_hippyvm) - 1] . "s";
			} else {
				$hippyvm_out = $exec_out_hippyvm[count($exec_out_hippyvm) - 1];
				$hippyvm_time = NULL;
			}

			//$hippyvm_out = $exec_out_hippyvm;
			//`rm $fname`;
		}

		$hack_out = NULL;

		if ($hack == TRUE) {
			$fname = "tmp/hack/" . $fname_top;	
			$file = fopen($fname, 'w');
			fwrite($file, "<?hh \n" . $data);
			fclose($file);

			exec("hhvm $fname 2>&1", $exec_out_hack, $hack_exit_code);

			if ($hack_exit_code == 0) {
				for ($i = 0; $i < count($exec_out_hack) - 1; ++$i) {
					if ($i == 0) {
						$hack_out = $exec_out_hack[0];
					} else {
						$hack_out = $hack_out . "\n" . $exec_out_hack[$i];
					}
				}
				$hack_time = $exec_out_hack[count($exec_out_hack) - 1] . "s";
			} else {
				$hack_out = $exec_out_hack[count($exec_out_hack) - 1];
				$hack_time = NULL;
			}
			//$hack_out = $exec_out_hack;
			//`rm $fname`;
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
