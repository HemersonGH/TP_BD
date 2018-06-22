<?php

class Usuario_model extends CI_Model
{
  function __contruct()
  {
    parent::__construct();
  }

  public function cadastrar($dadosUsuario)
  {
    return $this->db->insert('usuario', $dadosUsuario);
  }

  public function valida_Usuario($email, $senha)
  {
    $this->db->where('email', $email);
    $this->db->where('senha', $senha);

    return $this->db->get('usuario')->result();
  }

  public function get_Usuario($idUsuario=null)
  {
    $this->db->where('idUsuario', $idUsuario);

    return $this->db->get('usuario')->result();
  }

  public function excluir($idUsuario=null)
  {
    $this->db->where('idUsuario', $idUsuario);

    return $this->db->delete('usuario');
  }

  public function salvar_atualizacao($idUsuario, $dadosUsuario)
  {
    $this->db->where('idUsuario', $idUsuario);

    return $this->db->update('usuario', $dadosUsuario);
  }

  public function salvar_senha($idUsuario, $senhaAntiga, $senhaNova)
  {
    $this->db->select('senha');
    $this->db->where('idUsuario', $idUsuario);

    $dadosUsuario['senha'] = $this->db->get('usuario')->result();
    $novosDados['senha'] = $senhaNova;

    if ($dadosUsuario['senha'][0]->senha == $senhaAntiga) {
      $this->db->where('idUsuario', $idUsuario);
      $this->db->update('usuario', $novosDados);

      return true;
    } else {
      return false;
    }
  }

  public function get_Solicitacoes($idProfessor=null)
  {
    $this->db->select('count(*) as total');
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('status_solicitacao', 1);

    $qtd = $this->db->get('solicitacao_disciplina')->result();

    return $qtd[0]->total;
  }

  public function get_Atividades_Nao_Avaliada($idProfessor=null)
  {
    $this->db->select('count(*) as total');
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('status_avaliacao', 2);

    $qtd = $this->db->get('realiza_atividade')->result();

    return $qtd[0]->total;
  }

}

?>
