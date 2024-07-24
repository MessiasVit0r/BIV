<?php 
session_start();

include("../src/data.php");
include("../src/connection.php");

$acoes = Acoes($connection);
$minhas_acoes = MinhasAcoes($connection,$_SESSION['email']);
$total = TotalInvestido($connection,$_SESSION['iduser']);

$mercado = VerificarMercado($connection);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="../styles/acoes.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <title>Ações</title>
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
        <ul class="list-menu">
            <li class="item navigate-home">Início</li>
            <li class="item" id="navigate-acoes">Ações</li>
            <li class="item" id="navigate-historico">Histórico</li>
            <li class="item">Créditos</li>
        </ul>
        <div class="navigate-home container-logo">
            <h1>Via de Acesso</h1>
            <img src="../assets/logo-via.png">
        </div>
    </header>
    <section class="valor-container">
        <div class="text-container">
            <div class="title">MERCADO <?= $mercado ?></div>
            <div class="sub-title">SEJA BEM-VINDO</div>
        </div>
        <div class="card-container">
            <div class="card-valor" id="disponivel">
                <h3 class="text">Valor Disponivel</h3>
                <h1 class="valor">R$ <?= number_format($_SESSION['dinheiro'],2) ?></h1>
            </div>
            <div class="card-valor" id="investido">
                <h3 class="text">Valor em Ações</h3>
                <h1 class="valor">R$ <?= number_format($total,2) ?></h1>
            </div>
        </div>
    </section>
    <main>
        <section class="section-comprar section-organizer wrapper">
            <div class="warn warn-green">
                <p>O mercado está aberto!</p>
                <p>Você possui R$<?= number_format($_SESSION['dinheiro'],2) ?>, esse valor é zerado ao fim do pregão</p>
            </div>
            <div class="warn warn-blue">
                <p>Compre suas ações com consciência!</p>
                <p>É possivel vender suas ações depois, mas talvez não pelo mesmo que comprou.</p>
            </div>
            <div class="container-acoes">
                <h1>Compra de ações</h1>
                <div class="cards-container">
                    <?php 
foreach($acoes as $acao){ ?>
                    <div class="card-responsive">
                        <div class="card-upper-section">
                            <p><?= $acao['ticker'] ?></p>
                            <a class="button-primary" href="Comprar?ticker=<?= $acao['ticker'] ?>">
                                COMPRAR
                            </a>
                        </div>
                        <div class="card-img-container"
                            style="background-image: url('../assets/<?= $acao['logo'] ?>');">
                        </div>
                        <div class="card-down-section">
                            <h6>R$ <?= number_format($acao['valor'],2) ?></h6>
                            <p><?= $acao['nome'] ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <section class="section-vender section-organizer wrapper">
            <div class="warn warn-blue">
                <p>Compre suas ações com consciência!</p>
                <p>É possivel vender suas ações depois, mas talvez não pelo mesmo que comprou.</p>
            </div>
            <div class="container-acoes">
                <h1>Venda de ações</h1>
                <div class="cards-container">
                    <?php foreach($minhas_acoes as $acao){ ?>
                    <div class="card-responsive">
                        <div class="card-upper-section">
                            <p><?= $acao['ticker'] ?></p>
                            <a class="button-secondary" href="Vender?ticker=<?= $acao['ticker'] ?>">
                                VENDER
                            </a>
                        </div>
                        <div class="card-img-container"
                            style="background-image: url('../assets/<?= $acao['logo'] ?>');">
                        </div>
                        <div class="card-down-section">
                            <h6>R$ <?= number_format($acao['valor'],2) ?></h6>
                            <p><?= $acao['nome'] ?></p>
                            <p>Você tem <?= $acao['qtd'] ?> ações</p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p> &copy; Via de Acesso. Todos os direitos reservados.</p>
    </footer>

    <script src="../scripts/navBar.js"></script>
    <script src="../scripts/navbarPages.js"></script>
    <script src="../scripts/buy-sell.js"></script>
</body>

</html>