<?php 

function VerificarMercado($connection) : string {
    $sql = "SELECT situacao FROM tbpregao WHERE idpregao = 1";

    $estrutura = $connection->prepare($sql);
    $estrutura->execute();
    $dados = $estrutura->fetch();
    return $dados["situacao"];
    
}

function NegociacoesCompra($connection){
    $sql = "SELECT SUM(valor) as Valor, idacao FROM tbnegociacao WHERE `date` >= DATE_SUB(NOW(), INTERVAL 20 MINUTE) and operacao=1 GROUP BY idacao ORDER BY Valor DESC";

    $estrutura = $connection->prepare($sql);
    $estrutura->execute();
    return $estrutura;
}

function MercadoVenda($connection){
    $sql = "SELECT SUM(valor) as Valor, idacao FROM tbnegociacao WHERE `date` >= DATE_SUB(NOW(), INTERVAL 20 MINUTE) and operacao=2 GROUP BY idacao ORDER BY Valor DESC";

    $estrutura = $connection->prepare($sql);
    $estrutura->execute();
    return $estrutura;
}

function NegociacoesVenda($connection,$idacao){
    $sql = "SELECT SUM(valor) as Valor, idacao FROM tbnegociacao WHERE `date` >= DATE_SUB(NOW(), INTERVAL 20 MINUTE) and operacao=2 and idacao=?";

    $estrutura = $connection->prepare($sql);
    $estrutura->bindValue(1,$idacao,PDO::PARAM_INT);
    $estrutura->execute();
    return $estrutura;
}

function MenosNegociadaCompra($connection){
    $sql = "SELECT SUM(valor) as Valor, idacao FROM tbnegociacao WHERE `date` >= DATE_SUB(NOW(), INTERVAL 20 MINUTE) GROUP BY idacao ORDER BY Valor LIMIT 1";

    $estrutura = $connection->prepare($sql);
    $estrutura->execute();
    return $estrutura;
}

function DesvalorizarMenosComprada($connection,$valor_de_mercado){

    $menos_negociada = MenosNegociadaCompra($connection)->fetch(); 
    $Porcentagem = 100-intval(($menos_negociada['Valor'] * 100) / $valor_de_mercado);
    $dados_acao = AcaoID($connection,$menos_negociada['idacao'])->fetch();
    $novo_valor = $dados_acao['valor']*($Porcentagem/100);  
    if($novo_valor < 7.5) $novo_valor=7.5;
    return VariarAcao($connection,$menos_negociada['idacao'],$novo_valor,"Desvalorizando");
}

function Acoes($connection){
    $sql = "SELECT * FROM tbacoes ORDER BY valor DESC";

    $log = $connection -> prepare($sql);
    $log -> execute();
    return $log;
}

function Acao($connection,$ticker){
    $sql = "SELECT * FROM tbacoes WHERE ticker LIKE ?";

    $log = $connection -> prepare($sql);
    $log->bindValue(1,$ticker,PDO::PARAM_STR);
    $log -> execute();
    return $log;
}

function AcaoID($connection,$idacao){
    $sql = "SELECT * FROM tbacoes WHERE idacao = ?";

    $log = $connection -> prepare($sql);
    $log->bindValue(1,$idacao,PDO::PARAM_INT);
    $log -> execute();
    return $log;
}

function VariarAcao($connection,$idacao,$valor,$opcao){
    $sql = "UPDATE tbacoes SET valor = ?, situacao = ? WHERE idacao =?";

    $log = $connection -> prepare($sql);
    $log->bindValue(1,$valor,PDO::PARAM_STR);
    $log->bindValue(2,$opcao,PDO::PARAM_STR);
    $log->bindValue(3,$idacao,PDO::PARAM_INT);
    return $log -> execute();
}

function HaDinheiro($connection,$valor_total, $iduser) : bool{
    $sql = "SELECT * FROM tbbolsa WHERE idbolsa = ?";

    $log = $connection -> prepare($sql);
    $log->bindValue(1,$iduser,PDO::PARAM_INT);
    $log -> execute();

    $dados = $log->fetch();

    if($dados['dinheiro'] >= $valor_total){
        return true;
    }else{
        return false;
    }

}

function VerificarPosse($connection,$iduser, $idacao){
    $sql = "SELECT * FROM tbposse WHERE iduser = ? and idacao = ?";

    $log = $connection -> prepare($sql);
    $log->bindValue(1,$iduser,PDO::PARAM_INT);
    $log->bindValue(2,$idacao,PDO::PARAM_INT);
    $log->execute();

    if($log->RowCount()==0){
        return false;
    }else{
        $dados = $log->fetch();
        return $dados['qtd'];
    }

}

function Dinheiro($connection,$iduser) {
    $sql = "SELECT * FROM tbbolsa WHERE idbolsa = ?";

    $log = $connection -> prepare($sql);
    $log->bindValue(1,$iduser,PDO::PARAM_STR);
    $log -> execute();
    $dados = $log->fetch();
    return $dados['dinheiro'];
}

