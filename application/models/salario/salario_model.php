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
class Salario_model extends CI_Model
{
	private $table_name_salario = 'salario';	// user accounts
	private $table_name_cargo = 'cargo';		// user profiles
	private $table_name_canton = 'canton';
	private $table_name_parroquia = 'parroquia';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name_salario = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name_salario;
		$this->table_name_cargo = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name_cargo;
	}

	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_usuario_por_id($user_id, $activated) {
		$this->db->where('usu_id', $user_id);
		$this->db->where('usu_activado', $activated ? 1 : 0);

		$query = $this->db->get($this->table_name_salario);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	function listar_salarios() {
		$this->db->select('emp_id, emp_nombre_completo, emp_numero_cedula, emp_fecha_nacimiento');
		$query = $this->db->get($this->table_name_salario);
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	public function get_salario($crg_id = '') {
		//$this->db->select('crg_nombre');
		$this->db->join('cargo AS crg','sal.sal_id=crg.sal_id');
		//$this->db->where('sal_id',$sal_id);
		$this->db->where('crg_id',$crg_id);
		$query = $this->db->get($this->table_name_salario.' AS sal');
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	function crear_salario($data='')
	{
		$data['emp_creado'] = date('Y-m-d H:i:s');

		if ($this->db->insert($this->table_name_salario, $data)) {
			$emp_id = $this->db->insert_id();
			//if ($activated)	$this->crear_perfil($emp_id);
			return array('emp_id' => $emp_id);
		}
		return NULL;
	}
	
	public function get_id_por_nombre($emp_nombre_completo = '') {
		$this->db->select('emp_id');
		$this->db->where('emp_nombre_completo',$emp_nombre_completo);
		$query = $this->db->get($this->table_name_salario);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
}