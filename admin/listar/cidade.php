<?php

  if ( !isset ( $_SESSION["hqs"]["id"] ) )	exit;

?>
<div class="container">
	<h1 class="float-left">Listar Cidade</h1>
	<div class="float-right">
		<a href="cadastro/cidade" class="btn btn-success">Novo Registro</a>
		<a href="listar/cidade" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover" id="tabela">
		<thead>
			<tr>
				<td>ID</td>
				<td>Nome da Cidade</td>
				<td>Estado</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
			<?php
		
				$sql = 
				"SELECT 
					* 
				FROM 
					cidade 
				ORDER BY 
					cidade";
					
				$consulta = $pdo->prepare($sql);

				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					
					$id 		= $dados->id;
					$cidade 	= $dados->cidade;
					$estado 	= $dados->estado;

					echo 
					"<tr>
						<td>".$id."</td>
						<td>".$cidade."</td>
						<td>".$estado."</td>
						<td>
							<a href='cadastro/cidade/".$id."' class='btn btn-success btn-sm'>
								<i class='fas fa-edit'></i>
							</a>

			                <a href='javascript:excluir(".$id.")' class='btn btn-danger btn-sm'>
								<i class='fas fa-trash'></i>
							</a>
			
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
			location.href="excluir/cidade/"+id;
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