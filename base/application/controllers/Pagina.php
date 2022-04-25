<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagina extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function index()
	{
		// esse metodo vai carregar o form do helper
		$this->load->helper('form');
		//esse metodo vai carregar a biblioteca que vai validar os dados
		//o parametro array está carregando a validação de formulario e a biblioteca de email
		$this->load->library(array('form_validation', 'email'));

		// vai setar as configurações de cada tag de input dentro do formulário
		$this->form_validation->set_rules('nome', "Nome", "trim|required");
		$this->form_validation->set_rules('email', "Email", "trim|required|valid_email");
		$this->form_validation->set_rules('assunto', "Assunto", "trim|required");
		$this->form_validation->set_rules('descricao', "Descricao", "trim|required");

		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'systemdrogaria@gmail.com';
		$config['smtp_pass'] = '123*&%KenAle';
		$config['protocol']  = 'smtp';
		$config['validate']  = TRUE;
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['newline']   = "\r\n";

		$this->email->initialize($config);

		// teste e validação
		if ($this->form_validation->run() == false) :
			$dados['formError'] = validation_errors();
		else :
			// esse metodo vai recuperar as informações do formulário

			// esse é o metodo que vai pegar os dados passados pelo formulário
			$dados_form = $this->input->post();



			$this->email->from($dados_form['email'], $dados_form['nome']);
			$this->email->to('systemdrogaria@gmail.com');
			$this->email->subject($dados_form['assunto']);
			$this->email->message($dados_form['descricao']);
			if ($this->email->send()) :
				$dados['formError'] = "E-mail Enviado com sucesso";
			else :
				$dados['formError'] = "Erro ao enviar o e-mail, tente novamente mais tarde";
			endif;


		endif;


		$dados['titulo'] = 'Dev Coutin';
		$this->load->view('home', $dados);
	}

	public function servicos()
	{
		$dados['titulo'] = 'Dev Coutin';
		$this->load->view('servicos', $dados);
	}
}
