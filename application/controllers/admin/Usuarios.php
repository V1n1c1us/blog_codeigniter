<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        //dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Home';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/home');
        $this->load->view('backend/template/html-footer');
    }

    public function pag_login()
    {
        //dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Entrar no Sistema';
 
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/login');
        $this->load->view('backend/template/html-footer');
    }

    public function login(){
        //faz avalidação do FORM
        $this->load->library('form_validation'); //carrega a biblioteca de validação
        $this->form_validation->set_rules('txt-user','Usuário',
                                          'required|min_length[3]');
        $this->form_validation->set_rules('txt-senha','Senha',
                                          'required|min_length[3]');                                          
        if($this->form_validation->run()== FALSE)
        {
            $this->pag_login();
        }
        else
        {
            // Receb os dados do form
            $usuario = $this->input->post('txt-user'); 
            $senha = $this->input->post('txt-senha');
            //
            // busca no banco o usuario e senha identicos
            $this->db->where('user',$usuario);
            $this->db->where('senha',$senha);
            //
            //compara e cria a sessão e retorna um resultado
            $userLogado = $this->db->get('usuario')->result();
            //cria a comparação
            if(count($userLogado) == 1){
                $dadosSessao['userLogado'] = $userLogado[0];
                $dadosSessao['logado'] = TRUE;
                $this->session->set_userdata($dadosSessao);
                redirect(base_url('admin'));
            }else{
                $dadosSessao['userLogado'] = NULL;
                $dadosSessao['logado'] = FALSE;
                $this->session->set_userdata($dadosSessao);
                redirect(base_url('admin/login'));
            }
            {

            }


        }
    }

}

?>
