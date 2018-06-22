<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/welcome
	*	- or -
	* 		http://example.com/index.php/welcome/index
	*	- or -
	* Since this controller is set as the default controller in
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/welcome/<method_name>
	* @see https://codeigniter.com/user_guide/general/urls.html
	*/

	public function verificar_sessao()
	{
		if (!($this->session->userdata('logado'))) {
			$this->session->sess_destroy();

			redirect('usuario/login');
		}
	}

	public function index()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$indice = $this->uri->segment(2);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$disciplinas['disciplinas'] = $this->professor->get_Disciplinas($this->session->userdata('idUsuario'));

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);

		switch ($indice)
		{
			case 1:
			$msg['msg'] = "Dados atualizados com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível atualizar seus dados, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 3:
			$msg['msg'] = "Disciplina cadastrada com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 4:
			$msg['msg'] = "Não foi possível cadastrar a disciplina, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 5:
			$msg['msg'] = "Disciplina atualizada com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 6:
			$msg['msg'] = "Não foi possível atualizar a disciplina, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 7:
			$msg['msg'] = "Disciplina excluída com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 8:
			$msg['msg'] = "Não foi possível excluir a disciplina, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('professor/disciplinas', $disciplinas);
		$this->load->view('includes/html_footer');
	}

	public function criar_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/criar_disciplina');
		$this->load->view('includes/html_footer');
	}

	public function cadastrar_disciplina()
	{
		$this->verificar_sessao();

		$this->load->model('professor_model','professor');

		$disciplina['idProfessor'] = $this->input->post('idProfessor');
		$disciplina['nome_disciplina'] = $this->input->post('nome_disciplina');
		$disciplina['codigo_disciplina'] = $this->input->post('codigo_disciplina');
		$disciplina['descricao_disciplina'] = $this->input->post('descricao_disciplina');

		if ($this->professor->cadastrar_disciplina($disciplina)) {
			redirect('professor/3');
		} else {
			redirect('professor/4');
		}
	}

	public function atualizar_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idDisciplina = $this->uri->segment(3);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$disciplina['disciplina'] = $this->professor->get_Disciplina($idDisciplina);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/editar_disciplina', $disciplina);
		$this->load->view('includes/html_footer');
	}

	public function salvar_atualizacao_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idDisciplina = $this->input->post('idDisciplina');
		$disciplina['nome_disciplina'] = $this->input->post('nome_disciplina');
		$disciplina['codigo_disciplina'] = $this->input->post('codigo_disciplina');
		$disciplina['status_disciplina'] = $this->input->post('status');

		$disciplina['descricao_disciplina'] = $this->input->post('descricao_disciplina');

		if ($this->professor->salvar_atualizacao_disciplina($idDisciplina, $disciplina)) {
			redirect('professor/5');
		} else {
			redirect('professor/6');
		}
	}

	public function excluir_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idDisciplina = $this->input->post('idDisciplina');

		if ($this->professor->excluir_disciplina($idDisciplina)) {
			redirect('professor/7');
		} else {
			redirect('professor/8');
		}
	}

	public function adicionar_conjunto_atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idDisciplina = $this->uri->segment(3);
		$indice = $this->uri->segment(4);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));

		$disciplina['disciplina'] = $this->professor->get_Disciplina($idDisciplina);
		$conjunto_atividades_sem_disciplina['conjunto_atividades_sem_disciplina'] = $this->professor->get_Conjuntos_Sem_Disciplinas($this->session->userdata('idUsuario'));
		$conjunto_atividades_da_disciplina['conjunto_atividades_da_disciplina'] = $this->professor->get_Conjuntos_Da_Disciplinas($this->session->userdata('idUsuario'), $idDisciplina);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);

		switch ($indice) {
			case 1:
			$msg['msg'] = "Conjunto adicionado para a disciplina com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível adicionar o conjunto para a disciplina, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 3:
			$msg['msg'] = "Conjunto removido da disciplina com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 4:
			$msg['msg'] = "Não foi possível remover o conjunto da disciplina, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('professor/cabecalho_disciplina', $disciplina);
		$this->load->view('professor/adicionar_conjunto_atividade', $conjunto_atividades_sem_disciplina);
		$this->load->view('professor/conjuntos_atividades_disciplina', $conjunto_atividades_da_disciplina);
		$this->load->view('includes/html_footer');
	}

	public function cadastrar_conjunto_atividade_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$conjunto_atividade['idDisciplina'] = $this->input->post('idDisciplina');
		$conjunto_atividade['idConjuntoAtividade'] = $this->input->post('idConjuntoAtividade');

		if ($this->professor->cadastrar_conjunto_atividade_disciplina($conjunto_atividade)) {
			redirect('professor/adicionar_conjunto_atividade/'.$conjunto_atividade['idDisciplina'].'/1');
		} else {
			redirect('professor/adicionar_conjunto_atividade/'.$conjunto_atividade['idDisciplina'].'/2');
		}
	}

	public function remove_conjunto_atividade_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$conjunto_atividade = $this->professor->get_Conjunto($this->input->post('idConjuntoAtividadeRemover'));
		$conjunto_atividade[0]->idDisciplina = null;

		if ($this->professor->remove_conjunto_atividade_disciplina($this->input->post('idConjuntoAtividadeRemover'), $conjunto_atividade[0])) {
			redirect('professor/adicionar_conjunto_atividade/'.$this->input->post('idDisciplinaRemover').'/3');
		} else {
			redirect('professor/adicionar_conjunto_atividade/'.$this->input->post('idDisciplinaRemover').'/4');
		}
	}

	public function atividades()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$indice = $this->uri->segment(3);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);

		$conjunto_atividades['conjunto_atividades'] = $this->professor->get_Conjuntos($this->session->userdata('idUsuario'));

		switch ($indice) {
			case 1:
			$msg['msg'] = "Conjunto cadastrado com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível cadastrar o conjunto, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 3:
			$msg['msg'] = "Conjunto atualizado com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 4:
			$msg['msg'] = "Não foi possível atualizar o conjunto de atividades, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 5:
			$msg['msg'] = "Conjunto excluído com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 6:
			$msg['msg'] = "Não foi possível excluír o conjunto, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('professor/conjuntos_atividades', $conjunto_atividades);
		$this->load->view('includes/html_footer');
	}

	public function cadastrar_conjunto_atividades()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$dadosProfessorConjunto['idProfessor'] = $this->session->userdata('idUsuario');
		$dadosProfessorConjunto['nome_conjunto'] = $this->input->post('nome_conjunto');

		if ($this->professor->cadastrar_conjunto_atividades($dadosProfessorConjunto)) {
			redirect('professor/atividades/1');
		} else {
			redirect('professor/atividades/2');
		}
	}

	public function salvar_atualizacao_conjunto_atividades()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$conjunto_atividade['idProfessor'] = $this->session->userdata('idUsuario');
		$conjunto_atividade['nome_conjunto'] = $this->input->post('idNomeConjuntoEditar');
		$conjunto_atividade['idConjuntoAtividade'] = $this->input->post('idConjuntoAtividadeEditar');

		if ($this->professor->salvar_atualizacao_conjunto_atividades($this->input->post('idConjuntoAtividadeEditar'), $conjunto_atividade)) {
			redirect('professor/atividades/3');
		} else {
			redirect('professor/atividades/4');
		}
	}

	public function excluir_conjunto_atividades()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		if ($this->professor->excluir_conjunto_atividades($this->input->post('idConjuntoAtividadeExcluir'))) {
			redirect('professor/atividades/5');;
		} else {
			redirect('professor/atividades/6');
		}
	}

	public function atividades_conjunto()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idConjuntoAtividade = $this->uri->segment(3);
		$indice = $this->uri->segment(4);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);

		$conjunto_atividade['conjunto_atividade'] = $this->professor->get_Conjunto($idConjuntoAtividade);
		$atividades['atividades'] = $this->professor->get_Atividades($idConjuntoAtividade);

		switch ($indice) {
			case 1:
			$msg['msg'] = "Atividade cadastrada com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível cadastrar a atividade, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 3:
			$msg['msg'] = "Atividade atualizada com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 4:
			$msg['msg'] = "Não foi possível atualizar a atividade, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 5:
			$msg['msg'] = "Atividade excluída com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 6:
			$msg['msg'] = "Não foi possível excluír a atividade, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('professor/cabecalho_conjunto_atividade', $conjunto_atividade);
		$this->load->view('professor/atividades_conjunto', $atividades);
		$this->load->view('includes/html_footer');
	}

	public function adicionar_atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$id_conjunto_atividade = $this->uri->segment(3);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$conjunto_atividade['conjunto_atividade'] = $this->professor->get_Conjunto($id_conjunto_atividade);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/criar_atividade', $conjunto_atividade);
		$this->load->view('includes/html_footer');
	}

	public function cadastrar_atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$atividade['nome_atividade'] = $this->input->post('nome_atividade');
		$atividade['descricao_atividade'] = $this->input->post('descricao_atividade');
		$atividade['prazo_entrega'] = $this->input->post('data');
		$atividade['idConjuntoAtividade'] = $this->input->post('idConjuntoAtividade');
		$atividade['idProfessor'] = $this->session->userdata('idUsuario');

		$trofeus = $this->input->post('trofeu');

		foreach ($trofeus as $trofeu) {
			if ($trofeu == 1) {
				$atividade['trofeu_ouro'] = 1;
			} else if ($trofeu == 2) {
				$atividade['trofeu_prata'] = 1;
			} elseif ($trofeu == 3) {
				$atividade['trofeu_bronze'] = 1;
			}
		}

		if ($this->professor->cadastrar_atividade($atividade)) {
			redirect('professor/atividades_conjunto/'.$this->input->post('idConjuntoAtividade').'/1');
		} else {
			redirect('professor/atividades_conjunto/'.$this->input->post('idConjuntoAtividade').'/2');
		}
	}

	public function atualizar_atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAtividade = $this->uri->segment(3);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$atividade['atividade'] = $this->professor->get_Atividade($idAtividade);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/editar_atividade', $atividade);
		$this->load->view('includes/html_footer');
	}


	public function salvar_atualizacao_atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$atividade['idAtividade'] = $this->input->post('idAtividade');
		$atividade['nome_atividade'] = $this->input->post('nome_atividade');
		$atividade['descricao_atividade'] = $this->input->post('descricao_atividade');
		$atividade['prazo_entrega'] = $this->input->post('data');
		$atividade['idConjuntoAtividade'] = $this->input->post('idConjuntoAtividade');
		$atividade['idProfessor'] = $this->session->userdata('idUsuario');

		$trofeus = $this->input->post('trofeu');

		$atividade['trofeu_ouro'] = 0;
		$atividade['trofeu_prata'] = 0;
		$atividade['trofeu_bronze'] = 0;

		foreach ($trofeus as $trofeu) {
			if ($trofeu == 1) {
				$atividade['trofeu_ouro'] = 1;
			} else if ($trofeu == 2) {
				$atividade['trofeu_prata'] = 1;
			} elseif ($trofeu == 3) {
				$atividade['trofeu_bronze'] = 1;
			}
		}

		if ($this->professor->salvar_atualizacao_atividade($this->input->post('idAtividade'), $atividade)) {
			redirect('professor/atividades_conjunto/'.$this->input->post('idConjuntoAtividade').'/3');
		} else {
			redirect('professor/atividades_conjunto/'.$this->input->post('idConjuntoAtividade').'/4');
		}
	}

	public function excluir_atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		if ($this->professor->excluir_atividade($this->input->post('idAtividadeExcluir'))) {
			redirect('professor/atividades_conjunto/'.$this->input->post('idConjuntoAtividadeExcluir').'/5');
		} else {
			redirect('professor/atividades_conjunto/'.$this->input->post('idConjuntoAtividadeExcluir').'/6');
		}
	}

	public function get_Qtd_Atividades()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idConjuntoAtividade = $this->uri->segment(3);

		$this->professor->get_Qtd_Atividades($idConjuntoAtividade);
		// Estava implementado desse jeito antes, a view chamava a model direto
		// $this->professor->get_Qtd_Conjunto_Atividades($disciplina->idDisciplina);
	}

	public function get_Qtd_Conjunto_Atividades()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idDisciplina = $this->uri->segment(3);

		$this->professor->get_Qtd_Conjunto_Atividades($idDisciplina);
		// Estava implementado desse jeito antes, a view chamava a model direto
		// $this->professor->get_Qtd_Atividades($conjunto_atividade->idConjuntoAtividade);
	}

	public function visualizar_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idDisciplina = $this->uri->segment(3);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));

		$disciplina['disciplina'] = $this->professor->get_Disciplina($idDisciplina);
		$conjunto_atividades_da_disciplina['conjunto_atividades_da_disciplina'] = $this->professor->get_Conjuntos_Da_Disciplinas($this->session->userdata('idUsuario'), $idDisciplina);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/cabecalho_disciplina', $disciplina);
		$this->load->view('professor/visualizar_disciplina', $conjunto_atividades_da_disciplina);
		$this->load->view('includes/html_footer');
	}

	public function get_Atividades()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$id_conjunto_atividade = $this->uri->segment(3);

		$this->professor->get_Atividades($id_conjunto_atividade);
	}

	public function solicitacoes_disciplinas()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$indice = $this->uri->segment(3);

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$solicitacoes_disciplinas['solicitacoes_disciplinas'] = $this->professor->get_Solicitacoes_Disciplinas($this->session->userdata('idUsuario'));

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);

		switch ($indice) {
			case 1:
			$msg['msg'] = "Solicitação avaliada com sucesso, agora o aluno poderá reliazar as atividades dessa disciplina.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível avaliar a solicitação, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 3:
			$msg['msg'] = "Solicitação avaliada com sucesso, o aluno não poderá realizar as atividades dessa disciplina.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;
		}

		$this->load->view('professor/solicitacoes_disciplinas', $solicitacoes_disciplinas);
		$this->load->view('includes/html_footer');
	}

	public function get_Nome_Aluno()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAluno = $this->uri->segment(3);

		$this->professor->get_Nome_Aluno($idAluno);
	}

	public function get_Nome_Disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idDisciplina = $this->uri->segment(3);

		$this->professor->get_Nome_Disciplina($idDisciplina);
	}

	public function visualizar_solicitacao()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAluno = $this->uri->segment(3);
		$idDisciplina = $this->uri->segment(4);
		$idProfessor = $this->session->userdata('idUsuario');

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$solicitacao['solicitacao'] = $this->professor->get_Solicitacao($idAluno, $idDisciplina, $idProfessor);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/visualizar_solicitacao', $solicitacao);
		$this->load->view('includes/html_footer');
	}

	public function aceitar_solicitacao()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAluno = $this->uri->segment(3);
		$idDisciplina = $this->uri->segment(4);
		$idProfessor = $this->session->userdata('idUsuario');

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$solicitacao['status_solicitacao'] = 2;

		if ($this->professor->salvar_avaliacao_solicitacao($idAluno, $idDisciplina, $idProfessor, $solicitacao)) {
			$participacao_disciplina['idAluno'] = $idAluno;
			$participacao_disciplina['idDisciplina'] = $idDisciplina;
			$participacao_disciplina['status_participacao'] = 1;
			$participacao_disciplina['idProfessor'] = $idProfessor;

			if ($this->professor->salvar_Participacao_Disciplina($participacao_disciplina)) {
				redirect('professor/solicitacoes_disciplinas/1');
			} else {
				redirect('professor/solicitacoes_disciplinas/2');
			}
		} else {
			redirect('professor/solicitacoes_disciplinas/2');
		}
	}

	public function recusar_solicitacao()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAluno = $this->uri->segment(3);
		$idDisciplina = $this->uri->segment(4);
		$idProfessor = $this->session->userdata('idUsuario');

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$solicitacao['status_solicitacao'] = 3;

		if ($this->professor->salvar_avaliacao_solicitacao($idAluno, $idDisciplina, $idProfessor, $solicitacao)) {
			$participacao_disciplina['idAluno'] = $idAluno;
			$participacao_disciplina['idDisciplina'] = $idDisciplina;
			$participacao_disciplina['status_participacao'] = 0;
			$participacao_disciplina['idProfessor'] = $idProfessor;

			if ($this->professor->salvar_Participacao_Disciplina($participacao_disciplina)) {
				redirect('professor/solicitacoes_disciplinas/3');
			} else {
				redirect('professor/solicitacoes_disciplinas/2');
			}
		} else {
			redirect('professor/solicitacoes_disciplinas/2');
		}
	}

	public function get_Solicitacoes()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idProfessor = $this->uri->segment(3);

		$this->professor->get_Solicitacoes($idProfessor);
	}

	public function avaliacoes_atividades_realizada()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$atividadesRealizada['atividadesRealizada'] = $this->professor->get_Atividades_Realizadas($this->session->userdata('idUsuario'));

		$indice = $this->uri->segment(3);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');

		switch ($indice) {
			case 1:
			$msg['msg'] = "Atividade avaliada com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível avaliar a atividade, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/avaliacoes_atividades_realizada', $atividadesRealizada);
		$this->load->view('includes/html_footer');
	}

	public function get_Atividades_Realizadas()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idProfessor = $this->uri->segment(3);

		$this->professor->get_Atividades_Realizadas($idProfessor);
	}

	public function get_Nome_Atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAtividade = $this->uri->segment(3);

		$this->aluno->get_Nome_Atividade($idAtividade);
	}

	public function get_Prazo_Atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAtividade = $this->uri->segment(3);

		$this->aluno->get_Prazo_Atividade($idAtividade);
	}

	public function get_Pontos_Atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAtividade = $this->uri->segment(3);

		$this->aluno->get_Pontos_Atividade($idAtividade);
	}

	public function get_Descricao_Atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAtividade = $this->uri->segment(3);

		$this->aluno->get_Descricao_Atividade($idAtividade);
	}

	public function get_Status_Atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAtividade = $this->uri->segment(3);
		$idAluno = $this->uri->segment(4);

		$this->aluno->get_Status_Atividade($idAtividade, $idAluno);
	}

	public function avaliar_atividade_realizada()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAtividade = $this->uri->segment(3);
		$idAluno = $this->uri->segment(4);
		$indice = $this->uri->segment(5);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');

		switch ($indice) {
			case 1:
			$msg['msg'] = "Arquivo baixado com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível baixar o arquivo, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$atividadeRealizada['atividadeRealizada'] = $this->professor->get_Atividade_Realizada($idAtividade, $idAluno);

		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/avaliar_atividade_realizada', $atividadeRealizada);
		$this->load->view('includes/html_footer');
	}

	public function downloadAnexo()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$nomeArquivo = $this->uri->segment(3);
		$idAtividade = $this->uri->segment(4);
		$idAluno = $this->uri->segment(5);
		$caminhoArquivo = "application/anexos/".$nomeArquivo;

		$this->load->helper('download');

		if (force_download($caminhoArquivo, NULL)) {
			redirect('professor/avaliar_atividade_realizada/'.$idAtividade.'/'.$idAluno.'/1');
		} else {
			redirect('professor/avaliar_atividade_realizada/'.$idAtividade.'/'.$idAluno.'/2');
		}
	}

	public function salvar_avaliacao_atividade()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAtividade = $this->input->post('idAtividade');
		$idAluno = $this->input->post('idAluno');

		$atividadeAvaliada = $this->professor->get_Atividade_Realizada($idAtividade, $idAluno);
		$atividadeAvaliada[0]->status_avaliacao = $this->input->post('status_avaliacao');
		$atividadeAvaliada[0]->resposta_professor = $this->input->post('resposta_professor');

		if ($this->professor->salvar_avaliacao_atividade($idAtividade, $idAluno, $atividadeAvaliada[0])) {
			redirect('professor/avaliacoes_atividades_realizada/1');
		} else {
			redirect('professor/avaliacoes_atividades_realizada/2');
		}
	}

	public function alunos_matriculado()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$quantidadeSolicitacoesPendentes['quantidadeAtividadesNaoAvaliada'] =	$this->professor->get_Atividades_Nao_Avaliada($this->session->userdata('idUsuario'));
		$quantidadeSolicitacoesPendentes['quantidadeSolicitacoesPendentes'] =	$this->professor->get_Solicitacoes($this->session->userdata('idUsuario'));
		$alunosMatriculados['alunosMatriculados'] = $this->professor->get_Alunos_Matriculado($this->session->userdata('idUsuario'));

		$indice = $this->uri->segment(3);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');

		switch ($indice) {
			case 1:
			$msg['msg'] = "Matrícula excluída com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível excluír a matrícula, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('professor/menu_lateral', $quantidadeSolicitacoesPendentes);
		$this->load->view('professor/alunos_matriculado', $alunosMatriculados);
		$this->load->view('includes/html_footer');
	}

	public function excluir_matricula()
	{
		$this->verificar_sessao();
		$this->load->model('professor_model','professor');

		$idAluno = $this->uri->segment(3);
		$idDisciplina = $this->uri->segment(4);
		$idProfessor = $this->session->userdata('idUsuario');

		if ($this->professor->excluir_matricula($idAluno, $idDisciplina, $idProfessor)) {
			$solicitacao['idAluno'] = $idAluno;
			$solicitacao['idDisciplina'] = $idDisciplina;
			$solicitacao['idProfessor'] = $idProfessor;
			$solicitacao['status_solicitacao'] = 3;

			if ($this->professor->salvar_atualizacao_solicitacao($idAluno, $idProfessor, $idDisciplina, $solicitacao)) {
				redirect('professor/alunos_matriculado/1');
			} else {
				redirect('professor/alunos_matriculado/2');
			}
		} else {
			redirect('professor/alunos_matriculado/2');
		}
	}

}
