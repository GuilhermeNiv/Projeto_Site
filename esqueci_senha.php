<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Recuperar Senha - Currículo Guilherme</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
   
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-image: url('/Projeto_cadastro/imagens/fundo1.png');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      margin: 0;
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

  <div class="bg-[#1e1f22]/90 backdrop-blur-lg p-8 rounded-2xl shadow-2xl w-full max-w-md text-white">

    <h2 class="text-2xl font-bold text-blue-500 mb-2 text-center">Currículo Guilherme</h2>
    <p class="text-sm text-gray-300 mb-6 text-center">Recuperar Senha</p>

    <form id="form-email" class="space-y-4" autocomplete="off" novalidate>
      <label for="email" class="block text-sm font-medium text-gray-300">E-mail</label>
      <input
        type="email"
        id="email"
        name="email"
        placeholder="seu@email.com"
        required
        autocomplete="email"
        class="mt-1 w-full p-3 rounded-md bg-[#313338] text-white border border-[#4e5058] focus:outline-none focus:ring-2 focus:ring-blue-500"
      />
      <button
        type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200 font-semibold"
      >
        Enviar código
      </button>
    </form>

    <form id="form-token" class="hidden space-y-4 mt-6" autocomplete="off">
      <p class="text-gray-300 text-center mb-2">Insira os 4 números enviados por e-mail:</p>
      <div class="flex justify-center gap-3">
        <input
          type="text"
          name="digit1"
          maxlength="1"
          class="token-digit w-14 h-14 text-center rounded-md bg-[#313338] text-white border border-[#4e5058] text-2xl focus:outline-none focus:ring-2 focus:ring-blue-500"
          autocomplete="one-time-code"
          inputmode="numeric"
          pattern="[0-9]*"
        />
        <input
          type="text"
          name="digit2"
          maxlength="1"
          class="token-digit w-14 h-14 text-center rounded-md bg-[#313338] text-white border border-[#4e5058] text-2xl focus:outline-none focus:ring-2 focus:ring-blue-500"
          autocomplete="one-time-code"
          inputmode="numeric"
          pattern="[0-9]*"
        />
        <input
          type="text"
          name="digit3"
          maxlength="1"
          class="token-digit w-14 h-14 text-center rounded-md bg-[#313338] text-white border border-[#4e5058] text-2xl focus:outline-none focus:ring-2 focus:ring-blue-500"
          autocomplete="one-time-code"
          inputmode="numeric"
          pattern="[0-9]*"
        />
        <input
          type="text"
          name="digit4"
          maxlength="1"
          class="token-digit w-14 h-14 text-center rounded-md bg-[#313338] text-white border border-[#4e5058] text-2xl focus:outline-none focus:ring-2 focus:ring-blue-500"
          autocomplete="one-time-code"
          inputmode="numeric"
          pattern="[0-9]*"
        />
      </div>

      <div id="contador" class="text-center text-gray-400 text-sm"></div>
      <button
        type="button"
        id="reenviar"
        class="mt-2 w-full bg-yellow-600 text-white py-2 rounded-md hover:bg-yellow-700 transition duration-200 font-semibold hidden"
      >
        Reenviar código
      </button>
      <button
        type="submit"
        class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition duration-200 font-semibold"
      >
        Validar código
      </button>
    </form>

    <div id="mensagem" class="mt-4 text-center text-red-500 font-semibold min-h-[1.25rem]"></div>

    <p class="mt-6 text-center text-sm text-blue-400 hover:underline cursor-pointer" id="voltar-login">← Voltar para login</p>

  </div>

  <script>
    const formEmail = document.getElementById('form-email');
    const formToken = document.getElementById('form-token');
    const mensagem = document.getElementById('mensagem');
    const contador = document.getElementById('contador');
    const voltarLogin = document.getElementById('voltar-login');
    let tempoRestante = 0;
    let interval;

    voltarLogin.addEventListener('click', () => {
      window.location.href = 'index.php';
    });

    formEmail.addEventListener('submit', async (e) => {
      e.preventDefault();
      const email = document.getElementById('email').value.trim();

      const response = await fetch('envio_token.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `email=${encodeURIComponent(email)}`
      });

      const data = await response.json();

      if (data.status === 'ok') {
        formEmail.classList.add('hidden');
        formToken.classList.remove('hidden');
        mensagem.textContent = '';
        tempoRestante = data.tempo;
        iniciarContador();
      } else {
        mensagem.textContent = data.mensagem;
      }
    });

    function iniciarContador() {
      contador.textContent = `Aguarde ${tempoRestante} segundos para reenviar o código.`;
      interval = setInterval(() => {
        tempoRestante--;
        if (tempoRestante <= 0) {
          clearInterval(interval);
          contador.textContent = "Você pode reenviar o código.";
          document.getElementById('reenviar').classList.remove('hidden');
        } else {
          contador.textContent = `Aguarde ${tempoRestante} segundos para reenviar o código.`;
        }
      }, 1000);
    }

    formToken.addEventListener('submit', (e) => {
      e.preventDefault();
      const digits = document.querySelectorAll('.token-digit');
      const token = Array.from(digits).map(d => d.value).join('');
      const email = document.getElementById('email').value.trim();

      fetch('valida_token.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `token=${token}&email=${encodeURIComponent(email)}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'ok') {
          window.location.href = data.redirect;
        } else {
          mensagem.textContent = data.mensagem;
        }
      });
    });

    const inputs = document.querySelectorAll('.token-digit');
    inputs.forEach((input, index) => {
      input.addEventListener('input', (e) => {
        if (e.target.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });

      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value === '' && index > 0) {
          inputs[index - 1].focus();
        }
      });
    });
    document.getElementById('reenviar').addEventListener('click', async () => {
      const email = document.getElementById('email').value.trim();
      document.getElementById('mensagem').textContent = '';

      const response = await fetch('envio_token.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `email=${encodeURIComponent(email)}`
      });

      const data = await response.json();

      if (data.status === 'ok') {
        document.getElementById('reenviar').classList.add('hidden');
        tempoRestante = data.tempo;
        iniciarContador();
      } else {
        document.getElementById('mensagem').textContent = data.mensagem;
      }
    });
  </script>

</body>
</html>