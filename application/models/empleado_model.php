<?php
class Empleado_model extends CI_Model {
	
	function validar(){
		// redirect('articulos');
		// echo "validar";
		$this->db->where('usu_email', $this->input->post('e-mail'));
		$this->db->where('usu_clave', md5($this->input->post('clave')));
		$query = $this->db->get('usuarios');
		if ($query->num_rows == 1) {
			return true;
		}
	}
	
	function create_member() {
		$username = $this->input->post('username');
		$new_member_insert_data = array (
			'first_name' => $this->input->post('first_name'),
			'last_name'  => $this->input->post('last_name'),
			'email'      => $this->input->post('email'),
			'usuario'   => $this->input->post('username'),
			'clave'   => md5($this->input->post('password'))
		);
		$insert = $this->db->insert('usuarios', $new_member_insert_data);
		return $insert;
	}
	
	function check_if_username_exists($username) {
		$this->db->where('usuario', $username);
		$result = $this->db->get('usuarios');
		if( $result->num_rows() > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	function check_if_email_exists($email) {
		$this->db->where('email', $email);
		$result = $this->db->get('usuarios');
		if( $result->num_rows() > 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
?>
