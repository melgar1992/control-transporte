<?php
class Taller_model extends CI_Model
{
    public function getTalleres()
    {
        $this->db->select('*');
        $this->db->from('taller');
        return $this->db->get()->result();
    }
}