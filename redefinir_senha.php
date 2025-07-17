<?php
$email = isset($_GET['email']) ? $_GET['email'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';
$erro = isset($_GET['erro']) ? $_GET['erro'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Redefinir Senha - Currículo Guilherme</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="apple-touch-icon" sizes="180x180" href="imagens/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="imagens/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png" />
  <link rel="manifest" href="imagens/site.webmanifest" />
  <link rel="icon" type="image/x-icon" href="imagens/favicon.ico" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-image: url('/Projeto_cadastro/imagens/fundo1.png');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
    }
    input::placeholder {
      color: #9ca3af;
    }
    input:-webkit-autofill {
      -webkit-box-shadow: 0 0 0 1000px #313338 inset !important;
      -webkit-text-fill-color: white !important;
    }
  </style>
</head>
<body class="bg-black/70 flex items-center justify-center min-h-screen">

  <div class="bg-[#1e1f22]/90 backdrop-blur-lg p-8 rounded-2xl shadow-2xl w-full max-w-md text-white">
    <h1 class="text-2xl font-bold text-blue-500 mb-6 text-center">Redefinir Senha</h1>

    <div id="mensagem" class="text-red-500 text-sm text-center mb-4 <?= $erro ? '' : 'hidden' ?>">
      <?= htmlspecialchars($erro, ENT_QUOTES) ?>
    </div>

    <form id="formRedefinirSenha" action="processo_red_senha.php" method="POST" class="space-y-6" autocomplete="off" novalidate>
      <input type="hidden" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES) ?>">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES) ?>">

      <div class="relative">
        <label for="password" class="block mb-1 font-semibold text-gray-300">Nova Senha</label>
        <input type="password" id="password" name="password" placeholder="Digite a nova senha" required minlength="8" maxlength="20"
          class="w-full p-3 rounded-md bg-[#313338] text-white border border-[#4e5058] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button type="button" id="togglePassword" class="absolute right-3 top-[42px] text-gray-400 hover:text-gray-200">
          <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="icon-eye-off" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.477 10.477A3 3 0 0015 12m-3-3a3 3 0 00-4.243 4.243M12 5c4.477 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.134 5.148M4.858 4.858A9.963 9.963 0 002.458 12c1.274 4.057 5.065 7 9.542 7 1.312 0 2.569-.252 3.725-.708" />
          </svg>
        </button>
      </div>

      <div class="relative">
        <label for="password_confirm" class="block mb-1 font-semibold text-gray-300">Confirmar Nova Senha</label>
        <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirme a nova senha" required minlength="8" maxlength="20"
          class="w-full p-3 rounded-md bg-[#313338] text-white border border-[#4e5058] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <button type="button" id="togglePasswordConfirm" class="absolute right-3 top-[42px] text-gray-400 hover:text-gray-200">
          <svg id="icon-eye-confirm" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="icon-eye-off-confirm" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.477 10.477A3 3 0 0015 12m-3-3a3 3 0 00-4.243 4.243M12 5c4.477 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.134 5.148M4.858 4.858A9.963 9.963 0 002.458 12c1.274 4.057 5.065 7 9.542 7 1.312 0 2.569-.252 3.725-.708" />
          </svg>
        </button>
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200 font-semibold">
        Redefinir Senha
      </button>

      <a href="index.php" class="block mt-6 text-center text-blue-400 hover:underline">← Voltar para login</a>
    </form>
  </div>

  <script>
    function setupTogglePassword(toggleId, inputId, eyeId, eyeOffId) {
      const toggle = document.getElementById(toggleId);
      const input = document.getElementById(inputId);
      const iconEye = document.getElementById(eyeId);
      const iconEyeOff = document.getElementById(eyeOffId);

      toggle.addEventListener('click', () => {
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        iconEye.classList.toggle('hidden');
        iconEyeOff.classList.toggle('hidden');
      });
    }

    setupTogglePassword('togglePassword', 'password', 'icon-eye', 'icon-eye-off');
    setupTogglePassword('togglePasswordConfirm', 'password_confirm', 'icon-eye-confirm', 'icon-eye-off-confirm');

    const form = document.getElementById('formRedefinirSenha');
    const mensagem = document.getElementById('mensagem');

    form.addEventListener('submit', function(e) {
      mensagem.classList.add('hidden');
      mensagem.innerText = '';

      const senha = document.getElementById('password').value.trim();
      const confirma = document.getElementById('password_confirm').value.trim();

      if (!senha || !confirma) {
        e.preventDefault();
        mensagem.innerText = 'Preencha todos os campos';
        mensagem.classList.remove('hidden');
        return;
      }

      if (senha.length < 8 || senha.length > 20) {
        e.preventDefault();
        mensagem.innerText = 'A senha deve ter entre 8 e 20 caracteres';
        mensagem.classList.remove('hidden');
        return;
      }

      if (senha !== confirma) {
        e.preventDefault();
        mensagem.innerText = 'As senhas não conferem';
        mensagem.classList.remove('hidden');
        return;
      }
    });
  </script>
  <script>
  const mensagem = document.getElementById('mensagem');
  if (mensagem.textContent.trim() !== '') {
    mensagem.classList.remove('hidden');
  }
  </script>
</body>
</html>