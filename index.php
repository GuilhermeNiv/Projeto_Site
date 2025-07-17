<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Currículo Guilherme</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
      -webkit-box-shadow: 0 0 0 1000px #313338 inset !important;
      -webkit-text-fill-color: white !important;
      transition: background-color 5000s ease-in-out 0s !important;
    }
  </style>
  <link rel="apple-touch-icon" sizes="180x180" href="imagens/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="imagens/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png" />
  <link rel="manifest" href="imagens/site.webmanifest" />
  <link rel="icon" type="image/x-icon" href="imagens/favicon.ico" />
</head>
<body class="bg-black/70 flex items-center justify-center min-h-screen">

  <?php if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'sucesso'): ?>
    <div id="sucesso-msg" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500">
      Cadastro realizado com sucesso! Faça login abaixo.
    </div>
    <script>
      setTimeout(() => {
        const msg = document.getElementById('sucesso-msg');
        if (msg) {
          msg.style.opacity = '0';
          setTimeout(() => msg.remove(), 500);
        }
      }, 5000);
    </script>
  <?php endif; ?>

  <div class="bg-[#1e1f22]/90 backdrop-blur-lg p-8 rounded-2xl shadow-2xl w-full max-w-md text-white">
    <h2 class="text-2xl font-bold text-blue-500 mb-2 text-center">Currículo Guilherme</h2>
    <p class="text-sm text-gray-300 mb-6 text-center">Acesse sua conta</p>

    <?php if (isset($_GET['erro'])): ?>
      <p class="text-red-500 text-center font-semibold mb-4">
        <?php
          switch ($_GET['erro']) {
            case 'usuario_nao_encontrado':
              echo 'Usuário não encontrado';
              break;
            case 'senha_incorreta':
              echo 'Senha incorreta';
              break;
            case 'email_invalido':
              echo 'E-mail inválido';
              break;
            case 'senha_invalida':
              echo 'Senha inválida. Deve ter entre 8 e 20 caracteres.';
              break;
            default:
              echo 'Erro desconhecido';
              break;
          }
        ?>
      </p>
    <?php endif; ?>

    <form id="loginForm" action="processo_login.php" method="POST" class="space-y-4" novalidate autocomplete="off">
      <div>
        <label for="email" class="block text-sm font-medium text-gray-300">E-mail</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="seu@email.com"
          autocomplete="email"
          class="mt-1 w-full p-3 rounded-md bg-[#313338] text-white border border-[#4e5058] focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        />
        <p id="emailError" class="text-red-500 text-sm mt-1 hidden"></p>
      </div>

      <div class="relative">
        <label for="password" class="block text-sm font-medium text-gray-300">Senha</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Digite sua senha"
          autocomplete="current-password"
          class="mt-1 w-full p-3 rounded-md bg-[#313338] text-white border border-[#4e5058] focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        />
        <button
          type="button"
          id="togglePassword"
          aria-label="Mostrar senha"
          class="absolute right-3 top-[42px] text-gray-400 hover:text-gray-200 focus:outline-none"
        >
          <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.963 9.963 0 012.56-4.342m1.668-1.668A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.134 5.148M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
          </svg>
        </button>
        <p id="passwordError" class="text-red-500 text-sm mt-1 hidden"></p>
      </div>

      <button
        type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200 font-semibold"
      >
        Entrar
      </button>

      <p class="mt-4 text-center text-sm text-gray-400">
        <a href="esqueci_senha.php" class="text-blue-400 hover:underline">Esqueci minha senha</a>
      </p>
    </form>

    <p class="mt-4 text-center text-sm text-gray-400">
      Não possui conta?
      <a href="cadastro.php" class="text-blue-400 hover:underline">Cadastre-se</a>
    </p>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const iconEye = document.getElementById('icon-eye');
    const iconEyeOff = document.getElementById('icon-eye-off');

    togglePassword.addEventListener('click', () => {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      if (type === 'text') {
        iconEye.classList.add('hidden');
        iconEyeOff.classList.remove('hidden');
        togglePassword.setAttribute('aria-label', 'Esconder senha');
      } else {
        iconEye.classList.remove('hidden');
        iconEyeOff.classList.add('hidden');
        togglePassword.setAttribute('aria-label', 'Mostrar senha');
      }
    });

    document.getElementById('loginForm').addEventListener('submit', function (e) {
      const email = document.getElementById('email');
      const password = document.getElementById('password');
      const emailError = document.getElementById('emailError');
      const passwordError = document.getElementById('passwordError');

      let valid = true;

      emailError.classList.add('hidden');
      passwordError.classList.add('hidden');

      if (email.value.trim() === '') {
        emailError.textContent = 'Insira o e-mail.';
        emailError.classList.remove('hidden');
        valid = false;
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        emailError.textContent = 'E-mail inválido';
        emailError.classList.remove('hidden');
        valid = false;
      }

      if (password.value.trim() === '') {
        passwordError.textContent = 'Insira a senha';
        passwordError.classList.remove('hidden');
        valid = false;
      }

      if (!valid) e.preventDefault();
    });
  </script>
</body>
</html>