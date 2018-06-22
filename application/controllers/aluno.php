<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends CI_Controller {

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
		$this->load->model('aluno_model','aluno');

		$indice = $this->uri->segment(2);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');

		$disciplinas_matriculado['disciplinas_matriculado'] = $this->aluno->get_Disciplinas_Matriculado($this->session->userdata('idUsuario'));

		switch ($indice) {
			case 1:
			$msg['msg'] = "Dados atualizados com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 2:
			$msg['msg'] = "Não foi possível atualizar seus dados, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('aluno/menu_lateral');
		$this->load->view('aluno/disciplinas', $disciplinas_matriculado);
		$this->load->view('includes/html_footer');
	}

	public function get_Nome_Professor()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idProfessor = $this->uri->segment(3);

		$this->aluno->get_Nome_Professor($idProfessor);
	}

	public function get_Nome_Disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idDisciplina = $this->uri->segment(3);

		$this->aluno->get_Nome_Disciplina($idDisciplina);
	}

	public function get_Cod_Disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idDisciplina = $this->uri->segment(3);

		$this->aluno->get_Cod_Disciplina($idDisciplina);
	}

	public function get_Status_Disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idDisciplina = $this->uri->segment(3);

		$this->aluno->get_Status_Disciplina($idDisciplina);
	}

	public function matricular_Disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$indice = $this->uri->segment(3);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');

		$disciplinas['disciplinas'] = $this->aluno->get_Disciplinas();
		$solicitacoes['solicitacoes'] = $this->aluno->get_Solicitacoes($this->session->userdata('idUsuario'));

		switch ($indice) {
			case 1:
			$msg['msg'] = "Você já solicitou matrícula para essa disciplina, aguarde a resposta do professor.";
			$this->load->view('includes/msg_alerta', $msg);
			break;

			case 2:
			$msg['msg'] = "Solicitacao enviada com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 3:
			$msg['msg'] = "Não foi possível enviar sua solicitação, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 4:
			$msg['msg'] = "Solicitacao excluída com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 5:
			$msg['msg'] = "Não foi possível excluír sua solicitação, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 6:
			$msg['msg'] = "Solicitacao atualizada com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 7:
			$msg['msg'] = "Não foi possível atualizar sua solicitação, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('aluno/menu_lateral');
		$this->load->view('aluno/matricular_disciplina', $disciplinas);
		$this->load->view('aluno/solicitacoes_enviadas', $solicitacoes);
		$this->load->view('includes/html_footer');
	}

	public function solicitar_Matricula()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$disciplina['disciplina'] = $this->aluno->get_Disciplina($this->input->post('idDisciplina'));

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('aluno/menu_lateral');
		$this->load->view('aluno/solicitar_matricula', $disciplina);
		$this->load->view('includes/html_footer');
	}

	public function salvar_solicitacao_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$solicitacao['idAluno'] = $this->session->userdata('idUsuario');
		$solicitacao['idDisciplina'] = $this->input->post('idDisciplina');
		$solicitacao['idProfessor'] = $this->input->post('idProfDisciplina');
		$solicitacao['justificativa_aluno'] = $this->input->post('justificativa_aluno');

		$solicitada = $this->aluno->get_Solicitacao($this->session->userdata('idUsuario'), $this->input->post('idDisciplina'));

		if ($solicitada[0]->status_solicitacao == 3) {
			$solicitacao['status_solicitacao'] = 1;

			if ($this->aluno->salvar_atualizacao_solicitacao($this->session->userdata('idUsuario'), $this->input->post('idDisciplina'), $solicitacao)) {

				redirect('aluno/matricular_disciplina/2');
			} else {
				redirect('aluno/matricular_disciplina/3');
			}
		}

		if (count($solicitada) == 1 && $solicitada[0]->status_solicitacao != 3) {
			redirect('aluno/matricular_disciplina/1');
		}

		if ($this->aluno->salvar_solicitacao_disciplina($solicitacao)) {
			redirect('aluno/matricular_disciplina/2');
		} else {
			redirect('aluno/matricular_disciplina/3');
		}
	}

	public function excluir_solicitacao()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idAluno = $this->session->userdata('idUsuario');
		$idDisciplina = $this->input->post('idDisciplinaSolicitacao');

		if ($this->aluno->excluir_solicitacao($idAluno, $idDisciplina)) {
			redirect('aluno/matricular_disciplina/4');
		} else {
			redirect('aluno/matricular_disciplina/5');
		}
	}

	public function visualizar_Solicitacao()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idAluno = $this->session->userdata('idUsuario');
		$idDisciplina = $this->uri->segment(3);

		$solicitacao['solicitacao'] = $this->aluno->get_Solicitacao($idAluno, $idDisciplina);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('aluno/menu_lateral');
		$this->load->view('aluno/visualizar_solicitacao', $solicitacao);
		$this->load->view('includes/html_footer');
	}

	public function editar_solicitacao()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idAluno = $this->session->userdata('idUsuario');
		$idDisciplina = $this->uri->segment(3);

		$solicitacao['solicitacao'] = $this->aluno->get_Solicitacao($idAluno, $idDisciplina);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('aluno/menu_lateral');
		$this->load->view('aluno/editar_solicitacao', $solicitacao);
		$this->load->view('includes/html_footer');
	}

	public function salvar_atualizacao_solicitacao()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idAluno = $this->session->userdata('idUsuario');
		$idDisciplina = $this->input->post('idDisciplina');

		$solicitacao['justificativa_aluno'] = $this->input->post('justificativa_aluno');

		if ($this->aluno->salvar_atualizacao_solicitacao($idAluno, $idDisciplina, $solicitacao)) {
			redirect('aluno/matricular_disciplina/6');
		} else {
			redirect('aluno/matricular_disciplina/7');
		}
	}

	public function atividades_disciplina()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idDisciplina = $this->uri->segment(3);
		$indice = $this->uri->segment(4);

		$disciplina = $this->aluno->get_Disciplina($idDisciplina);
		$conjuntos_disciplina['conjuntos_disciplina'] = $this->aluno->get_Conjuntos_Da_Disciplinas($disciplina[0]->idProfessor, $idDisciplina);
		$nomeDisciplina['nomeDisciplina'] = $disciplina[0]->nome_disciplina;

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('aluno/menu_lateral');

		switch ($indice) {
			case 1:
			$msg['msg'] = "Não foi possível fazer o upload do seu arquivo, tente novamente ou contate o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;

			case 2:
			$msg['msg'] = "Sua atividade foi enviada com sucesso, aguarde a correção pelo professor.";
			$this->load->view('includes/msg_sucesso', $msg);
			break;

			case 3:
			$msg['msg'] = "Não foi possível enviar sua atividade, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
			break;
		}

		$this->load->view('aluno/cabecalho_disciplina', $nomeDisciplina);
		$this->load->view('aluno/atividades_disciplina', $conjuntos_disciplina);
		$this->load->view('includes/html_footer');
	}

	public function get_Atividades()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$id_conjunto_atividade = $this->uri->segment(3);

		$this->aluno->get_Atividades($id_conjunto_atividade);
	}

	public function enviar_atividade()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idAtividade = $this->uri->segment(3);

		$atividade = $this->aluno->get_Atividade($idAtividade);
		$conjunto = $this->aluno->get_Nome_Conjunto($atividade[0]->idConjuntoAtividade);
		$atividadeEnviar['atividadeEnviar'] = $this->aluno->get_Atividade($idAtividade);
		$atividadeEnviar['idDisciplina'] = $conjunto[0]->idDisciplina;
		$nomeConjunto['nomeConjunto'] = $conjunto[0]->nome_conjunto;

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('aluno/menu_lateral');
		$this->load->view('aluno/cabecalho_conjunto_atividade', $nomeConjunto);
		$this->load->view('aluno/enviar_atividade', $atividadeEnviar);
		$this->load->view('includes/html_footer');
	}

	public function get_Atividade()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idAtividade = $this->uri->segment(3);

		$this->aluno->get_Atividades($idAtividade);
	}

	public function salvar_atividade_enviada()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$disciplina  = $this->aluno->get_Disciplina($this->input->post('idDisciplina'));
		$nomeAluno   = str_replace(" ", "_", $this->session->userdata('nome'));
		$nomeArquivo = $nomeAluno.'_'.$this->session->userdata('idUsuario').'_'.$this->input->post('idAtividade');

		$anexo = $_FILES['anexo'];
		$extensao = @end(explode('.', $_FILES['anexo']['name']));

		$configuracao['upload_path']    = "application/anexos/";
		$configuracao['allowed_types']  = 'pdf|jpg|jpeg|png|zip|rar|doc|docx|txt';
		$configuracao['file_name']      = $nomeArquivo.".".$extensao;
		$configuracao['max_size']       = 150000;
		$configuracao['overwrite']      = true;

		$atividadeRealizada['idAtividade']      = $this->input->post('idAtividade');
		$atividadeRealizada['idAluno']          = $this->session->userdata('idUsuario');
		$atividadeRealizada['idDisciplina']     = $this->input->post('idDisciplina');
		$atividadeRealizada['idProfessor']      = $disciplina[0]->idProfessor;
		$atividadeRealizada['resposta_aluno']   = $this->input->post('resposta');
		$atividadeRealizada['anexo']            = $configuracao['file_name'];
		$atividadeRealizada['status_avaliacao'] = 2;

		$this->load->library('upload', $configuracao);
		$this->upload->initialize($configuracao);

		if ($this->upload->do_upload('anexo')) {
			$erro = false;
		}	else {
			$erro = true;
		}

		if ($erro == true) {
			redirect('aluno/atividades_disciplina/'.$this->input->post('idDisciplina').'/1');
			// $this->upload->display_errors();
		}

		if ($this->aluno->salvar_atividade_enviada($atividadeRealizada)) {
			redirect('aluno/atividades_disciplina/'.$this->input->post('idDisciplina').'/2');
		} else {
			redirect('aluno/atividades_disciplina/'.$this->input->post('idDisciplina').'/3');
		}
	}

	public function get_Status_Atividade()
	{
		$this->verificar_sessao();
		$this->load->model('aluno_model','aluno');

		$idAtividade = $this->uri->segment(3);
		$idAluno = $this->uri->segment(4);

		$this->aluno->get_Status_Atividade($idAtividade, $idAluno);
	}

}
