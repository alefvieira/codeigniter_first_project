<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicos_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function salvar($dados){
        if(isset($dados['id']) && $dados['id'] > 0){
            // serviços já existe, devo editar
			$this->db->where('id', $dados['id']);
			unset($dados['id']); // vai impedir que o id seja atualizado 
			// unset vai remover o id do array
			$this->db->update('noticias', $dados);
			return $this->db->affected_rows(); // affected_rows() é o metodo que vai retornar os valores que foram manipulados
        }
        else{
            // noticia não existe, devo inserir
            $this->db->insert("noticias", $dados);
            return $this->db->insert_id();
        }
    } 

    public function get($limit=0, $offset=0){
        // caso o parametro for 0 o resultado da pesquisa vai retornar todos os valores do banco de dados
        if($limit == 0){
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('noticias');
    
            // caso seja retornado algum valor vai retornar o resultado com os valores
            if($query->num_rows() > 0){
                return $query->result(); // result() é o metodo que está os valores
            }else{
                return null;
            }
        }else{
        // caso o limit seja diferente de 0 será executad o codicional else
            $this->db->order_by('id', 'desc');
            $query = $this->db->get('noticias', $limit);  // esse segundo parametro serve para setar quantos valores pegar do banco


            // caso seja retornado algum valor vai retornar o resultado com os valores
            if($query->num_rows() > 0){
                return $query->result(); // result() é o metodo que está os valores
            }else{
                return null;
            }
        }
        
    }

	// vai pegar apenas um resultado da consulta sql
	public function get_single($id=0){
		$this->db->where('id', $id);

		$query = $this->db->get('noticias', 1);
		// se o resultado da query der mais de 0 colunas significa que foi encontrado valores 
		if($query->num_rows() == 1){
			$row = $query->row();


			return $row;
		}else{
			return null;
		}
	}
	public function excluir($id=0){
		$this->db->where('id', $id);
		$this->db->delete('noticias');
		return $this->db->affected_rows();

	}
}
