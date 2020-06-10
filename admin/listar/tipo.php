<?php

  if ( !isset ( $_SESSION["hqs"]["id"] ) )	exit;

?>
<div class="container">
	<h1 class="float-left">Listar Tipo de Quadrinho</h1>
	<div class="float-right">
		<a href="cadastro/tipo" class="btn btn-success">Novo Registro</a>
		<a href="listar/tipo" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover" id="tabela">
		<thead>
			<tr>
				<td>ID</td>
				<td>Tipo de Quadrinho</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
			<?php

				$sql = 
				"SELECT 
					* 
				FROM 
					tipo 
				ORDER BY 
					tipo";

				$consulta = $pdo->prepare($sql);

				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
			
					$id 	= $dados->id;
					$tipo 	= $dados->tipo;

					echo 
					"<tr>
						<td>".$id."</td>
						<td>".$tipo."</td>
						<td>
							<a href='cadastro/tipo/".$id."' class='btn btn-success btn-sm'>
								<i class='fas fa-edit'></i>
							</a>
							<a href='excluir/tipo/".$id."' class='btn btn-danger btn-sm'>
								<i class='fas fa-trash'></i>
							</a>
						</td>
					</tr>";
				}
			?>
		</tbody>
	</table>
	<script>
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
	});
	</script>
</div>
