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
class Salida_model extends CI_Model
{
	private $table_name_salida = 'periodo_salida';

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
		$this->table_name_salida = $ci->config->item('db_table_prefix', 'tank_auth').$this->table_name_salida;
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

		$query = $this->db->get($this->table_name_salida);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	function listar_salida() {
		$this->db->select('sld_id, sld_inicio, sld_fin');
		$query = $this->db->get($this->table_name_salida);
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}

	public function get_salida($sld_id = '') {
		$this->db->where('sld_id',$sld_id);
		$query = $this->db->get($this->table_name_salida);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	function crear_salida($data)
	{
		//$emp_id=$data['emp_id'];
		//unset($data['emp_id']);
		$data['sld_creado'] = date('Y-m-d H:i:s');
		//$this->db->where('Empleado_emp_id', $data['emp_id']);

		if ($res = $this->existe_salida($data)){
			$sld_id = $res['0']->sld_id;
		} else {
			if ($this->db->insert($this->table_name_salida, $data)) {
				$sld_id = $this->db->insert_id();
			}
		}
		return array('sld_id' => $sld_id);
	}

	function existe_salida($data)
	{
		//$this->db->select('hor_hora_inicio');
		$this->db->select('sld_id', FALSE);
		$this->db->where('sld_inicio', $data['sld_inicio']);
		$this->db->where('sld_fin', $data['sld_fin']);
		$this->db->where('Empleado_emp_id', $data['Empleado_emp_id']);
		$query = $this->db->get($this->table_name_salida);
		if ($query->num_rows() > 0) return $query->result();
		return NULL;
	}
}