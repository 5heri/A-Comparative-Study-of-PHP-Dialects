<?php

function handle_output($out, $kind, $fname, $buffer, $ip, $O_TAGS, $O_UTIL) {
	$trusted_out = $out;

	switch ($kind) {
    case "zend":
    	$trusted_out = location_checking($trusted_out, $O_TAGS, $fname);
        break;	
    case "hhvm":
    	$trusted_out = location_checking($trusted_out, $O_TAGS, $fname);
        break;
    case "hippyvm":
    	$trusted_out = hippyvm_traceback($trusted_out);
    	$trusted_out = hippyvm_praseError($trusted_out);
    	$trusted_out = location_checking($trusted_out, $O_TAGS, $fname);
        break;
    case "hack":
    	$trusted_out = location_checking($trusted_out, $O_TAGS, $fname);
    	break;
    default:
    	return $out;
	}

	foreach ($O_UTIL as $util_tags) {
		$trusted_out = str_replace($util_tags . $ip, "", $trusted_out);
	}
	return fixLineNumbers($trusted_out, $buffer);
}

function location_checking($out, $O_TAGS, $fname) {
	foreach ($O_TAGS as $tag) {
		$out = str_replace($tag . $fname, "", $out);
	}
	return $out;
}

function fixLineNumbers($string, $buffer_exists) {
	$start = strpos($string, "on line");
	$end = strlen($string);

	if (!$start) {
		return $string;
	} else {
		$start += 8;
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

function handle_hippyvm_special($exec_hippyvm) {
	if (strpos($exec_hippyvm[0], "In function") !== false) {
		array_shift($exec_hippyvm);
		array_shift($exec_hippyvm);
	}
	if (strpos($exec_hippyvm[count($exec_hippyvm) - 1], "E: Child terminated")) {
		array_pop($exec_hippyvm);
	}
}

function hippyvm_traceback($error_out) {
	$start = strpos($error_out, "RPython traceback:");
	$end = strpos($error_out, "...");
	if (!$start || !$end) {
		return $error_out;
	}
	return substr($error_out, 0, $start) . " ". substr($error_out, $end + 3, strlen($error_out));
}

function hippyvm_praseError($error_out) {
	if (strpos($error_out, "Parse error") !== false) {
		$error_out = "Parse error";
	}
	return $error_out;
}

?>