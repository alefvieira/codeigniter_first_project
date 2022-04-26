<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Option_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // esse metodo serve para autenticar o usuário
    // caso não esteja logado ele será redirecionado
    // esse metodo vai fazer a consulta no banco de dados e vai retornar o valor caso ele tenha encontrado
    //$default_value=null é o paqrametro que é utilizado quando a busca sql não retornar nada
    public function get_option($option_name, $default_value=null)
    {
        $this->db->where('option_name', $option_name);
        $query = $this->db->get('options', 1);

        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->option_value;
        } else {
            return $default_value;
        }
    }

    // função que vai fazer o insert ou update de caso tela o usuário cadastrado
    public function update_option($option_name, $option_value)
    {
        $this->db->where('option_name', $option_name);

        $query = $this->db->get('options', 1);

        if ($query->num_rows() == 1) {
            //A opção já existe então eu devo atualizar ela

            // comando sql para atualizar os valores
            $this->db->set('option_value', $option_value);
            $this->db->where('option_name', $option_name);
            $this->db->update('options');

            // vai retornar a quantidade de linhas que foram alteradas
            return $this->db->affected_rows();
        } else {
            // a opção não existe por isse vai ser inserido no banco de dados

            // essa array está as colunas e os valores que serão inseridos na tavbela
            $dadosInsert = [
                'option_name' => $option_name,
                'option_value' => $option_value,
            ];

            // o primeiro parametro é o nome da tabela e o segundo parametro são as  colunas e seus valores
            $this->db->insert('options', $dadosInsert);

            return $this->db->insert_id();
        }
    }
}
