<?php

class Usuario_model extends CI_Model
{
  function __contruct()
  {
    parent::__construct();
  }

  public function cadastrar($dadosUsuario)
  {
    return $this->db->insert('professor', $dadosUsuario);
  }

  public function valida_Usuario($email, $senha)
  {
    $this->db->where('email', $email);
    $this->db->where('senha', $senha);

    return $this->db->get('professor')->result();
  }

  public function get_Usuario($idProfessor=null)
  {
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->get('professor')->result();
  }

  public function excluir($idProfessor=null)
  {
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->delete('professor');
  }

  public function salvar_atualizacao($idProfessor, $dadosUsuario)
  {
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->update('professor', $dadosUsuario);
  }

  public function salvar_senha($idProfessor, $senhaAntiga, $senhaNova)
  {
    $this->db->select('senha');
    $this->db->where('idProfessor', $idProfessor);

    $dadosUsuario['senha'] = $this->db->get('professor')->result();
    $novosDados['senha'] = $senhaNova;

    if ($dadosUsuario['senha'][0]->senha == $senhaAntiga) {
      $this->db->where('idProfessor', $idProfessor);
      $this->db->update('professor', $novosDados);

      return true;
    } else {
      return false;
    }
  }

}

?>
