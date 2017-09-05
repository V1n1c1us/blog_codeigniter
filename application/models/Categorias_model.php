<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    public $id;
    public $titulo;
    
    public function __construct(){
        parent::__construct();
    }

    public function listar_categorias(){
        $this->db->order_by('titulo','ASC'); //ordenando a consulta na coluna título em ordem crescente
        return $this->db->get('categoria')->result(); //referenciando a tabela e manda o resultado pro controller
    }

    public function listar_titulo($id){
        $this->db->from('categoria');
        $this->db->where('id ='.$id);
        return $this->db->get()->result();
    }

    public function categorias_pub($id)
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
        postagens.categoria');
        // esses dados vão ser puxados da tabela postagens
        $this->db->from('postagens');
        // com um join, com uma inserção da tabela usuário, aonde o id do usuário for igual oo user da postagem
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->where('postagens.categoria ='.$id);
        $this->db->order_by('postagens.data','DESC');
        return $this->db->get()->result(); //referenciando a tabela e manda o resultado pro controller
    }

    public function adicionar($titulo)
    {
        $dados['titulo'] = $titulo; //titulo que vem do fomr na posição título, coluna da tab categoria
        return $this->db->insert('categoria',$dados); //insere na tabela todos os dados dentro da var $dados
    }

    public function excluir($id)
    {
        $this->db->where('md5(id)',$id);
        return $this->db->delete('categoria');

    }

    public function listar_categoria($id){
        $this->db->from('categoria');
        $this->db->where('md5(id)',$id);
        return $this->db->get()->result();
    }

    public function alterar($titulo, $id)
    {
        $dados['titulo'] = $titulo;
        $this->db->where('id',$id);
        return $this->db->update('categoria',$dados);
    }



 
}

?>