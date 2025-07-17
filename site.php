<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Biografia de Guilherme Nivaldo</title>
  <link rel="apple-touch-icon" sizes="180x180" href="imagens/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="imagens/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="imagens/favicon-16x16.png" />
  <link rel="manifest" href="imagens/site.webmanifest" />
  <link rel="icon" type="image/x-icon" href="imagens/favicon.ico" />
  <style>
    body {
      margin: 0;
      padding: 40px 20px;
      background: url('imagens/fundo1.png') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      line-height: 1.7;
      color: #f5f5f5;
    }
    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      width: 100%;
      background-color: #1E3A8A;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.3);
      z-index: 999;
    }
    .navbar a {
      color: white;
      text-decoration: none;
      font-size: 1.5rem;
    }
    .navbar a:hover {
      opacity: 0.8;
    }
    .navbar span {
      font-weight: bold;
      font-size: 1.1rem;
    }
    .avatar {
      width: 160px;
      height: 160px;
      border-radius: 50%;
      object-fit: cover;
      object-position: center top;
      margin: 0 auto;
      display: block;
      position: relative;
      top: 40px;
      z-index: 1;
      box-shadow: 0 4px 12px rgba(0,0,0,0.5);
      border: 4px solid rgba(0,0,0,0.3);
    }
    main {
      max-width: 900px;
      margin: -30px auto 0;
      background-color: rgba(18, 18, 18, 0.75);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
    }
    h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
      color: #ffffff;
    }
    h2 {
      font-size: 2rem;
      margin-top: 2.5rem;
      margin-bottom: 1rem;
      color: #3B82F6;
    }
    p {
      margin-bottom: 1.2rem;
    }
    .toggle-wrapper {
      background-color: rgba(0, 0, 0, 0.4);
      border-radius: 8px;
      margin-bottom: 1rem;
      padding: 0.5rem 1rem;
      transition: background-color 0.3s ease;
    }
    .toggle.open-wrapper {
      background-color: transparent;
      padding: 0;
    }
    .toggle {
      font-size: 1.5rem;
      background: none;
      border: none;
      color: #3B82F6;
      text-align: left;
      width: 100%;
      padding: 0.5rem 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
    }
    .toggle-content {
      display: none;
      margin-bottom: 1.5rem;
    }
    .toggle.open + .toggle-content {
      display: block;
    }
    .icon {
      font-size: 1.2rem;
    }
    .imagem-programador {
      display: block;
      margin: 30px auto;
      height: 570px;
      width: 670px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    }
    .topicos {
      margin: 20px 0 30px;
      padding-left: 20px;
      list-style-type: disc;
    }

    .topicos li {
      margin-bottom: 8px;
      font-size: 1rem;
      line-height: 1.6;
    }
  </style>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const toggles = document.querySelectorAll(".toggle");
      toggles.forEach(toggle => {
        toggle.addEventListener("click", () => {
          toggle.classList.toggle("open");
          const wrapper = toggle.closest(".toggle-wrapper");
          if (wrapper) wrapper.classList.toggle("open-wrapper");

          const icon = toggle.querySelector(".icon");
          icon.textContent = toggle.classList.contains("open") ? "\u25B2" : "\u25BC";
        });
      });
    });
  </script>
