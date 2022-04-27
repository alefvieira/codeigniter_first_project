<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<section class="conteudo-3 " id="servicos">
	<div class="container">
		<p class="first--paragrafo">
			O que fazemos
		</p>
		<h2 class="titulo-da-section lineText">
			Temos tudo o que você precisa para você expandir seus negócios
		</h2>

		<!-- criando o laço de repetição para popular a section -->
		<?php 
		
		if($servicos = $this->servicos->get()){

			
			$contador = 0;
			foreach($servicos as $linha){
				
				if($contador == 0 ){
					echo '<div class="divblock--conteudo3">'; // essa div vai englobar duas sub-divs de de linha

				}
				$contador ++;
				?>

				<div class="formatblock--conteudo3"> <!-- div com 1 bloco que engloba a imagem, titulo e o conteudo-->
					<div class="div1--conteudo3">
						<img src="<?php echo base_url('uploads/'.$linha->imagem)?>" alt="" class="img__svg--conteudo3">
					</div>

					<div class="div2--conteudo3">
						<h3><?= to_html($linha->titulo)?></h3>
						<p>
							<?= resumo_post($linha->conteudo);?>... 
							<a style="color: black; text-decoration: none;" href="<?php echo base_url('post/'.$linha->id)?>" target="_blank">Leia mais</a>
						</p>
					</div>
				</div> <!-- fim da div que engloba 1 linha -->

				<?php
				if($contador == 2){
					echo '</div>'; // fim da div que engloba duas linhas
					$contador=0;
				}
				
			}
			

		}else{
			echo "<p>Nenhum Serviço cadastrado</p>" ;
		}
		
		?>

	</div>

</section>
