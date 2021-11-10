<?php
  //Coneção com o banco de dados
  include('conecta.php');
  
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: Content-Type");
	header("Content-type: application/json");

	$cpf     = $_GET['cpf'];
	$acao    = $_GET['acao'];
	$nome    = $_GET['nome'];
	$status  = $_GET['status'];

	if ($acao == "delete") {
		$sql = "DELETE FROM `tb_inscricao_2019` WHERE `cpf` = '".$cpf."'";
	}

	if ($acao == "editar") {
		if (strlen($nome) > 0 && strlen($status) > 0 ){
			$sql = "UPDATE `tb_inscricao_2019` SET `nome`= '" .$nome."', `pagamento` = '" .$status."' WHERE `cpf` = '".$cpf."'";
		}
		else{
			error_log;
		}
	}
	
	$mysqli->query($sql);
?>


	