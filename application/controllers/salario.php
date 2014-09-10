<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Salario extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/login/entrar/');
		} else {
			redirect('/salario/individual/');
		}
	}

	function individual(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/salario/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->load->view('/salario/generar_salario_individual');
		}
	}
	function general(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/salario/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->load->view('/salario/generar_salario_general');
		}
	}
}
