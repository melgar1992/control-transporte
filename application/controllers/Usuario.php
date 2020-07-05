<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends BaseController
{
    function __construct()
    {
        parent::__construct();
    }

    public function usuario()
    {
        $data['Usuarios'] = $this->User_model->obtenerUsuarios();
        $this->loadView('Usuario', '/form/usuarios/usuario', $data);
    }
    public function ingresarUsuario()
    {
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Contrasena de usuario', 'trim|required');
        $this->form_validation->set_rules('privilegios', 'Privilegios de usuario', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre de usuario', 'trim|required');
        $this->form_validation->set_rules('apellidos', 'Apellidos de usuario', 'trim|required');
        $this->form_validation->set_rules('CI', 'Numero de documento de identidad', 'trim|required');

        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $privilegios = $this->input->post('privilegios');
            $nombre = $this->input->post('nombre');
            $apellidos = $this->input->post('apellidos');
            $CI = $this->input->post('CI');

            $datos = array(
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'privilegios' => $privilegios,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'CI' => $CI,
            );
            $respuesta = $this->User_model->registration_insert($datos);
            if ($respuesta > 0) {
                $respuesta = array(
                    'respuesta' => 'Exitoso',
                    'datos' => array(
                        'ID_user' => $respuesta,
                        'username' => $username,
                        'privilegios' => $privilegios,
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'CI' => $CI,
                    ),
                );
            } else {
                $respuesta = array(
                    'tipo'      => 'Formulario',
                    'respuesta' => 'Error al ingresar los datos a la base de datos!',
                );
            }
        } else {
            $error = form_error('username');
            $respuesta = array(
                'tipo'      => 'Formulario',
                'respuesta' => 'Error de validacion' . ' ' . $error,
            );
        }
        echo json_encode($respuesta);
    }
    public function editarUsuario()
    {
       

        $ID_user = $this->input->post('ID_user');
        $username = $this->input->post('username');
        $password_actual = $this->input->post('password_actual');
        $password = $this->input->post('password');
        $privilegios = $this->input->post('privilegios');
        $nombre = $this->input->post('nombre');
        $apellidos = $this->input->post('apellidos');
        $CI = $this->input->post('CI');

        $usuarioActual = $this->User_model->obtenerUsuario($ID_user);
        if ($username == $usuarioActual['username']) {
            $is_unique = '';
        } else {
            $is_unique = '|is_unique[cliente.CI]';
        }
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'trim|required' . $is_unique);
        $this->form_validation->set_rules('password_actual', 'Contrasena de usuario', 'trim|required');
        $this->form_validation->set_rules('privilegios', 'Privilegios de usuario', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre de usuario', 'trim|required');
        $this->form_validation->set_rules('apellidos', 'Apellidos de usuario', 'trim|required');
        $this->form_validation->set_rules('CI', 'Numero de documento de identidad', 'trim|required');

        if ($this->form_validation->run()) {

            if (password_verify($password_actual, $usuarioActual['password'])) {
                if (empty($password)) {
                    $datos = array(
                        'username' => $username,
                        'privilegios' => $privilegios,
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'CI' => $CI,
                    );
                } else {
                    $datos = array(
                        'username' => $username,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'privilegios' => $privilegios,
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'CI' => $CI,
                    );
                } 
                
                $this->User_model->actualizarUsuario($ID_user,$datos);
                $respuesta = $this->User_model->obtenerUsuario($ID_user);
                if ($respuesta > 0) {
                    $respuesta = array(
                        'respuesta' => 'Exitoso',
                        'datos' => array(
                            'ID_user' => $respuesta,
                            'username' => $username,
                            'privilegios' => $privilegios,
                            'nombre' => $nombre,
                            'apellidos' => $apellidos,
                            'CI' => $CI,
                        ),
                    );
                } else {
                    $respuesta = array(
                        'tipo'      => 'Error',
                        'respuesta' => 'Error al ingresar los datos a la base de datos!',
                    );
                }
            } else {
                
            $respuesta = array(
                'tipo'      => 'Error',
                'respuesta' => 'Error contrasena incorrecta'
            );
            }
        } else {
            $error = form_error('username');
            $respuesta = array(
                'tipo'      => 'Error',
                'respuesta' => 'Error de validacion' . ' ' . $error,
            );
        }
        echo json_encode($respuesta);
    }
    public function obtenerUsuarioAjax()
    {
        $ID_user = $this->input->post('ID_user');
        $usuario = $this->User_model->obtenerUsuario($ID_user);
        echo json_encode($usuario);
    }
}
