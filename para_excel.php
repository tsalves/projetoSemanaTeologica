<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: Content-Type");
	header("Content-type: application/json");

	//autoload do projeto
	require './vendor/autoload.php';

	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Style\Fill;
	use PhpOffice\PhpSpreadsheet\Style\Border;
	
	//classe responsável pela manipulação da planilha
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	
	//classe que salvará a planilha em .xlsx
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	

	$json = json_decode(file_get_contents('php://input'), true);
	
	//instanciando uma nova planilha
	$spreadsheet = new Spreadsheet();
	
	$spreadsheet->getActiveSheet()->setTitle('Inscrição Semana Teológica 2020');
	
	//retornando a aba ativa
	$sheet = $spreadsheet->getActiveSheet();
	$num_linha = 2;
	
	$sheet->setCellValue('A1', 'Nome'); 
	$sheet->setCellValue('B1', 'CPF'); 
	$sheet->setCellValue('C1', 'Congregação');
	$sheet->setCellValue('D1', 'Pagamento');
	
	//foreach element in $arr
	foreach($json as $item) { 
		
		$sheet->setCellValue('A'.$num_linha, $item['nome']); 
		$sheet->setCellValue('B'.$num_linha, $item['cpf']); 
		$sheet->setCellValue('C'.$num_linha, $item['congregacao']); 
		$sheet->setCellValue('D'.$num_linha, $item['status']); 
		
		$num_linha++;
	}
	
	// Redirect output to a client's web browser (Xlsx)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename=$nomeArquivo');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');

	// $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
	$writer = new Xlsx($spreadsheet);
	$writer->save('php://output');
	exit;

?>