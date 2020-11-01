<?php
	header("Content-Type: application/json; charset=UTF-8");
	$obj = json_decode($_GET["x"],true);
	
	$data_write = $obj["data"];
	$write_index = $obj["index"];
	
	$data_read = array();
	$storage_read = fopen("storage_B.txt", "r");
	$raw_data_read = fgets($storage_read);
	fclose($storage_read);
	
	$data_read = json_decode($raw_data_read,true);
	
	$data_read[$write_index] = $data_write;
	
	$JSON = json_encode($data_read);
	
	$storage_write = fopen("storage_B.txt", "w+");
	fwrite($storage_write, $JSON);
	fclose($storage_write);
?>