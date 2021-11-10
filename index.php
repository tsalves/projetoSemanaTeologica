<?php
	// error_reporting(0);
	// incluindo a conexão com o banco de dados
	include ('conecta.php');
	
	session_start();
	
	// verifica se os campos de usuário e senha foram preenchidos
	if (isset($_POST['username']) && isset($_POST['pass']))
	{
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$_SESSION['username']=$username;
		$_SESSION['pass']	 =$pass;
		
		$sql = "SELECT usuario, senha FROM tb_user WHERE usuario = '".$username."' AND senha = '".$pass."' ";
		$result = $mysqli -> query($sql);

		if ($result->num_rows > 0) 
		{
			echo "<script>window.location.href = 'cadastro.php'</script>";
		}
		else
		{
			echo "<script>alert('Suas credencias não são válidas, por favor verificar!');</script>";
		}		
	}		
	// FECHA A CONEXÃO COM O BANCO
	$mysqli = null;
	
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Semana Teológica 2020 - Login</title>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/login-util.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg'); background-position: top; background-size: cover;">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					&nbsp;
				</span>
				<form method="POST" class="login100-form validate-form p-b-33 p-t-5" action="">

					<div class="wrap-input100 validate-input" data-validate = "Preencha com o Usuário">
						<input class="input100" type="text" name="username" placeholder="Usuário">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Preencha com a Senha">
						<input class="input100" type="password" name="pass" placeholder="Senha">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<input type="submit" class="login100-form-btn" value='LOGIN'/>
						<!--</button>-->
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/validate.js"></script>

</body>
</html>