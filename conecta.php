<?php

// exemplo de conexão comum
// mysqli_connect("10.210.1.127","root","","semanateologica2019");

// conecta com o banco de dados
// $mysqli = new mysqli("10.210.1.127", "root", "", "semanateologica2019");
// $mysqli = new PDO('mysql:host=localhost;dbname=semanateologica2019', 'root', '');
	$mysqli = new mysqli("localhost", "root", "", "semanateologica2019");

// verifica se a conexão foi bem sucedida
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

?>