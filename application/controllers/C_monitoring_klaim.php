<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_monitoring_klaim extends CI_Controller {

    // 24-04-2020

        public function index()
        {
            $data = ['menu' => 'Monitoring Klaim',
                     'page' => 'Monitoring Klaim'
                    ];
        
            $this->template->load('layout/template', 'monitoring_klaim/V_monitoring_klaim', $data);
        }

}

/* End of file C_monitoring_klaim.php */
