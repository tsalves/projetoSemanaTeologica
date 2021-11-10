<?php
	//Coneção com o banco de dados
	include ('conecta.php');
	
	session_start();
	
	if(strlen($_SESSION['username']) == 0 )
	{
		echo "<script>alert(Efetue o login na ferramenta!');</script>";
		echo "<script>window.location.href = 'index.php'</script>";
	}
	if($_SESSION['username'] == 'adbitapevi37'){
		echo "<script>window.location.href = 'consulta.php'</script>";
	}
	
	if(isset($_POST['cpf']))
	{
		$cpf = $_POST['cpf'];
		
		$valida_cpf = "SELECT cpf FROM tb_inscricao_2019 where cpf = '".$cpf."'";
		$result = $mysqli -> query($valida_cpf);
		
		if($result->num_rows > 0)
		{
			echo "<script>alert('O CPF: $cpf já estava cadastrado!');</script>";
			echo "<script>window.location.href = 'cadastro.php'</script>";
		}
	}
	
	if(!empty($_POST['fone']) && empty($_POST['email']))
	{
		$fone  = $_POST['fone'];
		// $nome  = utf8_decode($_POST['nome']);
		$nome  = $_POST['nome'];
		$congregacao = $_POST['congregacao'];
		// $congregacao = utf8_decode($_POST['congregacao']);
		$sql   = "INSERT INTO tb_inscricao_2019 (nome,cpf,congregacao,telefone) VALUES ('".$nome."','$cpf','$congregacao','$fone')";
		$res   = $mysqli -> query($sql);
		
		echo "<script>window.location.href = 'sucesso.html'</script>";
	}
	elseif (!empty($_POST['email']) && empty($_POST['fone']))
	{
		$email = $_POST['email'];
		$sql   = "INSERT INTO tb_inscricao_2019 (nome,cpf,congregacao,email) VALUES ('".$nome."','$cpf','$congregacao','$email')";
		$res = $mysqli -> query($sql);
		echo "<script>window.location.href = 'sucesso.html'</script>";
	}
	else
	{
		if(isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['congregacao']) && isset($_POST['fone']) && isset($_POST['email']))
		{
			$fone  = $_POST['fone'];
			$email = $_POST['email'];
			// $email = utf8_decode($_POST['email']);
			$nome  = $_POST['nome'];
			// $nome  = utf8_decode($_POST['nome']);
			$congregacao = $_POST['congregacao'];
			// $congregacao = utf8_decode($_POST['congregacao']);
			$sql   = "INSERT INTO tb_inscricao_2019 (nome,cpf,congregacao,telefone,email) VALUES ('".$nome."','$cpf','$congregacao','$fone','$email')";
			$res = $mysqli -> query($sql);
			echo "<script>window.location.href = 'sucesso.html'</script>";
		}	
	}
	
	$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Semana Teológica 2020 - Inscrição</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
    <!--===============================================================================================-->
</head>

