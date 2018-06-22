<?php

class Aluno_model extends CI_Model
{
  function __contruct()
  {
    parent::__construct();
  }

  public function get_Disciplinas_Matriculado($idAluno=null)
  {
    $this->db->select('*');
    $this->db->where('idAluno', $idAluno);
    $this->db->where('status_participacao', 1);

    return $this->db->get('participa_disciplina')->result();
  }

  public  function get_Disciplinas_Nao_Matriculado($idDisciplina=null)
  {
    $this->db->select('*');
    $this->db->where('idAluno', $idAluno);
    $this->db->where('status_participacao', 0);

    return $this->db->get('participa_disciplina')->result();
  }

  public function get_Nome_Professor($idDisciplina=null)
  {
    $this->db->select('*');
    $this->db->where('idDisciplina', $idDisciplina);

    $disciplina = $this->db->get('disciplina')->result();

    $this->db->where('idUsuario', $disciplina[0]->idProfessor);

    $professor = $this->db->get('usuario')->result();

    return $professor[0]->nome;
  }

  public function get_Nome_Disciplina($idDisciplina=null)
  {
    $this->db->where('idDisciplina', $idDisciplina);

    $disciplina = $this->db->get('disciplina')->result();

    return $disciplina[0]->nome_disciplina;
  }

  public function get_Cod_Disciplina($idDisciplina=null)
  {
    $this->db->where('idDisciplina', $idDisciplina);

    $disciplina = $this->db->get('disciplina')->result();

    return $disciplina[0]->codigo_disciplina;
  }

  public function get_Status_Disciplina($idDisciplina=null)
  {
    $this->db->where('idDisciplina', $idDisciplina);

    $disciplina = $this->db->get('disciplina')->result();

    return $disciplina[0]->status_disciplina;
  }

  public function get_Disciplinas()
  {
    $this->db->select('*');
    $this->db->where('status_disciplina', 2);

    return $this->db->get('disciplina')->result();
  }

  public function get_Disciplina($idDisciplina=null)
  {
    $this->db->select('*');
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->get('disciplina')->result();
  }

  public function salvar_solicitacao_disciplina($solicitacao)
  {
    return $this->db->insert('solicitacao_disciplina', $solicitacao);
  }

  public function get_Solicitacoes($idAluno=null)
  {
    $this->db->select('*');
    $this->db->where('idAluno', $idAluno);

    return $this->db->get('solicitacao_disciplina')->result();
  }

  public function excluir_solicitacao($idAluno=null, $idDisciplina=null)
  {
    $this->db->where('idAluno', $idAluno);
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->delete('solicitacao_disciplina');
  }

  public function get_Solicitacao($idAluno=null, $idDisciplina=null)
  {
    $this->db->select('*');
    $this->db->where('idAluno', $idAluno);
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->get('solicitacao_disciplina')->result();
  }

  public function salvar_atualizacao_solicitacao($idAluno=null, $idDisciplina=null, $solicitacao)
  {
    $this->db->where('idAluno', $idAluno);
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->update('solicitacao_disciplina', $solicitacao);
  }

  public function get_Conjuntos_Da_Disciplinas($idUsuario=null, $idDisciplina)
  {
    $this->db->select('*');
    $this->db->where('idProfessor', $idUsuario);
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->get('conjunto_atividade')->result();
  }

  public function get_Atividades($id_conjunto_atividade=null)
  {
    $this->db->select('*');
    $this->db->where('idConjuntoAtividade', $id_conjunto_atividade);

    return $this->db->get('atividade')->result();
  }

  public function get_Atividade($idAtividade=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);

    return $this->db->get('atividade')->result();
  }

  public function get_Nome_Conjunto($id_conjunto_atividade=null)
  {
    $this->db->select('*');
    $this->db->where('idConjuntoAtividade', $id_conjunto_atividade);

    return $this->db->get('conjunto_atividade')->result();
  }

  public function salvar_atividade_enviada($atividadeRealizada)
  {
    return $this->db->insert('realiza_atividade', $atividadeRealizada);
  }

  public function get_Status_Atividade($idAtividade=null, $idAluno=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);
    $this->db->where('idAluno', $idAluno);

    $atividadeRealizada = $this->db->get('realiza_atividade')->result();

    if ($atividadeRealizada == null) {
      return 1;
    } else {
      return $atividadeRealizada[0]->status_avaliacao;
    }
  }

}

?>
