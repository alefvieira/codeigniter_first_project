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
                $dados_insert['titulo'] = $dados_form['titulo'];
                $dados_insert['conteudo'] = $dados_form['conteudo'];
                $dados_insert['imagem'] = $dados_upload['file_name'];

                // caso esse condicional retorne alguma coisa significa que o serviço foi adicionado com sucesso
                if($id = $this->servicos->salvar($dados_insert)){
                    set_msg("<p>Notícia  cadastrada com sucesso !</p>");
                    redirect('servicos/listar', 'refresh');
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

}

