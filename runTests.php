<?php

if(!empty($_POST['name'])){
	$name = $_POST['name'];

	$fname = "behavioral_tests/" . $name . "Test.php";

	$zend_out = nl2br(`php $fname`);
	$hhvm_out = nl2br(`hhvm $fname`);
	$hippyvm_out = nl2br(`/usr/src/hippyvm/hippy-c $fname`);

	echo json_encode(array( "zend_out"=>$zend_out,
							 "hhvm_out"=>$hhvm_out,
							 "hippyvm_out"=>$hippyvm_out));
}



?>
