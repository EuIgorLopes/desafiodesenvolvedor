<?php
	include_once("../controllers/connection.class.php");
	include_once("../controllers/users.class.php");

	$users = new Users();

	if (isset($_GET['delete']) && $_GET['delete']) {
		$users->Delete($_GET['delete']);
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<title>Desafio</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

		<!-- For Chrome, Firefox OS, Opera and Vivaldi -->
		<meta name="theme-color" content="#ccc" />
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#ccc" />
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="#ccc" />
	</head>
	<body class="bg-light">
		<section class="container mt-4 bg-white p-4 rounded">
			<h1>Usuários</h1>
			<a href="create" class="btn btn-primary btn-lg my-3"><i class="far fa-file"></i> Cadastrar</a>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
						<tr class="text-center">
							<th>#</th>
							<th>Nome</th>
							<th>Sexo</th>
							<th>Data de Nascimento</th>
							<th>Data de Cadastro</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users->List() as $key => $value) { ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $value['user_name']; ?></td>
							<td><?php echo Users::Sexes()[$value['user_sex']]; ?></td>
							<td><?php echo date('d/m/Y', strtotime($value['user_date_birth'])); ?></td>
							<td><?php echo date('d/m/Y', strtotime($value['user_created_at'])); ?></td>
							<td class="text-center">
								<a href="update/<?php echo $value['id_user']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>

								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-<?php echo $key; ?>">
									<i class="fas fa-trash-alt"></i>
								</button>

								<div class="modal fade" id="modal-<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Usuários</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Tem certeza que deseja excluir?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
												<a href="<?php echo $_SERVER['REQUEST_URI'], '&delete=', $value['pk_ingredient']; ?>" class="btn btn-danger">Sim</a>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</section>
	</body>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>