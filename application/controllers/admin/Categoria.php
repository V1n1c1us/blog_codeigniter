<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('categorias_model','modelcategorias'); // apelido ao model alias
        $this->categorias = $this->modelcategorias->listar_categorias(); // this categorias, recebe tudo o que foi listado do método listar_categorias
    }

    public function index()
    {
        $this->load->library('table');
        //enviando pra view
        $dados['categorias'] = $this->categorias;
        //dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Categoria';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/categoria');
        $this->load->view('backend/template/html-footer');
    }

    public function insert()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-categoria','Nome da Categoria',
                                          'required|min_length[3]|is_unique[categoria.titulo]');
        if($this->form_validation->run()== FALSE)
        {
            $this->index();
        }
        else
        {
            $titulo = $this->input->post('txt-categoria');//recebe os dadso
            //envia pro model
            if($this->modelcategorias->adicionar($titulo)) //se acessou o modelcategoria com a função add e conseguir add as categorias
            {
                redirect(base_url('admin/categoria'));
            }
            else
            {
                echo 'Houve um erro no sistema';
            }
        }
    }

}

?>