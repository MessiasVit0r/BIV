<?php 
session_start();

include("dist/src/data.php");
include("dist/src/connection.php");

$acoes = Acoes($connection);
$minhas_acoes = MinhasAcoes($connection,$_SESSION['email']);
$total = TotalInvestido($connection,$_SESSION['iduser']);

$mercado = VerificarMercado($connection);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="dist/styles/nav-bar.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BIV</title>
  <link rel="icon" href="dist/assets/logo-via.png" type="image/x-icon">
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
      <img src="dist/assets/divisa-esquerda.png">
    </div>
    <ul class="list-menu">
      <li class="item navigate-home">Início</li>
      <li class="item" id="navigate-acoes">Ações</li>
      <li class="item" id="navigate-historico">Histórico</li>
      <li class="item" id="navigate-creditos"> Créditos</li>
			<li class="item" id="logout"> <img src="dist/assets/exit.png">&nbsp Sair</li>
    </ul>
    <div class="navigate-home container-logo">
      <h1>Via de Acesso</h1>
      <img src="dist/assets/logo-via.png" alt="Logo do via de acesso">
    </div>
  </header>
  <main>
    <section class="home-section wrapper">
      <div class="hero-container">
        <div class="hero-text-container">
          <h1 class="hero-title">Boas-vindas a BIV!
            Sua plataforma de compra e venda de ações!
          </h1>
          <h3 class="hero-title-secondary">
            Acreditamos que investir é para todos. Nossa plataforma simplifica a compra e venda de ações,
            tornando o mercado financeiro acessível a todos os perfis de investidores!
          </h3>
          <div class="container-buttons">
            <a id="navigate-acoes" class="button-primary">Investir</a>
            <a id="navigate-creditos" class="button-secondary">Conheça o time</a>
          </div>
        </div>
        <div class="hero-img-container">

        </div>
      </div>
    </section>

    <section class="highlight-section wrapper">
      <div class="highlight-text">
        <h2>Confira as ações em destaque no mercado hoje!</h2>
        <a id="navigate-acoes" class="button-primary remove-responsive">Investir</a>
      </div>

      <div class="highlight-cards-container-responsive">
			<?php foreach($acoes as $acao){ ?>
        <div class="card-responsive" id="navigate-acoes">
          <div class="card-upper-section">
            <p><?= $acao['ticker'] ?></p>
            <div class="card-img-container" style="background-image: url('dist/assets/<?= $acao['logo'] ?>');"></div>
          </div>
          <div class="card-down-section">
            <h6>R$ <?= number_format($acao['valor'],2) ?></h6>
            <p><?= $acao['nome'] ?></p>
          </div>
        </div>
				<?php } ?>
      </div>
      <div class="highlight-cards-container">
        <?php foreach($acoes as $acao){ ?>
        <div class="card">
					<!-- NOTA PARA ALGUÉM QUE TAVEZ VEJA ESSE REPOSITÓRIO
						PEÇA AOS EMPRESÁRIOS UMA LOGO COM UM TAMANHO PADRÃO PARA QUE NÃO HAJA ERROS
					-->
          <div class="card-img-container" style="background-image: url('dist/assets/<?= $acao['logo'] ?>'); width: 100%;
    height: 100px;">
          </div>
          <div class="card-text-container">
            <p>Código</p>
            <p>Nome da empresa</p>
            <p>R$14.33</p>
          </div>
        </div>
				<?php } ?>
      </div>
      
    </section>
  </main>
  <footer>
    <p> &copy; Via de Acesso. Todos os direitos reservados.</p>
  </footer>
  <script src="dist/scripts/navBar.js"></script>
  <script src="dist/scripts/navBarIndex.js"></script>
</body>

</html>