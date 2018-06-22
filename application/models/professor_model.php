<?php

class Professor_model extends CI_Model
{
  function __contruct()
  {
    parent::__construct();
  }

  public function cadastrar_disciplina($disciplina)
  {
    return $this->db->insert('disciplina', $disciplina);
  }

  public function get_Disciplinas($idProfessor=null)
  {
    $this->db->select('*');
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->get('disciplina')->result();
  }

  public  function get_Disciplina($idDisciplina=null)
  {
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->get('disciplina')->result();
  }

  public function salvar_atualizacao_disciplina($idDisciplina=null, $disciplina)
  {
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->update('disciplina', $disciplina);
  }

  public function excluir_disciplina($idDisciplina=null)
  {
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->delete('disciplina');
  }
}

?>
