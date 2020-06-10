<?php

  if ( !isset ( $_SESSION["hqs"]["id"] ) )  exit;

  if ( empty ( $id ) ) {
  	echo "<script>alert('Não foi possível excluir o registro');history.back();</script>";
  	exit;
  }

  $sql = 
  "SELECT
    id 
  FROM 
    cliente
  WHERE 
    cidade_id = :cidade_id
  LIMIT 1";

  $consulta = $pdo->prepare($sql);

  $consulta->bindParam(":cidade_id", $id);

  $consulta->execute();

  $dados = $consulta->fetch(PDO::FETCH_OBJ);

 
  if ( !empty ( $dados->id ) ) {

  	echo "<script>alert('Não é possível excluir este registro, pois existe um quadrinho relacionado');history.back();</script>";
  	exit;
  }

  $sql = 
  "DELETE FROM 
    cidade 
  WHERE 
    id = :id
  LIMIT 1";

  $consulta = $pdo->prepare($sql);

  $consulta->bindParam(":id", $id);
  
  if ( !$consulta->execute() ) {

  	echo "<script>alert('Erro ao excluir');javascript:history.back();</script>";
  	exit;
  }

  echo "<script>location.href='listar/cidade';</script>";
