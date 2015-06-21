<?php

	function search_input($source, $VUNS) {
		$tokens = token_get_all($source);
		$vun_found = array();
		foreach ($tokens as $token) {
 			if (!is_string($token)) {
    			list($id, $text) = $token;

    			if (in_array($text, $VUNS)) {
     				array_push($vun_found, $text);
    			}

    			//if (should_check($id)) {
      				//foreach($A_VUNS as $current) {
      					//if (in_array($text, $VUNS)) {
    						/*if (strpos($VUNS, "/var/www/html/website/tmp/") !== false) {

    						}
      						array_push($vun_found, $text);
      						array_push($vun_found, "<br>");
      					//}*/
      				//}
    			//}
  			}
		}
		//array_push($vun_found, "test");
		return $vun_found;
	}

	function print_blocked($arr) {
		$out_text = "The following functions are blocked:<br>";
		$out_text = $out_text . $arr[0];

		for ($i = 1; $i < count($arr); ++$i) {
			$out_text = $out_text . ", " . $arr[$i];
		}
		return $out_text;
	}

?>
