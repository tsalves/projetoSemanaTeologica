<?php
	session_start();
	if(strlen($_SESSION['username']) == 0 || $_SESSION['username'] != 'adbitapevi37'){
		echo "<script>alert(Efetue o login na ferramenta!');</script>";
		echo "<script>window.location.href = 'index.php'</script>";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Semana Teológica 2020 - Consulta</title>
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
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <!--===============================================================================================-->
</head>

<body class="scroll">

    <div class="image-header"></div>
    <div class="container-contact100 tela-sucesso">
        <div class="wrap-contact100">
            <span class="contact100-form-title" id="msg-cadastro-sucesso">
                Consulta de Inscritos
            </span>
			
			<div class="col report-screen">
			<a href="resumo.php" id="telaResumo">
				<i class="fa fa-newspaper-o  fa-3x mobile" aria-hidden="true" style="color:#009597; float: left;" data-toggle="tooltip" data-placement="top" title="Resumo por Congregação"></i>
			</a>
			
			</div>
			
			<div class="container-fluid">
				<div class="row">
					<div class="col download-excel">
					<a href="#" id="exportarParaExcel">
						<i class="fa fa-file-excel-o fa-3x mobile" aria-hidden="true" style="color:#009597; float: right;" data-toggle="tooltip" data-placement="top" title="Download Excel"></i>
					</a>
					</div>
				</div>
			</div>
			
            <div class="limiter">
                <div class="container-table100">
                    <div class="wrap-table100">
                        <div class="table100">
                            <table id="consulta" class="resultado-consulta">
                                <thead>
                                    <tr>
                                        <th class="column1"></th>
										<th class="column2"></th>
                                        <th class="column3">nome</th>
                                        <th class="column4">cpf</th>
                                        <th class="column5">congregação</th>
                                        <th class="column6">pagto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- <tr>
                                        <td class="column1"><i class="fa fa-trash-o delete" aria-hidden="true"></i></td>
                                        <td class="column2"><i class="fa fa-pencil-square-o alterar" aria-hidden="true"></i></td>
                                        <td class="column3">Saulo Francisco Barboza Escobar</td>
                                        <td class="column4">220.823.398-07</td>
                                        <td class="column5">Jardim Colinas de São José</td>
                                        <td class="column6">Nok</td>
                                </tr> -->
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
		// Enumerador 
        const AcaoNaTela = {
            DELETE: 'delete',
            EDITAR: 'editar'
        }

		// Função para buscar os usuário no banco
		const getDados = async () => {
			let url = 'http://localhost/semanateologica2020/dados_consulta.php'
			const response = await fetch(url);
				
			try {
				const json = await response.json();
				montaTabela(json);
			} catch (err) {
				const tbody = document.getElementsByTagName('tbody')[0];
				tbody.innerHTML = "";
				console.log(`Ocorreu um erro aqui erro: ${err}`);
			}
		}
		
		// Garante que os dados são exibidos junto com a página
		(function() {
			getDados();

			let btnExportarParaExcel = document.getElementById("exportarParaExcel");
			btnExportarParaExcel.addEventListener('click', function() {
				obterTabela();
			}); 

		}())

		//monta a tabela em tempo de execução
		function montaTabela(data) {
			const tbody = document.getElementsByTagName('tbody')[0];
			tbody.innerHTML = "";
			
			data.forEach(d => {
				//A variavel 'tr' é para montar as linhas da tabela
				let tr = document.createElement('tr');
                tr.setAttribute("id", d.cpf);

				let tdDelete = document.createElement('td');
				let tdEdit = document.createElement('td');
				
				//Variável responspavel por alocar um elemento'i' (icone) do html
				let iDelete  = document.createElement('i');
				let iEdit  = document.createElement('i');
				
				// Essas variáveis correspondem as colunas da tabela
				let tdNome   = document.createElement('td');
				tdNome.setAttribute("contentEditable", true);

				let tdCpf    = document.createElement('td');
				let tdLocal  = document.createElement('td');
				
				let tdStatus = document.createElement('td');
				tdStatus.setAttribute("contentEditable", true);

				iDelete.classList.add("fa");
				iDelete.classList.add("fa-trash-o");
				iDelete.classList.add("delete");
				iDelete.setAttribute("aria-hidden", "true");

				iEdit.classList.add("fa");
				iEdit.classList.add("fa-pencil-square-o");
				iEdit.classList.add("alterar");
				iEdit.setAttribute("aria-hidden", "true");
				
				iDelete.addEventListener('click', function(event) {
                    preparaDados(event, AcaoNaTela.DELETE);
				});

				iEdit.addEventListener('click', function(event) {
                    preparaDados(event, AcaoNaTela.EDITAR);
				});
				
				tdDelete.appendChild(iDelete);
				tdDelete.classList.add("column1");
				tr.appendChild(tdDelete);
                
				tdEdit.appendChild(iEdit);
				tdEdit.classList.add("column2");
				tr.appendChild(tdEdit);
				
				tdNome.classList.add("column3");
				tdNome.innerHTML = d.nome;
				
				tdCpf.classList.add("column4");
				tdCpf.innerHTML = d.cpf;
				
				tdLocal.classList.add("column5");
				tdLocal.innerHTML = d.local;
				
				tdStatus.classList.add("column6");
				tdStatus.innerHTML = d.status;
				
				tr.appendChild(tdNome);
				tr.appendChild(tdCpf);
				tr.appendChild(tdLocal);
				tr.appendChild(tdStatus);
				
				tbody.appendChild(tr);	
			})
			
			AdicionarFiltro("consulta", 5);	
		}
		
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
        
       // Prepara os dados para executar CRUD neste caso somente (Alteração e Exlusão) 
		function preparaDados(e, acao) {
            let params;
            let resposta;

            switch(acao) {
                case 'delete':
                    resposta = confirm(`Deseja mesmo excluir a inscrição do CPF: '${event.target.parentNode.parentNode.id}'?`);

                    if (resposta == true) {
                        params = new URLSearchParams({
                            cpf : event.target.parentNode.parentNode.id,
                            acao : 'delete'
                        });
                        executaCrud(params);
						document.location.reload(true);
                        getDados();
                    }
                break;
                case 'editar':
                    let nome = event.target.parentNode.parentNode.getElementsByTagName('td')[2].textContent.trim();
                    let status = event.target.parentNode.parentNode.getElementsByTagName('td')[5].textContent.trim();
                    
					if(nome.length > 0 && status.length > 0){
						resposta = confirm(`Deseja mesmo alterar os dados do '${nome}'?`);
						if (resposta == true) {
							params = new URLSearchParams({
								cpf : event.target.parentNode.parentNode.id,
								nome : nome,
								status : status,
								acao : 'editar'
							});
							executaCrud(params);
							getDados();
						}
					}else{
						alert("Os campos editáveis não podem estar vazios ou nulos!");
						getDados();
						return;
					}
                    
                break;
            }
		}
		
		//Excuta as ações do CRUD dependendo do parametro
		function executaCrud(params) {
			url = `http://localhost/semanateologica2020/executa_crud.php?${params.toString()}`;
			
			try {
				fetch(url)
					.then(response =>  response.json()) // retorna uma promise
					.then(result =>  {
						
					})
			} catch(err) {
				getDados();
			}
			document.location.reload(true);
		}

		//adiciona os dados para utilização com parentes
		function getParent() {
			let cpf = event.target.parentNode.id;
			let nome = event.target.parentNode.getElementsByTagName('td')[0].textContent;
			let status = event.target.parentNode.getElementsByTagName('td')[2].textContent;
		}
		
		//Contrução da saida para uma planilha em execel
		
		//Recebe informação da tela
		function obterTabela(){
			let trs = document.getElementsByTagName("tbody")[0].getElementsByTagName('tr');
			let obj = [];

			for (let i=0; i < trs.length; i++) {
				if (trs[i].style.display != "none") {
					let tds = trs[i].cells;
					let dadosRelatorio = {
						"nome" : tds[2].textContent,
						"cpf" : tds[3].textContent,
						"congregacao" : tds[4].textContent,
						"status" : tds[5].textContent,
					};
					
					obj.push(dadosRelatorio)
				}
			}

			toExcel(obj);
		}
				
		//monta o excel
		function toExcel(dados){
			let url = `http://localhost/semanateologica2020/para_excel.php`;

			console.log(JSON.stringify(dados));			
			
			fetch(url,{
				method: 'POST',
				headers: { 'Accept': 'application/json', 'Content-Type' : 'application/json'},
				body: JSON.stringify(dados)
			})
			.then((response) => response.blob())
			.then((semanateologica2019) => {	
				let url = window.URL.createObjectURL(semanateologica2019);
				let a   = document.createElement('a');
				a.href  = url;
				a.download = "insc_semanateologica.xlsx";
				document.body.appendChild(a);
				a.click();
				a.remove();
			})
			.catch((err) => { console.log(err); });
		}
		
    </script>

</body>

</html>
