<?php
session_start();
require('connection.php');

date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');

if(isset($_POST['email'])){
    $email = trim($_POST['email']);
}else{
    echo "<script>alert('Opa, está faltando algo, coloque corretamente e-mail e senha novamente'); document.location.href='../' </script>";
}


$query = "SELECT * FROM tbbolsa where email LIKE ?";

    $statement = $connection->prepare($query);
    $statement->bindValue(1,$email,PDO::PARAM_STR);
    $statement->execute();
    $aprendiz = $statement->fetch();

if($statement->rowCount() == 0){
    echo "<script>alert('Seu acesso não foi liberado nesse pregão'); document.location.href='../' </script>";
}else{

    $_SESSION['dinheiro']=$aprendiz['dinheiro'];
    $_SESSION['email']=$aprendiz['email'];
    $_SESSION['iduser']=$aprendiz['idbolsa'];

    header('Location: ../Restrito');

    
}