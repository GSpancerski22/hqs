<?php

  if ( !isset ( $_SESSION["hqs"]["id"] ) )  exit;
  
  if ( empty ( $id ) ) {
  	echo "<script>alert('Não foi possível excluir o registro');history.back();</script>";
  	exit;
  }

  $sql = 
  "SELECT 
    quadrinho_id 
  FROM 
    quadrinho_personagem
  WHERE 
    personagem_id = :personagem_id
  LIMIT 1";

  $consulta = $pdo->prepare($sql);

  $consulta->bindParam(":personagem_id", $id);
  
  $consulta->execute();

  $dados = $consulta->fetch(PDO::FETCH_OBJ);

  if ( !empty ( $dados->quadrinho_id1 ) ) {
  	echo "<script>alert('Não é possível excluir este registro, pois existe um quadrinho relacionado');history.back();</script>";
  	exit;
  }

  $sql = 
  "DELETE FROM 
    personagem   
  WHERE 
    id = :id 
  LIMIT 1";

  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(":id", $id);
  
  if ( !$consulta->execute() ) {

  	echo $consulta->errorInfo()[2];

  	echo "<script>alert('Erro ao excluir');javascript:history.back();</script>";
  	exit;
  }

  echo "<script>location.href='listar/personagem';</script>";
