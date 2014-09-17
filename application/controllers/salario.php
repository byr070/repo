<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Salario extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->load->library('table');
		$this->lang->load('form_validation','spanish');
		//$this->load->model('salario/salario_model');
		$this->load->model('empleado/empleado_model');
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
			$this->form_validation->set_rules('nombre_completo', 'nombre completo', 'trim|required|xss_clean');
			if ($this->form_validation->run()) {
				if (strlen($this->form_validation->set_value('nombre_completo')) > 0) {
					$data = array(
						'nombre_completo' => $this->form_validation->set_value('nombre_completo')
						);
					if (!is_null($res = $this->empleado_model->get_id_por_nombre($data['nombre_completo']))) {
						unset($data['nombre_completo']);
						
						$data['Empleado_emp_id'] = $res->emp_id;
						if (!is_null($res = $this->empleado_model->get_empleado($data['Empleado_emp_id']))) {}
						print_r($res);
						/** get empleado
						cargo
						cuantas horas (fin - inicio) * dias laborables
						cuantos dias
						salario nominal
						salario ganado
						horas 50%
						horas 100%
						*/

						/*if (!is_null($res = $this->salario_model->generar_salario_individual($data))) {
							print_r($res);
							$data['sld_id']=$res['sld_id'];
							print_r($data);
							$this->load->view('/salario/rol_pagos_individual',$data);
							//redirect('/horario/'); si ni hay registro redirige al controlador empleado
						}*/
					}
				}
			}
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
