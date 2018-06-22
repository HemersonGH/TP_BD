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

  public function cadastrar_conjunto_atividades($conjunto_atividade)
  {
    return $this->db->insert('conjunto_atividade', $conjunto_atividade);
  }

  public function get_Conjuntos($idProfessor=null)
  {
    $this->db->select('*');
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->get('conjunto_atividade')->result();
  }

  public function get_Conjuntos_Sem_Disciplinas($idProfessor=null)
  {
    $this->db->select('*');
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('idDisciplina', null);

    return $this->db->get('conjunto_atividade')->result();
  }

  public function get_Conjuntos_Da_Disciplinas($idProfessor=null, $idDisciplina)
  {
    $this->db->select('*');
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->get('conjunto_atividade')->result();
  }

  public function get_Conjunto($id_conjunto_atividade=null)
  {
    $this->db->where('idConjuntoAtividade', $id_conjunto_atividade);

    return $this->db->get('conjunto_atividade')->result();
  }

  public function salvar_atualizacao_conjunto_atividades($id_conjunto_atividade=null, $conjunto_atividade)
  {
    $this->db->where('idConjuntoAtividade', $id_conjunto_atividade);

    return $this->db->update('conjunto_atividade', $conjunto_atividade);
  }

  public function excluir_conjunto_atividades($id_conjunto_atividade=null)
  {
    $this->db->where('idConjuntoAtividade', $id_conjunto_atividade);

    return $this->db->delete('conjunto_atividade');
  }

  public function cadastrar_atividade($atividade=null)
  {
    return $this->db->insert('atividade', $atividade);
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

  public function get_Qtd_Atividades($id_conjunto_atividade=null)
  {
    $this->db->select('count(*) as total');
    $this->db->where('idConjuntoAtividade', $id_conjunto_atividade);

    $qtd = $this->db->get('atividade')->result();

    return $qtd[0]->total;
  }

  public function get_Qtd_Conjunto_Atividades($idDisciplina=null)
  {
    $this->db->select('count(*) as total');
    $this->db->where('idDisciplina', $idDisciplina);

    $qtd = $this->db->get('conjunto_atividade')->result();

    return $qtd[0]->total;
  }

  public function salvar_atualizacao_atividade($idAtividade=null, $atividade)
  {
    $this->db->where('idAtividade', $idAtividade);

    return $this->db->update('atividade', $atividade);
  }

  public function excluir_atividade($idAtividade=null)
  {
    $this->db->where('idAtividade', $idAtividade);

    return $this->db->delete('atividade');
  }

  public function cadastrar_conjunto_atividade_disciplina($conjunto_atividade)
  {
    $this->db->where('idConjuntoAtividade', $conjunto_atividade['idConjuntoAtividade']);

    return $this->db->update('conjunto_atividade', $conjunto_atividade);
  }

  public function remove_conjunto_atividade_disciplina($idConjuntoAtividade=null, $conjunto_atividade)
  {
    $this->db->where('idConjuntoAtividade', $idConjuntoAtividade);

    return $this->db->update('conjunto_atividade', $conjunto_atividade);
  }

  public function get_Solicitacoes_Disciplinas($idProfessor=null)
  {
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('status_solicitacao', 1);

    return $this->db->get('solicitacao_disciplina')->result();
  }

  public function get_Nome_Aluno($idAluno=null)
  {
    $this->db->where('idUsuario', $idAluno);

    $aluno = $this->db->get('usuario')->result();

    return $aluno[0]->nome;
  }

  public function get_Nome_Disciplina($idDisciplina=null)
  {
    $this->db->where('idDisciplina', $idDisciplina);

    $disciplina = $this->db->get('disciplina')->result();

    return $disciplina[0]->nome_disciplina;
  }

  public function get_Codigo_Disciplina($idDisciplina=null)
  {
    $this->db->where('idDisciplina', $idDisciplina);

    $disciplina = $this->db->get('disciplina')->result();

    return $disciplina[0]->codigo_disciplina;
  }

  public function excluir_solicitacao($idSolicitacao=null)
  {
    $this->db->where('idSolicitacao', $idSolicitacao);

    return $this->db->delete('solicitacao_disciplina');
  }

  public function get_Solicitacao($idAluno=null, $idDisciplina=null, $idProfessor=null)
  {
    $this->db->select('*');
    $this->db->where('idAluno', $idAluno);
    $this->db->where('idDisciplina', $idDisciplina);
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->get('solicitacao_disciplina')->result();
  }

  public function salvar_avaliacao_solicitacao($idAluno=null, $idDisciplina=null, $idProfessor=null, $solicitacao)
  {
    $this->db->where('idAluno', $idAluno);
    $this->db->where('idDisciplina', $idDisciplina);
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->update('solicitacao_disciplina', $solicitacao);
  }

  public function salvar_Participacao_Disciplina($participacao_disciplina)
  {
    return $this->db->insert('participa_disciplina', $participacao_disciplina);
  }

  public function atualiza_Participacao_Disciplina($participacao_disciplina)
  {
    $this->db->where('idAluno', $participacao_disciplina['idAluno']);
    $this->db->where('idDisciplina', $participacao_disciplina['idDisciplina']);

    return $this->db->update('participa_disciplina', $participacao_disciplina);
  }

  public function get_Solicitacoes($idProfessor=null)
  {
    $this->db->select('count(*) as total');
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('status_solicitacao', 1);

    $qtd = $this->db->get('solicitacao_disciplina')->result();

    return $qtd[0]->total;
  }

  public function get_Participacao($participacao_disciplina)
  {
    $this->db->where('idAluno', $participacao_disciplina['idAluno']);
    $this->db->where('idDisciplina', $participacao_disciplina['idDisciplina']);
    $this->db->where('status_participacao', 1);

    return $this->db->get('participa_disciplina')->result();
  }

  public function get_Atividades_Realizadas($idProfessor=null)
  {
    $this->db->select('*');
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->get('realiza_atividade')->result();
  }

  public function get_Nome_Conjunto($idAtividade=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);
    $atividade = $this->db->get('atividade')->result();

    $this->db->select('*');
    $this->db->where('idConjuntoAtividade', $atividade[0]->idConjuntoAtividade);
    $conjunto_atividade = $this->db->get('conjunto_atividade')->result();

    return $conjunto_atividade[0]->nome_conjunto;
  }

  public function get_Nome_Atividade($idAtividade=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);
    $atividade = $this->db->get('atividade')->result();

    return $atividade[0]->nome_atividade;
  }

  public function get_Trofeu_Ouro($idAtividade=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);
    $atividade = $this->db->get('atividade')->result();

    return $atividade[0]->trofeu_ouro;
  }

  public function get_Trofeu_Prata($idAtividade=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);
    $atividade = $this->db->get('atividade')->result();

    return $atividade[0]->trofeu_prata;
  }

  public function get_Trofeu_Bronze($idAtividade=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);
    $atividade = $this->db->get('atividade')->result();

    return $atividade[0]->trofeu_bronze;
  }

  public function get_Prazo_Atividade($idAtividade=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);
    $atividade = $this->db->get('atividade')->result();

    return $atividade[0]->prazo_entrega;
  }

  public function get_Descricao_Atividade($idAtividade=null)
  {
    $this->db->select('*');
    $this->db->where('idAtividade', $idAtividade);
    $atividade = $this->db->get('atividade')->result();

    return $atividade[0]->descricao_atividade;
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

  public function get_Atividade_Realizada($idAtividade=null, $idAluno=null)
  {
    $this->db->where('idAtividade', $idAtividade);
    $this->db->where('idAluno', $idAluno);

    return $this->db->get('realiza_atividade')->result();
  }

  public function salvar_avaliacao_atividade($idAtividade=null, $idAluno=null, $atividadeAvaliada)
  {
    $this->db->where('idAtividade', $idAtividade);
    $this->db->where('idAluno', $idAluno);

    return $this->db->update('realiza_atividade', $atividadeAvaliada);
  }

  public function get_Atividades_Nao_Avaliada($idProfessor=null)
  {
    $this->db->select('count(*) as total');
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('status_avaliacao', 2);

    $qtd = $this->db->get('realiza_atividade')->result();

    return $qtd[0]->total;
  }

  public function get_Alunos_Matriculado($idProfessor=null)
  {
    $this->db->select('*');
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('status_participacao', 1);

    return $this->db->get('participa_disciplina')->result();
  }

  public function excluir_matricula($idAluno=null, $idDisciplina=null, $idProfessor=null)
  {
    $this->db->where('idAluno', $idAluno);
    $this->db->where('idDisciplina', $idDisciplina);
    $this->db->where('idProfessor', $idProfessor);

    return $this->db->delete('participa_disciplina');
  }

  public function salvar_atualizacao_solicitacao($idAluno=null, $idProfessor=null, $idDisciplina=null, $solicitacao)
  {
    $this->db->select('*');
    $this->db->where('idAluno', $idAluno);
    $this->db->where('idProfessor', $idProfessor);
    $this->db->where('idDisciplina', $idDisciplina);

    return $this->db->update('solicitacao_disciplina', $solicitacao);
  }
}

?>
