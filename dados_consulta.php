<?php
	//Coneção com o banco de dados
	include('conecta.php');

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: Content-Type");
	header("Content-type: application/json");

	$sql = "SELECT 
				nome,
				cpf,
				congregacao,
				case 
					when pagamento is null then 
						'Não' 
				else 
					pagamento 
				end as pagamento
		  FROM
				tb_inscricao_2019";

	$data = $mysqli -> query($sql);

	foreach ($data as $row) {	  
	$array_result[] = array(
						  "nome"   => $row['nome'],
						  "cpf"    => $row['cpf'],
						  "local"  => $row['congregacao'],
						  "status" => $row['pagamento']
					  );
	}  	
	echo json_encode($array_result);
?>