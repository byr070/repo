<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('unit_test');
	}
	
	public function testRestarHora() {
        $test_name = 'Resta de minutos';
        $hora1 = '00:45';
        $hora2 = '00:20';
        $esperado = '00:25';
        $suma = $this->hora->restarTiempo($hora1,$hora2);
        echo $this->unit->run($suma, $esperado, $test_name);
 
        $test_name = 'Resta de horas';
        $hora1 = '15:15';
        $hora2 = '12:30';
        $esperado = '02:45';
        $suma = $this->hora->restarTiempo($hora1,$hora2);
        echo $this->unit->run($suma, $esperado, $test_name);
 
        $test_name = 'Resta de horas menos minutos';
        $hora1 = '12:08';
        $hora2 = '00:15';
        $esperado = '11:53';
        $suma = $this->hora->restarTiempo($hora1,$hora2);
        echo $this->unit->run($suma, $esperado, $test_name);
    }
    
}
