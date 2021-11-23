<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_login_lib
{
    // jika status masuk masih FALSE
    public function logged_in_false()
    {
        $_this =& get_instance();
        if ($_this->session->userdata('masuk') != 'ajk') {
            redirect('', 'refresh');
        }
    }

    // jika status masuk telah TRUE
    public function logged_in_true()
    {
        $_this =& get_instance();
        if ($_this->session->userdata('masuk') == 'ajk') {
            redirect("C_dashboard", 'refresh');
        }
    }
}

/* End of file Cek_login_lib.php */
