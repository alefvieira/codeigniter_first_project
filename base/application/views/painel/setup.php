<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $titulo ?> </title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

	<link rel="stylesheet" href="<?php echo base_url('assets/nav-bar.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url(
     'assets/styleCarrossel.css'
 ); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/painel.css'); ?>">

</head>

<body>
	<div class="linha">
		<div class="coluna col3">
			&nbsp;
		</div>
		<div class="coluna col6">
			<h2><?= $h2 ?></h2>
			<?php
				if ($msg = get_msg()) {
					echo '<div class="msg-box">' . $msg . '</div>';
				}

				echo form_open();

				echo form_label('Nome para login: ', 'login');
				echo form_input('login', set_value('login'), ['autofocus' => 'autofocus']);

				echo form_label('E-mail do administrador do site: ', 'email');
				echo form_input('email', set_value('email'));

				echo form_label('Senha: ', 'senha');
				echo form_password('senha', set_value('senha'));

				echo form_label('Repita a Senha: ', 'senha2');
				echo form_password('senha2', set_value('senha2'));

				echo form_submit('enviar', 'Enviar', ['class' => 'botao']);

				echo form_close();
				?>

		</div>
		<div class="coluna col3">
			&nbsp;
		</div>
	</div>
</body>

</html>
