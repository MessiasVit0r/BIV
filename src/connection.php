<?php
//Uso exclusivo do Desenvolvedor

try {
  $connection = NEW PDO("mysql:host=localhost;dbname=dbbolsa;charset=utf8", "root", "",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
      echo 'Perdão, tivemos dificuldades em te conectar com nosso banco de dados, tente novamente mais tarde';
  }

  