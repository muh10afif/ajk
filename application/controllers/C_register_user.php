<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_register_user extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_user', 'M_master'));
    }

    // 24-04-2020
    public function index()
    {
        $data = ['menu'     => 'Register User',
                 'page'     => 'Register User',
                 'level'    => $this->M_master->get_data_order('m_level', 'id_level', 'asc')->result_array(),
                 'level_2'  => $this->M_master->cari_data_level()->result_array()
                ];

        $this->template->load('layout/template', 'register_user/V_register_user', $data);
    }

    // 28-04-2020
    // menampilkan isi modal user
    public function modal_user()
    {
        $id_bpr = $this->input->post('id_bpr');
        $level  = $this->input->post('level');

        $data = ['id_bar'   => $id_bpr,
                    'level'    => $level
                ];

        $this->load->view('register_user/V_modal_user_manager', $data);

    }

    // 14-02-2021
    public function ambil_bpr_asuransi()
    {
        $id_level = $this->input->post('id_level');

        if ($id_level == '') {
            $option = "<option value=''></option>";
        } 
        // bpr
        else if ($id_level == 3) {
            $list = $this->M_master->cari_list_bpr()->result_array();

            $option = "";

            foreach ($list as $d) {
                $option .= "<option value='".$d['id_bpr']."'>".$d['nama_bpr']."</option>";
            }
        } 
        // asuransi
        else {
            $list = $this->M_master->cari_list_asuransi()->result_array();

            $option = "";

            foreach ($list as $d) {
                $option .= "<option value='".$d['id_asuransi']."'>".$d['nama_asuransi']."</option>";
            }
        }

        echo json_encode(['status' => true, 'option' => $option]);
    }

    // 28-01-2021
    public function tampil_data_use()
    {
        $list = $this->M_user->get_data_user();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['id_bpr'] != null) {
                $nama_instansi = $o['nama_bpr'];
            }

            if ($o['id_asuransi'] != null) {
                $nama_instansi = $o['nama_asuransi'];
            }
            if ($o['id_asuransi'] == null && $o['id_bpr'] == null) {
                $nama_instansi = "-";
            }

            if ($o['status'] == 1) {
                $st     = "<span class='badge badge-primary'>Aktif</span>";
            } else {
                $st     = "<span class='badge badge-danger'>Non Aktif</span>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_pic'];
            $tbody[]    = $nama_instansi;
            $tbody[]    = $o['level'];
            $tbody[]    = $o['username'];
            $tbody[]    = $st;
            $tbody[]    = "<span style='cursor:pointer' title='Edit User' class='mr-3 text-primary edit' data-id='".$o['id_user']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' data-toggle='tooltip' class='text-danger hapus' data-id='".$o['id_user']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => isset($_POST['draw']),
                    "recordsTotal"     => $this->M_user->jumlah_semua_user(),
                    "recordsFiltered"  => $this->M_user->jumlah_filter_user(),
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    public function leveldata($value='')
    {
      $data = $this->db->get('m_level');
      echo json_encode($data->result());
    }

    public function bprdata($value='')
    {
      if (isset($value) && $value != null) {
        $this->db->where('id_bpr', $value);
      }
      $data = $this->db->get('m_bpr');
      echo json_encode($data->result());
    }

    // 14-02-2021
    public function simpan_data_user()
    {
        $aksi         = $this->input->post('aksi');

        $id_user      = $this->input->post('id_user');

        $username     = $this->input->post('username');
        $password     = $this->input->post('password');
        $level_user   = $this->input->post('level_user');
        $bpr_asuransi = $this->input->post('bpr_asuransi');
        $nama_pic     = $this->input->post('nama_pic');
        $status       = $this->input->post('status');

        $data = [
                'username'       => $username,
                'sha'            => password_hash($password, PASSWORD_DEFAULT),
                'id_level'       => $level_user,
                'nama_pic'       => $nama_pic,
                'status'         => $status
                ];
        
        if ($level_user == 3) {
            $data['id_bpr']         = $bpr_asuransi;
        } else {
            $data['id_asuransi']    = $bpr_asuransi;
        }

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_user', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_user', $data, array('id_user' => $id_user));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_user', array('id_user' => $id_user));
        }

        echo json_encode($aksi);
    }

    public function ambil_data_use($value='')
    {
      $this->db->select('mu.id_user, mu.username, mu.nama_lengkap, mu.email, mu.kontak, mb.nama_bpr, ml."level", mu.id_bpr, mu.level as level_id');
      $this->db->from('m_user mu');
      $this->db->join('m_bpr mb','mu.id_bpr = mb.id_bpr', 'left');
      $this->db->join('m_level ml','mu."level" = ml.id_level', 'left');
      $this->db->where('id_user', $value);
      $data = $this->db->get();
      echo json_encode($data->result_array());
    }

}

/* End of file C_register_user.php */
