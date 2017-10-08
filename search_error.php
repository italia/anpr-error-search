<?php 
require 'xlsx_errors_reader.php';
//print_r($array_data);
$code_to_find = htmlspecialchars($_GET['code']);
$found = false;
foreach ($array_data as $key => $code) {
	if($code_to_find === $code['code']){
		$found = $code;
		break;
	}
}
header('Content-Type: application/json');
if ($database === false) {
	echo json_encode(array('result' => -1));
} elseif ($found === false){
	echo json_encode(array('result' => 0));
}
else{
	echo json_encode(array('result' => 1, 'data' => $found ));
}

?>