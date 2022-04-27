<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<section class="barra-menu">
	<header>
		<nav>
			<a class="logo evtClick ir_topo">
			<?php

				if($nome_site != null ){

					echo $nome_site;

				}else{
					echo 'Falta Configurar';
				}
			
			?>
		
			</a>

			<div class="mobile-menu">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
			</div>

			<ul class="nav-list">

				<li><a class="evtClick" href="<?= base_url("setup")?>">Sign In</a></li>
				<li><a class="evtClick" href="<?= base_url("#sobre")?>">Sobre Nós</a></li>
				<li><a class="evtClick" href="<?= base_url("#servicos")?>">Serviços</a></li>
				<li><a class="evtClick" href="<?= base_url("#xps")?>">Últimas Experiências</a></li>
				<li><a class="evtClick" href="<?= base_url("#parceiros")?>">Nossos Parceiros</a></li>
				<li><a class="evtClick" href="<?= base_url("#contatos")?>">Entre em Contato</a></li>
			</ul>
		</nav>
	</header>
</section>