<body class="scroll">

    <div class="image-header"></div>
    <div class="container-contact100">
        <div class="wrap-contact100">
            <form method="POST" class="contact100-form" name="form_contato" action="">
                <span class="contact100-form-title">
                    Inscrição Semana Teológica 2020
                </span>

                <span class="contact100-form-description">
                    Após fazer sua inscrição lembre-se de que deve levar o valor da matrícula até o día 15/01/2020
                </span>

                <span class="contact100-form-required">
                    *Campo obrigatório
                </span>


                <div class="wrap-input100">
                    <span class="label-input100">Nome<span class="red">*</span></span>
                    <input class="input100" type="text" name="nome" id="nome" onkeypress="clearAlert(); return Onlychars(event)" placeholder="Digite seu nome">
                    <span class="focus-input100"></span>

                </div>
                <p class="alert" id="msg-name"></p>

                <div class="wrap-input100 validate-input" data-validate="Por favor, digite seu CPF.">
                    <span class="label-input100">CPF<span class="red">*</span></span>
                    <input class="input100" type="text" name="cpf" id="cpf" onkeypress="clearAlert()" placeholder="Digite seu CPF">
                    <span class="focus-input100"></span>
                </div>
                <p class="alert" id="msg-cpf"></p>

                <div class="wrap-input100 input100-select validate-input">
                    <span class="label-input100">Congregação<span class="red">*</span></span>
                    <div>
                        <select class="selection-2" name="congregacao" id="congregacao" onchange="clearAlert()">
						
                            <option value=""> Congregação... </option>
                            <option value="Alabama">Alabama</option>
                            <option value="Alto Da Colina">Alto da Colina</option>
                            <option value="Amador Bueno 1">Amador Bueno 1</option>
                            <option value="Amador Bueno 2">Amador Bueno 2</option>
                            <option value="Ambuitá">Ambuitá</option>
                            <option value="Areião">Areião</option>
                            <option value="Bela Vista Alta">Bela Vista Alta</option>
                            <option value="Bela Vista Baixa 1">Bela Vista Baixa 1</option>
                            <option value="Bela Vista Baixa 2">Bela Vista Baixa 2</option>
                            <option value="Briquet 1">Briquet 1</option>
                            <option value="Briquet 2">Briquet 2</option>
                            <option value="Cohab 2">Cohab 2</option>
                            <option value="Colinas São José">Colinas São José</option>
                            <option value="Engenheiro Cardoso">Engenheiro Cardoso</option>
                            <option value="itapuã">Itapuã</option>
                            <option value="Nova Cotia">Nova Cotia</option>
                            <option value="Paulista">Paulista</option>
                            <option value="Pedra Branca">Pedra Branca</option>
                            <option value="Rainha">Rainha</option>
                            <option value="Recanto Paulistano">Recanto Paulistano</option>
                            <option value="Roselândia">Roselândia</option>
                            <option value="Rosemary">Rosemary</option>
                            <option value="Ruth">Ruth</option>
                            <option value="Sabiá">Sabiá</option>
                            <option value="Santa Cecilia 1">Santa Cecília 1</option>
                            <option value="Santa Cecilia 2">Santa Cecília 2</option>
                            <option value="Santa Flora">Santa Flora</option>
                            <option value="Santa Rita">Santa Rita</option>
                            <option value="São Carlos">São Carlos</option>
                            <option value="Sede">Sede</option>
                            <option value="Suburbano 1">Suburbano 1</option>
                            <option value="Suburbano 2">Suburbano 2</option>
                            <option value="Vitápolis">Vitápolis</option>
                            <option value="Outras Denominações">Outras denominações</option>

                        </select>
                    </div>
                    <span class="focus-input100"></span>
                </div>
                <p class="alert" id="msg-congregacao"></p>

                <div class="wrap-input100 validate-input" data-validate="Por favor, digite seu telefone.">
                    <span class="label-input100">Número de Telefone</span>
                    <input class="input100" type="text" name="fone" id="fone" placeholder="Digite seu telefone">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Por favor, digite um e-mail válido: ex@abc.xyz">
                    <span class="label-input100">E-mail</span>
                    <input class="input100" type="text" name="email" id="email" placeholder="Digite seu  e-mail">
                    <span class="focus-input100"></span>
                </div>

                <div class="container-contact100-form-btn">
                    <div class="wrap-contact100-form-btn">
                        <div class="contact100-form-bgbtn"></div>
                        <button class="contact100-form-btn" onclick="return validar_form_contato()">
                            <span>
                                Enviar
                                <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });

    </script>
    <!--===============================================================================================-->
    <!--script src="js/main.js"></script-->
    <script src="js/principal.js"></script>

    <script>
        $(document).ready(function() {
            $("#cpf").mask('999.999.999-99'); // máscara para o CPF
            $("#fone").mask('(99) 99999-9999'); // máscara para o Telefone

        });

    </script>
    <!--===============================================================================================-->
    <script src="js/validator.min.js"></script>

</body>

</html>
