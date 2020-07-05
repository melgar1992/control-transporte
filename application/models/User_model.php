<?php

class User_model extends CI_Model
{

    // Insert registration data in database
    public function registration_insert($data)
    {
        // Query to insert data in database
        $this->db->insert('user', $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();;
        } else {
            return false;
        }
    }


    public function Login($data)
    {

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

    public function read_user_information($username)
    {
        $condition = "username =" . "'" . $username . "'";
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
    }
    public function obtenerUsuarios()
    {
        $this->db->select('*');
        $this->db->from('user');
        $usuarios = $this->db->get()->result_array();
        return $usuarios;
    }
    public function obtenerUsuario($id_user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('ID_user', $id_user);
        return $this->db->get()->row_array();
    }
    public function actualizarUsuario(int $id_user, array $data)
    {
        $this->db->where('ID_user', $id_user);
        $this->db->update('user', $data);
    }
}
