<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {

    public function index()
    {
        $data = ['menu' => 'Dashboard',
                 'page' => 'Dashboard'
                ];

        $this->template->load('layout/template', 'dashboard/V_dashboard', $data);
    }

}

/* End of file C_dashboard.php */
