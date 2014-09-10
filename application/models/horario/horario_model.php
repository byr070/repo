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
class Horario_model extends CI_Model
{
	private $table_name_horario = 'horario_trabajo';
	private $table_name_salario = 'salario';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name_horario = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name_horario;
		$this->table_name_salario = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name_salario;
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

		$query = $this->db->get($this->table_name_horario);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	function listar_horario() {
		$this->db->select('hor_id, hor_hora_inicio, hor_hora_fin');
		$query = $this->db->get($this->table_name_horario);
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	public function get_empleado($emp_id = '') {
		$this->db->where('emp_id',$emp_id);
		$query = $this->db->get($this->table_name_horario);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
}