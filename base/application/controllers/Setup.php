<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Option_mobel', 'optM');
	}
	public function index()
	{
		if ($this->optM->getOption('setup_executado') == 1) :
			// setup ok, mostrar tela para editar dados de setup_executado
			redirect('setup/alterar', 'refresh'); // refresh atualiza a pagina
		else :
			redirect('setup/instalar', 'refresh');
		endif;

		echo "teste";
	}
	public function instalar()
	{

		if ($this->optM->getOption('setup_executado') == 1) {
			// setup ok, mostrar tela para editar dados de setup_executado
			redirect('setup/alterar', 'refresh'); // refresh atualiza a pagina
		}

		// carrega views
		$dados['titulo'] = 'Setup Dev Coutin';
		$dados['h2'] = 'Setup do sistema';
		$this->load->view('painel/setup', $dados);
	}
}
