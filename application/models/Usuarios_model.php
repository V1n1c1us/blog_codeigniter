<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public $id;
    public $nome;
    public $email;
    public $img;
    public $historico;
    public $user;
    public $senha;
    
    public function __construct(){
        parent::__construct();
    }

    public function listar_autor($id)
    {
        $this->db->select('id,nome,historico,img');
        $this->db->from('usuario');
        $this->db->where('id ='.$id);
        return $this->db->get()->result();
    }

    public function listar_autores()
    {
        $this->db->select('id,nome,img');
        $this->db->from('usuario');
        $this->db->order_by('nome','ASC');
        return $this->db->get()->result();
    }

    public function adicionar($nomeUser, $emailUser, $historicoUser, $user, $userSenha)
    {
        $dados['nome'] = $nomeUser; //titulo que vem do fomr na posição título, coluna da tab categoria
        $dados['email'] = $emailUser;
        $dados['historico'] = $historicoUser;
        $dados['user'] = $user;
        $dados['senha'] = md5($userSenha);
        
        return $this->db->insert('usuario',$dados); //insere na tabela todos os dados dentro da var $dados
    }

    public function excluir($id)
    {
        $this->db->where('md5(id)',$id);
        return $this->db->delete('usuario');

    }
}

?>