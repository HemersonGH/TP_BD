<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

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
			redirect('usuario/login');
		}
	}

	public function index()
	{
		$this->verificar_sessao();

		redirect('professor');
	}

	public function login()
	{
		$this->load->view('includes/html_header');
		$this->load->view('login/login');

		$indice = $this->uri->segment(3);

		switch ($indice) {
			case '1':
			$msg['msg'] = "Usuário cadastrado com sucesso.";
			$this->load->view('includes/msg_sucesso_login', $msg);
			break;

			case '2':
			$msg['msg'] = "Não foi possível cadastrar o usuário, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro_login', $msg);
			break;

			case '3':
			$msg['msg'] = "Usuário/Senha incorretos.";
			$this->load->view('includes/msg_erro_login', $msg);
			break;

			case null:
			$this->load->view('includes/div');
			break;
		}

		$this->load->view('includes/html_footer');
	}

	public function registrar()
	{
		$this->load->view('includes/html_header');
		$this->load->view('login/registrar');
		$this->load->view('includes/html_footer');
	}

	public function logar()
	{
		$email = $this->input->post('email');
		$senha = md5($this->input->post('password'));

		$this->load->model('usuario_model','usuario');

		$dadosUsuario['usuario'] = $this->usuario->valida_Usuario($email, $senha);

		if (count($dadosUsuario['usuario']) == 1) {
			$dadosUsuarioLogado['nome'] = $dadosUsuario['usuario'][0]->nome;
			$dadosUsuarioLogado['idProfessor'] = $dadosUsuario['usuario'][0]->idProfessor;
			$dadosUsuarioLogado['logado'] = true;
			$this->session->set_userdata($dadosUsuarioLogado);

			redirect('professor');
		} else {
			redirect('usuario/login/3');
		}
	}

	public function cadastrar()
	{
		$dadosUsuario['nome'] = $this->input->post('nome');
		$dadosUsuario['cpf'] = $this->input->post('cpf');
		$dadosUsuario['data'] = $this->input->post('data');
		$dadosUsuario['email'] = $this->input->post('email');
		$dadosUsuario['senha'] = md5($this->input->post('senha'));

		$this->load->model('usuario_model','usuario');

		if ($this->usuario->cadastrar($dadosUsuario)) {
			redirect('usuario/login/1');
		} else {
			redirect('usuario/login/2');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect('usuario');
	}

	public function atualizar()
	{
		$this->verificar_sessao();
		$this->load->model('usuario_model','usuario');

		$idProfessor = $this->uri->segment(3);
		$indice = $this->uri->segment(4);

		$dadosUsuario['usuario'] = $this->usuario->get_Usuario($idProfessor);

		$this->load->view('includes/html_header');
		$this->load->view('includes/menu');
		$this->load->view('professor/menu_lateral');

		if ($indice == 1) {
			$msg['msg'] = 	"Senha atualizada com sucesso.";
			$this->load->view('includes/msg_sucesso', $msg);
		} else if ($indice == 2) {
			$msg['msg'] = 	"Não foi possível atualizar sua senha, tente novamente ou entre em contato com o administrador do sistema.";
			$this->load->view('includes/msg_erro', $msg);
		}

		$this->load->view('includes/editar_usuario', $dadosUsuario);
		$this->load->view('includes/html_footer');
	}


	public function salvar_atualizacao()
	{
		$this->verificar_sessao();

		$idProfessor = $this->input->post('idProfessor');

		$dadosUsuario['nome'] = $this->input->post('name');
		$dadosUsuario['cpf'] = $this->input->post('cpf');
		$dadosUsuario['data'] = $this->input->post('data');
		$dadosUsuario['email'] = $this->input->post('email');

		$this->load->model('usuario_model','usuario');

		if ($this->usuario->salvar_atualizacao($idProfessor, $dadosUsuario)) {
			$dadosUsuarioLogado['nome'] = $dadosUsuario['nome'];
			$this->session->set_userdata($dadosUsuarioLogado);

			redirect('professor/1');
		} else {
			redirect('professor/2');
		}

	}

	public function excluir()
	{
		$this->verificar_sessao();
		$this->load->model('usuario_model','usuario');

		$idProfessor = $this->uri->segment(3);

		if ($this->usuario->excluir($idProfessor)) {
			redirect('usuario/3');
		} else {
			redirect('usuario/4');
		}
	}

	public function salvar_senha()
	{
		$this->verificar_sessao();
		$this->load->model('usuario_model','usuario');

		$id = $this->input->post('idProfessorSenha');
		$senha_antiga = md5($this->input->post('senha_antiga'));
		$senha_nova = md5($this->input->post('senha_nova'));

		if ($this->usuario->salvar_senha($id, $senha_antiga, $senha_nova)) {
			redirect('usuario/atualizar/'.$id.'/1');
		} else {
			redirect('usuario/atualizar/'.$id.'/2');
		}
	}


}
