<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

    /**
     * Categorias constructor.
     */
    public function __construct(){
        parent::__construct();

        $this->load->model('categorias_model','modelcategorias'); // apelido ao model alias
        $this->categorias = $this->modelcategorias->listar_categorias(); // this categorias, recebe tudo o que foi listado do método listar_categorias      
    }

    public function index($id, $slug=null)
    {
        //enviando pra view
        $dados['categorias'] = $this->categorias;
        //carregando o model publicações
        $this->load->model('publicacoes_model','modelpublicacoes');
        $dados['postagem'] = $this->modelcategorias->categorias_pub($id);

        //dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Categorias';
        $dados['subtitulo'] = '';
        $dados['subtitulodb'] = $this->modelcategorias->listar_titulo($id);

        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/categoria');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

}
?>