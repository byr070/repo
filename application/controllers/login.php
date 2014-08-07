<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function index(){
		$this->load->view('login_form');
		// $this->load->view('includes/header');
		// $this->load->view('login_form');
		// $this->load->view('includes/footer');
	}
	
	function validar(){

		echo $this->input->post('e-mail');
		echo $this->input->post('clave');
		
		$this->load->model('empleado_model');
		$query = $this->empleado_model->validar();
		echo $query;
		if($query){
			$data = array(
				'e-mail' => $this->input->post('e-mail'),
				'is_logged_in' => true
			);

			$this->session->set_userdata($data);
			redirect('articulos');
	    } else {
			$this->index();
		}
    }
    
    function signup() {
		 $this->load->view('signup_form');
	}
	    
    function crear_usuario(){
		$this->load->library('form_validation');
		//$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		//$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|callback_check_if_email_exists');
		//$this->form_validation->set_rules('username', 'Username', 'trim|required|min_lenght[4]|max_length[15]|callback_check_if_username_exists');
		$this->form_validation->set_rules('clave', 'Password', 'trim|required|min_lenght[4]|max_length[32]');
		$this->form_validation->set_rules('confirmacion_clave', 'Password Confirmation', 'trim|required|matches[clave]');
		
		if ($this->form_validation->run() == FALSE) {
					$this->load->view('signup_form');
		} else {
			$this->load->model('empleado_model');
			if ($query = $this->empleado_model->crea_usuario()) {
				$data['account_created'] = 'Usuario creado. <br/><br/> Ahora puedes entrar.';
				$this->load->view('login_form',$data);
			} else {
				$this->load->view('signup_form');
			}
		}
	}
	
	function check_if_username_exists($requested_username) {
		$this->load->model('membership_model');
		$username_available = $this->membership_model->check_if_username_exists($requested_username);
		if ($username_available) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function check_if_email_exists($requested_email) {
		$this->load->model('membership_model');
		$email_not_in_use = $this->membership_model->check_if_email_exists($requested_email);
		if ($email_not_in_use) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	function logout(){}
}
?>
