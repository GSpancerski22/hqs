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
    quadrinho
  WHERE 
    editora_id = :editora_id
  LIMIT 1";

  $consulta = $pdo->prepare($sql);

  $consulta->bindParam(":editora_id", $id);
  
  $consulta->execute();

  $dados = $consulta->fetch(PDO::FETCH_OBJ);

  if ( !empty ( $dados->id ) ) {
  	echo "<script>alert('Não é possível excluir este registro, pois existe um quadrinho relacionado');history.back();</script>";
  	exit;
  }

  $sql = 
  "DELETE FROM 
    editora 
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

  echo "<script>location.href='listar/editora';</script>";
