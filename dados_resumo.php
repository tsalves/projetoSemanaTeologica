<?php
	//Coneção com o banco de dados
	include('conecta.php');

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: Content-Type");
	header("Content-type: application/json");

	$sql = "select
				tb_congregacao.congregacao,
				count(tb_inscricao_2019.congregacao) as qtd_insc,
				sum(case when tb_inscricao_2019.pagamento = 'Sim' then 1 else 0 end) as qtd_pago
			from
				tb_inscricao_2019 right join tb_congregacao
				  on tb_congregacao.congregacao = tb_inscricao_2019.congregacao
			group by";

	$data = $mysqli -> query($sql);

	foreach ($data as $row) {	  
	$array_result[] = array(
						  "congregacao"   => $row['congregacao'],
						  "qtd_insc"      => $row['qtd_insc'],
						  "qtd_pago"  	  => $row['qtd_pago']
					  );
	}  	
	echo json_encode($array_result);
?>