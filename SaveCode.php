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

		if ($zend === "true") {
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
						$zend_out = $zend_out . "<br>" . $exec_out_zend[$i];
					}
				}
				$zend_time = $exec_out_zend[count($exec_out_zend) - 1] . "s";
			} else {
				//$zend_out = $exec_out_zend[count($exec_out_zend) - 1];
				//$zend_time = NULL;

				/*for ($i = 0; $i < count($exec_out_zend); ++$i) {
					if (strcmp($exec_out_zend[$i], "") != 0) {
						if ($i == 0) {
							$zend_out = $exec_out_zend[0];
						} else {
							$zend_out = $zend_out . "<br>" . $exec_out_zend[$i];
						}
					}
				}*/
				$is_first_zend = true;
				for ($i = 0; $i < count($exec_out_zend); ++$i) {
					if (strcmp($exec_out_zend[$i], "") != 0) {
                		if ($is_first_zend) {
                     		$zend_out = $exec_out_zend[$i];
                     		$is_first_zend = false;
                		} else {
                     		$zend_out = $zend_out . "<br>" . $exec_out_zend[$i];
                		}
					}
				}
				while(strpos($zend_out, "/var/www/html/website/tmp/") !== false) {
					$zend_out = errorPrinter($zend_out);
				}
				while (strpos($zend_out, "on line") !== false) {
					$zend_out = fixLineNumbers($zend_out, $start_tag);	
				}
				$zend_time = NULL;
			}

			

			//`rm $fname`;
		}

		$hhvm_out = NULL;

		if ($hhvm === "true") {
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
						$hhvm_out = $hhvm_out . "<br>" . $exec_out_hhvm[$i];
					}
				}
				$hhvm_time = $exec_out_hhvm[count($exec_out_hhvm) - 1] . "s";
			} else {
				//$hhvm_out = $exec_out_hhvm[count($exec_out_hhvm) - 1];
				//$hhvm_time = NULL;

				/*for ($i = 0; $i < count($exec_out_hhvm); ++$i) {
					if (strcmp($exec_out_hhvm[$i], "") != 0) {
						if ($i == 0) {
							$hhvm_out = $exec_out_hhvm[0];
						} else {
							$hhvm_out = $hhvm_out . "<br>" . $exec_out_hhvm[$i];
						}
					}
				}*/
				$is_first_hhvm = true;
				for ($i = 0; $i < count($exec_out_hhvm); ++$i) {
					if (strcmp($exec_out_hhvm[$i], "") != 0) {
                		if ($is_first_hhvm) {
                     		$hhvm_out = $exec_out_hhvm[$i];
                     		$is_first_hhvm = false;
                		} else {
                     		$hhvm_out = $hhvm_out . "<br>" . $exec_out_hhvm[$i];
                		}
					}
				}


				while(strpos($hhvm_out, "/var/www/html/website/tmp/") !== false) {
					$hhvm_out = errorPrinter($hhvm_out);
				}
				while (strpos($hhvm_out, "on line") !== false) {
					$hhvm_out = fixLineNumbers($hhvm_out, $start_tag);	
				}
				$hhvm_time = NULL;
			}

			//$hhvm_out = $exec_out_hhvm;

			//`rm $fname`;
		}

		$hippyvm_out = NULL;

		if ($hippyvm === "true") {
			$fname = "tmp/hippyvm/" . $fname_top;	
			$file = fopen($fname, 'w');
			fwrite($file, "<?php \n" . $data . " \n?>" );
			fclose($file);

			exec("/usr/src/hippyvm/hippy-c $fname 2>&1", $exec_out_hippyvm, $hippyvm_exit_code);

			if ($hippyvm_exit_code == 0) {
				for ($i = 0; $i < count($exec_out_hippyvm) - 1; ++$i) {
					if ($i == 0) {
						$hippyvm_out = $exec_out_hippyvm[0];
					} else {
						$hippyvm_out = $hippyvm_out . "<br>" . $exec_out_hippyvm[$i];
					}
				}
				$hippyvm_time = $exec_out_hippyvm[count($exec_out_hippyvm) - 1] . "s";
			} else {
				//$hippyvm_out = $exec_out_hippyvm[count($exec_out_hippyvm) - 1];
				//$hippyvm_time = NULL;

				/*for ($i = 0; $i < count($exec_out_hippyvm); ++$i) {
					if (strcmp($exec_out_hippyvm[$i], "") != 0) {
						if ($i == 0) {
							$hippyvm_out = $exec_out_hippyvm[0];
						} else {
							$hippyvm_out = $hippyvm_out . "<br>" . $exec_out_hippyvm[$i];
						}
					}
				}*/
				if (strpos($exec_out_hippyvm[0], "In function") !== false) {
					$exec_out_hippyvm[0] = "";
				}
				$is_first_hippyvm = true;
				for ($i = 0; $i < count($exec_out_hippyvm); ++$i) {
					if (strcmp($exec_out_hippyvm[$i], "") != 0) {
                		if ($is_first_hippyvm) {
                     		$hippyvm_out = $exec_out_hippyvm[$i];
                     		$is_first_hippyvm = false;
                		} else {
                     		$hippyvm_out = $hippyvm_out . "<br>" . $exec_out_hippyvm[$i];
                		}
					}
				}
				while(strpos($hippyvm_out, "tmp/hippyvm") !== false) {
					$hippyvm_out = errorPrinterHippyvm($hippyvm_out);
				}
				$hippyvm_out = errorPrinterHippyvmCaseTrace($hippyvm_out);
				if (strpos($hippyvm_out, "Parse error") === false) {
					$hippyvm_out = "Parse error";
				} else {
					$hippyvm_out = rtrim($hippyvm_out, ":");
				}
				$hippyvm_time = NULL;
			}

			//$hippyvm_out = $exec_out_hippyvm;
			//`rm $fname`;
		}

		$hack_out = NULL;

		if ($hack === "true") {
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
						$hack_out = $hack_out . "<br>" . $exec_out_hack[$i];
					}
				}
				$hack_time = $exec_out_hack[count($exec_out_hack) - 1] . "s";
			} else {
				//$hack_out = $exec_out_hack[count($exec_out_hack) - 1];
				//$hack_time = NULL;

				/*for ($i = 0; $i < count($exec_out_hack); ++$i) {
					if (strcmp($exec_out_hack[$i], "") != 0) {
						if ($i == 0) {
							$hack_out = $exec_out_hack[0];
						} else {
							$hack_out = $hack_out . "<br>" . $exec_out_hack[$i];
						}
					}
				}*/

				$is_first_hack = true;
				for ($i = 0; $i < count($exec_out_hack); ++$i) {
					if (strcmp($exec_out_hack[$i], "") != 0) {
                		if ($is_first_hack) {
                     		$hack_out = $exec_out_hack[$i];
                     		$is_first_hack = false;
                		} else {
                     		$hack_out = $hack_out . "<br>" . $exec_out_hack[$i];
                		}
					}
				}
				while (strpos($hack_out, "/var/www/html/website/tmp/") !== false) {
					$hack_out = errorPrinter($hack_out);
				}
				while (strpos($hack_out, "on line") !== false) {
					$hack_out = fixLineNumbers($hack_out, $start_tag);	
				}
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

	function errorPrinter($error_out) {
		$start = strpos($error_out, "/var/www/html/website/tmp/");
		$end = strlen($error_out);

		if (!$start) {
			return $error_out;
		}

		for ($i = $start; $i < strlen($error_out) - 1; ++$i) {
			if ($error_out{$i + 1} == ' ') {
				$end = $i;
				break;
			}
		}
		return substr($error_out, 0, $start - 3) . " ". substr($error_out, $end + 1, strlen($error_out));
	}

	function errorPrinterHippyvmCaseTrace($error_out) {
		$start = strpos($error_out, "RPython traceback:");
		$end = strpos($error_out, "...");
		if (!$start || !$end) {
			return $error_out;
		}
		return substr($error_out, 0, $start) . " ". substr($error_out, $end + 3, strlen($error_out));
	}

	function errorPrinterHippyvm($error_out) {
		$start = strpos($error_out, "tmp/hippyvm");
		$end = strlen($error_out);

		if (!$start) {
			return $error_out; 
		}

		for ($i = $start; $i < strlen($error_out) - 1; ++$i) {
			if ($error_out{$i + 1} == ' ') {
				$end = $i;
				break;
			}
		}
		return substr($error_out, 0, $start - 3) . " ". substr($error_out, $end + 1, strlen($error_out));
	}

	function fixLineNumbers($string, $buffer_exists) {
		$start = strpos($string, "on line") + 8;
		$end = strlen($string);

		if (!$start) {
			return $string;
		}

		for ($i = $start; $i < strlen($string) - 1; ++$i) {
			if ($string{$i + 1} == '<' || $string{i + 1} == ' ') {
				$end = $i;
				break;
			}
		}
		$actual_value = substr($string, $start, $end - $start + 1) - 4;
		if ($buffer_exists === "true") {
			$actual_value++;
		}

		$actual_string = substr($string, 0, $start) . $actual_value . substr($string, $end + 1, strlen($string));

		return $actual_string;
	}

	/*function isAlpa() {

	}*/

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
