<?php
session_start();
include 'conexao.php';
 
$email = trim($_POST['email'] ?? '');
$token = trim($_POST['token'] ?? '');
$novaSenha = trim($_POST['password'] ?? '');
$confirmacao = trim($_POST['password_confirm'] ?? '');

function redireciona_com_erro($email, $token, $mensagem) {
    header("Location: redefinir_senha.php?email=".urlencode($email)."&token=".urlencode($token)."&erro=".urlencode($mensagem));
    exit();
}

if (empty($email) || empty($token) || empty($novaSenha) || empty($confirmacao)) {
    redireciona_com_erro($email, $token, "Por favor, preencha todos os campos");
}

if ($novaSenha !== $confirmacao) {
    redireciona_com_erro($email, $token, "As senhas não conferem");
}

if (strlen($novaSenha) < 8 || strlen($novaSenha) > 20) {
    redireciona_com_erro($email, $token, "A senha deve ter entre 8 e 20 caracteres");
}

if (
    !isset($_SESSION['recuperacao'][$email]) ||
    $_SESSION['recuperacao'][$email]['token'] !== $token ||
    time() > $_SESSION['recuperacao'][$email]['validade']
) {
    redireciona_com_erro($email, $token, "Token inválido ou expirado");
}

$novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
$stmt->bind_param("ss", $novaSenhaHash, $email);

if ($stmt->execute()) {
    unset($_SESSION['recuperacao'][$email]);
    header("Location: index.php?senha_redefinida=1");
    exit();
} else {
    redireciona_com_erro($email, $token, "Erro ao atualizar senha: " . $stmt->error);
}

$stmt->close();
$conn->close();