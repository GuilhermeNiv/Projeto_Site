<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Cadastro - Currículo Guilherme</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="apple-touch-icon" sizes="180x180" href="imagens/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="imagens/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png" />
  <link rel="manifest" href="imagens/site.webmanifest" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-image: url('imagens/fundo1.png');
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
    <h1 class="text-2xl font-bold text-blue-500 mb-2 text-center">Currículo Guilherme</h1>
    <p class="text-sm text-gray-300 mb-6 text-center">Crie sua conta para continuar</p>

    <form action="processo_cad.php" method="POST" class="space-y-4" id="formCadastro" novalidate autocomplete="off">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-300">Nome</label>
        <input
          type="text"
          name="name"
          id="name"
          maxlength="66"
          autocomplete="name"
          class="mt-1 w-full p-3 rounded-md bg-[#313338] text-white border border-[#4e5058] focus:outline-none focus:ring-2 focus:ring-blue-500"
          value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
          required
        />
        <?php if (isset($_GET['erro']) && in_array($_GET['erro'], ['nome_vazio', 'nome_longo'])): ?>
          <p class="text-red-500 text-sm mt-1" role="alert">
            <?php
              if ($_GET['erro'] === 'nome_vazio') echo 'Por favor, preencha seu nome.';
              else if ($_GET['erro'] === 'nome_longo') echo 'Nome muito longo (máximo 66 caracteres).';
            ?>
          </p>
        <?php else: ?>
          <p id="nameError" class="text-red-500 text-sm mt-1 hidden" role="alert"></p>
        <?php endif; ?>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-300">E-mail</label>
        <input
          type="email"
          name="email"
          id="email"
          maxlength="254"
          autocomplete="email"
          class="mt-1 w-full p-3 rounded-md bg-[#313338] text-white border border-[#4e5058] focus:outline-none focus:ring-2 focus:ring-blue-500"
          value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
          required
        />
        <?php if (isset($_GET['erro']) && in_array($_GET['erro'], ['email_vazio', 'email_invalido', 'email_dominio', 'email_ja_cadastrado'])): ?>
          <p class="text-red-500 text-sm mt-1" role="alert">
            <?php
              switch ($_GET['erro']) {
                case 'email_vazio':
                  echo 'Por favor, preencha seu e-mail.';
                  break;
                case 'email_invalido':
                  echo 'E-mail inválido.';
                  break;
                case 'email_dominio':
                  echo 'Domínio de e-mail inválido ou não configurado para receber e-mails.';
                  break;
                case 'email_ja_cadastrado':
                  echo 'E-mail já cadastrado.';
                  break;
              }
            ?>
          </p>
        <?php else: ?>
          <p id="emailError" class="text-red-500 text-sm mt-1 hidden" role="alert"></p>
        <?php endif; ?>
      </div>

      <div class="relative">
        <label for="password" class="block text-sm font-medium text-gray-300">Senha</label>
        <input
          type="password"
          name="password"
          id="password"
          minlength="8"
          maxlength="20"
          autocomplete="new-password"
          class="mt-1 w-full p-3 rounded-md bg-[#313338] text-white border border-[#4e5058] focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10"
          required
        />
        <?php if (isset($_GET['erro']) && in_array($_GET['erro'], ['senha_vazia', 'senha_invalida'])): ?>
          <p class="text-red-500 text-sm mt-1" role="alert">
            <?php
              if ($_GET['erro'] === 'senha_vazia') echo 'Por favor, preencha sua senha.';
              else if ($_GET['erro'] === 'senha_invalida') echo 'Senha deve ter entre 8 e 20 caracteres.';
            ?>
          </p>
        <?php else: ?>
          <p id="passwordError" class="text-red-500 text-sm mt-1 hidden" role="alert"></p>
        <?php endif; ?>
        <button
          type="button"
          id="togglePassword"
          class="absolute right-3 top-[38px] text-gray-400 hover:text-gray-200 focus:outline-none"
          aria-label="Mostrar senha"
        >
          <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.754-4.346M6.825 6.825A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.969 9.969 0 01-1.598 2.815M3 3l18 18" />
          </svg>
        </button>
      </div>

      <button
        type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200 font-semibold"
      >
        Cadastrar
      </button>
    </form>

    <p class="mt-4 text-center text-sm text-gray-400">
      Já possui uma conta?
      <a href="index.php" class="text-blue-400 hover:underline">Acesse aqui</a>
    </p>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeOpen = document.getElementById('eyeOpen');
    const eyeClosed = document.getElementById('eyeClosed');

    togglePassword.addEventListener('click', () => {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      eyeOpen.classList.toggle('hidden', !isPassword);
      eyeClosed.classList.toggle('hidden', isPassword);
    });

    document.getElementById('formCadastro').addEventListener('submit', function(e) {
      let valid = true;

      const name = document.getElementById('name');
      const email = document.getElementById('email');
      const password = document.getElementById('password');

      const nameError = document.getElementById('nameError');
      const emailError = document.getElementById('emailError');
      const passwordError = document.getElementById('passwordError');

      nameError.textContent = '';
      emailError.textContent = '';
      passwordError.textContent = '';
      nameError.classList.add('hidden');
      emailError.classList.add('hidden');
      passwordError.classList.add('hidden');

      if (name.value.trim() === '') {
        nameError.textContent = 'Preencha com seu nome';
        nameError.classList.remove('hidden');
        valid = false;
      }

      if (email.value.trim() === '') {
        emailError.textContent = 'Preencha com seu e-mail';
        emailError.classList.remove('hidden');
        valid = false;
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
        emailError.textContent = 'E-mail inválido';
        emailError.classList.remove('hidden');
        valid = false;
      }

      if (password.value.length < 8 || password.value.length > 20) {
        passwordError.textContent = 'A senha deve ter entre 8 e 20 caracteres';
        passwordError.classList.remove('hidden');
        valid = false;
      }

      if (!valid) {
        e.preventDefault();
      }
    });
  </script>

</body>
</html>