function Comprar($connection,$iduser,$ticker,$qtd,$valor_total) : bool{

    $dados_acao = Acao($connection,$ticker)->fetch();
    $idacao = $dados_acao['idacao'];

    $dinheiro = Dinheiro($connection,$iduser)-$valor_total;

    if(!VerificarPosse($connection,$iduser,$idacao)){
        $sql = "START TRANSACTION;

        UPDATE tbbolsa set dinheiro = :dinheiro WHERE idbolsa=:iduser;
        INSERT INTO tbnegociacao (`iduser`, `idacao`, `valor`, `acoes`) VALUES (:iduser,:idacao,:valor_total,:qtd);
        INSERT INTO tbposse (`iduser`, `idacao`, `qtd`) VALUES (:iduser,:idacao,:qtd);
        
        COMMIT;";

        $estrutura=$connection->prepare($sql);
        $estrutura->bindValue(":iduser",$iduser,PDO::PARAM_INT);
        $estrutura->bindValue(":dinheiro",$dinheiro,PDO::PARAM_STR);
        $estrutura->bindValue(":idacao",$idacao,PDO::PARAM_INT);
        $estrutura->bindValue(":valor_total",$valor_total,PDO::PARAM_STR);
        $estrutura->bindValue(":qtd",$qtd,PDO::PARAM_INT);
        return $estrutura->execute();

    }else{
        $posse = VerificarPosse($connection,$iduser,$idacao);
        $total = $posse+$qtd;

        $sql = "START TRANSACTION;

        UPDATE tbbolsa set dinheiro = :dinheiro WHERE idbolsa=:iduser;
        INSERT INTO tbnegociacao (`iduser`, `idacao`, `valor`, `acoes`) VALUES (:iduser,:idacao,:valor_total,:qtd);
        UPDATE tbposse SET qtd = :total where iduser = :iduser and idacao = :idacao;
        
        COMMIT;";

        $estrutura=$connection->prepare($sql);
        $estrutura->bindValue(":iduser",$iduser,PDO::PARAM_INT);
        $estrutura->bindValue(":dinheiro",$dinheiro,PDO::PARAM_STR);
        $estrutura->bindValue(":idacao",$idacao,PDO::PARAM_INT);
        $estrutura->bindValue(":valor_total",$valor_total,PDO::PARAM_STR);
        $estrutura->bindValue(":qtd",$qtd,PDO::PARAM_INT);
        $estrutura->bindValue(":total",$total,PDO::PARAM_INT);
        return $estrutura->execute();
    }
}

function Vender($connection,$iduser,$idacao,$qtd,$valor_total) : bool{


    $dinheiro = Dinheiro($connection,$iduser)+$valor_total;

    $posse = VerificarPosse($connection,$iduser,$idacao);
    $total = $posse-$qtd;

        $sql = "START TRANSACTION;

        UPDATE tbbolsa set dinheiro = :dinheiro WHERE idbolsa=:iduser;
        INSERT INTO tbnegociacao (`iduser`, `idacao`, `valor`, `acoes`, `operacao`) VALUES (:iduser,:idacao,:valor_total,:qtd,2);
        UPDATE tbposse SET qtd = :total where iduser = :iduser and idacao = :idacao;
        
        COMMIT;";

        $estrutura=$connection->prepare($sql);
        $estrutura->bindValue(":iduser",$iduser,PDO::PARAM_INT);
        $estrutura->bindValue(":dinheiro",$dinheiro,PDO::PARAM_STR);
        $estrutura->bindValue(":idacao",$idacao,PDO::PARAM_INT);
        $estrutura->bindValue(":valor_total",$valor_total,PDO::PARAM_STR);
        $estrutura->bindValue(":qtd",$qtd,PDO::PARAM_INT);
        $estrutura->bindValue(":total",$total,PDO::PARAM_INT);
        return $estrutura->execute();
}

function DeletarPosse($connection){
    $sql = "DELETE FROM tbposse WHERE qtd = 0";
    $connection->query($sql);
}

function MinhasAcoes($connection,$email){
    $sql = "SELECT A.ticker,A.valor, P.qtd, A.nome, A.logo FROM tbacoes as A inner join tbposse as P ON A.idacao=P.idacao inner join tbbolsa as B ON B.idbolsa=P.iduser WHERE B.email LIKE ?";

    $log = $connection -> prepare($sql);
    $log->bindValue(1,$email,PDO::PARAM_STR);
    $log -> execute();
    return $log;
}

function TotalInvestido($connection,$iduser) : float {
    $sql = "SELECT SUM(P.qtd*A.valor) as Total FROM `tbposse` as P inner join tbacoes as A ON A.idacao=P.idacao WHERE P.iduser = ?";

    $estrutura = $connection->prepare($sql);
    $estrutura->bindValue(1,$iduser,PDO::PARAM_INT);
    $estrutura->execute();
    $dados = $estrutura->fetch();

    if(empty($dados['Total'])){
        return 0;
    }else{
        return $dados['Total'];
    }
}