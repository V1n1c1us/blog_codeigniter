<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sobrenos extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('categorias_model','modelcategorias'); // apelido ao model alias
        $this->categorias = $this->modelcategorias->listar_categorias(); // this categorias, recebe tudo o que foi listado do método listar_categorias      

        $this->load->model('usuarios_model','modelusuarios'); //funciona tanto no método index quanto no método autores
    }

    public function index()
    {
        //enviando pra view
        $dados['categorias'] = $this->categorias;
        //carregando o model publicações
        $dados['autores'] = $this->modelusuarios->listar_autores();

        //dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Sobre Nós';
        $dados['subtitulo'] = 'Conheça a nossa equipe';

        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/sobrenos');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

    public function autores($id, $slug=null)    
    {
        //enviando pra view
        $dados['categorias'] = $this->categorias;
        //carregando o model publicações

        $dados['autores'] = $this->modelusuarios->listar_autor($id);

        //dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Sobre Nós';
        $dados['subtitulo'] = 'Autor';

        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/autor');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

}

?>