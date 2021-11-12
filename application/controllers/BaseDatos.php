<?php
class BaseDatos extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function backupPage()
    {
        $datos[''] = '';
        $this->loadView('Cliente', '/form/sistema/Basededatos_views', $datos);
    }
    public function backup()
    {
        $this->load->dbutil();
        $prefs = array(
            'format'      => 'zip',
            'filename'    => 'db_transporte.sql'
        );
        $backup = $this->dbutil->backup($prefs);

        $db_name = 'backup-on-' . date("Y-m-d") . '.zip';
        $save = 'pathtobkfolder/' . $db_name;

        $this->load->helper('file');
        write_file($save, $backup);


        $this->load->helper('download');
        force_download($db_name, $backup);
    }
}
