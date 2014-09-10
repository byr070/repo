<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Horario extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('table');
		$this->load->model('horario/horario_model');
		$this->load->model('horario/salida_model');
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
				$this->load->view('/horario/listar_horario_view');
			} else {
				redirect('/horario/');
			}
		}
	}

	function asignar_horario($value='')
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
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
	public function asignar_salida($value='')
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->load->view('/horario/asignar_salida_form');
		}
	}
}
