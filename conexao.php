<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto_cadastro";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>