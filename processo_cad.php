<?php
session_start();
require 'conexao.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$nome = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['password'] ?? '';

if ($nome === '') {
    header('Location: cadastro.php?erro=nome_vazio');
    exit();
}

if (strlen($nome) > 66) {
    header('Location: cadastro.php?erro=nome_longo');
    exit();
}

if ($email === '') {
    header('Location: cadastro.php?erro=email_vazio');
    exit();
}

if (strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: cadastro.php?erro=email_invalido');
    exit();
}

$dominio = substr(strrchr($email, "@"), 1);
if (!checkdnsrr($dominio, "MX")) {
    header('Location: cadastro.php?erro=email_dominio');
    exit();
}

if ($senha === '') {
    header('Location: cadastro.php?erro=senha_vazia');
    exit();
}

if (strlen($senha) < 8 || strlen($senha) > 20) {
    header('Location: cadastro.php?erro=senha_invalida');
    exit();
}

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, email_verificado) VALUES (?, ?, ?, 1)");
    $stmt->bind_param("sss", $nome, $email, $senha_hash);
    $stmt->execute();
    $stmt->close();

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['EMAIL_USERNAME'];
        $mail->Password = $_ENV['EMAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($_ENV['EMAIL_USERNAME'], 'GuilhermeDev');
        $mail->addAddress($email, $nome);

        $mail->isHTML(true);
        $mail->Subject = 'Bem-vindo(a) ao meu projeto!';
        $mail->Body = "<h2>Olá, $nome!</h2>
                      <p>Seja muito bem-vindo(a) ao meu site.</p>
                      <p>Aqui você poderá acessar com seus dados e visualizar o restante do meu projeto.</p>
                      <p style='margin-top:20px;'>Atenciosamente,<br>GuilhermeDev</p>";

        $mail->AltBody = "\n\nSeja bem-vindo(a) ao meu projeto!\n\n";

        $mail->send();

    } catch (Exception $e) {

    }

    header('Location: index.php?cadastro=sucesso');
    exit();

} catch (mysqli_sql_exception $e) {
    if ($e->getCode() === 1062) {
        header('Location: cadastro.php?erro=email_ja_cadastrado');
        exit();
    } else {
        header('Location: cadastro.php?erro=erro_inesperado');
        exit();
    }
}