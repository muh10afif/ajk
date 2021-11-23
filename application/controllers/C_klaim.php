<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_klaim extends CI_Controller {

    // 24-04-2020

        public function index()
        {
            $data = ['menu' => 'Klaim',
                     'page' => 'Klaim'
                    ];
        
            $this->template->load('layout/template', 'klaim/V_klaim', $data);
        }

}

/* End of file C_klaim.php */
