<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
    }

    public function index()
    {
        if ($this->option->get_option('setup_executado') == 1):
            // setup ok, mostrar tela para editar dados de setup_executado
            redirect('setup/login', 'refresh'); // refresh atualiza a pagina
        else:
            redirect('setup/instalar', 'refresh');
        endif;
    }
    public function instalar()
    {
        if ($this->option->get_option('setup_executado') == 1):
            // setup ok, mostrar tela para editar dados de setup_executado
            redirect('setup/login', 'refresh'); // refresh atualiza a pagina
        endif;

        // Regras de validação - PARTE QUE VAI VALIDAR OS VALORES DOS FORMALÁRIOS
        $this->form_validation->set_rules(
            'login',
            'Login',
            'trim|required|min_length[5]'
        );
        $this->form_validation->set_rules(
            'email',
            'E-mail',
            'trim|required|valid_email'
        );
        $this->form_validation->set_rules(
            'senha',
            'Senha',
            'trim|required|min_length[6]'
        );
        $this->form_validation->set_rules(
            'senha2',
            'Repita a Senha',
            'trim|required|min_length[6]|matches[senha]'
        ); // matches[senha] vai conferir se as senhas são as mesmas

        // verificação da validação
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(validation_errors());
            }
        } else {
            $dados_form = $this->input->post(); // vai fazer o post com todos os valores dos campos inputs
            $this->option->update_option('user_login', $dados_form['login']);
            $this->option->update_option('user_email', $dados_form['email']);
            $this->option->update_option(
                'user_senha',
                password_hash($dados_form['senha'], PASSWORD_DEFAULT)
            );

            $inserido = $this->option->update_option('setup_executado', 1);

            if ($inserido) {
                set_msg('<p>Usuário inserido com sucesso</p>');
                redirect('setup/alterar', 'refresh');
            }
        }

        // carrega views
        $dados['titulo'] = 'Setup Dev Coutin';
        $dados['h2'] = 'Setup do sistema';
        $this->load->view('painel/setup', $dados);
    }


    public function alterar()
    {
        // verifica o login do usuário
        verifica_login();
        // regras de validação do formulário
        $this->form_validation->set_rules('login', "Login", "trim|required|min_length[5]");
        $this->form_validation->set_rules('email', "Email", "trim|required|valid_email");
        $this->form_validation->set_rules('senha', "Senha", "trim|min_length[6]");
        $this->form_validation->set_rules('nome_site', "Nome do Site", "trim|required");

        if(isset($_POST['senha']) && $_POST['senha'] != ''){
            $this->form_validation->set_rules("senha2", "Repita a Senha", "trim|min_length[6]|min_length[6]|matches[senha]");

        }

        // verificação da validação
        if ($this->form_validation->run() == false) {
            if (validation_errors()) {
                set_msg(validation_errors());
            }
        } else {
            $dados_form = $this->input->post();

            $this->option->update_option('user_login', $dados_form['login']);
            $this->option->update_option('user_email', $dados_form['email']);
            $this->option->update_option('nome_site', $dados_form['nome_site']);
            
            if(isset($dados_form['senha']) && $dados_form['senha'] != ''){
                $this->option->update_option(
                    'user_senha',
                    password_hash($dados_form['senha'], PASSWORD_DEFAULT)
                );
                // set_msg("<p>Dados alterados com sucesso </p>");
                
            }
            
            set_msg('<p>Usuário inserido com sucesso</p>');
            

        }

        //carrega a view
        $_POST['login'] = $this->option->get_option('user_login');
        $_POST['email'] = $this->option->get_option('user_email');
        $_POST['nome_site'] = $this->option->get_option('nome_site' );

        $dados['titulo'] = 'Configuração do sistema';
        $dados['h2'] = 'Alterar Configuração básica';
        $dados['nome_site'] = $this->option->get_option('nome_site', "Falta alterar");

        $this->load->view('painel/config', $dados);



    }



    public function login()
    {
        if ($this->option->get_option('setup_executado') != 1):
            // setup ok, mostrar tela para editar dados de setup_executado
            redirect('setup/instalar', 'refresh'); // refresh atualiza a pagina
            // Regras de validação - PARTE QUE VAI VALIDAR OS VALORES DOS FORMALÁRIOS

            // verificação da validação
            // usuario existe // verificação da senha o primeiro parametro é a senha vinda do form e o segundo é a que está no banco de dados
            // usuario existe e as senhas conferem
            //usuario existe, mas as senhas não conferem
            // else do condicional do usuario não encontrado
        else:
            $this->form_validation->set_rules(
                'login',
                'Login',
                'trim|required|min_length[5]'
            );

            $this->form_validation->set_rules(
                'senha',
                'Senha',
                'trim|required|min_length[6]'
            );

            if ($this->form_validation->run() == false){

                if (validation_errors()){
                    set_msg(validation_errors());
                }
            }else{
                
                $dados_form = $this->input->post(); // metodo de validação do acesso do usuário
            
                // vai verificar se encontra o usuário no banco 
                if ($this->option->get_option('user_login') == $dados_form['login']){ // condicional que compara se as senhas estão ok
                    
                    if (password_verify( $dados_form['senha'], $this->option->get_option('user_senha'))){

                        // ESSES METODOS ABAIXO VAI SETAR VALORES NA variavel SESSÃO (LOCALSTORAGE) DA APLICAÇÃO
                        $this->session->set_userdata('logged', TRUE);
                        $this->session->set_userdata('user_login', $dados_form['login']);
                        $this->session->set_userdata('user_email', $this->option->get_option('user_email'));
                        //fazer o redirect para o painel 

                        redirect('setup/alterar');
                        // var_dump($_SESSION);
                        
                    }
                    
                    else{// senhas não conferem
                        set_msg('<p>Senha ou Usuário Incorreta ! !</p>');
                    }

                }
                
                else{  // usuário não encontrado
                    set_msg('<p>Senha ou Usuário Incorreta ! !</p>');
                }
                    
            }

            $dados['titulo'] = 'Tela de Login do Painel';
            $dados['h2'] = 'Tela de Login de Acesso';

            $this->load->view('painel/login', $dados);

        endif;
    }

    //  vai limpar os dados da session
    public function logout(){
        // esse metodo vai matar todos os valores setados nas variaveis de sessão abaixo
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('user_login');
        $this->session->unset_userdata('user_email');

        set_msg("<p>Você saiu do sistema</p>");
        redirect('setup/login', 'refresh');
        
    }
}
