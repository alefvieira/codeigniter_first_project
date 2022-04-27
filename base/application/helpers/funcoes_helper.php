<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('set_msg')) {
    // seta uma mensagem via session para ser lida posteriormente
    function set_msg($msg = null)
    {
        // em helpers para recurar uma instancia de uma função se deve usar o & get_instance()
        $ci = &get_instance();
        $ci->session->set_userdata('aviso', $msg);
    }
}

if (!function_exists('get_msg')) {
    // seta uma mensagem via session para ser lida posteriormente
    function get_msg($destroy = true)
    {
        $ci = &get_instance();
        $retorno = $ci->session->userdata('aviso');
        if ($destroy) {
            $ci->session->unset_userdata('aviso');
        }
        return $retorno;
    }
}

if (!function_exists('verifica_login')) {
    
    function verifica_login($redirect="setup/login"){
        $ci = &get_instance();

        if($ci->session->userdata('logged') != true ){
            set_msg("<p>Acesso restrito! Faça login para continuar.</p>");
            redirect($redirect, 'refresh');
        }
    }

}

if(!function_exists('config_uploads')){
    function config_upload($path='./uploads', $types='svg|jpg|png', $size=512){
        $config['upload_path'] = $path;
        $config['allowed_types'] = $types;
        $config['max_size'] = $size;
        return $config;

    }
}


// métodos para salvar a edição do texto com as tags e atributos no banco de dados e puxar do banco de dados com essas formatações
if(!function_exists('to_bd')){
    function to_bd($string=null){

        return htmlentities($string);

    }
}

if(!function_exists('to_html')){
    function to_html($string=null){

        return html_entity_decode($string);

    }
}

// esse metodo vai trazer o resumo de um post
if(!function_exists('resumo_post')){
    function resumo_post($string=null, $tamanho=150){
		$string = to_html($string);
		$string = strip_tags($string); // metodo que vai remover as tags html

		$string = substr($string, 0 , $tamanho); // metodo que vai pegar a string do indice 0 até o 100

        return $string;

    }
}


