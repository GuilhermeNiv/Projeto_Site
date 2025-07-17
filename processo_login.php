<?php
session_start();
include 'conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254) {
        header("Location: index.php?erro=email_invalido");
        exit();
    }

    if (strlen($senha) < 8 || strlen($senha) > 20) {
        header("Location: index.php?erro=senha_invalida");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, nome, senha, email_verificado FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (!$usuario['email_verificado']) {
            header("Location: index.php?erro=email_nao_verificado");
            exit();
        }

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            header("Location: site.php"); 
            exit();
        } else {
            header("Location: index.php?erro=senha_incorreta");
            exit();
        }
    } else {
        header("Location: index.php?erro=usuario_nao_encontrado");
        exit();
    }
}