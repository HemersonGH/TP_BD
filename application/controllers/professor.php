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

		$disciplinas['disciplinas'] = $this->professor->get_Disciplinas($this->session->userdata('idProfessor'));

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral');

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

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral');
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

		$disciplina['disciplina'] = $this->professor->get_Disciplina($idDisciplina);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral');
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
}
