<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Option_mobel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	// esse metodo vai fazer a consulta no banco de dados e vai retornar o valor caso ele tenha encontrado 
	public function getOption($option_name)
	{
		$this->db->where('option_name', $option_name);
		$query = $this->db->get('options', 1);

		if ($query->num_rows() == 1) {
			$row = $query->row();
			return $row->option_value;
		} else {
			return null;
		}
	}
}
