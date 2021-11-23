<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_login'));
    }

    public function index()
    {
        $this->cek_login_lib->logged_in_true();
        $this->load->view('V_login');
    }

    // 01-02-2021
    public function cek_login()
    {
        $post = $this->input->post();

        $u = $post['username'];
        $p = $post['password'];

        $username = $this->security->xss_clean(trim(htmlspecialchars($u, ENT_QUOTES))); 
        $password = $this->security->xss_clean(trim(htmlspecialchars($p, ENT_QUOTES))); 

        $user       = $this->M_login;
        $isiUser    = $user->cari_username($username);
        $hasil      = $isiUser->row_array();

        // mengecek username
        if ($isiUser->num_rows() != 0 ) {

            // cek password
            if (password_verify($password, $hasil['sha'])) {

                // set session
                $array = array(
                    'masuk'         => 'ajk',
                    'username'      => $hasil['username'],
                    'id_bpr'        => $hasil['id_bpr'],
                    'id_asuransi'   => $hasil['id_asuransi'],
                    'id_level'      => $hasil['id_level'],
                    'level'         => $hasil['level'],
                    'nama_bpr'      => $hasil['nama_bpr']
                );
                
                $this->session->set_userdata( $array );

                // berhasil masuk
                echo json_encode(['hasil'   => 'silahkan masuk']);

            }else{

                // password salah
                echo json_encode(['hasil' => 'password salah']);
            }

        }else{

            // username tidak ditemukan
            echo json_encode(['hasil' => 'username tidak ditemukan']);
        }
    }

    // 01-02-2021
    public function logout()
    {
        $ms = $this->session->userdata('masuk');
        
        if ($ms == 'ajk') {
            $this->session->sess_destroy();
            redirect(base_url());  
        } else {
            redirect(base_url());  
        }
    }

    // 01-02-2021
    public function hash()
    {
        echo password_hash('123456', PASSWORD_DEFAULT);
    }

    public function tes()
    {
        for ($i=1; $i <= 3 ; $i++) { 
            for ($r=0; $r <= 3 ; $r++) { 
                if ($i == 1) {
                    if ($r == 0) {
                        $id= $i;
                        $name = 'Alpha';
                        $parent = '';
                    } else {
                        if ($r == 1 || $r == 2) {
                            $id = $i+10+$r-1;
                        } else {
                            $id = $i+10+1;
                            $id = $id.$i;
                        }
                        // $id= $i;
                        $name = 'Alpha-0'.$r;
                        if ($r == 3) {
                            $parent = 1+11;
                        } else {
                            $parent = 1;
                        }
                       
                    }
                    
                } elseif ($i == 2) {
                    $id= $i;
                    $name = 'Beta-01';
                    $parent = '';
                } else {
                    $id= '22';
                    $name = 'Beta-02';
                    $parent = '2';
                }

                echo "Id : $id, Name: $name, ParentId: $parent";
                echo "<br>";
            }

            
        }
    }

}

/* End of file C_login.php */
