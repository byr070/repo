<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Empleado extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('table');
		$this->load->model('empleado/empleado_model');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/login/entrar/');
		} else {
			redirect('/empleado/listar/');
		}
	}

	function listar(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->table->set_heading( array(
				'Id',
				'Nombre completo',
				'Numero cedula',
				'Fecha nacimiento')
			);
			$empleados = $this->empleado_model->listar_empleados();
			foreach ($empleados as /*$key => */$emp) {
				// print_r($key); optional
				// print_r($emp);
				$this->table->add_row( array(
					anchor('/empleado/verDetalle/'.$emp->emp_id, $emp->emp_id),
					anchor('/empleado/verDetalle/'.$emp->emp_id, $emp->emp_nombre_completo),
					$emp->emp_numero_cedula,
					$emp->emp_fecha_nacimiento
					)
				);

			}
			$this->load->view('/empleado/listar_view');
		}
	}

	public function verDetalle($emp_id = '') {
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			if (empty($emp_id)){
				redirect('');
			} else {
				if (!is_null($emp = $this->empleado_model->get_empleado($emp_id))){
					$data['user_id']	= $this->tank_auth->get_user_id();
					$data['email']	= $this->tank_auth->get_email();
					$this->load->view('welcome', $data);
					$this->load->view('menu');
					$data['empleado'] = $emp;
					$this->load->view('/empleado/ver_detalle_form', $data);
				}else {
					redirect('');
				}
			}
		}
	}

	public function registrar()	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			// form validation set
			// form validation value
			$this->load->view('/empleado/registrar_form');
		}
	}
}
