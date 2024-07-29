<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../index.css">
  <link rel="stylesheet" href="../styles/nav-bar.css">
  <link rel="stylesheet" href="../styles/creditos.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BIV</title>
  <link rel="icon" href="../assets/logo-via.png" type="image/x-icon">
</head>

<body>
  <div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
      <div class="vw-plugin-top-wrapper"></div>
    </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
  new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>

  <header>
    <div class="menu-button" id="menu-button">
      <div class="linha"></div>
      <div class="linha"></div>
      <div class="linha"></div>
    </div>
    <div class="seta-esquerda" id="seta-esquerda">
      <img src="../assets/divisa-esquerda.png">
    </div>
    <ul class="list-menu">
      <li class="item navigate-home">Início</li>
      <li class="item" id="navigate-acoes">Ações</li>
      <li class="item" id="navigate-historico">Histórico</li>
      <li class="item" id="navigate-creditos"> Créditos</li>
      <li class="item" id="logout"> <img src="../assets/exit.png">&nbsp Sair</li>
    </ul>
    <div class="navigate-home container-logo">
      <h1>Via de Acesso</h1>
      <img src="../assets/logo-via.png" alt="Logo do via de acesso">
    </div>
  </header>
  <main>
    <section class="credit-hero-section" style="background-image: url('../assets/wallhaven-34xkv0_1920x1080.png')">
      <!-- INSIRA UMA IMAGEM DE TODO MUNDO AQUI EM CIMA -->
      <div class="credit-text-container">
        <h1>Aqui nós também investimos na equipe e em laços duradouros!</h1>
        <p>Vem conhecer um pouco dos membros que tornaram isso possível!</p>
      </div>
    </section>
    <section class="about-team-section">
      <h2>Nosso time</h2>
      <div class="team-container">
        <div class="member-card">
          <div class="member-img" id="gabriel"></div>
          <div class="about-member">
            <h3>Gabriel</h3>
            <p>Gestor do projeto</p>
            <div class="socials">
              <a href="https://www.linkedin.com/in/gabriel-s-ssantana/"><img src="../assets/mdi--linkedin.svg" alt="LinkedIn"></a>
              <a href="https://github.com/Gabriel-S-Santana/"><img src="../assets/mdi--github.svg" alt="GitHub"></a>
            </div>
          </div>
        </div>
        <div class="member-card">
          <div class="member-img" id="samuel"></div>
          <div class="about-member">
            <h3>Samuel</h3>
            <p>Desenvolvedor</p>
            <div class="socials">
              <a href="https://www.linkedin.com/in/samuel-seguins/"><img src="../assets/mdi--linkedin.svg" alt="LinkedIn"></a>
              <a href="https://github.com/samseg01"><img src="../assets/mdi--github.svg" alt="GitHub"></a>
            </div>
          </div>
        </div>
        <div class="member-card">
          <div class="member-img" id="walssimon"></div>
          <div class="about-member">
            <h3>Walssimon</h3>
            <p>UI Designer</p>
            <div class="socials">
              <a href="https://www.linkedin.com/in/walssimon-sacramento-883375111/"><img src="../assets/mdi--linkedin.svg" alt="LinkedIn"></a>
              <a href="https://github.com/Walssimon"><img src="../assets/mdi--github.svg" alt="GitHub"></a>
            </div>
          </div>
        </div>
        <div class="member-card">
          <div class="member-img" id="matheus"></div>
          <div class="about-member">
            <h3>Matheus</h3>
            <p>Desenvolvedor</p>
            <div class="socials">
              <a href="https://www.linkedin.com/in/matheus-lima-5b05b8196?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"><img src="../assets/mdi--linkedin.svg" alt="LinkedIn"></a>
              <a href="https://github.com/imdevlima"><img src="../assets/mdi--github.svg" alt="GitHub"></a>
            </div>
          </div>
        </div>
        <div class="member-card">
          <div class="member-img" id="sophia"></div>
          <div class="about-member">
            <h3>Sophia</h3>
            <p>Dona do produto(PO)</p>
            <div class="socials">
              <a href="https://www.linkedin.com/in/sophiasodre/"><img src="../assets/mdi--linkedin.svg" alt="LinkedIn"></a>
              <a href="https://github.com/SophCSodre"><img src="../assets/mdi--github.svg" alt="GitHub"></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="message-section">
      <h2>Uma mensagem</h2>
      <div class="text-image">
        <div class="text">
          <p>Fazer parte desse projeto foi uma experiência extremamente especial e enriquecedora.</p>
            <p>Somos muito gratos a todo o corpo docente e os demais funcionários do Instituto Via de Acesso. Colocamos nossos corações nesse projeto e esperamos que seja de grande utilidade!</p>
        </div>
        <!-- INSIRA AS FOTOS NOS CARDS-->
        <div class="message-img" style="background-image: url('../assets/wallhaven-34xkv0_1920x1080.png')"></div>
      </div>
      <div class="text-image reverse">
        <div class="text">
          <p>Um agradecimento especial ao professor Luís e ao professor e técnico de TI Vítor que trouxeram esse desafio
            e nos apoiaram do começo ao fim. </p>
            <p>Não há métricas que descrevam o quanto pudemos aprender em tão pouco tempo
            por conta deles. Muito obrigado.</p>
        </div>
        <div class="message-img" style="background-image: url('../assets/wallhaven-34xkv0_1920x1080.png')"></div>
      </div>
      <div class="text-image">
        <div class="text">
          <p>Esperamos que todos possam usufruir desse projeto com carinho e que ele sirva de inspiração para as
            próximas gerações.
            Obrigado pela atenção!
          </p>
        </div>
        <div class="message-img" style="background-image: url('../assets/wallhaven-34xkv0_1920x1080.png')"></div>
      </div>
    </section>
  </main>
  <footer>
    <p> &copy; Via de Acesso. Todos os direitos reservados.</p>
  </footer>
  <script src="../scripts/navBar.js"></script>
  <script src="../scripts/navBarPages.js"></script>
</body>

</html>