<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users
 *
 * This model represents user authentication data. It operates the following tables:
 * - user account data,
 * - user profiles
 *
 * @package	Tank_auth
 * @author	Ilya Konyukhov (http://konyukhov.com/soft/)
 */
class Usuarios extends CI_Model
{
	private $table_name			= 'usuarios';	// user accounts
	private $profile_table_name	= 'roles';		// user profiles

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name			= $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name;
		$this->profile_table_name	= $ci->config->item('db_table_prefix', 'tank_auth').$this->profile_table_name;
	}

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_usuario_por_id($user_id, $activated)
	{
		$this->db->where('usu_id', $user_id);
		$this->db->where('usu_activado', $activated ? 1 : 0);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	

	/**
	 * Get user record by email
	 *
	 * @param	string
	 * @return	object
	 */
	function get_usuario_por_email($email)
	{
		$this->db->where('LOWER(usu_email)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Check if email available for registering
	 *
	 * @param	string
	 * @return	bool
	 */
	function esta_email_disponible($email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(usu_email)=', strtolower($email));
		$this->db->or_where('LOWER(usu_nuevo_email)=', strtolower($email));

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	/**
	 * Create new user record
	 *
	 * @param	array
	 * @param	bool
	 * @return	array
	 */
	function crear_usuario($data, $activated = TRUE)
	{
		$data['usu_creado'] = date('Y-m-d H:i:s');
		$data['usu_activado'] = $activated ? 1 : 0;

		if ($this->db->insert($this->table_name, $data)) {
			$user_id = $this->db->insert_id();
			if ($activated)	$this->crear_perfil($user_id);
			return array('usu_id' => $user_id);
		}
		return NULL;
	}

	/**
	 * Activate user if activation key is valid.
	 * Can be called for not activated users only.
	 *
	 * @param	int
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function activar_usuario($user_id, $activation_key, $activate_by_email)
	{
		$this->db->select('1', FALSE);
		$this->db->where('usu_id', $user_id);
		if ($activate_by_email) {
			$this->db->where('usu_nuevo_email_key', $activation_key);
		} else {
			$this->db->where('usu_nueva_clave_key', $activation_key);
		}
		$this->db->where('usu_activado', 0);
		$query = $this->db->get($this->table_name);

		if ($query->num_rows() == 1) {

			$this->db->set('usu_activado', 1);
			$this->db->set('usu_nuevo_email_key', NULL);
			$this->db->where('usu_id', $user_id);
			$this->db->update($this->table_name);

			$this->crear_perfil($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Purge table of non-activated users
	 *
	 * @param	int
	 * @return	void
	 */
	function eliminar_na($expire_period = 172800)
	{
		$this->db->where('usu_activado', 0);
		$this->db->where('UNIX_TIMESTAMP(usu_creado) <', time() - $expire_period);
		$this->db->delete($this->table_name);
	}

	/**
	 * Delete user record
	 *
	 * @param	int
	 * @return	bool
	 */
	function eliminar_usuario($user_id)
	{
		$this->db->where('usu_id', $user_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->eliminar_perfil($user_id);
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * Set new password key for user.
	 * This key can be used for authentication when resetting user's password.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function set_clave_key($user_id, $new_pass_key)
	{
		$this->db->set('usu_nueva_clave_key', $new_pass_key);
		$this->db->set('usu_nueva_clave_peticion', date('Y-m-d H:i:s'));
		$this->db->where('usu_id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Check if given password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	int
	 * @return	void
	 */
	function puede_reset_clave($user_id, $new_pass_key, $expire_period = 900)
	{
		$this->db->select('1', FALSE);
		$this->db->where('usu_id', $user_id);
		$this->db->where('usu_nueva_clave_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(usu_nueva_clave_peticion) >', time() - $expire_period);

		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	/**
	 * Change user password if password key is valid and user is authenticated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	int
	 * @return	bool
	 */
	function reset_clave($user_id, $new_pass, $new_pass_key, $expire_period = 900)
	{
		$this->db->set('usu_clave', $new_pass);
		$this->db->set('usu_nueva_clave_key', NULL);
		$this->db->set('usu_nueva_clave_peticion', NULL);
		$this->db->where('usu_id', $user_id);
		$this->db->where('usu_nueva_clave_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(usu_nueva_clave_peticion) >=', time() - $expire_period);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Change user password
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function cambiar_clave($user_id, $new_pass)
	{
		$this->db->set('usu_clave', $new_pass);
		$this->db->where('usu_id', $user_id);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Set new email for user (may be activated or not).
	 * The new email cannot be used for login or notification before it is activated.
	 *
	 * @param	int
	 * @param	string
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function set_nuevo_email($user_id, $new_email, $new_email_key, $activated)
	{
		$this->db->set($activated ? 'usu_nuevo_email' : 'email', $new_email);
		$this->db->set('usu_nuevo_email_key', $new_email_key);
		$this->db->where('usu_id', $user_id);
		$this->db->where('usu_activado', $activated ? 1 : 0);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Activate new email (replace old email with new one) if activation key is valid.
	 *
	 * @param	int
	 * @param	string
	 * @return	bool
	 */
	function activar_nuevo_email($user_id, $new_email_key)
	{
		$this->db->set('usu_email', 'usu_nuevo_email', FALSE);
		$this->db->set('usu_nuevo_email', NULL);
		$this->db->set('usu_nuevo_email_key', NULL);
		$this->db->where('usu_id', $user_id);
		$this->db->where('usu_nuevo_email_key', $new_email_key);

		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	/**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function actualizar_info_login($user_id, $record_ip, $record_time)
	{
		$this->db->set('usu_nueva_clave_key', NULL);
		$this->db->set('usu_nueva_clave_peticion', NULL);

		if ($record_ip)		$this->db->set('usu_ultima_ip', $this->input->ip_address());
		if ($record_time)	$this->db->set('usu_ultimo_login', date('Y-m-d H:i:s'));

		$this->db->where('usu_id', $user_id);
		$this->db->update($this->table_name);
	}

	/**
	 * Ban user
	 *
	 * @param	int
	 * @param	string
	 * @return	void
	 */
	function bloquear_usuario($user_id, $reason = NULL)
	{
		$this->db->where('usu_id', $user_id);
		$this->db->update($this->table_name, array(
			'usu_bloqueado'		=> 1,
			'usu_razon_bloqueo'	=> $reason,
		));
	}

	/**
	 * Unban user
	 *
	 * @param	int
	 * @return	void
	 */
	function desbloquear_usuario($user_id)
	{
		$this->db->where('usu_id', $user_id);
		$this->db->update($this->table_name, array(
			'usu_bloqueado'		=> 0,
			'usu_razon_bloqueo'	=> NULL,
		));
	}

	/**
	 * Create an empty profile for a new user
	 *
	 * @param	int
	 * @return	bool
	 */
	private function crear_perfil($user_id)
	{
		$this->db->set('usu_id', $user_id);
		return $this->db->insert($this->profile_table_name);
	}

	/**
	 * Delete user profile
	 *
	 * @param	int
	 * @return	void
	 */
	private function eliminar_perfil($user_id)
	{
		$this->db->where('usu_id', $user_id);
		$this->db->delete($this->profile_table_name);
	}

	/**
	 * Activate user if activation key is valid.
	 * Can be called for not activated users only.
	 *
	 * @param	int
	 * @param	string
	 * @param	bool
	 * @return	bool
	 */
	function actualizar_empleado($usu_id, $emp_id)
	{
		$this->db->select('1', FALSE);
		$this->db->where('usu_id', $usu_id);
		// $this->db->where('emp_id', 0);
		$query = $this->db->get($this->table_name);

		if ($query->num_rows() == 1) {

			$this->db->set('emp_id', $emp_id);
			$this->db->where('usu_id', $usu_id);
			$this->db->update($this->table_name);
			return TRUE;
		}
		return FALSE;
	}
}

/* End of file usuarios.php */
/* Location: ./application/models/tank_auth/usuarios.php */
