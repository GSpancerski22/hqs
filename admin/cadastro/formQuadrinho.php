<?php 
    if (!isset($pagina)) exit;
?>
<form action="adicionarPersonagem.php" name="formPersonagem" method="post" data-parsley-validate="" target="personagens">
<h3>Adicionar Personagem</h3>

<input type="hidden" name="quadrinho_id" value="<?=$id?>">
    <div class="row">
        <div class="col-10 col-md-8">
            <select name="personagem_id" id="personagem_id" class="form-control" requirede data-parsley-required-message="Selecione um Personagem">
                <option value="">Selecione um personagem</option>
                    <?php

                        $sql = 
                        "SELECT 
                            id, nome 
                        FROM 
                            personagem 
                        ORDER BY 
                            nome";

                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();

                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){

                            $personagem_id = $dados->id;
                            $nome = $dados->nome;

                            echo "<option value='$personagem_id'>$nome</option>";

                        }
                    ?>
            </select>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-success">OK</button>
            <button type="reset" class="btn btn-danger">Novo</button>
        </div>
    </div>
</form>
<iframe name="personagens" width="100%" height="300px" src="adicionarPersonagem.php?quadrinho_id=<?=$id;?>"></iframe>                   
