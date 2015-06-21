<?php

include 'InputConfig.php';

$source = file_get_contents('test.php');
$tokens = token_get_all($source);

//

//print_r($tokens);

//

$holder = array();

foreach ($tokens as $token) {
  if (!is_string($token)) {
    list($id, $text) = $token;
    echo  token_name($id) . " # " . $text . "\n";
    if (in_array($text, $A_VUNS)) {
      array_push($holder, $text);
    }
  }
}

function should_check($current_id) {
  return $current_id == T_STRING;
}

echo "#######\n";
print_r($holder);

?>
