<?php

	//exec("php tmp/zend/test.php", $out, $exit);

	//print_r ($out);
	//echo $exit;

	$fname = "test.php";

	$data = "

while (TRUE) {
    echo 'running';
}

";



	$fname = "tmp/zend/" . $fname;	
	$file = fopen($fname, 'w');
	fwrite($file, "<?php\nset_time_limit(3);\nini_set('memory_limit','256K');\n" . $data . " \n?>" );
	fclose($file);

			//$zend_out = `php $fname`;
	exec("php $fname", $out, $exit);
	print_r($out);
	echo $exit;
//	exec("php $fname", $out, $zend_exit_code);



?>
