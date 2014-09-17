<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Empleado extends CI_Controller
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
		$this->lang->load('tank_auth','spanish');
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
					$this->form_validation->set_rules('nombre_completo', 'nombre completo', 'trim|required|xss_clean');
					$this->form_validation->set_rules('numero_cedula', 'numero de cedula', 'trim|required|xss_clean');
					if ($this->form_validation->run()) {
						//actualizar usuario
					}
					$data['empleado'] = $emp;
					$this->load->view('/empleado/ver_detalle_form', $data);
				}else {
					redirect('');
				}
			}
		}
	}

	/**
	 * Enviar un mensaje email del tipo dado (activado, recuperar_clave, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	/**
	 * Crear una imagen CAPTCHA para verificar un usuario como un humano
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));
		echo $cap['word']; 				// mostrar captcha en letras
		return $cap['image'];
	}

	/**
	 * Funcion callback. Verifica si la prueba de CAPTCHA se supero.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Mostrar un mensaje de informacion
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('mensaje', $message);
		redirect('/empleado/');
	}

	public function registrar()	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('');
		} else {
			$email_activation = TRUE;
			$data['user_id'] = $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');


			$this->form_validation->set_rules('nombre_completo', 'nombre completo', 'trim|required|xss_clean');
			$this->form_validation->set_rules('numero_cedula', 'numero de cedula', 'trim|required|xss_clean');
			$this->form_validation->set_rules('crear_login', 'crear login', 'integer');

			$this->form_validation->set_rules('email', 'email', 'trim|xss_clean|valid_email');
			$this->form_validation->set_rules('clave', 'clave', 'trim|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirmar_clave', 'Confirmar clave', 'trim|xss_clean|matches[clave]');

			//$captcha_registration	= $this->config->item('captcha_registration', 'tank_auth');
			$captcha_registration	= FALSE;

			if ($captcha_registration) {
					$this->form_validation->set_rules('captcha', 'Codigo confirmacion', 'trim|xss_clean|callback__check_captcha');
			}
			$data['errors'] = array();

			if ($this->form_validation->run()) {
				if ((strlen($this->form_validation->set_value('nombre_completo')) > 0)
					AND (strlen($this->form_validation->set_value('numero_cedula')) > 0)) {
					$empleado = array(
						'emp_nombre_completo' => $this->form_validation->set_value('nombre_completo'),
						'emp_numero_cedula' => $this->form_validation->set_value('numero_cedula')
						);
					if($this->form_validation->set_value('crear_login')){
						if (!is_null($data = $this->tank_auth->create_user(
							$this->form_validation->set_value('email'),
							$this->form_validation->set_value('clave'),
							$email_activation))){
							if (!is_null($res = $this->empleado_model->crear_empleado($empleado))) {
								$empleado['emp_id'] = $res['emp_id'];			
								if($this->tank_auth->actualizar_empleado($data['usu_id'], $empleado['emp_id'])) {
									$data['site_name'] = $this->config->item('website_name', 'tank_auth');
									if ($email_activation) {
										$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;
										$this->_send_email('activate', $data['usu_email'], $data);
										unset($data['clave']); // Clear password (just for any case)
										$this->_show_message($this->lang->line('auth_message_registration_completed_1'));
									} else {
										if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email
											$this->_send_email('welcome', $data['email'], $data);
										}
										unset($data['clave']); // Clear password (just for any case)
										$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/login/entrar/', 'Login'));
									}
								}
							}
						} else {
							$errors = $this->tank_auth->get_error_message();
							foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
						}
					} else {
						if (!is_null($res = $this->empleado_model->crear_empleado($empleado))) {
							$empleado['emp_id'] = $res['emp_id'];
						}
					}
				}
			}
			if ($captcha_registration) {
				$data['captcha_html'] = $this->_create_captcha();
			}
			$data['captcha_registration'] = $captcha_registration;
			$this->load->view('/empleado/registrar_form', $data);
		}
	}
}
