<?php 

ini_set('memory_limit', '16M');
set_time_limit(0);
require_once dirname(__FILE__) . '/classes/PHPExcel.php';

$stream = file_get_contents("https://www.anpr.interno.it/portale/documents/20182/26001/errori_anpr+28092017.xlsx/88075662-10c0-479e-8824-f00e5755e792");

// database is false if xlsx file is not found
if ($stream === false) {
	$database = false;
	$array_data = array();
} else {
	$database = true;

file_put_contents("errors.xlsx", $stream);

$filename = "errors.xlsx";

$fileType = 'Excel2007';

// Read the file
$objReader = PHPExcel_IOFactory::createReader($fileType);
$objReader = PHPExcel_IOFactory::createReaderForFile($filename);
$objReader->setReadDataOnly(true);
$objReader->load($filename);
$objPHPExcel = $objReader->load( $filename );

$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();

$sheet = $objPHPExcel->getActiveSheet();

$array_data = array();
foreach($rowIterator as $row){
	$cellIterator = $row->getCellIterator();
	$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
	if($row->getRowIndex() <= 2) continue;//skip first row
	$rowIndex = $row->getRowIndex();
	$array_data[$rowIndex] = array( 'code'=>'', 
									'desc'=>'',
									'ref_table'=>'',
									'sub_severity'=>'',
									'sub_note' =>'',
									'serv_severity' =>'',
									'serv_note' =>'',
									'last_var' => '');
	
	foreach ($cellIterator as $cell) {
		switch ($cell->getColumn()) {
			case 'A':
				$array_data[$rowIndex]['code'] = $cell->getCalculatedValue();
				break;
			case 'B':
			$array_data[$rowIndex]['desc'] = $cell->getCalculatedValue();
			break;
			case 'C':
			$array_data[$rowIndex]['ref_table'] = $cell->getCalculatedValue();
			break;
			case 'D':
			$array_data[$rowIndex]['sub_severity'] = $cell->getCalculatedValue();
			break;
			case 'E':
			$array_data[$rowIndex]['sub_note'] = $cell->getCalculatedValue();
			break;
			case 'F':
			$array_data[$rowIndex]['serv_severity'] = $cell->getCalculatedValue();
			break;
			case 'G':
			$array_data[$rowIndex]['serv_note'] = $cell->getCalculatedValue();
			break;
			case 'H':
			$array_data[$rowIndex]['last_var'] = $cell->getCalculatedValue();
			break;

		}
	}
}

}
?>