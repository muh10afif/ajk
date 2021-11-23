<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class C_transaksi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_transaksi', 'M_master'));   
    }

    public function index()
    {
        $this->underwriting();
    }

    // 06-02-2021
    public function underwriting()
    {
        $data = ['menu'         => 'Underwriting',
                 'page'         => 'Underwriting',
                 'asuransi'     => $this->M_master->get_data_order('m_asuransi', 'nama_asuransi', 'asc')->result_array(),
                 'jenis_dok'    => $this->M_master->get_data_order('m_dok_underwriting', 'jenis_dokumen', 'asc')->result_array(),
                 'status'       => $this->M_master->get_data_order('m_status_underwriting', 'status_underwriting', 'asc')->result_array()
                ];
    
        $this->template->load('layout/template', 'transaksi/V_underwriting', $data);
    }

    // 07-02-2021
    public function tampil_udw()
    {
        $list = $this->M_transaksi->get_data_udw();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_asuransi'];
            $tbody[]    = $o['status_underwriting'];
            $tbody[]    = $o['jenis_dokumen'];
            $tbody[]    = "<span style='cursor:pointer' title='Edit' class='mr-3 text-primary edit' data-toggle='tooltip' title='Edit' id_asuransi='".$o['id_asuransi']."' nama_asuransi='".$o['nama_asuransi']."' id_status_udw='".$o['id_status_underwriting']."' status_udw='".$o['status_underwriting']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' data-toggle='tooltip' title='Hapus' class='text-danger hapus' id_asuransi='".$o['id_asuransi']."' id_status_udw='".$o['id_status_underwriting']."' status_udw='".$o['status_underwriting']."' nama_asuransi='".$o['nama_asuransi']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_transaksi->jumlah_semua_udw(),
                    "recordsFiltered"  => $this->M_transaksi->jumlah_filter_udw(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 07-02-2021
    public function ambil_status_udw()
    {
        $id_asuransi = $this->input->post('id_asuransi');

        if ($id_asuransi == '') {
            $option = "<option value=''></option>";
        } else {
            $status    = $this->M_transaksi->get_status_belum($id_asuransi)->result_array();

            $option = "";

            foreach ($status as $d) {
                $option .= "<option value='".$d['id_status_underwriting']."'>".$d['status_underwriting']."</option>";
            }
        }

        echo json_encode(['option' => $option]);
    }

    public function simpan_data_udw()
    {
        $aksi               = $this->input->post('aksi');
        $id_asuransi_tambah = $this->input->post('id_asuransi_tambah');
        $status             = $this->input->post('status');
        $jenis_dokumen      = json_decode(stripslashes($this->input->post('jenis_dokumen')));
        $e_id_asuransi      = $this->input->post('e_id_asuransi');
        $e_status           = $this->input->post('e_status');

        if ($aksi == 'Tambah' || $aksi == 'Ubah') {

            if ($aksi == 'Ubah') {
                $this->M_master->hapus_data('tr_dok_underwriting', array('id_asuransi' => $e_id_asuransi, 'id_status_underwriting' => $e_status));

                $sts = $e_status;
                $ids = $e_id_asuransi;
            } else {
                $sts = $status;
                $ids = $id_asuransi_tambah;
            }

            foreach ($jenis_dokumen as $j) {

                $data = ['id_status_underwriting'   => $sts,
                         'id_dok_underwriting'      => $j,
                         'id_asuransi'              => $ids,
                         'add_time'                 => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];
                
                $this->M_master->input_data('tr_dok_underwriting', $data);
            }


        } elseif ($aksi == 'Hapus') {

            $this->M_master->hapus_data('tr_dok_underwriting', array('id_asuransi' => $id_asuransi_tambah, 'id_status_underwriting' => $status));

        }

        echo json_encode(['status' => true]);
    }

    // 07-02-2021
    public function ambil_selected_jenis_dok()
    {
        $id_asuransi    = $this->input->post('id_asuransi');
        $id_status      = $this->input->post('id_status');

        $cr = $this->M_master->cari_data('tr_dok_underwriting', ['id_status_underwriting' => $id_status, 'id_asuransi' => $id_asuransi])->result_array();

        $arr = [];
        foreach ($cr as $c) {
            array_push($arr, $c['id_dok_underwriting']);
        }

        echo json_encode(['selected' => $arr]);
        
    }
}

/* End of file C_transaksi.php */
