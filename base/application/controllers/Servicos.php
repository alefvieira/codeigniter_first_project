<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('servicos_model', 'servicos');
    }
    public function index(){
        redirect('servicos/listar', 'refresh');
    }

    public function listar(){
        verifica_login();

        // carrega views
        $dados['titulo'] = 'Listagem de Serviços';
        $dados['h2'] = 'Listagem de Serviços';
        $dados['servicos'] = $this->servicos->get();
        $dados['nome_site'] = $this->option->get_option('nome_site', "Falta alterar");
        $dados['tela'] = 'listar';

        $this->load->view('painel/servicos', $dados);
    }
    public function cadastrar(){
        // verificação do usuário
        verifica_login();

        //regras de validação
        $this->form_validation->set_rules("titulo", 'Título', "trim|required");
        $this->form_validation->set_rules('conteudo', "Conteúdo", "trim|required");

        //  verifica a validação
        if($this->form_validation->run() == false){
            if(validation_errors()){
                set_msg(validation_errors());
            }
        }else{

            $this->load->library('upload', config_upload());

            if($this->upload->do_upload('imagem')){
                // upload foi efetuado com sucesso
                // $dados_upload vai receber os dados do upload da imagem
                $dados_upload = $this->upload->data();

                // está recebendo todos os dados do formulário
                $dados_form = $this->input->post();

                // criando a lista com contendo os campos no banco de dados
                $dados_insert['titulo'] = to_bd($dados_form['titulo']);
                $dados_insert['conteudo'] = to_bd($dados_form['conteudo']);
                $dados_insert['imagem'] = $dados_upload['file_name'];

                // caso esse condicional retorne alguma coisa significa que o serviço foi adicionado com sucesso
                if($id = $this->servicos->salvar($dados_insert)){
                    set_msg("<p>Notícia  cadastrada com sucesso !</p>");
                    redirect('servicos/editar/'.$id, 'refresh');
                }else{
                    set_msg("<p>Erro! Serviço não cadastrado.</p>");
                }
                

                
            }
            else{
                // erro no upload
                $msg = $this->upload->display_errors();
                $msg .= "<p>São permitidos arquivos JPG e PNG de até 512KB.</p>";
                set_msg($msg);
            }
        }

        // carrega views
        $dados['titulo'] = 'Cadastro de Serviços';
        $dados['h2'] = 'Cadastro de Serviços';
        $dados['nome_site'] = $this->option->get_option('nome_site', "Falta alterar");
        $dados['tela'] = 'cadastrar';

        $this->load->view('painel/servicos', $dados);
    }

	public function excluir(){
		// verificação do usuário
		verifica_login();
		$id = $this->uri->segment(3);
		//  verifica se foi passado o id do serviço na url
		if($id > 0){

			if($servicos_id = $this->servicos->get_single($id)){
				$dados['servico_id'] = $servicos_id;

			}else{
				set_msg("<p>Notícia inexistente! Escolha um notícia para excluir.</p>") ;
				redirect("servicos/listar", 'refresh');
			}
			
		}else{
			set_msg("<p>Você deve escolher uma notícia para excluir!</p>");
			redirect("servicos/listar", 'refresh');

		}

		$this->form_validation->set_rules('enviar', 'Excluir Serviço', "trim|required");
		if($this->form_validation->run() == false){

            if(validation_errors()){
                set_msg(validation_errors());
            }

		}else{

			$imagem = 'uploads/'.$servicos_id->imagem;
			// condicional que via verificar se o elemento foi excluido
			if($this->servicos->excluir($id)){

				unlink($imagem); // unlink serve para remover um arquivo
				set_msg("<p>Serviço excluído com sucesso!</p>"); 
				redirect("servicos/listar","refresh");

			}
			else{
				set_msg("<p>Nenhum Serviço foi excluído.</p>"); 
			}
		}
		

		 // carrega views
		 $dados['titulo'] = 'Exclusão de Serviços';
		 $dados['h2'] = 'Exclusão de Serviços';
		 $dados['nome_site'] = $this->option->get_option('nome_site', "Falta alterar");
		 $dados['tela'] = 'excluir';
 
		 $this->load->view('painel/servicos', $dados);


	}

	public function editar(){
		 // verificação do usuário
		 verifica_login();

		 
		$id = $this->uri->segment(3);
		//  verifica se foi passado o id do serviço na url
		if($id > 0){

			if($servicos_id = $this->servicos->get_single($id)){
				$dados['servico_id'] = $servicos_id;
				$dados_update['id'] = $servicos_id->id;

			}else{
				set_msg("<p>Notícia inexistente! Escolha um notícia para Editar.</p>") ;
				redirect("servicos/listar", 'refresh');
			}
			
		}else{
			set_msg("<p>Você deve escolher um serviço para Editar!</p>");
			redirect("servicos/listar", 'refresh');

		}

		//regras de validação
		$this->form_validation->set_rules("titulo", 'Título', "trim|required");
		$this->form_validation->set_rules('conteudo', "Conteúdo", "trim|required");

		if($this->form_validation->run() == false){

            if(validation_errors()){
                set_msg(validation_errors());
            }

		}else{
			$this->load->library('upload', config_upload());
			
			// condicional que vai verificar se o campo de upload de arquivo está preechido
			if(isset($_FILES['imagem']) && $_FILES['imagem']['name'] != ''){
				// foi enviado uma imagem
				if($this->upload->do_upload('imagem')){
					$imagem_antiga = "uploads/".$servicos_id->imagem;
					$dados_upload = $this->upload->data();
					
					
					$dados_form = $this->input->post();

					$dados_update['titulo'] = to_bd($dados_form['titulo']);
					$dados_update['conteudo'] = to_bd($dados_form['conteudo']);
					$dados_update['imagem'] = $dados_upload['file_name'];

					if($this->servicos->salvar($dados_update)){
						unlink($imagem_antiga);
						set_msg("<p>O serviço foi alterado com sucesso!</p>");
						// vai setar a nova imagem na variavel de sessão
						$dados['servico_id']->imagem = $dados_update['imagem'];
					}
					else{

						set_msg("<p>O Erro! Nenhuma alteração foi salva. </p>");
					}
				}else{
					// erro no upload
					$msg = $this->upload->display_errors();
					$msg .= "<p>São permitidos arquivos JPG e PNG de até 512KB.</p>";
					set_msg($msg);
				}
			}
			else{

				// não foi enviado
				$dados_form = $this->input->post();

				$dados_update['titulo'] = to_bd($dados_form['titulo']);
				$dados_update['conteudo'] = to_bd($dados_form['conteudo']);

				if($this->servicos->salvar($dados_update)){
					set_msg("<p>O serviço foi alterado com sucesso!</p>");
				}
				else{
					set_msg("<p>O Erro! Nenhuma alteração foi salva. </p>");
				}

			}
		}

		 // carrega views
		 $dados['titulo'] = 'Atualização de Serviços';
		 $dados['h2'] = 'Atualização de Serviços';
		 $dados['nome_site'] = $this->option->get_option('nome_site', "Falta alterar");
		 $dados['tela'] = 'editar';
 
		 $this->load->view('painel/servicos', $dados);

	}

}

