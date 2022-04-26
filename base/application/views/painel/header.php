<section class="barra-menu">
	<header>
		<nav>
			<a href="#topo" class="logo evtClick">
				<?php echo $nome_site; ?>

			</a>

			<div class="mobile-menu">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
			</div>

			<ul class="nav-list">

				<li><a class="evtClick" href="<?= base_url(); ?>" target="_blanck" >Ver página</a></li>
				<li><a class="evtClick" href="#sobre">Alterar Sobre Nós</a></li>
				<li><a class="evtClick" href="#servicos">Aterar Serviços</a></li>
				<li><a class="evtClick" href="#xps">Alterar Últimas Experiências</a></li>
				<li><a class="evtClick" href="#parceiros">Alterar Nossos Parceiros</a></li>
				<li><a class="evtClick" href="#contatos">Alterar Entre em Contato</a></li>
				<li><a class="evtClick" href="<?php echo base_url('setup/logout') ?>">Sair</a></li>
			</ul>
		</nav>
	</header>
</section>
