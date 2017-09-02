<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacoes_model extends CI_Model {

    public $id;
    public $categoria;
    public $titulo;
    public $subtitulo;
    public $conteudo;
    public $data;
    public $img;
    public $user;

    
    public function __construct()
    {
        parent::__construct();
    }

    public function destaques_home()
    {
        // select nas colunas das tabelas usuario e postagens
        $this->db->select('
        usuario.id as idautor,
        usuario.nome, 
        postagens.id, 
        postagens.titulo,
        postagens.subtitulo,
        postagens.user,
        postagens.data,
        postagens.img');
        // esses dados vão ser puxados da tabela postagens
        $this->db->from('postagens');
        // com um join, com uma inserção da tabela usuário, aonde o id do usuário for igual oo user da postagem
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->limit(4);
        $this->db->order_by('postagens.data','DESC'); //ordenando a consulta na coluna título em ordem crescente
        return $this->db->get()->result(); //referenciando a tabela e manda o resultado pro controller
    }

     public function publicacao($id)
    {
        $this->db->select('
        usuario.id as idautor,
        usuario.nome, 
        postagens.id, 
        postagens.titulo,
        postagens.subtitulo,
        postagens.user,
        postagens.data,
        postagens.img,
        postagens.categoria,
        postagens.conteudo');
        // esses dados vão ser puxados da tabela postagens
        $this->db->from('postagens');
        // com um join, com uma inserção da tabela usuário, aonde o id do usuário for igual oo user da postagem
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->where('postagens.id ='.$id);
        return $this->db->get()->result(); //referenciando a tabela e manda o resultado pro controller
    }

    public function listar_titulo($id){
        $this->db->select('id,titulo');
        $this->db->from('postagens');
        $this->db->where('id ='.$id);
        return $this->db->get()->result();
    }
}

?>