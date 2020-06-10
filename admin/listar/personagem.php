<?php

  if ( !isset ( $_SESSION["hqs"]["id"] ) )	exit;
  
?>
<div class="container">
	<h1 class="float-left">Listar Personagens</h1>
	<div class="float-right">
		<a href="cadastro/personagem" class="btn btn-success">Novo Registro</a>
		<a href="listar/personagem" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover" id="tabela">
		<thead>
			<tr>
				<td>ID</td>
				<td>Imagem</td>
				<td>Nome</td>
				<td>Nome Civil</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
  <?php 
$sql = 
"SELECT 
    *
FROM 
	personagem 
ORDER BY 
	nome ";

$consulta = $pdo->prepare($sql);
$consulta->execute();
while ($dados 	= $consulta->fetch(PDO::FETCH_OBJ)){

    $id         = $dados->id;
    $nome       = $dados->nome;
    $nomecivil  = $dados->nomecivil;
    $foto 	    = $dados->foto;
    $resumo 	= $dados->resumo;

   $imagem = "../fotos/".$foto."p.jpg";
	
	echo 
	"<tr>
		<td>$id</td>
		<td><img src='$imagem' alt='$nome' width='50px'></td>
		<td>$nome</td>
		<td>$nomecivil</td>
		<td>
			<a href='cadastro/personagem/".$id."' class='btn btn-success btn-sm'>
				<i class='fas fa-edit'></i>
			</a>
	
			<button type='button' class='btn btn-danger btn-sm' onclick='excluir(".$id.")'>
				<i class='fas fa-trash'></i>
			</button>
		</td>
	</tr>";
}

?>

		</tbody>
	</table>
</div>
<script>
	function excluir( id ) {

		if ( confirm ( "Deseja mesmo excluir?" ) ) {

			location.href="excluir/personagem/"+id;
		}
	}
	$(document).ready( function () {
    	$('#tabela').DataTable({       "language": {
            "lengthMenu": "Mostrado _MENU_ registros por páginas",
            "zeroRecords": "Nem um registro encontrado",
            "info": "Mostrando páginas _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"searach" : "Busca",
			"previous" : "Anterior"
        }});
	} );
</script>