</head>
<body>
    <div class="navbar">
    <span>Olá, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</span>
      <a href="index.php" title="Voltar para tela inicial" style="display: flex; align-items: center; padding-right: 32px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
          <path d="M10 17v-2h4v-2h-4v-2h4V9l5 3-5 3v-2h-4v2h4v2h-4z"/>
          <path d="M3 2h13a1 1 0 0 1 1 1v5h-2V4H4v16h11v-4h2v5a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1z"/>
        </svg>
      </a>
    </div>
    <img src="imagens/avatar.png" alt="Avatar Guilherme" class="avatar" />
  <main>
    <h1>Biografia de Guilherme Nivaldo</h1>

    <p>Sou Guilherme Nivaldo, tenho 22 anos e atualmente estou em transição de carreira para a área de Tecnologia da Informação. Estudo Análise e Desenvolvimento de Sistemas e venho construindo projetos que demonstram meu domínio em desenvolvimento web, automações e banco de dados, com foco tanto no front-end quanto no back-end.</p>

    <p>Sou uma pessoa comunicativa, colaborativa e gosto muito de trabalhar em equipe. Tenho facilidade para aprender e resolver problemas com lógica e praticidade. Fora do ambiente acadêmico e profissional, valorizo meu tempo com a família e amigos, além de manter o hábito constante de estudar e me aprimorar.</p>

    <h2>Trajetória Profissional</h2>
    <p>Meu primeiro contato com o mercado de trabalho onde minha carteira de trabalho foi em uma empresa de telemarketing, minha carteira foi assinada para o cargo de atendente telemarketing, posteriormente apartir de processos seletivos subi de cargo para assistente operacional e supervisor de operações, confira abaixo resumo das minhas atividades em cada um dos cargos:</p>

    <div class="toggle-wrapper">
      <button class="toggle">Atendente Telemarketing <span class="icon">▼</span></button>
      <div class="toggle-content">
        <p>Nesta função eu realizava diariamente atendimento à clientes prestando auxílio à assuntos bancários, prestei apoio à colegas da minha equipe e também fui "tutor" de novatos que chegavam à operação em suas primeiras ligações e também sempre gostei de ajudar no atingimento de metas dos indicadores da operação.</p>
      </div>
    </div>

    <div class="toggle-wrapper">
      <button class="toggle">Assistente Operacional <span class="icon">▼</span></button>
      <div class="toggle-content">
        <p>Neste cargo me tornei definitivamente apoio dos atendentes e dos gestores da operação em demandas administrativas e operacionais, corri atrás de melhorias dos processos e sistemas utilizados, realizava controle de regras de negócio, gerenciamento dos dados gerados pela operação em si e como um ponto de destaque eu desenvolvi duas automações para a operação que trabalhei para auxiliar nas demandas diárias repetitivas.</p>
      </div>
    </div>

    <div class="toggle-wrapper">
      <button class="toggle">Supervisor de Operações <span class="icon">▼</span></button>
      <div class="toggle-content">
        <p>Após meu satisfatório rendimento como assistente consegui subir de cargo para gestor imediato de uma equipe de atendentes, liderei meu time ao atingimento de metas operacionais, participei de reuniões com gestores externos (Clientes) e internos da empresa, elaborei relatórios interativos para visualização das metas, fiz alterações nos procedimentos realizados pelos meus liderados e um ponto de destaque para este cargo foi o desenvolvimento de pessoas, sem dúvidas a melhor parte em ser líder é ver o quanto podemos influenciar pessoas para serem melhores!</p>
      </div>
    </div>

    <p>Como você pode notar acima eu tive um contato maior com a parte operacional com demandas administrativas e liderança em operações de vendas e de relacionamento com cliente, porém nunca deixei o meu lado técnico falar mais baixo, sempre dominei rápido sistemas e usei de vantagem meus conhecimentos em TI por diversas vezes, para me ajudar em feedbacks a operadores, automatizar demandas, apresentar resultados e até mesmo descobrir brechas que poderiam ser usadas de má fé, sendo brechas nos procedimentos realizados pelos atendentes e vulnerabilidades nos sistemas.</p>

    <img src="imagens/programador.png" alt="Programador trabalhando" class="imagem-programador">

    <h2>Formação Acadêmica</h2>
    <p>Estou cursando atualmente o curso superior de Analise e Desenvolvimento de Sistemas, na faculdade UNA, terminarei meu curso ainda este ano de 2025. Estou muito satisfeito com meu curso e pretendo logo aplicar cada vez mais tudo o que aprendo nas aulas.</p>

    <h2>Habilidades Técnicas:</h2>
    <ul class="topicos">
      <li>Ferramentas: Excel Avançado (com VBA e Macros), Power BI, Word e PowerPoint.</li>
      <li>Banco de dados: Linguagem SQL, utilização de MySQL e Apache para aplicações web.</li>
      <li>Desenvolvimento Web: PHP,HTML, CSS e JavaScript</li>
      <li>Linguagens de programação: VBA e Python</li>
    </ul>

    <h2>Competências Comportamentais:</h2>
    <ul class="topicos">
    <li>Perfil analítico</li>
    <li>Aprendizado rápido e adaptabilidade</li>
    <li>Liderança</li>
    <li>Proatividade e iniciativa</li>
    <li>Foco em resultados com qualidade</li>
    <li>Comunicação ideal entre áreas técnicas e operacionais</li>
    </ul>

  </main>
</body>
</html>