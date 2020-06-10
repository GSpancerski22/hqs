<?php

  if ( !isset ( $_SESSION["hqs"]["id"] ) ) exit;
  
  if ($_POST){

    include "functions.php";
    include "config/conexao.php";

      $id = $nome = $cpf = $datanascimento = $email = $senha = $senha2 = $cep = $endereco = $complemento = $bairro = $cidade_id = $foto = $telefone = $celular = "";

      foreach ($_POST as $key => $value) {
          $$key = trim ($value);
      }
      if ($senha != $senha2){
        echo "<script>alert('A senha estão diferentes!');history.back();</script>";
      }

      $pdo->beginTransaction();

      $datanascimento    = formatar($datanascimento);
      
      $arquivo = time()."-".$_SESSION["hqs"]["id"];

      if (empty($id)){

        $sql = 
        "INSERT INTO 
          cliente (nome, cpf, datanascimento, email, senha, cep, endereco, complemento, bairro, cidade_id, foto, telefone, celular) 
        VALUES 
          (:nome, :cpf, :datanascimento, :email, :senha, :cep, :endereco, :complemento, :bairro, :cidade_id, :foto, :telefone, :celular)";

        $consulta = $pdo->prepare($sql);

        $consulta->bindParam(":nome",           $nome);
        $consulta->bindParam(":cpf",            $cpf);
        $consulta->bindParam(":datanascimento", $datanascimento);
        $consulta->bindParam(":email",          $email);
        $consulta->bindParam(":senha",          $senha);
        $consulta->bindParam(":cep",            $cep);
        $consulta->bindParam(":endereco",       $endereco);
        $consulta->bindParam(":complemento",    $complemento);
        $consulta->bindParam(":bairro",         $bairro);
        $consulta->bindParam(":cidade_id",      $cidade_id);
        $consulta->bindParam(":foto",           $arquivo);
        $consulta->bindParam(":telefone",       $telefone);
        $consulta->bindParam(":celular",        $celular);


      }else {

        if ( !empty ( $_FILES["foto"]["name"])) $foto = $arquivo;

        $sql = 
        "UPDATE 
          cliente 
        SET 
          nome = :nome, cpf = :cpf, datanascimento = :datanascimento, email = :email, senha = :senha, 
          cep = :cep, endereco = :endereco, complemento = :complemento, bairro = :bairro, cidade_id = :cidade_id,
          foto = :foto, telefone = :telefone, celular = :celular
        WHERE
          id = :id 
        LIMIT 1";

        $consulta = $pdo->prepare($sql);


        $consulta->bindParam(":nome",           $nome);
        $consulta->bindParam(":cpf",            $cpf);
        $consulta->bindParam(":datanascimento", $datanascimento);
        $consulta->bindParam(":email",          $email);
        $consulta->bindParam(":senha",          $senha);
        $consulta->bindParam(":cep",            $cep);
        $consulta->bindParam(":endereco",       $endereco);
        $consulta->bindParam(":complemento",    $complemento);
        $consulta->bindParam(":bairro",         $bairro);
        $consulta->bindParam(":cidade_id",      $cidade_id);
        $consulta->bindParam(":foto",           $foto);
        $consulta->bindParam(":telefone",       $telefone);
        $consulta->bindParam(":celular",        $celular);
        $consulta->bindParam(":id",             $id);


      
      }

      if ($consulta->execute()){
        if ((empty ($_FILES["foto"]["type"])) and (!empty($id))){

          $pdo->commit();
          
          echo "<script>alert('Registro salvo');location.href='listar/cliente';</script>";
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

          echo "<script>alert('Registro salvo');location.href='listar/cliente';</script>";
          exit;
        }
        echo "<script>alert('Erro ao enviar para o servido');history.back();</script>";
      }
      exit;
  }
  echo "<p class='alert alert-danger'>Requisição Invalida</p>";

