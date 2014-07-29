<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function index(){
		$this->load->view('includes/header');
		$this->load->view('login_form');
		$this->load->view('includes/footer');
	}
	
	function validate_credentials(){
		$this->load->model('membership_model');
		$query = $this->membership_model->validate();
		if($query){
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('site/members_area');
	    } else {
			$this->index();
		}
    }
    
    function signup() {
		$this->load->view('includes/header');
		$this->load->view('signup_form');
		$this->load->view('includes/footer');	
    }
    
    function create_member(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|callback_check_if_email_exists');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_lenght[4]|max_length[15]|callback_check_if_username_exists');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_lenght[4]|max_length[32]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('includes/header');
			$this->load->view('signup_form');
			$this->load->view('includes/footer');
		} else {
			$this->load->model('membership_model');
			if ($query = $this->membership_model->create_member()) {
				$data['account_created'] = 'Tu cuenta ha sido creada. <br/><br/> Ahora puedes entrar.';
				$this->load->view('includes/header');
				$this->load->view('login_form',$data);
				$this->load->view('includes/footer');
			} else {
				$this->load->view('includes/header');
				$this->load->view('signup_form');
				$this->load->view('includes/footer');
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
