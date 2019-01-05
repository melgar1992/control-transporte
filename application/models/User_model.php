<?php
class Usr {
	
	function __construct(){
        parent::__construct();
		
    }
	
	public static function limpiar() { 
		SS()->usr_Usuario = null;
		SS()->usr_Password = null;
		SS()->usr_Url_img = null;
	}
	
	public static function setUsuario($Usuario,$Password,$Url_img){
		SS()->usr_Usuario = $Usuario;
		SS()->usr_Password = $Password;
		SS()->usr_Url_img = $Url_img;		
	}
	
	public static function ok(){ return SS()->usr_Usuario!=null;}
	public static function sa(){ return false;}
	
	
	public static function gUsuario(){ return SS()->usr_Usuario; }
	public static function gNombreCompleto(){ return SS()->usr_Password; }
	public static function gNombre(){ return SS()->usr_Url_img; }

	
}
class User_model extends CI_Model {
    

    public function Login($user, $pass){

        Usr::limpiar();

        //$query = "select username, password, url_img from user where username = '".$user."' and password = '".$pass."';";
        
        $this->db->where('username', $user);
        $this->db->where('password', $pass);
        $this->db->from('user');
        
        $result = $this->db->get();

        $row = $result->row_array();

        if (($result->num_rows())==1){

            Usr::setUsuario(
                $row['username'],
                $row['password'],
                $row['url_img']
            );
        }
        else{
            Usr::limpiar();
        }
        return $result->result();      
    }
    

}