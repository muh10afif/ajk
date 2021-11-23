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
            if (password_verify($password, $hasil['password'])) {

                // set session
                $array = array(
                    'masuk'         => 'simon_pro',
                    'posisi'        => $hasil['id_posisi'],
                    'jenis_modul'   => $hasil['jenis_modul'],
                    'jabatan'       => $hasil['id_jabatan'],
                    'nama_jabatan'  => $hasil['nama_jabatan'],
                    'nama_lengkap'  => $hasil['nama_pegawai'],
                    'id_pegawai'    => $hasil['id_pegawai'],
                    'email'         => $hasil['email'],
                    'userdata'      => $hasil
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

    public function logout()
    {
        $ms = $this->session->userdata('masuk');
        
        if ($ms == 'simon_pro') {
            $this->session->sess_destroy();
            redirect(base_url());  
        } else {
            redirect(base_url());  
        }
    }

    public function tes()
    {
        $hash = password_hash('manager', PASSWORD_DEFAULT);
        echo $hash;
    }

}

/* End of file C_login.php */
