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

	<link rel="stylesheet" href="<?php echo base_url('assets/nav-bar.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/style.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/styleCarrossel.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/painel.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/jquery-te-1.4.0.css') ?>">

</head>

<body>
    <!-- cabeçalho da página -->
	<?php $this->load->view('painel/header'); ?>

    
    <div class="container servicos">
        <!-- segunda barra de navegação -->
    <div class="div_nav2">
        <ul>
            <li><a href="<?php echo base_url('servicos/cadastrar') ?>">Inserir</a></li>
            <li><a href="<?php echo base_url('servicos/listar') ?>">Listar</a></li>
        </ul>
    </div>

    <h2><?= $h2?></h2>

    <?php //ini php
        if ($msg = get_msg()) {
            echo '<div class="msg-box">' . $msg . '</div>';
        }

        switch($tela){

            // case para listar listar 
            case "listar":
                // essa variavel servicos é a variavel de session
                if(isset($servicos) && sizeof($servicos) > 0){
                    ?> <!-- end php -->
                    <table>
                        <thead>
                            <th align="left">Título</th>
                            <th align="right" >Ações</th>
                        </thead>
                        <tbody>
                            <?php // ini php
                                foreach($servicos as $linha){
                                    ?>  <!-- end php -->
                                    <tr>
                                        <td align="left" class="titulo-servico"><?= $linha->titulo ?></td>
                                        <td align="right" class="acoes-servico"><?= anchor("servicos/editar".$linha->id,"Editar"); ?> | <?= anchor("servicos/excluir".$linha->id,"Excluir") ; ?> | <?= anchor("post/".$linha->id, "Ver", ['target'=> '_blanck']);?> </td>
                                    </tr>
                                    <?php // ini php
                                }
                            ?> <!-- end php -->
                            
                        </tbody>
                    </table>
                    <?php // ini php
                }
                else{
                    echo "<div class='msg-box'><p>Nenhum Serviço cadastrado</p></div>";
                }
 
                break; // fim do case listar
            case "cadastrar":
                echo form_open_multipart('', 'class="form_cadastro__servicos"');

                echo form_label("Título:", 'titulo');
                echo form_input("titulo", set_value('titulo'));

                
                echo form_label("Conteúdo:", 'conteudo');
                // crinado textarea
				echo form_textarea(
					'conteudo',
					set_value('descricao'),
					['placeholder'=>"Seu Assunto", 'cols'=> '30', 'rows'=>'10', 'class'=>'editorhtml']
					// 'placeholder= cols="30" rows="10" '
				);
                
                echo form_label('Imagem do serviço Prestado', 'imagem');
                echo form_upload('imagem' );

                echo form_submit(
					"enviar",
					"Encaminhar",
					array("class" => "formatacao--btn")

				);




                break;
            case "excluir":
                break;
            case "atualizar":
                break;

            default:
                break;
        }
    ?> <!-- end php -->
    </div>
    

	<!-- inserindo a arquivo do componet footer -->
    
	<?php $this->load->view('painel/footer'); ?>

    <a alt="Ir para o topo" title="Ir para o Topo da página" class="toTOP active"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
			<path fill="currentColor" d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z">
			</path>
		</svg></a>
        

	<script src="<?php echo base_url('assets/mobileNavBar.js') ?> "></script>

	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	<script src="<?php echo base_url('assets/script-carrossel.js') ?> "></script>

	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	<script src="<?php echo base_url('assets/scripts.js') ?> "></script>

	<script src="<?php echo base_url('assets/jquery-3.6.0.min.js') ?> "></script>
	<script src="<?php echo base_url('assets/jquery-te-1.4.0.min.js') ?> "></script>
	<script>
		// metodo que vai permitir que o elemento que estiver com essa classe vai receber as propriedes dessa função 
		$('.editorhtml').jqte();
	</script>
</body>

</html>
