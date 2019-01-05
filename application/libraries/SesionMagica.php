<?php

class SesionMagica {
	
	public function __get($prop) {
		$ci = get_instance();
		return $ci->session->userdata(PREFIJO_SESION.$prop);
	}
	
	public function __set($prop,$valor) {
		$ci = get_instance();
		$ci->session->set_userdata(PREFIJO_SESION.$prop,$valor);
	}
	
}
