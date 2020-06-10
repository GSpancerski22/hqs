<?php
  if ( !isset ( $_SESSION["hqs"]["id"] ) )   exit;
  
  if ($_POST){

    include "functions.php";
    include "config/conexao.php";

      $id = $nome = $nomecivil = $resumo = "";

      foreach ($_POST as $key => $value) {
          $$key = trim ($value);
      }

      $pdo->beginTransaction();

      $arquivo = time()."-".$_SESSION["hqs"]["id"];

      if (empty($id)){
  
        $sql = 
        "INSERT INTO 
          personagem (nome, nomecivil, foto, resumo) 
        VALUES 
          (:nome, :nomecivil, :foto, :resumo)";

        $consulta = $pdo->prepare($sql);

        $consulta->bindParam(":nome",      $nome);
        $consulta->bindParam(":nomecivil", $nomecivil);
        $consulta->bindParam(":foto",      $arquivo);
        $consulta->bindParam(":resumo",    $resumo);

      }else {

        if ( !empty ( $_FILES["foto"]["name"])) $foto = $arquivo;

        $sql = 
        "UPDATE 
          personagem 
        SET 
          nome = :nome, nomecivil = :nomecivil, foto = :foto, resumo = :resumo 
        WHERE 
          id = :id 
        LIMIT 1";

        $consulta = $pdo->prepare($sql);

        $consulta->bindParam(":id"        ,$id);
        $consulta->bindParam(":nome"      ,$nome);
        $consulta->bindParam(":nomecivil" ,$nomecivil);
        $consulta->bindParam(":foto"      ,$foto);
        $consulta->bindParam(":resumo"    ,$resumo);
      
      }

      if ($consulta->execute()){

        if ((empty ($_FILES["foto"]["type"])) and (!empty($id))){

          $pdo->commit();

          echo "<script>alert('Registro salvo');location.href='listar/personagem';</script>";
          exit;
        }
    
        if ($_FILES["foto"]["type"] != "image/jpeg") 
          echo "<script> alert('Selecione uma imagem JPG valida!!!');history.back();</script>";
        
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], "../fotos/".$_FILES["foto"]["name"])){


          $pastaFotos = "../fotos/";
          $imagem     = $_FILES["foto"]["name"];
          $nome       = $arquivo;

          redimensionarImagem($pastaFotos,$imagem,$nome);

          $pdo->commit();
          
          echo "<script>alert('Registro salvo');location.href='listar/personagem';</script>";
          exit;
        }
        echo "<script>alert('Erro ao enviar para o servido');history.back();</script>";
      }
      exit;
  }
  echo "<p class='alert alert-danger'>Requisição Invalida</p>";
