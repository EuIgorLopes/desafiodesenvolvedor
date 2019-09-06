<?php
	include_once("../controllers/connection.class.php");
	include_once("../controllers/users.class.php");

	if (isset($_POST['save']) && !empty($_POST['save'])) {
		$user = new Users();

		$user->Create(
			$_POST['name'],
			$_POST['birth'],
			$_POST['sex']
		);
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/fontawesome-all.min.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/config.css" />
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
		<div id="loading" class="container-fluid d-none loading">
			<div class="d-flex justify-content-center">
				<div class="spinner-border text-danger" role="status">
					<span class="sr-only">Aguarde...</span>
				</div>
			</div>
		</div>
		<section class="container mt-4 bg-white p-4 rounded">
			<h1>Cadastrar Usuário</h1>
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
				<div class="form-group row">
					<div class="col-md-6">
						<label for="name">Nome:</label>
						<input type="text" class="form-control" id="name" name="name" required value="" placeholder="Seu nome" />
					</div>
					<div class="col-md-6">
						<label for="birth">Data de Nascimento:</label>
						<input type="date" name="birth" id="birth" class="form-control" value="" required max="<?php echo date('Y-m-d'); ?>" />
					</div>
				</div>
				<div class="form-group row">
					<div class="col-md-6">
						<label for="">Sexo:</label>
						<?php foreach (Users::Sexes() as $key => $value) { ?>
						<div class="custom-control custom-radio">
							<input type="radio" id="sex-<?php echo $key; ?>" value="<?php echo $key; ?>" name="sex" class="custom-control-input" />
							<label class="custom-control-label" for="sex-<?php echo $key; ?>"><?php echo $value; ?></label>
						</div>
						<?php } ?>
					</div>
				</div>
				<button type="submit" name="save" value="save" class="btn btn-success"><i class="far fa-save"></i> Cadastrar</button>
			</form>
		</section>
	</body>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/config.js"></script>
</html>