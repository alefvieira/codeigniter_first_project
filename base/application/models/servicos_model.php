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
            $query = $this->db->get('noticias', $limit); 

            // caso seja retornado algum valor vai retornar o resultado com os valores
            if($query->num_rows() > 0){
                return $query->result(); // result() é o metodo que está os valores
            }else{
                return null;
            }
        }
        
    }
}
