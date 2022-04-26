<!-- <?php
defined('BASEPATH') or exit('No direct script access allowed'); ?> -->

<section class="barra-menu">
	<header>
		<nav>
			<a href="#" class="logo evtClick">
				<?php echo $nome_site; ?>

			</a>

			<div class="mobile-menu">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
			</div>

			<ul class="nav-list">

				<li><a class="evtClick" href="<?= base_url(); ?>" target="_blanck" >Ver Site</a></li>
				
				<li><a class="evtClick" href="<?php echo base_url('setup/alterar')?>">Configs</a></li>

				<li><a class="evtClick" href="<?php echo base_url('setup/sobre')?>">Alterar Sobre Nós</a></li>
				<li><a class="evtClick" href="<?php echo base_url('servicos')?>">
				Alterar Serviços</a></li>

				<li><a class="evtClick" href="<?php echo base_url('setup/ultimas_exp')?>">Alterar Últimas Experiências</a></li>
				<li><a class="evtClick" href="<?php echo base_url('setup/nossos_parceiros')?>">Alterar Nossos Parceiros</a></li>
				<!-- <li><a class="evtClick" href="<?php //echo base_url('setup/contato')?>">Alterar Entre em Contato</a></li> -->

				<li><a class="evtClick" href="<?php echo base_url('setup/logout') ?>">Sair</a></li>
			</ul>
		</nav>
	</header>
</section>
