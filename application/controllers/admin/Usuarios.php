<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {

        if(!$this->session->userdata('logado')){ //tudo que colocar aqui, vai ser falnso quando for falsa manda pro login
            redirect(base_url('admin/login'));
        }
        //chama a biblioteca de tabela
        $this->load->library('table');

        $this->load->model('usuarios_model','modelUsuarios');
        $dados['usuarios'] = $this->modelUsuarios->listar_autores();
        //dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Usuários';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/usuarios');
        $this->load->view('backend/template/html-footer');
    }

    public function insert()
    {
        if(!$this->session->userdata('logado')){ //tudo que colocar aqui, vai ser falnso quando for falsa manda pro login
            redirect(base_url('admin/login'));
        }
        $this->load->model('usuarios_model','modelUsuarios');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-nome','Nome do Usuário',
                                          'required|min_length[3]');
        $this->form_validation->set_rules('txt-email','Email',
                                          'required|valid_email');
        $this->form_validation->set_rules('txt-historico','Histórico',
                                          'required|min_length[20]');                                          
        $this->form_validation->set_rules('txt-user','User',
                                          'required|min_length[3]|is_unique[usuario.user]');                                                                                    
        $this->form_validation->set_rules('txt-senha','Senha',
                                          'required|min_length[3]');                                                                                    
        $this->form_validation->set_rules('txt-confir-senha','Confirmar Senha',
                                          'required|matches[txt-senha]');                                                                                    
        // caso aconteça algum erro
        if($this->form_validation->run()== FALSE)
        {
            $this->index(); //retorna pra index
        }
        else
        {
            //recebe os dados do form
            $nomeUser = $this->input->post('txt-nome');
            $emailUser = $this->input->post('txt-email');
            $historicoUser = $this->input->post('txt-historico');
            $user = $this->input->post('txt-user');
            $userSenha = $this->input->post('txt-senha');

            //manda pro model
            if($this->modelUsuarios->adicionar($nomeUser, $emailUser, $historicoUser, $user, $userSenha)) //se acessou o modelcategoria com a função add e conseguir add as categorias
            {
                redirect(base_url('admin/usuarios'));
            }
            else
            {
                echo 'Houve um erro no sistema';
            }
        }
    }

    public function excluir($id)
    {
        if(!$this->session->userdata('logado')){ //tudo que colocar aqui, vai ser falnso quando for falsa manda pro login
            redirect(base_url('admin/login'));
        }
        $this->load->model('usuarios_model','modelUsuarios');

        if($this->modelUsuarios->excluir($id)) //se acessou o modelcategoria com a função add e conseguir add as categorias
        {
            redirect(base_url('admin/usuarios'));
        }
        else
        {
            echo 'Houve um erro no sistema';
        }
    }

    public function alterar($id)
    {
        if(!$this->session->userdata('logado')){ //tudo que colocar aqui, vai ser falnso quando for falsa manda pro login
            redirect(base_url('admin/login'));
        }
        $this->load->model('usuarios_model','modelUsuarios'); //carrega o model

        //enviando pra view
        $dados['usuarios'] = $this->modelUsuarios->listar_usuario($id);
        //dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Painel de Controle';
        $dados['subtitulo'] = 'Usuários';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/alterar-usuario');
        $this->load->view('backend/template/html-footer');
    }

    public function salvar_alteracoes()
    {
        if(!$this->session->userdata('logado')){ //tudo que colocar aqui, vai ser falnso quando for falsa manda pro login
            redirect(base_url('admin/login'));
        }
        $this->load->model('usuarios_model','modelUsuarios');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-nome','Nome do Usuário',
                                          'required|min_length[3]');
        $this->form_validation->set_rules('txt-email','Email',
                                          'required|valid_email');
        $this->form_validation->set_rules('txt-historico','Histórico',
                                          'required|min_length[20]');                                          
        $this->form_validation->set_rules('txt-user','User',
                                          'required|min_length[3]|is_unique[usuario.user]');                                                                                    
        $this->form_validation->set_rules('txt-senha','Senha',
                                          'required|min_length[3]');                                                                                    
        $this->form_validation->set_rules('txt-confir-senha','Confirmar Senha',
                                          'required|matches[txt-senha]');   
        if($this->form_validation->run()== FALSE)
        {
            $this->alterar();
        }
        else
        {
            $nome = $this->input->post('txt-nome');
            $email = $this->input->post('txt-email');
            $historico = $this->input->post('txt-historico');
            $user = $this->input->post('txt-user');
            $senha = $this->input->post('txt-senha');
            $id = $this->input->post('txt-id');
            //envia pro model
            if($this->modelUsuarios->alterar($nome, $email, $historico, $user, $senha, $id)) //se acessou o modelcategoria com a função add e conseguir add as categorias
            {
                redirect(base_url('admin/usuarios'));
            }
            else
            {
                echo 'Houve um erro no sistema';
            }
        } 
    }

    public function nova_foto()
    {
        if(!$this->session->userdata('logado')){ //tudo que colocar aqui, vai ser falnso quando for falsa manda pro login
            redirect(base_url('admin/login'));
        }
        $this->load->model('usuarios_model','modelUsuarios'); //carrega o model

        $id = $this->input->post('id'); //recebe o id
        //configura o upload
        $config['upload_path'] = './assets/frontend/img/usuarios'; //caminho da img salva
        $config['allowed_types'] = 'jpg'; //tipo de arquivo suportado
        $config['file_name'] = $id.".jpg";
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config); //carrega a biblioteca de upload

        if(!$this->upload->do_upload()){
            echo $this->upload->display_errors();
        }else{
            $config2['source_image'] = './assets/frontend/img/usuarios/'.$id.'.jpg';
            $config2['create_thumb'] = FALSE;
            $config2['width'] = 200;
            $config2['height'] = 200;
            $this->load->library('image_lib', $config2);
            if($this->image_lib->resize()){

                if($this->modelUsuarios->alterar_img($id)) //se acessou o modelcategoria com a função add e conseguir add as categorias
                {
                    redirect(base_url('admin/usuarios/alterar/'.$id));
                }else{
                    echo 'Houve um erro no sistema';
                }
            }else{
                echo $this->image_lib->display_errors();
            }
        }
        
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

    public function login()
    {
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
            $this->db->where('senha',md5($senha));
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

    public function logout()
    {
        $dadosSessao['userLogado'] = NULL;
        $dadosSessao['logado'] = FALSE;
        $this->session->set_userdata($dadosSessao); //registra no banco
        redirect(base_url('admin/login'));   
    }

  

}

?>
