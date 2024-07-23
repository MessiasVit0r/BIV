<?php 
session_start();

include("../src/data.php");
include("../src/connection.php");

if(VerificarMercado($connection)=="Fechado"){
  echo "<script>alert('O mercado está fechado'); document.location.href='acoes';</script>";
  die;
}

$iduser = $_SESSION['iduser'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!isset($_POST['ticker']) || !isset($_POST['qtd']) || empty($_POST['ticker']) || empty($_POST['qtd'])){
        header('Location: acoes');
    }

  $ticker = filter_input(INPUT_POST,"ticker",FILTER_SANITIZE_ADD_SLASHES);
  $qtd = filter_input(INPUT_POST,"qtd",FILTER_SANITIZE_NUMBER_INT);

  $dados_acao = Acao($connection,$ticker)->fetch();
  $valor_total = $dados_acao['valor']*$qtd;
  $idacao = $dados_acao['idacao'];

 if(!VerificarPosse($connection,$iduser,$idacao)){
    echo "<script>alert('Você não possui nenhuma ação dessa empresa'); document.location.href='acoes';</script>";
    die;
 }

 $posse = VerificarPosse($connection,$iduser,$idacao);

 if($qtd > $posse){
    echo "<script>alert('Não é possivel vender mais ações do que as que você possui'); document.location.href='acoes';</script>";
    die;
 }

 if(Vender($connection,$iduser,$idacao,$qtd,$valor_total)){
    DeletarPosse($connection);
    $_SESSION['vende']=false;
    $_SESSION['dinheiro'] = Dinheiro($connection,$iduser);
    echo "<script>alert('Ações vendidas com sucesso'); document.location.href='acoes';</script>";
 }else{
  echo "<script>alert('Ações indisponiveis para venda no momento'); document.location.href='acoes';</script>";
 }
}

$ticker = filter_input(INPUT_GET,"ticker",FILTER_SANITIZE_ADD_SLASHES);

$dados_acao = Acao($connection,$ticker)->fetch();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../index.css">
    <link rel="stylesheet" href="../styles/confirm.css">
    <link rel="stylesheet" href="../styles/nav-bar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Confirmação</title>
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
            <li class="item" >Créditos</li>
        </ul>
        <div class="navigate-home container-logo">
            <h1>Via de Acesso</h1>
            <img src="../assets/logo-via.png">
        </div>
    </header>
    <main>
        <section class="wrapper">
            <form method="POST">
            <div class="container-confirm">
                <h1>
                VENDER AÇÕES
                </h1>
                <div class="text-container">
                    <p>Ação selecionada: <?= $ticker ?></p>
                    <p>Nome da empresa: <?= $dados_acao['nome'] ?></p>
                    <p>Valor da ação: R$ <?= $dados_acao['valor'] ?></p>
                    <label for="input">Quantas ações você vai vender?</label>
                    <input type="number" id="input" name="qtd">
                    <p id="total"></p>
                </div>
                <input type="hidden" value="<?= $ticker ?>" name="ticker">
                <div class="form-group" style="text-align: center;">            
                <button  type="submit" name="submit" class="btn btn-danger">Vender</button>
                </div>
            </div>
            </form>
        </section>
    </main>
    <script src="../scripts/navBar.js"></script>
    <script src="../scripts/load.js"></script>
    <script src="../scripts/navbarPages.js"></script>
    <script>
        input.addEventListener('keyup', () => {
  let valorInput = parseFloat(input.value);

  if (isNaN(valorInput)) {
    total.innerHTML = ''; 
    return;
  }

  let valorAcao = <?= $dados_acao['valor'] ?>;
  valorTotal = valorInput * valorAcao;

  if (isNaN(valorTotal)) {
    total.innerHTML = ''; 
  } else {
    total.innerHTML = `O valor total será: R$${valorTotal.toFixed(2)}`;
  }
});
    </script>
</body>
</html>