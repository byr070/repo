<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Salario extends CI_Controller
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
		$this->load->model('salario/salario_model');
		$this->load->model('empleado/empleado_model');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/login/entrar/');
		} else {
			redirect('/salario/individual/');
		}
	}

	function individual(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/salario/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->form_validation->set_rules('nombre_completo', 'nombre completo', 'trim|required|xss_clean');
			if ($this->form_validation->run()) {
				if (strlen($this->form_validation->set_value('nombre_completo')) > 0) {
					$data = array(
						'nombre_completo' => $this->form_validation->set_value('nombre_completo')
						);
					if (!is_null($res = $this->empleado_model->get_id_por_nombre($data['nombre_completo']))) {
						unset($data['nombre_completo']);
						
						$data['Empleado_emp_id'] = $res->emp_id;
						if (!is_null($res = $this->empleado_model->get_empleado($data['Empleado_emp_id']))) {}
						print_r($res);
						if (!is_null($res = $this->salario_model->get_salario($data['Empleado_emp_id']))) {}
						$salario = $res->sal_valor;
						$cargo = $res->crg_nombre;
						print_r($res);
						//$CantidadDiasHabiles = $this->Evalua($this->DiasHabiles('1-10-2014','13-10-2014'));
						//echo $CantidadDiasHabiles; 
					$feriados        = array(
					'1-1',  //  Año Nuevo (irrenunciable)
					'10-4',  //  Viernes Santo (feriado religioso)
					'11-4',  //  Sábado Santo (feriado religioso)
					'1-5',  //  Día Nacional del Trabajo (irrenunciable)
					'21-5',  //  Día de las Glorias Navales
					'29-6',  //  San Pedro y San Pablo (feriado religioso)
					'16-7',  //  Virgen del Carmen (feriado religioso)
					'15-8',  //  Asunción de la Virgen (feriado religioso)
'18-9',  //  Día de la Independencia (irrenunciable)
'19-9',  //  Día de las Glorias del Ejército
'12-10',  //  Aniversario del Descubrimiento de América
'31-10',  //  Día Nacional de las Iglesias Evangélicas y Protestantes (feriado religioso)
'1-11',  //  Día de Todos los Santos (feriado religioso)
'8-12',  //  Inmaculada Concepción de la Virgen (feriado religioso)
'13-12',  //  elecciones presidencial y parlamentarias (puede que se traslade al domingo 13)
'25-12',  //  Natividad del Señor (feriado religioso) (irrenunciable)
);
						$dias_h= $this->getDiasHabiles('1-10-2014','13-10-2014',$feriados);
						//print_r($dias_h);
						$dias_trabajados=count($dias_h);
						echo '<br>Dias trabajadas: '.$dias_trabajados;
						$horas_trabajadas = $this->RestarHoras('10:00','22:00');
						echo '<br>Horas trabajadas: '.$horas_trabajadas;
						$horas_ext = 0;
						echo '<br>Horas ext: '.$horas_ext;
						$horas_sup = 1;
						echo '<br>Horas sup: '.$horas_sup;
						echo '<br>Cargo: '.$cargo;
						echo '<br>Salario: '.$salario.'<br>';
						/** empleado10:00
						cargo
						dias trabajados (-permisos, -feriados)
						horas trabajadas (-permisos)
						salario nominal
						salario ganado = dt * ht * (salario/30/8)
						horas extras = hs*1,5 + he*2 * (salario/30/8)
						comisiones
						TOTAL ingresos
						aporte iess = total ingresos * 9,36
						anticipos y prestamos
						TOTAL descuentos
						TOTAL A PAGAR
						horas suplem: lunes-viernes antes de las 00h00
						horas extras: 00h00-06h00, feriados, fin de semana
						calcular cuantas horas extras
						calcular cuantas horas suplementarias
						 *** ultimo dia de pago ***
						*/

						/*if (!is_null($res = $this->salario_model->generar_salario_individual($data))) {
							print_r($res);
							$data['sld_id']=$res['sld_id'];
							print_r($data);
							$this->load->view('/salario/rol_pagos_individual',$data);
							//redirect('/horario/'); si ni hay registro redirige al controlador empleado
						}*/
					}
				}
			}
			$this->load->view('/salario/generar_salario_individual');
		}
	}
	function general(){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/salario/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['email']	= $this->tank_auth->get_email();
			$this->load->view('welcome', $data);
			$this->load->view('menu');
			$this->load->view('/salario/generar_salario_general');
		}
	}

	function RestarHoras($horaini,$horafin) {
		$horai=substr($horaini,0,2);
		$mini=substr($horaini,3,2);
		$segi=substr($horaini,6,2);
		$horaf=substr($horafin,0,2);
		$minf=substr($horafin,3,2);
		$segf=substr($horafin,6,2);
		$ini=((($horai*60)*60)+($mini*60)+$segi);
		$fin=((($horaf*60)*60)+($minf*60)+$segf);
		$dif=$fin-$ini; $difh=floor($dif/3600);
		$difm=floor(($dif-($difh*3600))/60);
		$difs=$dif-($difm*60)-($difh*3600);
		return date("H-i-s",mktime($difh,$difm,$difs));
	}

	public function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array()) {
        // Convirtiendo en timestamp las fechas
        $fechainicio = strtotime($fechainicio);
        $fechafin = strtotime($fechafin);
       
        // Incremento en 1 dia
        $diainc = 24*60*60;
       
        // Arreglo de dias habiles, inicianlizacion
        $diashabiles = array();
       
        // Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
        for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
                // Si el dia indicado, no es sabado o domingo es habil
                if (!in_array(date('N', $midia), array(6,7))) { // DOC: http://www.php.net/manual/es/function.date.php
                        // Si no es un dia feriado entonces es habil
                        if (!in_array(date('d-m', $midia), $diasferiados)) {
                                array_push($diashabiles, date('Y-m-d', $midia));
                        }
                }
        }
       
        return $diashabiles;
}


	function DiasHabiles($fecha_inicial,$fecha_final)
{
list($dia,$mes,$year) = explode("-",$fecha_inicial);
$ini = mktime(0, 0, 0, $mes , $dia, $year);
list($diaf,$mesf,$yearf) = explode("-",$fecha_final);
$fin = mktime(0, 0, 0, $mesf , $diaf, $yearf);

$r = 1;
while($ini != $fin)
{
$ini = mktime(0, 0, 0, $mes , $dia+$r, $year);
$newArray[] =$ini; 
$r++;
}
return $newArray;
}
function Evalua($arreglo)
{
$feriados        = array(
'1-1',  //  Año Nuevo (irrenunciable)
'10-4',  //  Viernes Santo (feriado religioso)
'11-4',  //  Sábado Santo (feriado religioso)
'1-5',  //  Día Nacional del Trabajo (irrenunciable)
'21-5',  //  Día de las Glorias Navales
'29-6',  //  San Pedro y San Pablo (feriado religioso)
'16-7',  //  Virgen del Carmen (feriado religioso)
'15-8',  //  Asunción de la Virgen (feriado religioso)
'18-9',  //  Día de la Independencia (irrenunciable)
'19-9',  //  Día de las Glorias del Ejército
'12-10',  //  Aniversario del Descubrimiento de América
'31-10',  //  Día Nacional de las Iglesias Evangélicas y Protestantes (feriado religioso)
'1-11',  //  Día de Todos los Santos (feriado religioso)
'8-12',  //  Inmaculada Concepción de la Virgen (feriado religioso)
'13-12',  //  elecciones presidencial y parlamentarias (puede que se traslade al domingo 13)
'25-12',  //  Natividad del Señor (feriado religioso) (irrenunciable)
);
//print_r($arreglo);
$j= count($arreglo);
$dia_i=0;
for($i=0;$i<$j;$i++) {
	
$dia = $arreglo[$i];

        $fecha = getdate($dia);
            $feriado = $fecha['mday']."-".$fecha['mon'];
                    if($fecha["wday"]==0 or $fecha["wday"]==6)
                    {
                        $dia_i ++;
                    }
                        elseif(in_array($feriado,$feriados))
                        {   
                            $dia_i++;
                        }
}
$rlt = $j - $dia_i;
return $rlt;
}

	function ObtenerHorasExtras($value='') {
		$horas_extras = 1;
		return $horas_extras;
	}
	function ObtenerHorasSuplementarias($value='') {
		$horas_suplementarias = 1;
		return $horas_suplementarias;
	}
}
