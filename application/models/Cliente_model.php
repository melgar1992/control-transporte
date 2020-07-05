<?php
class Cliente_model extends CI_Model
{
    public function obtenerClientes()
    {
        //retorna todos los clientes activos en la tabla
        $this->db->select('*');
        $this->db->from('cliente');
        $this->db->order_by('Nombre');
        $this->db->where('Estado', 'Activo');
        return $this->db->get()->result();
    }
    public function obtenerCliente($ID_cliente)
    {
        $this->db->select('*');
        $this->db->where('ID_cliente', $ID_cliente);
        return $this->db->get('cliente')->row_array();
    }
    public function ingresarCliente($Nombre, $CI, $Apellidos, $Direccion, $Telefono_01, $Telefono_02)
    {
        $datos = array(
            'Nombre' => $Nombre,
            'Apellidos' => $Apellidos,
            'CI' => $CI,
            'Direccion' => $Direccion,
            'Telefono_01' => $Telefono_01,
            'Telefono_02' => $Telefono_02,
            'Estado' => 'Activo',
        );
        $this->db->insert('cliente', $datos);
        return $this->db->insert_id();
    }
    public function editarCliente($ID_cliente, $Nombre, $CI, $Apellidos, $Direccion, $Telefono_01, $Telefono_02)
    {
        $datos = array(
            'Nombre' => $Nombre,
            'Apellidos' => $Apellidos,
            'CI' => $CI,
            'Direccion' => $Direccion,
            'Telefono_01' => $Telefono_01,
            'Telefono_02' => $Telefono_02,
            
        );
        $this->db->where('ID_cliente',$ID_cliente);
        $this->db->update('cliente', $datos);
 
    }
    public function eliminarCliente($ID_cliente)
    {
        $datos = array(
            'CI' => '0',
            'Estado' => 'Inactivo', 
        );
        $this->db->where('ID_cliente',$ID_cliente);
        $this->db->update('cliente', $datos);
    }
}
