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
	<?php $this->load->view('painel/header'); ?>






	<!-- inserindo a arquivo do componet footer -->

	<?php $this->load->view('painel/footer'); ?>



	<script src="<?php echo base_url('assets/mobileNavBar.js') ?> "></script>

	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<script src="<?php echo base_url('assets/script-carrossel.js') ?> "></script>

	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	<script src="<?php echo base_url('assets/scripts.js') ?> "></script>
</body>

</html>
