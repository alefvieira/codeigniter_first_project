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

	<link rel="stylesheet" href="<?php echo base_url('assets/nav-bar.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/style.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/styleCarrossel.css') ?>">

</head>

<body>
	<!-- chamada do componete do cabeçalho -->
	<?php $this->load->view('header'); ?>


	<section>
		<div class="container" style="text-align: center; display: flex; flex-direction: column; min-height: 70vh; padding-top: 80px;">
			<div >
				<h2><?php echo $ser_titulo ?></h2>
				<p><?php echo $ser_conteudo ?></p>

			</div>
			<div>
				<img style= "width: 150px;" src="<?= base_url('uploads/'.$ser_imagem);?>" alt="<?= $titulo ?>" srcset="">
			</div>
		</div>
		
	</section>
	
	





	<!-- inserindo a arquivo do componet footer -->

	<?php $this->load->view('footer'); ?>

	<a alt="Ir para o topo" title="Ir para o Topo da página" class="toTOP active"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
			<path fill="currentColor" d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z">
			</path>
		</svg></a>


	<script src="<?php echo base_url('assets/mobileNavBar.js') ?> "></script>

	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<script src="<?php echo base_url('assets/script-carrossel.js') ?> "></script>

	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	<script src="<?php echo base_url('assets/scripts.js') ?> "></script>
</body>

</html>
