<?php

	session_start();

	$pagina = "paginas/login";

	include "config/conexao.php";


	$site 	= $_SERVER['SERVER_NAME'];
	$porta  = $_SERVER['SERVER_PORT'];
	$url	= $_SERVER['SCRIPT_NAME'];
	
	$h = "http";


	if( isset($_SERVER['HTTPS']) ) 	$h = "https";

	
	//$h 		= $_SERVER['REQUEST_SCHEME'];

	// http://localhost:8888/hqs/admin/index.php
	//site localhost
	//porta 8888
	//url /hqs/admin/index.php

	$base 	= "$h://$site:$porta/$url";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin - Hqs</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="">
  	<meta name="author" content="">

  	<base href="<?=$base;?>">

 
  	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  	<link href="css/sb-admin-2.min.css" rel="stylesheet">

  	<link rel="stylesheet" type="text/css" href="css/style.css">
  	<link rel="stylesheet" type="text/css" href="vendor/summernote/summernote.css">
  	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

	<script src="vendor/jquery/jquery.min.js"></script>

	<script src="js/jquery.maskMoney.min.js"></script>
	<script src="js/jquery.inputMask.min.js"></script>

	<script src="js/bindings/inputmask.binding.js"></script>
</head>
<body>

	<?php
	$pagina = $pagina.".php";

	if ( !isset ( $_SESSION["hqs"]["id"] ) )	include $pagina;
	else {

		
	?>

		<div id="wrapper">

			<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		    	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		        	<div class="sidebar-brand-icon rotate-n-15">
		          		<i class="fas fa-check"></i>
		        	</div>
		        	<div class="sidebar-brand-text mx-3">HQs System</div>
		     	</a>

		      	<hr class="sidebar-divider my-0">

		      	<li class="nav-item active">
		        	<a class="nav-link" href="index.php">
		          	<i class="fas fa-fw fa-tachometer-alt"></i>
		         	<span>Dashboard</span></a>
		      	</li>

		      	<hr class="sidebar-divider">

		      	<li class="nav-item">
		        	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
		          		<i class="fas fa-fw fa-file"></i>
		          		<span>Cadastros</span>
		        	</a>
		        	<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
		          		<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">Cadastro:</h6>
							<a class="collapse-item" href="cadastro/cidade">Cidade</a>
							<a class="collapse-item" href="cadastro/cliente">Cliente</a>
							<a class="collapse-item" href="cadastro/tipo">Tipo de Quadrinho</a>
							<a class="collapse-item" href="cadastro/editora">Editora de Quadrinho</a>
							<a class="collapse-item" href="cadastro/quadrinho">Quadrinho</a>
							<a class="collapse-item" href="cadastro/personagem">Personagem</a>
		          		</div>
		        	</div>
		      	</li>

		      	<li class="nav-item">
		        	<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
		          		<i class="fas fa-fw fa-wrench"></i>
		          		<span>Processos</span>
		        	</a>
		        	<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
		          		<div class="bg-white py-2 collapse-inner rounded">
		            	<h6 class="collapse-header">Processos:</h6>
		            	<a class="collapse-item" href="cadastro/venda">Venda</a>
		          		</div>
		        	</div>
		      	</li>

		      	<hr class="sidebar-divider">

		      	<div class="sidebar-heading">
		        	Outros
		      	</div>

		      	<li class="nav-item">
		        	<a class="nav-link" href="cadastro/usuario">
		          		<i class="fas fa-fw fa-user"></i>
		          		<span>Usuários</span>
					</a>
		      	</li>

		      	<li class="nav-item">
		        	<a class="nav-link" href="sair.php">
		          		<i class="fas fa-fw fa-off"></i>
		          		<span>Sair</span>
					</a>
		      	</li>

		      	<hr class="sidebar-divider d-none d-md-block">

		      	<div class="text-center d-none d-md-inline">
		        	<button class="rounded-circle border-0" id="sidebarToggle"></button>
		      	</div>
		    </ul>

		    <div id="content-wrapper" class="d-flex flex-column">
		    	<div id="content">

					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

						<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
						</button>

						<ul class="navbar-nav ml-auto">

							<li class="nav-item dropdown no-arrow d-sm-none">
								<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-search fa-fw"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
									<form class="form-inline mr-auto w-100 navbar-search">
									<div class="input-group">
										<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
										<div class="input-group-append">
											<button class="btn btn-primary" type="button">
												<i class="fas fa-search fa-sm"></i>
											</button>
										</div>
									</div>
									</form>
								</div>
							</li>


							<div class="topbar-divider d-none d-sm-block"></div>

							<li class="nav-item dropdown no-arrow">
								<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="mr-2 d-none d-lg-inline text-gray-600 small">
										<?=$_SESSION["hqs"]["nome"];?>
									</span>
									<img class="img-profile rounded-circle" src="../fotos/<?=$_SESSION["hqs"]["foto"];?>p.jpg">
								</a>
			
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<a class="dropdown-item" href="cadastro/dados">
										<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
										Meus Dados
									</a>

									<a class="dropdown-item" href="cadastro/senha">
										<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
										Mudar Senha
									</a>
								
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
										<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
										Logout
									</a>
								</div>

							</li>
						</ul>
					</nav>
	
		        	<div class="container-fluid">

					<?php
					
						$pagina = "paginas/home.php";

						if ( isset ( $_GET["parametro"])){

							$p = trim ( $_GET["parametro"] );
							
							$p = explode("/", $p);

							$pasta 		= $p[0];
							$arquivo	= $p[1];

							$pagina = "$pasta/$arquivo.php";

							if ( isset ( $p[2] ) )	$id = $p[2];
						}

						if ( file_exists($pagina) )
							include $pagina;
						else
							include "paginas/404.php";

					?> 
		        	</div>
				</div>

				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright &copy; GSpancerski - 2020</span>
						</div>
					</div>
				</footer>
			</div>
		</div>

		<a class="scroll-to-top rounded" href="#page-top">
		    <i class="fas fa-angle-up"></i>
		</a>

		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		    <div class="modal-dialog" role="document">
		     	<div class="modal-content">
		        	<div class="modal-header">
		          		<h5 class="modal-title" id="exampleModalLabel">Sair do Sistema?</h5>
		          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
		            		<span aria-hidden="true">×</span>
		          		</button>
		        	</div>
		        	<div class="modal-body">Selecione sair para efetuar o logout do Sistema</div>
		    			<div class="modal-footer">
		      				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	          				<a class="btn btn-primary" href="sair.php">Logout</a>
		        		</div>
		      		</div>
		    	</div>
		</div>

		<?php

	}

	?>

	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/parsley.min.js"></script>
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="js/sb-admin-2.min.js"></script>
	<script src="vendor/chart.js/Chart.min.js"></script>
	<script src="vendor/summernote/summernote.min.js"></script>
	<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</body>
</html>
