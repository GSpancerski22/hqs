<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["hqs"]["id"] ) ){
	exit;
	
  }

  if (!isset($id)) $id = "";

  $nome = $nomecivil = $foto = $resumo = "";
  
  if (!empty ($id)){

	  $sql = 
	  "SELECT * FROM 
	  	personagem 
	  WHERE
		  id = :id LIMIT 1";

		  $consulta = $pdo->prepare($sql);
		  $consulta->bindParam(":id", $id);
		  $consulta->execute();

		  $dados 	  = $consulta->fetch(PDO::FETCH_OBJ);
		  $nome  	  = $dados->nome;
		  $nomecivil  = $dados->nomecivil;
		  $foto 	  = $dados->foto;
		  $resumo 	  = $dados->resumo;

		 $imagem = "../fotos/".$foto."p.jpg";
  }
?>
<div class="container">
	<h1 class="float-left">Cadastro de Personagem</h1>
	<div class="float-right">
		<a href="cadastro/personagem" class="btn btn-success">Novo Registro</a>
		<a href="listar/personagem" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<form name="formCadastro" method="post"
	action="salvar/personagem" data-parsley-validate enctype="multipart/form-data">

		<label for="id">ID</label>
		<input type="text" name="id" id="id" readonly class="form-control"
		value="<?=$id;?>">

					
		<script type="text/javascript">
			$("#id").val(<?=$id;?>);
		</script>


		<label for="nome">Nome do personagem:</label>
		<input type="text" name="nome" 
		id="nome" class="form-control"
		required data-parsley-required-message="Por favor, preencha este campo"
		value="<?=$nome;?>">
					
		<script type="text/javascript">
			$("#nome").val(<?=$nome;?>);
		</script>


		<label for="nomecivil">Nome Civil</label>
		<input name="nomecivil" id="nomecivil"
		class="form-control" required 
		data-parsley-required-message="Preencha o nome" value="<?=$nomecivil;?>">
			
		<script type="text/javascript">
			$("#nomecivil").val(<?=$nomecivil;?>);
		</script>

		<?php 
			$r = ' required data-parsley-required-message="Selecione uma foto" ';
			if (!empty($id)) $r = '';
		?> 

		<label for="foto">Foto do Personagem</label>
		<input type="file" name="foto" id="foto"
		class="form-control" accept=".jpg" <?=$r?>>

		<input type="hidden" name="foto" value="<?=$foto;?>">
		<?php
			if (!empty($foto)){
				echo "<img src='$imagem' alt='$nome' width='80px'> <br>";
			}
		?>

		<label for="resumo">Resumo/Descrição</label>
		<textarea name="resumo" id="resumo" required 
		data-parsley-required-message="Preencha este campo" class="form-control"></textarea>
						
		<script type="text/javascript"> 
			$("#resumo").val("<?=$resumo;?>");
		</script>

		<button type="submit" class="btn btn-success margin">
			<i class="fas fa-check"></i> Gravar Dados
		</button>
	</form>

</div>

<script type="text/javascript">
	$(document).ready(function() {
  		$('#resumo').summernote();
		$('#valor').maskMoney({  //ele coloca a mascara no valor - tambem define onde ficara o ponto e virgula
			thousands: ".",
			decimal: ","
		});
		$('#data').inputmask('99/99/9999');
		$('#numero').inputmask('9999');
	});
</script>
