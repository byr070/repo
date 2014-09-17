<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Horario extends CI_Controller
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
		$this->load->model('horario/horario_model');
		$this->load->model('horario/salida_model');
		$this->load->model('empleado/empleado_model');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/login/entrar/');
		} else {
			redirect('/horario/listar_horario/');
		}
	}

	function listar_horario(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->table->clear();
			$this->table->set_heading( array(
				'Nombre',
				'Hora inicio',
				'Hora fin')
			);
			if (!is_null($horarios = $this->horario_model->listar_horario())){
				foreach ($horarios as /*$key => */$hor) {
					//print_r($key); optional
					//print_r($hor);
					$this->table->add_row( array(
						anchor('/horario/verDetalle/'.$hor->hor_id, $hor->hor_id),
						anchor('/horario/verDetalle/'.$hor->hor_id, $hor->hor_hora_inicio),
						anchor('/horario/verDetalle/'.$hor->hor_id, $hor->hor_hora_fin))
					);
				}
			}
			$this->load->view('/horario/listar_horario_view'); 
		}
	}

	function asignar_horario()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');

			$this->form_validation->set_rules('nombre_completo', 'nombre completo', 'trim|required|xss_clean');
			$this->form_validation->set_rules('hora_inicio', 'hora inicio', 'trim|required|xss_clean');
			$this->form_validation->set_rules('hora_fin', 'hora fin', 'trim|required|xss_clean');
			
			if ($this->form_validation->run()) {
				if (strlen($this->form_validation->set_value('nombre_completo')) > 0) {
					$data = array(
						'hor_hora_inicio' => $this->form_validation->set_value('hora_inicio'),
						'hor_hora_fin' => $this->form_validation->set_value('hora_fin'),
						'nombre_completo' => $this->form_validation->set_value('nombre_completo')
						);
					if (!is_null($res = $this->empleado_model->get_id_por_nombre($data['nombre_completo']))) {
						unset($data['nombre_completo']);
						$data['emp_id'] = $res->emp_id;
						if (!is_null($res = $this->horario_model->crear_horario($data))) {
							$data['hor_id']=$res['hor_id'];
							//print_r($res);
							//redirect('/horario/'); si ni hay registro redirige al controlador empleado
						}
					}
				}
			} 
			$this->load->view('/horario/asignar_horario_form');
		}
	}

	public function listar_salida($value='')
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->table->clear();
			$this->table->set_heading( array(
				'Nombre',
				'Hora inicio',
				'Hora fin')
			);
			if (!is_null($salidas = $this->salida_model->listar_salida())){
				foreach ($salidas as /*$key => */$salida) {
					//print_r($key); optional
					//print_r($salida);
					$this->table->add_row( array(
						anchor('/salida/verDetalle/'.$salida->sld_id, $salida->sld_id),
						anchor('/salida/verDetalle/'.$salida->sld_id, $salida->sld_inicio),
						anchor('/salida/verDetalle/'.$salida->sld_id, $salida->sld_fin))
					);
				}
				$this->load->view('/horario/listar_salida_view');
			} else {
				redirect('/horario/');
			}


		}
	}
	public function asignar_salida($value='') {
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->form_validation->set_rules('nombre_completo', 'nombre completo', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sld_inicio', 'hora inicio', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sld_fin', 'hora fin', 'trim|required|xss_clean');
			
			if ($this->form_validation->run()) {
				if (strlen($this->form_validation->set_value('nombre_completo')) > 0) {
					$data = array(
						'sld_inicio' => $this->form_validation->set_value('sld_inicio'),
						'sld_fin' => $this->form_validation->set_value('sld_fin'),
						'nombre_completo' => $this->form_validation->set_value('nombre_completo')
						);
					if (!is_null($res = $this->empleado_model->get_id_por_nombre($data['nombre_completo']))) {
						unset($data['nombre_completo']);
						$data['Empleado_emp_id'] = $res->emp_id;
						if (!is_null($res = $this->salida_model->crear_salida($data))) {
							$data['sld_id']=$res['sld_id'];
							print_r($data);
							//redirect('/horario/'); si ni hay registro redirige al controlador empleado
						}
					}
				}
			} 
			$this->load->view('/horario/asignar_salida_form');
		}
	}
}
