<?php 
    session_start();
    
    if (!isset ($_SESSION["hqs"]["id"])){
        exit;
    }

    include "config/conexao.php";
    //verificar se foi dado o post 
    if ($_POST){

        $personagem_id = $_POST["personagem_id"] ?? "";
        $quadrinho_id  = $_POST["quadrinho_id"]  ?? "";

        if ((empty($personagem_id)) or (empty($quadrinho_id))) echo "<script>alert('Erro ao adicionar personagem');</script>";
        else {

            $sql = 
            "INSERT INTO 
                quadrinho_personagem
             VALUES
                (:quadrinho_id, :personagem_id) ";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":quadrinho_id",  $quadrinho_id);
            $consulta->bindParam(":personagem_id", $personagem_id);
            
            if (!$consulta->execute()){
                echo "<script> alert('Não foi possivel inserir o personagem neste quadrinho');</script>";
            }
        }
    }

?>
<!DOCTYPE html> 
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <h4>aedw</h4>
    <table class="table table-hover table-striped table-bordered">
        <thead>
        
        </thead>
        <?php 
            $sql = "SELECT q.id qid, p.id pid, p.nome
            FROM 
                quadrinho_personagem qp 
            INNER JOIN
                personagem p ON (p.id = qp.personagem_id)
            INNER JOIN 
                quadrinho q on (q.id = qp.quadrinho_id)
            WHERE
                qp.quadrinho_id = :quadrinho_id
            ORDER BY 
                p.nome";

            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":quadrinho_id", $quadrinho_id);
            $consulta->execute();

            while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                ?>
                <?php
            }
    ?>
    </table>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
