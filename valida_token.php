<?php
session_start();
header('Content-Type: application/json');

if (!isset($_POST['email']) || !isset($_POST['token'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados incompletos.']);
    exit;
}

$email = trim($_POST['email']);
$token_digitado = trim($_POST['token']);
$rec = $_SESSION['recuperacao'][$email] ?? null;

if (!$rec) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Token não solicitado.']);
    exit;
}

if (time() > $rec['validade']) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Token expirado.']);
    exit;
}

if ($token_digitado !== $rec['token']) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Token inválido.']);
    exit;
}

$_SESSION['recuperacao'][$email]['verificado'] = true;

echo json_encode([
    'status' => 'ok',
    'redirect' => 'redefinir_senha.php?email=' . urlencode($email) . '&token=' . urlencode($token_digitado)
]);
exit;