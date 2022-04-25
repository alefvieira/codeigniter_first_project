<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- INICIO DA SECTION 6 -->
<section class="conteudo-6" id="contatos">
	<div class="vertical"></div>

	<div class="container">
		<p class="first--paragrafo ">Entre em contato</p>
		<h2 class="titulo-da-section">Faça o orçamento do seu negócio mesmo sem compromisso</h2>
		<!-- informações  -->
		<div class="divblock--conteudo6">
			<div class="div1--conteudo6">
				<?php
				if ($formError) :
					echo "<p style='text-align: center;'>" . $formError . "</p>";
				endif;
				// vai abrir um formulário
				echo form_open('Pagina/index', "id ='form--conteudo6'");
				// no form_input o primeiro valor é o name, o segundo é o valor e o terceiro são as propriedades

				// criando o input 
				echo form_input(
					'nome', // name
					set_value('nome'), // metodo que vai setar o valor digitado no campo
					'placeholder="Seu Nome" ' // parametro de propriedades
				);
				// criando o input 
				echo form_input(
					'email',
					set_value('email'),
					'placeholder="Seu e-mail" '
				);

				// criando o input 
				echo form_input(
					'assunto', // name
					set_value('assunto'), // metodo que vai setar o valor digitado no campo
					'placeholder="Seu Assunto"'
				);
				// crinado textarea
				echo form_textarea(
					'descricao',
					set_value('descricao'),
					'placeholder="Seu Assunto" cols="30" rows="10" '
				);

				echo form_submit(
					"enviar",
					"Encaminhar",
					array("class" => "formatacao--btn")

				);


				echo form_close();
				// vai fechar o formulário

				?>

			</div>
			<div class="div2--conteudo6">
				<h3>Informações</h3>

				<p class="cor__red">Nosso E-mail</p>
				<p>alef_coutin@hotmail.com</p>

				<p class="cor__red">Nosso Número</p>
				<p>WhatsApp: (27) 9 9785-0672</p>

				<p class="cor__red">Nossas Redes</p>
				<p></p>

			</div>
		</div>
	</div>

</section>
