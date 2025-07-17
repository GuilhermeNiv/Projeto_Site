<?php
session_start();
require 'vendor/autoload.php';
include 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$email = trim($_POST['email']);

if (empty($email)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Preencha o campo com seu e-mail']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'E-mail inválido']);
    exit;
}
 
$dominio = substr(strrchr($email, "@"), 1);
if (!checkdnsrr($dominio, "MX")) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Domínio de e-mail inválido']);
    exit;
}

$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não encontrado']);
    exit;
}

$agora = time();
$limite_tentativas = 10;
$tempo_bloqueio = 5 * 60;
$tempo_espera = 30;

if (!isset($_SESSION['recuperacao'])) {
    $_SESSION['recuperacao'] = [];
}

$rec = &$_SESSION['recuperacao'];

if (!isset($rec[$email])) {
    $rec[$email] = [
        'tentativas' => 0,
        'ultimo_envio' => 0,
        'bloqueado_ate' => 0
    ];
}

if ($rec[$email]['bloqueado_ate'] > $agora) {
    echo json_encode([
        'status' => 'bloqueado',
        'mensagem' => 'Você excedeu o limite de envios. Tente novamente mais tarde.'
    ]);
    exit;
}

if ($agora - $rec[$email]['ultimo_envio'] < $tempo_espera) {
    echo json_encode([
        'status' => 'aguarde',
        'mensagem' => 'Aguarde 30 segundos para tentar novamente'
    ]);
    exit;
}

if ($rec[$email]['tentativas'] >= $limite_tentativas) {
    $rec[$email]['bloqueado_ate'] = $agora + $tempo_bloqueio;
    echo json_encode([
        'status' => 'bloqueado',
        'mensagem' => 'Você excedeu o limite de envios. Aguarde 5 minutos para tentar novamente.'
    ]);
    exit;
}

$token = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
$rec[$email]['token'] = $token;
$rec[$email]['validade'] = $agora + (30 * 60);
$rec[$email]['tentativas'] += 1;
$rec[$email]['ultimo_envio'] = $agora;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['EMAIL_USERNAME'];
    $mail->Password = $_ENV['EMAIL_PASSWORD'];
    $mail->CharSet = 'UTF-8';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom($_ENV['EMAIL_USERNAME'], 'GuilhermeDev');
    $mail->addAddress($email);
    $mail->Subject = 'Seu código de recuperação de senha';
    $mail->isHTML(true);
    $mail->Body = "
        <h2>Código de recuperação</h2>
        <p>Seu código de verificação é:</p>
        <h1 style='font-size: 32px; color: #333;'>$token</h1>
        <p>Ele expira em 30 minutos. Não compartilhe este código.</p>
        <hr>
        <p style='font-size: 14px; color: #555;'>
            Atenciosamente,<br>
            <strong>Guilherme Nivaldo</strong><br>
            Desenvolvedor PHP<br>
            <a href='mailto:projeto.dev@gmail.com'>projeto.dev@gmail.com</a><br>
        </p>
    ";

    $mail->send();

    echo json_encode([
        'status' => 'ok',
        'mensagem' => 'Token enviado com sucesso',
        'tempo' => $tempo_espera
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Erro ao enviar e-mail: ' . $mail->ErrorInfo
    ]);
}