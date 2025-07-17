# 🛡️ Projeto de Cadastro de Usuários com Validação de E-mail e Recuperação de Senha

Este projeto é um sistema de cadastro de usuários, login seguro, e recuperação de senha com verificação em duas etapas. O sistema foi construído com foco em boas práticas, segurança e apresentação moderna. Meu objetivo com este projeto é destacar minhas habilidades em desenvolvimento WEB com envio de e-mail integrado, ou demonstrar que possuo a base necessária para programação Back-end e Front-end nas linguagens PHP, Js, HTML, CSS e SQL.

---

https://youtu.be/pL5kaJneY84

## 🎥 Demonstração em vídeo

[![Assista ao vídeo no YouTube](https://img.youtube.com/vi/pL5kaJneY84/hqdefault.jpg)](https://www.youtube.com/watch?v=pL5kaJneY84)

---

## 💡 Funcionalidades

- Cadastro de usuários com validação de e-mail via token  
- Login apenas após validação do e-mail  
- Recuperação de senha com envio de token por e-mail  
- Validação de tokens com contagem regressiva, limite de tentativas e expiração  
- Validações front-end e back-end  
- Layout moderno com tema escuro  
- Sistema de mensagens de erro amigáveis e estilizadas  

---

## 🛠️ Tecnologias Utilizadas

- **PHP** (Back-end)  
- **HTML5 & CSS3** (Front-end)  
- **JavaScript** (para interações dinâmicas)  
- **MySQL** (Banco de dados)  
- **PHPMailer** (Envio de e-mails)  
- **Sessions & .env** (Segurança e configurações)  

---

## 📁 Componentes do Projeto

Projeto_cadastro/
├── imagens/
│   ├── android-chrome-192x192.png
│   ├── android-chrome-512x512.png
│   ├── apple-touch-icon.png
│   ├── avatar.png
│   ├── favicon_io.zip
│   ├── favicon-16x16.png
│   ├── favicon-32x32.png
│   ├── fundo1.png
│   └── programador.png
├── vendor/
│   ├── composer/
│   ├── graham-campbell/
│   ├── phpmailer/
│   ├── phpoption/
│   ├── symfony/
│   ├── vlucas/
│   └── autoload.php
├── .env
├── cadastro.php
├── composer.json
├── composer.lock
├── conexao.php
├── envio_token.php
├── esqueci_senha.php
├── index.php
├── logout.php
├── processo_cad.php
├── processo_login.php
├── processo_red_senha.php
├── redefinir_senha.php
├── site.php
└── valida_token.php

---

## 🧪 Como Você Pode Testar Localmente

1. Clone este repositório:  
   ```bash
   git clone https://github.com/seuusuario/projeto-cadastro.git
   
2. Importe o banco de dados projeto_cademail.sql no seu MySQL, no meu caso eu utilizo o Xampp como servidor web para rodar sites e aplicações que usam PHP, MySQL e outras tecnologias localmente.

3. Crie um arquivo .env no seu projeto com este conteúdo:

EMAIL_USERNAME=seuemail@dominio.com
EMAIL_PASSWORD=senhadeapp

Obs: A senha de app a qual me refiro acima é a gerada pelo seu provedor de domínio, geralmente composta por 16 caracteres aleatórios

Execute localmente com um servidor PHP (XAMPP, WAMP, Laragon etc.)

👨‍💻 Autor:
Guilherme Laureano | 
Disponível para contratação | Uberlândia - MG
