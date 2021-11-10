<?php
	//Conecção com o banco de dados
	include ('conecta.php');
	
	$resumo = "select
					trim(tb_congregacao.congregacao) as congregacao,
					count(tb_inscricao_2019.congregacao) as qtd_insc,
					sum(case when tb_inscricao_2019.pagamento = 'Sim' then 1 else 0 end) as qtd_pago
				from
					tb_inscricao_2019 right join tb_congregacao
					  on tb_congregacao.congregacao = tb_inscricao_2019.congregacao
				group by
					  tb_congregacao.congregacao;";

	$con = $mysqli -> query($resumo);
	
	$sql= "select count(tb_congregacao.congregacao) as total from tb_inscricao_2019";
	$total = $mysqli -> query($sql);
	
	// $total_geral = $total;
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Semana Teológica 2020 - Resumo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/table-util.css">
    <link rel="stylesheet" type="text/css" href="css/table-resumo.css">
    <!--===============================================================================================-->
</head>

<body class="scroll">

    <div class="image-header"></div>
    <div class="container-contact100 tela-sucesso">
        <div class="wrap-contact100">
            <span class="contact100-form-title" id="msg-cadastro-sucesso">
                Resumo de Inscritos  
            </span>
			
			<?php
					include('conecta.php');
					
					$sql= "select count(*) as total from tb_inscricao_2019;";
					
					$result = $mysqli -> query($sql);
	
					foreach ($result as $row){
						
						$total = ($row ['total']);
					}			
			?>
			
			<div class="container-fluid">
				<div class="row">
					<div class="col come-back">
						<a href="consulta.php" id="volataParaConsulta">
							<i class="fa fa-mail-reply fa-2x" aria-hidden="true" style="color:#009597; float: left;" data-toggle="tooltip" data-placement="top" title="voltar"></i>
						</a>
                        <div class="resumo-total">
                            <div class="resumo-total-item">Total Geral :  <?php echo($total);?></div>
                            <div id="total-resumo" class="resumo-total-item"></div>
                        </div>
					</div>
				</div>
			</div>
			
            <div class="limiter">
                <div class="container-table100">
                    <div class="wrap-table100">
                        <div class="table100">
                            <table id="resumo" class="resultado-consulta">
                                <thead>
                                    <tr>
                                        <th class="column1">Congregação</th>
                                        <th class="column2">Qtd Insc</th>
                                        <th class="column3">Qtd pgto</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php while($dados = $con->fetch_array()){?>
									<tr>
										<td class="column1"><?php echo utf8_encode($dados["congregacao"]);?></td>
										<td class="column2"><?php echo $dados["qtd_insc"];?></td>
										<td class="column3"><?php echo $dados["qtd_pago"];?></td>
									</tr> 
								<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <!--===============================================================================================-->
    <script>
		// Filtra campos direto da tabela montada na pagina sem intervenção do banco
		function AdicionarFiltro(tabela, coluna) {
            var cols = $("#" + tabela + " thead tr:first-child th").length;
            if ($("#" + tabela + " thead tr").length == 1) {
                var linhaFiltro = "<tr>";
                for (var i = 0; i < cols; i++) {
                    linhaFiltro += "<th></th>";
                }
                linhaFiltro += "</tr>";

                $("#" + tabela + " thead").append(linhaFiltro);
            }

            var colFiltrar = $("#" + tabela + " thead tr:nth-child(2) th:nth-child(" + coluna + ")");

            $(colFiltrar).html("<select id='filtroColuna_" + coluna.toString() + "'  class='filtroColuna'> </select>");

            var valores = new Array();

            $("#" + tabela + " tbody tr").each(function() {
                var txt = $(this).children("td:nth-child(" + coluna + ")").text();
                if (valores.indexOf(txt) < 0) {
                    valores.push(txt);
                }
            });
            $("#filtroColuna_" + coluna.toString()).append("<option>Todos</option>")
            for (elemento in valores) {
                $("#filtroColuna_" + coluna.toString()).append("<option>" + valores[elemento] + "</option>");
            }

            $("#filtroColuna_" + coluna.toString()).change(function() {
                var filtro = $(this).val();
                $("#" + tabela + " tbody tr").show();
                if (filtro != "Todos") {
                    $("#" + tabela + " tbody tr").each(function() {
                        var txt = $(this).children("td:nth-child(" + coluna + ")").text();
                        if (txt != filtro) {
                            $(this).hide();
                        }
                    });
                }
            });
        };
        AdicionarFiltro("resumo", 1);
        
    </script>

</body>

</html>
