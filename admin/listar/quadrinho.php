<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["hqs"]["id"] ) ){
    exit;
  }
?>
<div class="container">
	<h1 class="float-left">Listar Quadrinho</h1>
	<div class="float-right">
		<a href="cadastro/quadrinho" class="btn btn-success">Novo Registro</a>
		<a href="listar/quadrinho" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover" id="tabela">
		<thead>
			<tr>
				<td>ID</td>
				<td>Imagem</td>
				<td>Capa</td>
				<td>Titulo</td>
				<td>Data</td>
				<td>Valor</td>
				<td>Editora</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
	<?php 
	$sql = 
	"SELECT 
		q.id, q.titulo, q.capa, q.valor, q.numero, 
		date_format(q.data, '%d/%m/%Y') dt, e.nome editora
	FROM 
		quadrinho q 
	INNER JOIN 
		editora e ON (e.id = q.editora_id)
	ORDER BY 
		q.titulo ";

	$consulta = $pdo->prepare($sql);
	$consulta->execute();
	while ($dados 	= $consulta->fetch(PDO::FETCH_OBJ)){
		$id 		= $dados->id;
		$titulo 	= $dados->titulo;
		$capa 		= $dados->capa;
		$valor 		= number_format($dados->valor,2,",",".");
		$numero 	= $dados->numero;
		$editora 	= $dados->editora; 
		$dt 		= $dados->dt;
		$imagem 	= "../fotos/".$capa."p.jpg";
		
		echo 
		"<tr>
			<td>$id</td>
			<td><img src='$imagem' alt='$titulo' width='50px'></td>
			<td>$capa</td>
			<td>$titulo</td>
			<td>$dt</td>
			<td>R$ $valor</td>
			<td>$editora</td>
			<td>
				<a href='cadastro/quadrinho/".$id."' class='btn btn-success btn-sm'>
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

				location.href="excluir/quadrinho/"+id;
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
