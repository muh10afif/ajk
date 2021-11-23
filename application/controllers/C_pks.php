<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class C_pks extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_pks', 'M_master'));   
        $this->cek_login_lib->logged_in_false();
    }

    public function index()
    {
        $this->klausal_asuransi();
    }

    public function klausal_asuransi()
    {
        $data = ['menu' => 'PKS',
                 'page' => 'Klausal'
                ];
    
        $this->template->load('layout/template', 'surat_pks/klausul/V_klausal', $data);
    }

    // 04-02-2021
    public function tampil_data_asuransi()
    {
        $list = $this->M_pks->get_data_asuransi();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_asuransi'];
            $tbody[]    = $o['jenis_produk'];
            $tbody[]    = "<a href='".base_url()."C_pks/detail_klausul/".$o['id_asuransi']."/".$o['id_jenis_produk']."' class='mr-3 text-warning detail' data-toggle='tooltip' title='Detail'><i class='mdi mdi-information-outline mdi-24px'></i></a><a href='".base_url()."C_pks/edit_klausul/".$o['id_asuransi']."/".$o['id_jenis_produk']."' class='mr-3 text-primary edit' data-toggle='tooltip' title='Edit'><i class='mdi mdi-pencil mdi-24px'></i></a><span style='cursor:pointer' data-toggle='tooltip' title='Hapus' class='mr-3 text-danger hapus' data-id='".$o['id_asuransi']."' id_jenis_produk='".$o['id_jenis_produk']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_pks->jumlah_semua_asuransi(),
                    "recordsFiltered"  => $this->M_pks->jumlah_filter_asuransi(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 31-03-2021
    public function edit_klausul($id_asuransi, $id_jenis_produk)
    {
      $cr1 = $this->M_master->cari_data('tr_jenis_resiko', ['id_asuransi' => $id_asuransi, 'id_jenis_produk' => $id_jenis_produk])->result_array();
      
      $data = [ 'menu'              => 'PKS',
                'page'              => 'Edit Klausal',
                'id_asuransi'       => $id_asuransi,
                'id_jenis_produk'   => $id_jenis_produk,
                'plafond'           => $this->M_pks->get_data_order('m_plafond', 'id_plafond', 'asc')->result_array(),
                'usia_masuk'        => $this->M_pks->get_data_order('m_usia_masuk', 'id_usia_masuk', 'asc')->result_array(),
                'asuransi'          => $this->M_pks->get_data_order('m_asuransi', 'id_asuransi', 'asc')->result_array(),
                // 'asuransi'      => $this->M_pks->get_sel_asuransi()->result_array(),
                'jenis_produk'      => $this->M_pks->cari_jenis_produk_2($id_asuransi, $id_jenis_produk)->result_array(),
                'jenis_resiko_1'    => $this->M_master->cari_data_order('m_jenis_resiko', ['tampil_otomatis' => 0], 'id_jenis_resiko', 'asc')->result_array(),
                'jenis_resiko'      => $this->M_master->get_data_order('m_jenis_resiko', 'id_jenis_resiko', 'asc')->result_array(),
                'jenis_tanggung'    => $this->M_master->get_data_order('m_jenis_tanggung', 'id_jenis_tanggung', 'asc')->result_array(),
                'status_dok'        => $this->M_pks->tampil_status_dok($id_asuransi)->result_array()
              ];
    
      $this->template->load('layout/template', 'surat_pks/klausul/V_edit_klausal', $data);
    }

    // 31-03-2021
    public function detail_klausul($id_asuransi, $id_jenis_produk)
    {
      // cari detail tr resiko ptg
      $cr = $this->M_pks->cari_detail_resiko($id_asuransi, $id_jenis_produk)->row_array();

      $data = [ 'menu'              => 'PKS',
                'page'              => 'Detail Klausal',
                'id_asuransi'       => $id_asuransi,
                'id_jenis_produk'   => $id_jenis_produk,
                'det'               => $cr,
                'plafond'           => $this->M_pks->get_data_order('m_plafond', 'id_plafond', 'asc')->result_array(),
                'usia_masuk'        => $this->M_pks->get_data_order('m_usia_masuk', 'id_usia_masuk', 'asc')->result_array(),
                'asuransi'          => $this->M_pks->get_data_order('m_asuransi', 'id_asuransi', 'asc')->result_array(),
                // 'asuransi'      => $this->M_pks->get_sel_asuransi()->result_array(),
                'jenis_produk'      => $this->M_master->get_data_order('m_jenis_produk', 'jenis_produk', 'asc')->result_array(),
                'jenis_resiko_1'    => $this->M_master->cari_data_order('m_jenis_resiko', ['tampil_otomatis' => 0], 'id_jenis_resiko', 'asc')->result_array(),
                'jenis_resiko'      => $this->M_master->get_data_order('m_jenis_resiko', 'id_jenis_resiko', 'asc')->result_array(),
                'jenis_tanggung'    => $this->M_master->get_data_order('m_jenis_tanggung', 'id_jenis_tanggung', 'asc')->result_array(),
                'status_dok'        => $this->M_pks->tampil_status_dok($id_asuransi)->result_array()
              ];
    
      $this->template->load('layout/template', 'surat_pks/klausul/V_detail_klausal', $data);
    }

    public function hapus_klausul()
    {
      $id_asuransi      = $this->input->post('id_asuransi');
      $id_jenis_produk  = $this->input->post('id_jenis_produk');

      // cari klausul
      // $cr1 = $this->M_master->cari_data('tr_klausul', ['id_asuransi' => $id_asuransi, 'id_jenis_produk' => $id_jenis_produk])->result_array();

      $cr1 = $this->M_pks->cari_produk_resiko($id_asuransi, $id_jenis_produk)->result_array();

      $this->db->trans_begin();

      // cari ke tr klausul
      foreach ($cr1 as $c1) {

        // syarat ptg
        $id_syarat_ptg  = $c1['id_syarat_pertanggungan'];
        $kode_udw       = $c1['kode_underwriting'];
        $kode_tfu       = $c1['kode_tarif_perusia'];

        // hapus dokumen asuransi
          $cr2 = $this->M_master->cari_data('dokumen_asuransi', ['id_syarat_pertanggungan' => $id_syarat_ptg])->result_array();

          foreach ($cr2 as $c2) {
            $dok_as = $c2['nama_dokumen'];

            if ($dok_as) {
              $path = "./uploads/dokumen_asuransi/$dok_as";
              unlink($path); 
            }
          }

          $this->M_master->hapus_data('syarat_pertanggungan', ['id_syarat_pertanggungan' => $id_syarat_ptg]);
          $this->M_master->hapus_data('dokumen_asuransi', ['id_syarat_pertanggungan' => $id_syarat_ptg]);
          $this->M_master->hapus_data('tr_underwriting', ['kode_underwriting' => $kode_udw]);
          $this->M_master->hapus_data('tr_tarif_perusia', ['kode_tarif_perusia' => $kode_tfu]);
          $this->M_master->hapus_data('tr_klausul', ['id_syarat_pertanggungan' => $id_syarat_ptg]);
        
      }

      $this->M_master->hapus_data('tr_jenis_resiko', ['id_asuransi' => $id_asuransi, 'id_jenis_produk' => $id_jenis_produk]);

      if($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
      }else{
        $this->db->trans_commit();
      }

      echo json_encode(['status' => TRUE]);
      
    }

    // 01-04-2021
    public function download_dokumen_asuransi($id_dok)
    {
        $cr = $this->M_master->cari_data('dokumen_asuransi', ['id_dokumen_asuransi' => $id_dok])->row_array();

        force_download("uploads/dokumen_asuransi/".$cr['dokumen'],NULL);
    }

    // 05-02-2021
    public function tampil_status_underwriting()
    {
        $id_kategori = $this->input->post('id_kategori');
        
        $list 	   = $this->kategori->tampil_produk($id_kategori)->result_array();
        $data 	   = [];
        $no		   = 1;
        foreach($list as $k)
        {
                $row 	= [];

          $row[] 	= $no++.'.';
                $row[] 	= $k['nama'];
                $row[] 	= "Rp. ".number_format($k['harga'],0,'.','.');
                $data[] = $row;
        }
        
        if ($list) {
            echo json_encode(array('data'=> $data));
        }else{
            echo json_encode(array('data'=> 0));
        }
    }

    // 03-02-2021
    public function tambah_klausal()
    {
      $data = [ 'menu'          => 'PKS',
                'page'          => 'Tambah Klausal',
                'plafond'       => $this->M_pks->get_data_order('m_plafond', 'id_plafond', 'asc')->result_array(),
                'usia_masuk'    => $this->M_pks->get_data_order('m_usia_masuk', 'id_usia_masuk', 'asc')->result_array(),
                'asuransi'      => $this->M_pks->get_data_order('m_asuransi', 'id_asuransi', 'asc')->result_array(),
                // 'asuransi'      => $this->M_pks->get_sel_asuransi()->result_array(),
                'jenis_produk'  => $this->M_master->get_data_order('m_jenis_produk', 'jenis_produk', 'asc')->result_array(),
                'jenis_resiko_1'=> $this->M_master->cari_data_order('m_jenis_resiko', ['tampil_otomatis' => 0], 'id_jenis_resiko', 'asc')->result_array(),
                'jenis_resiko'  => $this->M_master->get_data_order('m_jenis_resiko', 'id_jenis_resiko', 'asc')->result_array(),
                'jenis_tanggung'=> $this->M_master->get_data_order('m_jenis_tanggung', 'id_jenis_tanggung', 'asc')->result_array()
              ];
    
      $this->template->load('layout/template', 'surat_pks/klausul/V_tambah_klausal', $data);
    }

    // 07-02-2021
    public function tampil_status_dok()
    {
        $id_asuransi = $this->input->post('id_asuransi');
        
        $list 	   = $this->M_pks->tampil_status_dok($id_asuransi)->result_array();

            $option    = "<option value=''></option>";
        $data 	   = [];
        $no		   = 1;
        foreach($list as $k)
        {
                $row 	= [];

                $option .= "<option value='".$k['id_status_underwriting']."'>".$k['status_underwriting']."</option>";

                $row[] 	= $k['status_underwriting'];
                $row[] 	= $k['jenis_dokumen'];
                $data[] = $row;
        }
        
        if ($list) {
            echo json_encode(array('data'=> $data, 'option' => $option));
        }else{
            echo json_encode(array('data'=> 0, 'option' => ''));
        }
    }

    // 02-03-2021
    public function ambil_jenis_produk()
    {
      $id_asuransi = $this->input->post('id_asuransi');

      $cari = $this->M_pks->cari_jenis_produk($id_asuransi)->result_array();

      $option = "<option value=''></option>";

      foreach ($cari as $c) {

        $option .= "<option value='".$c['id_jenis_produk']."'>".$c['jenis_produk']."</option>";
        
      }

      echo json_encode(['sel_jenis_produk' => $option]);
      
    }

    public function simpan_klausul_data()
    {
      include APPPATH.'third_party/PHPExcel/IOFactory.php';
      
      // Syarat Pertanggungan

      $config['upload_path']    = './uploads/dokumen_asuransi/';
      $config['allowed_types']  = 'gif|jpg|png|pdf|xls|xlsx';
      $config['max_size']       = 5000;
      // load library upload
      $this->load->library('upload', $config);

      $jenis_resiko = [];
      
      $id_sel_asuransi    = $this->input->post('sel_asuransi');
      $id_jenis_produk    = $this->input->post('jenis_produk');
      $jenis_ptg          = $this->input->post('jenis_ptg');
      $jenis_resiko       = $this->input->post('jenis_resiko');

      $cari_d = $this->M_master->cari_data('m_jenis_resiko', ['tampil_otomatis' => 1])->result_array();

      if ($jenis_resiko) {
        $jenis_resiko = $jenis_resiko;
      } else {
        $jenis_resiko = [];
      }

      foreach ($cari_d as $c) {

        array_push($jenis_resiko, $c['id_jenis_resiko']);
        
      }

      $a  = strtoupper(bin2hex(random_bytes(2)));

      $dt = date("dmy", now('Asia/Jakarta'));
      
      $kode_klausul = "KLU$dt$a";

      foreach ($jenis_ptg as $j_ptg) {

        // $idptg = $this->M_master->cari_data('m_jenis_tanggung', ['jenis_tanggung' => strtoupper($j_ptg)])->row_array();

        $id_jenis_ptg = $j_ptg;
        
        foreach ($jenis_resiko as $j_rso) {
          $id_jenis_rso = $j_rso;

          $id = $id_jenis_ptg.$id_jenis_rso;

          $data_sp = ['pks'               => $this->input->post("nama_pks_$id"),
                      'polis_induk'       => $this->input->post("no_polis_$id"),
                      'maksimal_plafond'  => $this->input->post("maksimal_plafond_$id"),
                      'x_n'               => $this->input->post("x_plus_n_$id"),
                      'free_cover'        => $this->input->post("free_cover_$id"),
                      'tenor_maksimal'    => $this->input->post("tenor_maksimal_$id"),
                      'brokerage'         => $this->input->post("brokerage_$id")            
                      ];

          $this->M_master->input_data('syarat_pertanggungan', $data_sp);
          $id_data_sp = $this->db->insert_id();
          
          // upload gambar 1
          $this->upload->do_upload("pks_file_$id");
          $result1 = $this->upload->data();
          $nama1   = 'pks';

          if ($_FILES["pks_file_$id"]['name'] != "") {
              $nm1 = $result1['file_name'];
          } else {
              $nm1 = null;
          }

          $data_dok['jenis_dokumen']          = $nama1;
          $data_dok['nama_dokumen']           = $nm1;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;

          $this->M_master->input_data('dokumen_asuransi', $data_dok);
          // upload gambar 2
          $this->upload->do_upload("no_polis_file_$id");
          $result2 = $this->upload->data();
          $nama2   = 'polis_induk';

          if ($_FILES["no_polis_file_$id"]['name'] != "") {
              $nm2 = $result2['file_name'];
          } else {
              $nm2 = null;
          }

          $data_dok['jenis_dokumen']          = $nama2;
          $data_dok['nama_dokumen']           = $nm2;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;

          $this->M_master->input_data('dokumen_asuransi', $data_dok);

          // upload gambar 3
          $this->upload->do_upload("compro_file_$id");
          $result3 = $this->upload->data();
          $nama3   = 'compro';

          if ($_FILES["compro_file_$id"]['name'] != "") {
              $nm3 = $result3['file_name'];
          } else {
              $nm3 = null;
          }

          $data_dok['jenis_dokumen']          = $nama3;
          $data_dok['nama_dokumen']           = $nm3;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;
          
          $this->M_master->input_data('dokumen_asuransi', $data_dok);

          // upload gambar 3
          $this->upload->do_upload("legalitas_$id");
          $result4 = $this->upload->data();
          $nama4   = 'legalitas';

          if ($_FILES["legalitas_$id"]['name'] != "") {
              $nm4 = $result4['file_name'];
          } else {
              $nm4 = null;
          }

          $data_dok['jenis_dokumen']          = $nama4;
          $data_dok['nama_dokumen']           = $nm4;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;

          $this->M_master->input_data('dokumen_asuransi', $data_dok);

          $a  = strtoupper(bin2hex(random_bytes(2)));

          $dt = date("dmy", now('Asia/Jakarta'));
  
          $kode_udw     = "UDW$dt$a";
          $kode_tru     = "TRU$dt$a";

          $data_klausul = [ 'id_asuransi'             => $id_sel_asuransi,
                            'id_syarat_pertanggungan' => $id_data_sp,
                            'kode_klausul'            => $kode_klausul,
                            'kode_underwriting'       => $kode_udw,
                            'kode_tarif_perusia'      => $kode_tru
                          ];
          
          $this->M_master->input_data('tr_klausul', $data_klausul);
          $id_klausul = $this->db->insert_id();

          $data_tr_resiko = [ 'id_asuransi'       => $id_sel_asuransi,
                              'id_jenis_produk'   => $id_jenis_produk,
                              'id_jenis_tanggung' => $id_jenis_ptg,
                              'id_jenis_resiko'   => $id_jenis_rso,
                              'id_klausul'        => $id_klausul
                            ];

          $this->M_master->input_data('tr_jenis_resiko', $data_tr_resiko);

          // Underwriting

            for ($i=1; $i <= 3 ; $i++) { 

              for ($v=1; $v <= 3 ; $v++) { 

                $isi = $this->input->post('input_'.$i.'_'.$v.'_'.$id);
                
                $ar = explode("_", $isi);

                $data_u1 = ['id_status_underwriting'  => $ar[0],
                            'id_plafond'              => $ar[1],
                            'id_usia_masuk'           => $ar[2],
                            'id_asuransi'             => $this->input->post('sel_asuransi'),
                            'kode_underwriting'       => $kode_udw
                          ];

                $this->M_master->input_data('tr_underwriting', $data_u1);

              }
            }

          // end--Underwriting

          // Tarif Asuransi

          $new_name = time()."_data_upload";

          $this->upload->do_upload("excdata_$id");
          $result5 = $this->upload->data();
          $nama5   = 'tarif_asuransi';

          if ($_FILES["excdata_$id"]['name'] != "") {
              $nm5 = $result5['file_name'];
          } else {
              $nm5 = null;
          }

          $data_dok['jenis_dokumen']          = $nama5;
          $data_dok['nama_dokumen']           = $nm5;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;

          $this->M_master->input_data('dokumen_asuransi', $data_dok);

          $this->storedatabase($result5['file_name'], $kode_tru);

        }
        
      }
      

      // $data_sp = ['pks'               => $this->input->post('nama_pks'),
      //             'polis_induk'       => $this->input->post('no_polis'),
      //             'maksimal_plafond'  => $this->input->post('maksimal_plafond'),
      //             'x_n'               => $this->input->post('x_plus_n'),
      //             'free_cover'        => $this->input->post('free_cover'),
      //             'tenor_maksimal'    => $this->input->post('tenor_maksimal'),
      //             'brokerage'         => $this->input->post('brokerage')            
      //             ];

      // $this->M_master->input_data('syarat_pertanggungan', $data_sp);
      // $id_data_sp = $this->db->insert_id();

      // $nama   = 'nama';
      // $result = 'result';
      
      // // upload gambar 1
      // $this->upload->do_upload('pks_file');
      // $result1 = $this->upload->data();
      // $nama1   = 'pks';

      // $data_dok['jenis_dokumen']          = $nama1;
      // $data_dok['nama_dokumen']           = $result1['file_name'];
      // $data_dok['id_syarat_pertanggungan']= $id_data_sp;

      // $this->M_master->input_data('dokumen_asuransi', $data_dok);
      // // upload gambar 2
      // $this->upload->do_upload('no_polis_file');
      // $result2 = $this->upload->data();
      // $nama2   = 'polis_induk';

      // $data_dok['jenis_dokumen']          = $nama2;
      // $data_dok['nama_dokumen']           = $result2['file_name'];
      // $data_dok['id_syarat_pertanggungan']= $id_data_sp;

      // $this->M_master->input_data('dokumen_asuransi', $data_dok);

      // // upload gambar 3
      // $this->upload->do_upload('compro_file');
      // $result3 = $this->upload->data();
      // $nama3   = 'compro';

      // $data_dok['jenis_dokumen']          = $nama3;
      // $data_dok['nama_dokumen']           = $result3['file_name'];
      // $data_dok['id_syarat_pertanggungan']= $id_data_sp;

      // // upload gambar 3
      // $this->upload->do_upload('legalitas');
      // $result4 = $this->upload->data();
      // $nama4   = 'legalitas';

      // $data_dok['jenis_dokumen']          = $name4;
      // $data_dok['nama_dokumen']           = $result4['file_name'];
      // $data_dok['id_syarat_pertanggungan']= $id_data_sp;

      // $this->M_master->input_data('dokumen_asuransi', $data_dok);

      // $data_klausul = [ 'id_asuransi'             => $this->input->post('sel_asuransi'),
      //                   'id_syarat_pertanggungan' => $id_data_sp
      //                 ];
      
      // $this->M_master->input_data('tr_klausul', $data_klausul);

      // // end--Syarat Pertanggungan

      // // Kriteria Peserta

      // /* start code here... */

      // // end--Kriteria Peserta

      // // Underwriting

      //   for ($i=1; $i <= 3 ; $i++) { 

      //     for ($v=1; $v <= 3 ; $v++) { 

      //       $isi = $this->input->post('input_'.$i.'_'.$v);
            
      //       $ar = explode("_", $isi);

      //       $data_u1 = ['id_status_underwriting'  => $ar[0],
      //                   'id_plafond'              => $ar[1],
      //                   'id_usia_masuk'           => $ar[2],
      //                   'id_asuransi'             => $this->input->post('sel_asuransi')
      //                 ];

      //       $this->M_master->input_data('tr_underwriting', $data_u1);

      //     }
      //   }

      // // end--Underwriting

      // // Tarif Asuransi

      // $new_name = time()."_data_upload";

      // $this->upload->do_upload('excdata');
      // $result4 = $this->upload->data();

      // // $config1['upload_path'] = './uploads/excel/';
      // // $config1['allowed_types'] = 'xls|xlsx|csv';
      // // $config1['max_size'] = 5000;
      // // $config1['file_name'] = $new_name."_.".pathinfo($_FILES["excdata"]['name'], PATHINFO_EXTENSION);
      // // $this->load->library('upload', $config1);

      // // if (!$this->upload->do_upload('excdata')) {
      // //   $error = array('error' => $this->upload->display_errors());
      // //   // $this->template->load('layout/template', 'V_tambah_klausal', $error);
      // // }

      // // $media = $this->upload->data('excdata');
      // // $this->storedatabase($config1['file_name']);
      // // end--Tarif Asuransi

      // $this->storedatabase($result4['file_name']);

      redirect('C_pks/tambah_klausal', 'refresh');
    }

    public function simpan_edit_klausul_data()
    {
      include APPPATH.'third_party/PHPExcel/IOFactory.php';
      
      // Syarat Pertanggungan
      $config['upload_path']    = './uploads/dokumen_asuransi/';
      $config['allowed_types']  = 'gif|jpg|png|pdf|xls|xlsx';
      $config['max_size']       = 5000;
      // load library upload
      $this->load->library('upload', $config);

      $jenis_resiko = [];
      
      $id_sel_asuransi    = $this->input->post('sel_asuransi');
      $id_jenis_produk    = $this->input->post('jenis_produk');
      $jenis_ptg          = $this->input->post('jenis_ptg');
      $jenis_resiko       = $this->input->post('jenis_resiko');

      $cari_d = $this->M_master->cari_data('m_jenis_resiko', ['tampil_otomatis' => 1])->result_array();

      if ($jenis_resiko) {
        $jenis_resiko = $jenis_resiko;
      } else {
        $jenis_resiko = [];
      }

      foreach ($cari_d as $c) {

        array_push($jenis_resiko, $c['id_jenis_resiko']);
        
      }

      $a  = strtoupper(bin2hex(random_bytes(2)));

      $dt = date("dmy", now('Asia/Jakarta'));
      
      $kode_klausul = "KLU$dt$a";

      foreach ($jenis_ptg as $j_ptg) {

        // $idptg = $this->M_master->cari_data('m_jenis_tanggung', ['jenis_tanggung' => strtoupper($j_ptg)])->row_array();

        $id_jenis_ptg = $j_ptg;
        
        foreach ($jenis_resiko as $j_rso) {
          $id_jenis_rso = $j_rso;

          $id = $id_jenis_ptg.$id_jenis_rso;

          $data_sp = ['pks'               => $this->input->post("nama_pks_$id"),
                      'polis_induk'       => $this->input->post("no_polis_$id"),
                      'maksimal_plafond'  => $this->input->post("maksimal_plafond_$id"),
                      'x_n'               => $this->input->post("x_plus_n_$id"),
                      'free_cover'        => $this->input->post("free_cover_$id"),
                      'tenor_maksimal'    => $this->input->post("tenor_maksimal_$id"),
                      'brokerage'         => $this->input->post("brokerage_$id")            
                      ];

          $this->M_master->input_data('syarat_pertanggungan', $data_sp);
          $id_data_sp = $this->db->insert_id();
          
          // upload gambar 1
          $this->upload->do_upload("pks_file_$id");
          $result1 = $this->upload->data();
          $nama1   = 'pks';

          if ($_FILES["pks_file_$id"]['name'] != "") {
              $nm1 = $result1['file_name'];
          } else {
              $nm1 = null;
          }

          $data_dok['jenis_dokumen']          = $nama1;
          $data_dok['nama_dokumen']           = $nm1;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;

          $this->M_master->input_data('dokumen_asuransi', $data_dok);
          // upload gambar 2
          $this->upload->do_upload("no_polis_file_$id");
          $result2 = $this->upload->data();
          $nama2   = 'polis_induk';

          if ($_FILES["no_polis_file_$id"]['name'] != "") {
              $nm2 = $result2['file_name'];
          } else {
              $nm2 = null;
          }

          $data_dok['jenis_dokumen']          = $nama2;
          $data_dok['nama_dokumen']           = $nm2;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;

          $this->M_master->input_data('dokumen_asuransi', $data_dok);

          // upload gambar 3
          $this->upload->do_upload("compro_file_$id");
          $result3 = $this->upload->data();
          $nama3   = 'compro';

          if ($_FILES["compro_file_$id"]['name'] != "") {
              $nm3 = $result3['file_name'];
          } else {
              $nm3 = null;
          }

          $data_dok['jenis_dokumen']          = $nama3;
          $data_dok['nama_dokumen']           = $nm3;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;
          
          $this->M_master->input_data('dokumen_asuransi', $data_dok);

          // upload gambar 3
          $this->upload->do_upload("legalitas_$id");
          $result4 = $this->upload->data();
          $nama4   = 'legalitas';

          if ($_FILES["legalitas_$id"]['name'] != "") {
              $nm4 = $result4['file_name'];
          } else {
              $nm4 = null;
          }

          $data_dok['jenis_dokumen']          = $nama4;
          $data_dok['nama_dokumen']           = $nm4;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;

          $this->M_master->input_data('dokumen_asuransi', $data_dok);

          $a  = strtoupper(bin2hex(random_bytes(2)));

          $dt = date("dmy", now('Asia/Jakarta'));
  
          $kode_udw     = "UDW$dt$a";
          $kode_tru     = "TRU$dt$a";

          $data_klausul = [ 'id_asuransi'             => $id_sel_asuransi,
                            'id_syarat_pertanggungan' => $id_data_sp,
                            'kode_klausul'            => $kode_klausul,
                            'kode_underwriting'       => $kode_udw,
                            'kode_tarif_perusia'      => $kode_tru
                          ];
          
          $this->M_master->input_data('tr_klausul', $data_klausul);
          $id_klausul = $this->db->insert_id();

          $data_tr_resiko = [ 'id_asuransi'       => $id_sel_asuransi,
                              'id_jenis_produk'   => $id_jenis_produk,
                              'id_jenis_tanggung' => $id_jenis_ptg,
                              'id_jenis_resiko'   => $id_jenis_rso,
                              'id_klausul'        => $id_klausul
                            ];

          $this->M_master->input_data('tr_jenis_resiko', $data_tr_resiko);

          // Underwriting

            for ($i=1; $i <= 3 ; $i++) { 

              for ($v=1; $v <= 3 ; $v++) { 

                $isi = $this->input->post('input_'.$i.'_'.$v.'_'.$id);
                
                $ar = explode("_", $isi);

                $data_u1 = ['id_status_underwriting'  => $ar[0],
                            'id_plafond'              => $ar[1],
                            'id_usia_masuk'           => $ar[2],
                            'id_asuransi'             => $this->input->post('sel_asuransi'),
                            'kode_underwriting'       => $kode_udw
                          ];

                $this->M_master->input_data('tr_underwriting', $data_u1);

              }
            }

          // end--Underwriting

          // Tarif Asuransi

          $new_name = time()."_data_upload";

          $this->upload->do_upload("excdata_$id");
          $result5 = $this->upload->data();
          $nama5   = 'tarif_asuransi';

          if ($_FILES["excdata_$id"]['name'] != "") {
              $nm5 = $result5['file_name'];
          } else {
              $nm5 = null;
          }

          $data_dok['jenis_dokumen']          = $nama5;
          $data_dok['nama_dokumen']           = $nm5;
          $data_dok['id_syarat_pertanggungan']= $id_data_sp;

          $this->M_master->input_data('dokumen_asuransi', $data_dok);

          $this->storedatabase($result4['file_name'], $kode_tru);

        }
        
      }

      redirect('C_pks/tambah_klausal', 'refresh');
    }

    public function storedatabase($inifile, $kode_tru)
    {
      $inputFileName = './uploads/dokumen_asuransi/'.$inifile;
      try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel   = $objReader->load($inputFileName);
      } catch (Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
      }

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      $rw = 1; $list = array();
      foreach($sheet->getRowIterator() as $row) {
        $is = array();
        foreach($row->getCellIterator() as $key => $cell) {
          $inb = $this->number_to_alphabet($key+1).($rw);
          if ($inb != 'A2') { $is[] = $sheet->getCell($inb)->getValue(); }
        }
        $list[] = $is;
        $rw++;
      }

      $stro = [];
      for ($i=2; $i < $highestRow; $i++) {
        for ($x=0; $x < count($list[1]); $x++) {
          if ($list[$i][$x+1] != "") {
            $cet = [
              'usia'               => $list[$i][0],
              'masa_tahun'         => $list[1][$x],
              'tarif'              => $list[$i][$x+1],
              'add_time'           => date("Y-m-d H:i:s", now('Asia/Jakarta')),
              'id_asuransi'        => $this->input->post('sel_asuransi'),
              'kode_tarif_perusia' => $kode_tru
            ];
            $stro[] = $cet;
          }
        }
      }
      $this->db->insert_batch('tr_tarif_perusia', $stro);
    }

    function number_to_alphabet($number) {
      $number = intval($number);
      if ($number <= 0) {
        return '';
      }
      $alphabet = '';
      while($number != 0) {
        $p = ($number - 1) % 26;
        $number = intval(($number - $p) / 26);
        $alphabet = chr(65 + $p) . $alphabet;
      }
      return $alphabet;
    }

    // 07-02-2021
    public function upload_tarif()
    {
        $path = $_FILES["upload_excel"]["tmp_name"];
    
        $object = PHPExcel_IOFactory::load($path);
    
        foreach($object->getWorksheetIterator() as $worksheet) {
    
            $highestRow = $worksheet->getHighestRow();
    
            $highestColumn = $worksheet->getHighestColumn();
    
            for($row=2; $row<=$highestRow; $row++){
    
                for($col = 'A'; $col != $highestColumn; $col++){
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $colIndex = PHPExcel_Cell::columnIndexFromString($cell->getColumn());
                    $data[] = $colIndex;
               }
    
            }
    
        } 

        $dt = ['data'   => $data];
            
        $this->load->view('surat_pks/klausal/V_preview_upload', $dt);
    }

    // 03-02-2021
    public function lihat_klausal()
    {
        $data = ['menu' => 'PKS',
                 'page' => 'Klausal'
                ];
    
        $this->template->load('layout/template', 'surat_pks/klausul/V_klausal_asuransi', $data);
    }

    public function penawaran()
    {
        $data = ['menu' => 'PKS',
                 'page' => 'Penawaran'
                ];
    
        $this->template->load('layout/template', 'surat_pks/penawaran/V_penawaran', $data);
    }

    // 08-02-2021
    public function tampil_penawaran()
    {
        $list = $this->M_pks->get_data_penawaran();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['status'] == 1) {
                $sts = "<span style='font-size:13px;' class='badge badge-primary'>Aktif</span>";
            } else {
                $sts = "<span style='font-size:13px;' class='badge badge-secondary'>Tidak</span>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nomor_penawaran'];
            $tbody[]    = $o['kode_klausul'];
            $tbody[]    = $o['nama_bpr'];
            $tbody[]    = $o['nama_asuransi'];
            $tbody[]    = $sts;
            $tbody[]    = "<span style='cursor:pointer' title='Dokumen' class='mr-3 text-dark dokumen' data-toggle='tooltip' title='Dokumen' data-id='".$o['id_penawaran']."'><i class='mdi mdi-file mdi-24px'></i></span><a href='".base_url()."C_pks/edit_penawaran/".$o['id_penawaran']."' class='mr-3 text-primary edit' data-toggle='tooltip' title='Edit' data-id='".$o['id_penawaran']."'><i class='mdi mdi-pencil mdi-24px'></i></a><span style='cursor:pointer' data-toggle='tooltip' title='Hapus' class='mr-3 text-danger hapus' data-id='".$o['id_penawaran']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_pks->jumlah_semua_penawaran(),
                    "recordsFiltered"  => $this->M_pks->jumlah_filter_penawaran(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 01-04-2021
    public function edit_penawaran($id_penawaran)
    {
      $det = $this->M_pks->cari_detail_penawaran($id_penawaran)->row_array();

      $data = [ 'menu'          => 'PKS',
                'page'          => 'Edit Penawaran',
                'det'           => $det,
                'bpr'           => $this->M_master->get_data_order('m_bpr', 'nama_bpr', 'asc')->result_array(),
                'asuransi'      => $this->M_master->get_data_order('m_asuransi', 'nama_asuransi', 'asc')->result_array(),
                'kd_klausul'    => $this->M_pks->cari_data_klausul_2($det['id_asuransi'], $det['kode_klausul'])->result_array(),
                'id_penawaran'  => $id_penawaran
              ];
  
      $this->template->load('layout/template', 'surat_pks/penawaran/V_edit_penawaran', $data);
    }

    // 01-04-2021
    public function hapus_penawaran()
    {
      $id_penawaran = $this->input->post('id_penawaran');
      
      $this->M_master->hapus_data('tr_penawaran', ['id_penawaran' => $id_penawaran]);

      echo json_encode(['status'  => TRUE]);
    }

    // 03-02-2021
    public function tambah_penawaran()
    {
        // buat generate
        $cr = $this->M_master->get_data_order('tr_penawaran', 'add_time', 'desc')->row_array();

        if ($cr) {
          $n  = strpos($cr['nomor_penawaran'], '/');

          $no = substr($cr['nomor_penawaran'],0,$n);
          $a  = str_pad($no + 1, 4, "0", STR_PAD_LEFT);
        } else {
          $a  = str_pad(1, 4, "0", STR_PAD_LEFT);
        }

        $b  = date("m", now('Asia/Jakarta'));
        $c  = date("Y", now('Asia/Jakarta'));
        // generate
        $kode   = "$a/LGO/$b/$c";

        $data = ['menu'     => 'PKS',
                 'page'     => 'Tambah Penawaran',
                 'kode'     => $kode,
                 'bpr'      => $this->M_master->get_data_order('m_bpr', 'nama_bpr', 'asc')->result_array(),
                 'asuransi' => $this->M_master->get_data_order('m_asuransi', 'nama_asuransi', 'asc')->result_array()
                ];
    
        $this->template->load('layout/template', 'surat_pks/penawaran/V_tambah_penawaran', $data);
    }

    // 08-02-2021
    public function tampil_sel_klausul()
    {
        $id_asuransi = $this->input->post('id_asuransi');

        if ($id_asuransi == '') {

            $option = "<option value=''></option>";

        } else {

            $cr = $this->M_pks->cari_data_klausul($id_asuransi)->result_array();

            $option = "<option value=''></option>";

            foreach ($cr as $c) {
                
                $option .= "<option value='".$c['kode_klausul']."'>".$c['kode_klausul']."</option>";
                
            }

        }

        echo json_encode(['option' => $option]);
        
    }

    public function tampil_sel_klausul_2()
    {
        $id_asuransi  = $this->input->post('id_asuransi');
        $kd_klausul   = $this->input->post('kd_klausul');

        if ($id_asuransi == '') {

            $option = "<option value=''></option>";

        } else {

            $cr = $this->M_pks->cari_data_klausul_2($id_asuransi, $kd_klausul)->result_array();

            $option = "<option value=''></option>";

            foreach ($cr as $c) {

                if ($c['kode_klausul'] == $kd_klausul) {
                  $sel = 'selected';
                } else {
                  $sel = '';
                }
                
                $option .= "<option value='".$c['kode_klausul']."' $sel>".$c['kode_klausul']."</option>";
                
            }

        }

        echo json_encode(['option' => $option]);
        
    }

    // 08-02-2021
    public function lihat_klausul()
    {
        $kode_klausul = $this->input->post('kode_klausul');

        $cr = $this->M_master->cari_data('tr_klausul', ['kode_klausul' => $kode_klausul])->row_array();
        
        $data = ['kode_klausul' => $kode_klausul,
                 'syarat_p'     => $this->M_master->cari_data('syarat_pertanggungan', ['id_syarat_pertanggungan' => $cr['id_syarat_pertanggungan']])->row_array(),
                 'kriteria'     => $this->M_master->cari_data('kriteria_peserta', ['id_kriteria_peserta' => $cr['id_kriteria_peserta']])->row_array(),
                ];

        $this->load->view('surat_pks/klausul/V_lihat_klausul', $data, FALSE);
        
    }

    // 08-02-2021
    public function simpan_penawaran()
    {
        $id_penawaran   = $this->input->post('id_penawaran');
        $no_penawaran   = $this->input->post('nomor_penawaran');
        $id_bpr         = $this->input->post('id_bpr');
        $id_asuransi    = $this->input->post('id_asuransi');
        $kode_klausul   = $this->input->post('kode_klausul');

        $data   = ['nomor_penawaran'    => $no_penawaran,
                   'id_bpr'             => $id_bpr,
                   'kode_klausul'       => $kode_klausul,
                   'id_asuransi'        => $id_asuransi,
                   'status'             => 1,
                   'add_time'           => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                  ];

        if ($id_penawaran != '') {
          $this->M_master->ubah_data('tr_penawaran', $data, ['id_penawaran' => $id_penawaran]);
        } else {
          $this->M_master->input_data('tr_penawaran', $data);
        }

        echo json_encode(['status' => true]);
    }

    public function pks()
    {
        $data = ['menu' => 'PKS',
                 'page' => 'PKS'
                ];
    
        $this->template->load('layout/template', 'surat_pks/pks/V_pks', $data);
    }

    public function nomorpenawaran($value='')
    {
      if (isset($value) && $value != null) {
        $this->db->where('id_bpr', $value);
      }
      $data = $this->db->get('tr_penawaran');
      echo json_encode($data->result());
    }

    // 08-02-2021
    // public function tampil_pks()
    // {
    //     $list = $this->M_pks->get_data_pks();

    //     $data = array();

    //     $no   = $this->input->post('start');

    //     foreach ($list as $o) {
    //         $no++;
    //         $tbody = array();

    //         $tbody[]    = "<div align='center'>".$no.".</div>";
    //         $tbody[]    = $o['nomor_pks'];
    //         $tbody[]    = $o['nama_bpr'];
    //         $tbody[]    = $o['nomor_penawaran'];
    //         $tbody[]    = $o['email'];
    //         $tbody[]    = $o['kontak'];
    //         $tbody[]    = $o['alamat'];
    //         $tbody[]    = $o['komisi_broker'];
    //         $tbody[]    = "";
    //         $data[]     = $tbody;
    //     }

    //     $output = [ "draw"             => $_POST['draw'],
    //                 "recordsTotal"     => $this->M_pks->jumlah_semua_pks(),
    //                 "recordsFiltered"  => $this->M_pks->jumlah_filter_pks(),   
    //                 "data"             => $data
    //             ];

    //     echo json_encode($output);
    // }


    public function tampil_data_pks($value='')
    {
      $list = $this->M_pks->get_data_pks();

      $data = array();

      $no   = $this->input->post('start');

      foreach ($list as $o) {
          $no++;
          $tbody = array();

          $buton = "<a href='edit_pks/".$o['id_pks']."' style='cursor:pointer' title='Edit User' class='mr-3 text-primary edit-use' data-id='".$o['id_pks']."'>
                      <i class='mdi mdi-pencil mdi-24px'></i>
                    </a>
                    <span style='cursor:pointer' data-toggle='tooltip' class='text-danger hapus' data-id='".$o['id_pks']."'>
                      <i class='mdi mdi-delete mdi-24px'></i>
                    </span>";

          $tbody[]    = "<div align='center'>".$no.".</div>";
          $tbody[]    = $o['nomor_pks'];
          $tbody[]    = $o['nomor_penawaran'];
          $tbody[]    = $o['nama_bpr'];
          $tbody[]    = $o['nama_asuransi'];
          $tbody[]    = $buton;
          $data[]     = $tbody;
      }

      $output = [ "draw"             => isset($_POST['draw']),
                  "recordsTotal"     => $this->M_pks->jumlah_semua_pks(),
                  "recordsFiltered"  => $this->M_pks->jumlah_filter_pks(),
                  "data"             => $data
              ];

      echo json_encode($output);
    }

    public function tambah_pks()
    {
      // buat generate
      $cr = $this->M_master->get_data_order('tr_pks', 'add_time', 'desc')->row_array();

      if ($cr) {
        $n  = strpos($cr['nomor_pks'], '/');

        $no = substr($cr['nomor_pks'],0,$n);
        $a  = str_pad($no + 1, 4, "0", STR_PAD_LEFT);
      } else {
        $a  = str_pad(1, 4, "0", STR_PAD_LEFT);
      }

      $b  = date("m", now('Asia/Jakarta'));
      $c  = date("Y", now('Asia/Jakarta'));
      // generate
      $kode   = "$a/PKS/$b/$c";

      $data = [ 'menu'          => 'PKS',
                'page'          => 'Tambah PKS',
                'link'          => 'simpan_data_pks',
                'kode'          => $kode,
                'no_penawaran'  => $this->M_master->get_data_order('tr_penawaran', 'nomor_penawaran', 'asc')->result_array()
              ];

      $this->template->load('layout/template', 'surat_pks/pks/V_tambah_pks', $data);
    }

    public function simpan_data_pks($value='')
    {
      $datax = ['menu' => 'PKS', 'page' => 'Tambah PKS'];
      $id_pnwr  = $this->input->post('no_penawaran');

      $new_name = time().$_FILES["dok_penawaran"]['name'];
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx';
      $config['max_size'] = 5000;
      $config['file_name'] = $new_name."_.".pathinfo($_FILES["dok_penawaran"]['name'], PATHINFO_EXTENSION);
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('dok_penawaran')) {
        $error = array('error' => $this->upload->display_errors());
        $this->template->load('layout/template', 'surat_pks/pks/V_pks', $error);
      } 
      // else {
      //   // $dk_pnwr = [ 'dokumen' => $new_name."_.".pathinfo($_FILES["dok_penawaran"]['name'], PATHINFO_EXTENSION) ];
      //   // $this->db->update('tr_penawaran', $dk_pnwr, array('id_penawaran' => $id_pnwr));
      // }

      $nm_bpr   = $this->input->post('nama_bpr');
      $nmr_spk  = $this->input->post('no_pks');

      $komiage = $this->input->post('komiage');
      $fepepo  = $this->input->post('fepepo');
      $overid  = $this->input->post('overid');
      $konebro = $this->input->post('konebro');
      $judeso  = $this->input->post('judeso');
      $nefebro = $this->input->post('nefebro');

      $datax = [
        'soc'               => $this->input->post('soc'),
        'komisi_agent'      => str_replace('%','',$komiage),
        'feebase'           => str_replace('%','',$fepepo),
        'overiding'         => str_replace('%','',$overid),
        'komisi_net_broker' => str_replace('%','',$konebro),
        'net_fee_broker'    => $nefebro,
        'jumlah_detail_soc' => str_replace('%','',$judeso),
        'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta'))
      ];
      $this->db->insert('tr_soc', $datax);
      $idx = $this->db->insert_id();

      $datay = [
        'nomor_pks'     => $nmr_spk,
        'id_soc'        => $idx,
        'id_penawaran'  => $id_pnwr,
        'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
      ];
      $this->db->insert('tr_pks', $datay);

      echo json_encode(['status' => true]);
    }

    public function edit_pks($idd)
    {
      $getisi = $this->M_pks->get_data_per_id($idd);

      $data = [
        'menu'          => 'PKS',
        'page'          => 'Tambah PKS',
        'link'          => "edit_data_pks/".$idd,
        'data'          => $getisi,
        'no_penawaran'  => $this->M_master->get_data_order('tr_penawaran', 'nomor_penawaran', 'asc')->result_array()
      ];

      $this->template->load('layout/template', 'surat_pks/pks/V_tambah_pks', $data);
    }

    public function edit_data_pks($value='')
    {
      $datax = ['menu' => 'PKS', 'page' => 'Edit PKS'];
      $id_pnwr  = $this->input->post('idnopenawar');

      $new_name = time().$_FILES["dok_penawaran"]['name'];
      $config['upload_path'] = './uploads/';
      $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx';
      $config['max_size'] = 5000;
      $config['file_name'] = $new_name."_.".pathinfo($_FILES["dok_penawaran"]['name'], PATHINFO_EXTENSION);
      $this->load->library('upload', $config);

      $this->db->where('id_penawaran', $id_pnwr);
      $xda = $this->db->get('tr_penawaran')->result();
      if ($xda[0]->dokumen != null) {
        unlink('./uploads/'.$xda[0]->dokumen);
        if (!$this->upload->do_upload('dok_penawaran')) {
          $error = array('error' => $this->upload->display_errors());
          $this->template->load('layout/template', 'surat_pks/pks/V_pks', $error);
        } else {
          $dk_pnwr = [ 'dokumen' => $new_name."_.".pathinfo($_FILES["dok_penawaran"]['name'], PATHINFO_EXTENSION) ];
          $this->db->update('tr_penawaran', $dk_pnwr, array('id_penawaran' => $id_pnwr));
        }
      }

      $nm_bpr   = $this->input->post('nama_bpr');
      $nmr_spk  = $this->input->post('nama_bpr');

      $komiage = $this->input->post('komiage');
      $fepepo  = $this->input->post('fepepo');
      $overid  = $this->input->post('overid');
      $konebro = $this->input->post('konebro');
      $judeso  = $this->input->post('judeso');
      $nefebro = $this->input->post('nefebro');

      $socid    = $this->input->post('socid');
      $soc      = $this->input->post('soc');
      $no_pks   = $this->input->post('no_pks');

      $datax = [
        'soc'               => $soc,
        'komisi_agent'      => str_replace('%','',$komiage),
        'feebase'           => str_replace('%','',$fepepo),
        'overiding'         => str_replace('%','',$overid),
        'komisi_net_broker' => str_replace('%','',$konebro),
        'net_fee_broker'    => $nefebro,
        'jumlah_detail_soc' => str_replace('%','',$judeso),
        'id_bpr'            => $nm_bpr,
        'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta'))
      ];

      $this->db->update('tr_soc', $datax, array('id_soc' => $socid));
      // $idx = $this->db->insert_id();

      $datay = [
        'nomor_pks'     => $no_pks,
        'id_soc'        => $socid,
        'id_penawaran'  => $id_pnwr,
        'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
      ];
      $this->db->update('tr_pks', $datay, array('id_pks' => $value));
      // $this->db->insert('tr_pks', $datay);

      echo json_encode(['status' => TRUE]);
    }

    public function hapus_pks()
    {
      $id_pks = $this->input->post('id_pks');
      
      $this->db->where('id_pks', $id_pks);
      $data = $this->db->get('tr_pks')->row();

      $datazz = ['dokumen' => ''];
      $this->db->update('tr_penawaran', $datazz, array('id_penawaran' => $data->id_penawaran));

      $this->db->delete('tr_pks', array('id_pks' => $data->id_pks));
      $this->db->delete('tr_soc', array('id_soc' => $data->id_soc));

      echo json_encode(['status' => TRUE]);
    }

}

/* End of file C_pks.php */
