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

    // Insert registration data in database
    public function registration_insert($data) {

        // Query to check whether username already exist or not
        $condition = "username =" . "'" . $data['username'] . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {

            // Query to insert data in database
            $this->db->insert('user', $data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }
    

    public function Login($data){

        //Usr::limpiar();

        //$query = "select username, password, url_img from user where username = '".$user."' and password = '".$pass."';";
        
        $condition = "username =" . "'" . $data['username'] . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }

        //$row = $result->row_array();

        
        //if (($result->num_rows())==1){

         //   Usr::setUsuario(
        //        $row['username'],
        //        $row['password'],
        //        $row['url_img']
        //    );
        //}
        //else{
       //     Usr::limpiar();
        //}
        //return $result->result();      
    }

    //Lee información del usuario final

    public function read_user_information($username) {
        $condition = "username =" . "'" . $username . "'";
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if($query->num_rows() == 1) {
            return $query->result( );
        } else {
            return false;
        }
    }
    

}