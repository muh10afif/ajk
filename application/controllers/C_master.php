<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_master extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_master'));   
        $this->cek_login_lib->logged_in_false();
    }

    public function index()
    {
        $this->negara;
    }
    
    // 24-04-2020

        // menampilkan halaman negara 
        public function negara()
        {
            $data = ['menu' => 'Master Wilayah',
                     'page' => 'Negara'
                    ];
        
            $this->template->load('layout/template', 'master/wilayah/V_negara', $data);
        }

    // 29-04-2020
    
        // menampilkan list negara 
        public function tampil_data_negara()
        {
            $list = $this->M_master->get_data_negara();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nama_negara'];
                $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit-negara' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_negara']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus-negara' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_negara']."' nama='".$o['nama_negara']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_negara(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_negara(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // aksi proses simpan data negara
        public function simpan_data_negara()
        {
            $aksi          = $this->input->post('aksi');
            $id_negara     = $this->input->post('id_negara');
            $negara        = $this->input->post('nama_negara');

            $data = ['nama_negara'  => $negara,
                        'add_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_negara', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_negara', $data, array('id_negara' => $id_negara));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_negara', array('id_negara' => $id_negara));
            }

            echo json_encode($aksi);
        }

        // ambil data negara
        public function ambil_data_negara($id_negara)
        {
            $data = $this->M_master->cari_data('m_negara', array("id_negara" => $id_negara))->row_array();

            echo json_encode($data);
        }

    // 24-04-2020

        // menapilkan halaman provinsi
        public function provinsi()
        {
            $data = ['menu'     => 'Master Wilayah',
                     'page'     => 'Provinsi',
                     'negara'   => $this->M_master->get_data_order('m_negara', 'nama_negara', 'asc')->result_array()
                    ];
        
            $this->template->load('layout/template', 'master/wilayah/V_provinsi', $data);
        }

        // menampilkan list provinsi 
        public function tampil_data_provinsi()
        {
            $list = $this->M_master->get_data_provinsi();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nama_provinsi'];
                $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit-provinsi' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_provinsi']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus-provinsi' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_provinsi']."' nama='".$o['nama_provinsi']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_provinsi(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_provinsi(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // aksi proses simpan data provinsi
        public function simpan_data_provinsi()
        {
            $aksi           = $this->input->post('aksi');
            $id_negara      = $this->input->post('id_negara');
            $id_provinsi    = $this->input->post('id_provinsi');
            $provinsi       = $this->input->post('nama_provinsi');

            $data = ['nama_provinsi'    => $provinsi,
                     'id_negara'        => $id_negara,
                     'add_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_provinsi', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_provinsi', $data, array('id_provinsi' => $id_provinsi));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_provinsi', array('id_provinsi' => $id_provinsi));
            }

            echo json_encode($aksi);
        }

        // ambil data provinsi
        public function ambil_data_provinsi($id_provinsi)
        {
            $data = $this->M_master->cari_data('m_provinsi', array("id_provinsi" => $id_provinsi))->row_array();

            echo json_encode($data);
        }

    // 24-04-2020

        // menapilkan halaman kota/kabupaten
        public function kota_kabupaten()
        {
            $data = ['menu'     => 'Master Wilayah',
                     'page'     => 'Kota/Kabupaten',
                     'provinsi' => $this->M_master->get_data_order('m_provinsi', 'nama_provinsi', 'desc')->result_array()
                    ];
        
            $this->template->load('layout/template', 'master/wilayah/V_kota_kabupaten', $data);
        }

        // menampilkan list kota_kab 
        public function tampil_data_kota_kab()
        {
            $list = $this->M_master->get_data_kota_kab();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nama_provinsi'];
                $tbody[]    = $o['nama_kota_kab'];
                $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit-kota-kab' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_kota_kab']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus-kota-kab' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_kota_kab']."' nama='".$o['nama_kota_kab']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_kota_kab(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_kota_kab(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // aksi proses simpan data kota_kab
        public function simpan_data_kota_kab()
        {
            $aksi           = $this->input->post('aksi');
            $id_provinsi    = $this->input->post('provinsi');
            $id_kota_kab    = $this->input->post('id_kota_kab');
            $nama_kota_kab  = $this->input->post('nama_kota_kab');

            $data = ['nama_kota_kab'    => $nama_kota_kab,
                     'id_provinsi'      => $id_provinsi,
                     'add_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_kota_kab', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_kota_kab', $data, array('id_kota_kab' => $id_kota_kab));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_kota_kab', array('id_kota_kab' => $id_kota_kab));
            }

            echo json_encode($aksi);
        }

        // ambil data kota_kab
        public function ambil_data_kota_kab($id_kota_kab)
        {
            $data = $this->M_master->cari_data('m_kota_kab', array("id_kota_kab" => $id_kota_kab))->row_array();

            echo json_encode($data);
        }

    // 24-04-2020

        // menapilkan halaman kecamatan
        public function kecamatan()
        {
            $data = ['menu'     => 'Master Wilayah',
                     'page'     => 'Kecamatan',
                     'provinsi' => $this->M_master->get_data_order('m_provinsi', 'nama_provinsi', 'desc')->result_array()
                    ];
        
            $this->template->load('layout/template', 'master/wilayah/V_kecamatan', $data);
        }

        // mengambil list option kota/kab
        public function ambil_option_kota_kab()
        {
            $id_provinsi = $this->input->post('id_provinsi');
            $id_kota_kab = $this->input->post('id_kota_kab');

            if ($id_provinsi != null) {
                $list = $this->M_master->cari_data('m_kota_kab', array('id_provinsi' => $id_provinsi))->result_array();

                $option = "";

                foreach ($list as $a) {

                    if ($a['id_kota_kab'] == $id_kota_kab) {
                        $sel = 'selected';
                    } else {
                        $sel = '';
                    }

                    $option .= "<option value='".$a['id_kota_kab']."' ".$sel.">".$a['nama_kota_kab']."</option>";
                }
            } else {
                $option = "";
            }
            
            echo json_encode(['kab_kota' => $option]);
        }

        // menampilkan list kecamatan 
        public function tampil_data_kecamatan()
        {
            $list = $this->M_master->get_data_kecamatan();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nama_provinsi'];
                $tbody[]    = $o['nama_kota_kab'];
                $tbody[]    = $o['nama_kecamatan'];
                $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit-kecamatan' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_kecamatan']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus-kecamatan' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_kecamatan']."' nama='".$o['nama_kecamatan']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_kecamatan(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_kecamatan(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // aksi proses simpan data kecamatan
        public function simpan_data_kecamatan()
        {
            $aksi           = $this->input->post('aksi');
            $id_kecamatan   = $this->input->post('id_kecamatan');
            $id_kota_kab    = $this->input->post('kota_kab');
            $nama_kecamatan = $this->input->post('kecamatan');

            $data = ['nama_kecamatan'   => $nama_kecamatan,
                     'id_kota_kab'      => $id_kota_kab,
                     'add_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_kecamatan', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_kecamatan', $data, array('id_kecamatan' => $id_kecamatan));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_kecamatan', array('id_kecamatan' => $id_kecamatan));
            }

            echo json_encode($aksi);
        }

        // ambil data kecamatan
        public function ambil_data_kecamatan($id_kecamatan)
        {
            $data = $this->M_master->cari_data('m_kecamatan', array("id_kecamatan" => $id_kecamatan))->row_array();

            // cari id_provinsi
            $cari = $this->M_master->cari_data('m_kota_kab', array('id_kota_kab' => $data['id_kota_kab']))->row_array();

            array_push($data, array('id_provinsi' => $cari['id_provinsi']));

            echo json_encode($data);
        }

    // 24-04-2020

        // menampilkan halaman jenis kredit
        public function jenis_kredit()
        {
            $data = ['menu' => 'Master Asuransi',
                     'page' => 'Jenis kredit'
                    ];
        
            $this->template->load('layout/template', 'master/asuransi/V_jenis_kredit', $data);
        }

    // 30-04-2020
    
        // menampilkan list jenis_kredit 
        public function tampil_data_jenis_kredit()
        {
            $list = $this->M_master->get_data_jenis_kredit();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['jenis_kredit'];
                $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit-jenis_kredit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_jenis_kredit']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus-jenis_kredit' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_jenis_kredit']."' nama='".$o['jenis_kredit']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_jenis_kredit(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_jenis_kredit(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // aksi proses simpan data jenis_kredit
        public function simpan_data_jenis_kredit()
        {
            $aksi               = $this->input->post('aksi');
            $id_jenis_kredit    = $this->input->post('id_jenis_kredit');
            $jenis_kredit       = $this->input->post('nama_jenis_kredit');

            $data = ['jenis_kredit' => $jenis_kredit,
                     'add_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_jenis_kredit', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_jenis_kredit', $data, array('id_jenis_kredit' => $id_jenis_kredit));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_jenis_kredit', array('id_jenis_kredit' => $id_jenis_kredit));
            }

            echo json_encode($aksi);
        }

        // ambil data jenis_kredit
        public function ambil_data_jenis_kredit($id_jenis_kredit)
        {
            $data = $this->M_master->cari_data('m_jenis_kredit', array("id_jenis_kredit" => $id_jenis_kredit))->row_array();

            echo json_encode($data);
        }

    // 24-04-2020

        // menampilkan halaman jenis pertanggungan
        public function jenis_pertanggungan()
        {
            $data = ['menu' => 'Master Asuransi',
                     'page' => 'Jenis Pertanggungan'
                    ];
        
            $this->template->load('layout/template', 'master/asuransi/V_jenis_pertanggungan', $data);
        }

    // 30-04-2020
    
        // menampilkan list jenis_tanggung 
        public function tampil_data_jenis_tanggung()
        {
            $list = $this->M_master->get_data_jenis_tanggung();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['jenis_tanggung'];
                $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit-jenis_tanggung' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_jenis_tanggung']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus-jenis_tanggung' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_jenis_tanggung']."' nama='".$o['jenis_tanggung']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_jenis_tanggung(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_jenis_tanggung(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // aksi proses simpan data jenis_tanggung
        public function simpan_data_jenis_tanggung()
        {
            $aksi               = $this->input->post('aksi');
            $id_jenis_tanggung    = $this->input->post('id_jenis_tanggung');
            $jenis_tanggung       = $this->input->post('nama_jenis_tanggung');

            $data = ['jenis_tanggung'   => $jenis_tanggung,
                     'add_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_jenis_tanggung', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_jenis_tanggung', $data, array('id_jenis_tanggung' => $id_jenis_tanggung));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_jenis_tanggung', array('id_jenis_tanggung' => $id_jenis_tanggung));
            }

            echo json_encode($aksi);
        }

        // ambil data jenis_tanggung
        public function ambil_data_jenis_tanggung($id_jenis_tanggung)
        {
            $data = $this->M_master->cari_data('m_jenis_tanggung', array("id_jenis_tanggung" => $id_jenis_tanggung))->row_array();

            echo json_encode($data);
        }

    // 04-05-2020

        // menampilkan halaman data spk
        public function spk()
        {
            $data = ['menu' => 'Master',
                     'page' => 'Spk',
                     'bpr'  => $this->M_master->get_data_order('m_bpr', 'nama_bpr', 'asc')->result_array()
                    ];
        
            $this->template->load('layout/template', 'master/V_spk', $data);
        }

        // menampilkan list spk 
        public function tampil_data_spk()
        {
            $list = $this->M_master->get_data_spk();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['no_spk'];
                $tbody[]    = $o['nama_bpr'];
                $tbody[]    = "<div align='center'>".nice_date($o['tgl_mulai'], 'd-M-Y')."</div>";
                $tbody[]    = "<div align='center'>".nice_date($o['tgl_berakhir'], 'd-M-Y')."</div>";
                $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit-spk' data-id='".$o['id_spk']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus-spk' data-id='".$o['id_spk']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_spk(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_spk(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // aksi proses simpan data spk
        public function simpan_data_spk()
        {
            $aksi           = $this->input->post('aksi');
            $id_spk         = $this->input->post('id_spk');
            $id_bpr         = $this->input->post('id_bpr');
            $no_spk         = $this->input->post('no_spk');
            $tgl_mulai      = $this->input->post('tgl_mulai');
            $tgl_berakhir   = $this->input->post('tgl_berakhir');

            $data = ['no_spk'       => $no_spk,
                     'id_bpr'       => $id_bpr,
                     'tgl_mulai'    => $tgl_mulai,
                     'tgl_berakhir' => $tgl_berakhir,
                     'add_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_spk', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_spk', $data, array('id_spk' => $id_spk));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_spk', array('id_spk' => $id_spk));
            }

            echo json_encode($aksi);
        }

        // ambil data spk
        public function ambil_data_spk($id_spk)
        {
            $data = $this->M_master->cari_data('m_spk', array("id_spk" => $id_spk))->row_array();

            $tgl_mulai      = date("d-M-Y", strtotime($data['tgl_mulai']));
            $tgl_berakhir   = date("d-M-Y", strtotime($data['tgl_berakhir']));

            array_push($data, array('tgl_mulai' => $tgl_mulai, 'tgl_berakhir' => $tgl_berakhir));

            echo json_encode($data);
        }

    // 24-04-2020

        // menampilkan halaman data bpr
        public function bpr()
        {
            $data = ['menu' => 'Master',
                     'page' => 'Bpr'
                    ];
        
            $this->template->load('layout/template', 'master/V_bpr', $data);
        }

    // 04-05-2020
        
        // menampilkan list bpr 
        public function tampil_data_bpr()
        {
            $list = $this->M_master->get_data_bpr();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nama_bpr'];
                $tbody[]    = $o['email'];
                $tbody[]    = $o['kontak'];
                $tbody[]    = $o['alamat'];
                // $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-success detail-spk-bpr' data-id='".$o['id_bpr']."'><i class='mdi mdi-information-outline mdi-24px'></i></span><span style='cursor:pointer' title='Edit Bpr' class='mr-3 text-primary edit-bpr' data-id='".$o['id_bpr']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' data-toggle='tooltip' class='text-danger hapus-bpr' data-id='".$o['id_bpr']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $tbody[]    = "<span style='cursor:pointer' title='Edit Bpr' class='mr-3 text-primary edit-bpr' data-id='".$o['id_bpr']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' data-toggle='tooltip' class='text-danger hapus-bpr' data-id='".$o['id_bpr']."' nama='".$o['nama_bpr']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_bpr(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_bpr(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // aksi proses simpan data bpr
        public function simpan_data_bpr()
        {
            $aksi      = $this->input->post('aksi');
            $id_bpr    = $this->input->post('id_bpr');
            $nama_bpr  = $this->input->post('nama_bpr');
            $email     = $this->input->post('email');
            $kontak    = $this->input->post('kontak');
            $alamat    = $this->input->post('alamat');

            $data = ['nama_bpr'     => $nama_bpr,
                     'email'        => $email,
                     'kontak'       => $kontak,
                     'alamat'       => $alamat,
                     'add_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_bpr', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_bpr', $data, array('id_bpr' => $id_bpr));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_bpr', array('id_bpr' => $id_bpr));
            }

            echo json_encode($aksi);
        }

        // ambil data bpr
        public function ambil_data_bpr($id_bpr)
        {
            $data = $this->M_master->cari_data('m_bpr', array("id_bpr" => $id_bpr))->row_array();

            echo json_encode($data);
        }

        // ambil data spk - bpr
        public function ambil_detail_spk()
        {
            $id_bpr = $this->input->post('id_bpr');
            
            $dt = $this->M_master->cari_data('m_spk', array("id_bpr" => $id_bpr))->result_array();

            // cari nama bpr
            $cr = $this->M_master->cari_data('m_bpr', array("id_bpr" => $id_bpr))->row_array();

            $data = ['detail'   => $dt,
                     'nama_bpr' => $cr['nama_bpr']
                    ];

            $this->load->view('master/V_detail_bpr_spk', $data);
            
        }

    // 24-04-2020

        // menampilkan halaman data debitur
        public function debitur()
        {
            $data = ['menu'     => 'Master',
                     'page'     => 'Debitur',
                     'provinsi' => $this->M_master->get_data_order('m_provinsi', 'nama_provinsi', 'desc')->result_array()
                    ];
        
            $this->template->load('layout/template', 'master/V_debitur', $data);
        } 
        
    // 04-05-2020
        
        // menampilkan halaman debitur awal 
        public function tampil_data_debitur_total()
        {
            $list = $this->M_master->get_data_debitur_total();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nomor_pks'];
                $tbody[]    = $o['nama_bpr'];
                $tbody[]    = "<div align='center'>".$o['tot_debitur']."</div>";
                $tbody[]    = "<span style='cursor:pointer' class='text-primary lihat-debitur' data-id='".$o['id_pks']."' id_bpr='".$o['id_bpr']."'><i class='mdi mdi-information-outline mdi-24px'></i></span>";
                $data[]     = $tbody;
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_debitur_total(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_debitur_total(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // ambil data debitur
        public function ambil_data_detail_debitur()
        {
            $id_spk = $this->input->post('id_spk');
            $id_bpr = $this->input->post('id_bpr');

            // cari data
            $cr1 = $this->M_master->cari_data('m_bpr', array('id_bpr' => $id_bpr))->row_array();

            $cr2 = $this->M_master->cari_data('m_spk', array('id_spk' => $id_spk))->row_array();

            $data = ['nama_bpr' => $cr1['nama_bpr'],
                     'no_spk'   => $cr2['no_spk']
                    ];

            echo json_encode($data);
        }

        // menampilkan data debitur
        public function tampil_data_debitur()
        {
            $list = $this->M_master->get_data_debitur();

            $data = array();

            $no   = $this->input->post('start');

            $no =1;
            foreach ($list as $v) {
                $tbody = array();

                $tbody[] = "<div align='center'>".$no++.".</div>";
                $tbody[] = $v['nik'];
                $tbody[] = $v['nama_lengkap'];
                $tbody[] = $v['jenis_kelamin'];
                $tbody[] = $v['tempat_lahir'];
                $tbody[] = "<div align='center'>".nice_date($v['tgl_lahir'], 'd-M-Y')."</div>";
                $tbody[] = $v['kontak'];
                $tbody[] = $v['email'];
                $tbody[] = "<span style='cursor:pointer' class='mr-3 text-success detail-debitur' data-id='".$v['id_debitur']."'><i class='mdi mdi-information-outline mdi-24px'></i></span><span style='cursor:pointer' title='Edit Bpr' class='mr-3 text-primary edit-debitur' data-id='".$v['id_debitur']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' data-toggle='tooltip' class='text-danger hapus-debitur' data-id='".$v['id_debitur']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]  = $tbody; 
            }

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_master->jumlah_semua_debitur(),
                        "recordsFiltered"  => $this->M_master->jumlah_filter_debitur(),   
                        "data"             => $data
                      ];

            echo json_encode($output);
        }

        // menampilkan halaman tamba debitur
        public function halaman_tambah_debitur()
        {
            $id_spk = $this->input->post('id_spk');
            $id_bpr = $this->input->post('id_bpr');

            $list = $this->M_master->cari_data('m_range_bpr', array('id_bpr' => $id_bpr))->result_array();
            
            $option = '';

            foreach ($list as $a) {
                
                $option .= "<option value='".$a['id_range_bpr']."'>Rp. ".number_format($a['range_penghasilan_tahun'],'0',',','.')."</option>";

            }

            // cari data
            $cr1 = $this->M_master->cari_data('m_bpr', array('id_bpr' => $id_bpr))->row_array();

            $cr2 = $this->M_master->cari_data('m_spk', array('id_spk' => $id_spk))->row_array();

            $data = ['nama_bpr'     => $cr1['nama_bpr'],
                     'no_spk'       => $cr2['no_spk'],
                     'list_range'   => $option
                    ];

            echo json_encode($data);
        }

    // 05-05-2020
        // mengambil list option kecamatan
        public function ambil_option_kecamatan()
        {
            $id_kota_kab = $this->input->post('id_kota_kab');

            if ($id_kota_kab != null) {
                $list = $this->M_master->cari_data('m_kecamatan', array('id_kota_kab' => $id_kota_kab))->result_array();

                $option = "";

                foreach ($list as $a) {

                    $option .= "<option value='".$a['id_kecamatan']."'>".$a['nama_kecamatan']."</option>";

                }
            } else {
                $option = "";
            }
            
            echo json_encode(['kecamatan' => $option]);
        }

        // aksi simpan debitur
        public function simpan_data_debitur()
        {
            $aksi           = $this->input->post('aksi');
            $id_debitur     = $this->input->post('id_debitur');

            $data = [

                    'nik'                               => $this->input->post('nik'),
                    'nama_lengkap'                      => $this->input->post('nama_lengkap'),
                    'jenis_kelamin'                     => $this->input->post('jenis_kelamin'),
                    'tempat_lahir'                      => $this->input->post('tempat_lahir'),
                    'tgl_lahir'                         => ($this->input->post('tgl_lahir') == '') ? null : $this->input->post('tgl_lahir'),
                    'jenis_identitas'                   => $this->input->post('jenis_identitas'),
                    'no_identitas'                      => $this->input->post('no_identitas'),
                    'status_nikah'                      => $this->input->post('status_nikah'),
                    'warga_negara'                      => $this->input->post('warga_negara'),
                    'negara_wna'                        => $this->input->post('negara_wna'),
                    'agama'                             => $this->input->post('agama'),
                    'alamat_rumah'                      => $this->input->post('alamat_rumah'),
                    'kode_pos_rumah'                    => $this->input->post('kode_pos_rumah'),
                    'alamat_korespondensi'              => $this->input->post('alamat_korespon'),
                    'kode_pos_korespondensi'            => $this->input->post('kode_pos_korespon'),
                    'kontak'                            => $this->input->post('kontak'),
                    'email'                             => $this->input->post('email'),
                    'pekerjaan'                         => $this->input->post('pekerjaan'),
                    'bagian'                            => $this->input->post('bagian'),
                    'alamat_kantor'                     => $this->input->post('alamat_kantor'),
                    'kode_pos_kantor'                   => $this->input->post('kode_pos_kantor'),
                    'tujuan_beli_asuransi'              => $this->input->post('tujuan_beli_asuransi'),
                    'sumber_dana_pembelian'             => $this->input->post('sumber_dana_beli'),
                    'sumber_dana_pembelian_lainnya'     => $this->input->post('sdb_lainnya'),
                    'pengahasilan_per_tahun'            => $this->input->post('penghasilan_tahun'),
                    'sumber_dana_penghasilan'           => $this->input->post('sumber_dana_penghasilan'),
                    'sumber_dana_penghasilan_lainnya'   => $this->input->post('sdp_lainnya'),
                    'id_spk'                            => $this->input->post('id_spk'),
                    'add_time'                          => date("Y-m-d H:i:s", now('Asia/Jakarta'))

                    ];


            if ($aksi == 'Tambah') {
                $this->M_master->input_data('m_debitur', $data);
            } elseif ($aksi == 'Ubah') {
                $this->M_master->ubah_data('m_debitur', $data, array('id_debitur' => $id_debitur));
            } elseif ($aksi == 'Hapus') {
                $this->M_master->hapus_data('m_debitur', array('id_debitur' => $id_debitur));
            }

            echo json_encode($aksi);
            
        }

        // ambil data jabatan
        public function ambil_data_debitur($id_debitur)
        {
            $data = $this->M_master->cari_data('m_debitur', array("id_debitur" => $id_debitur))->row_array();

            if ($data['tgl_lahir'] != null) {
                $tgl = nice_date($data['tgl_lahir'], 'd-M-Y');
            } else {
                $tgl = '';
            }
            
            array_push($data, array('tgl_lahir' => $tgl));

            echo json_encode($data);
        }

    // 24-04-2020

        // menampilkan halaman data verifikator
        public function verifikator()
        {
            $data = ['menu' => 'Master',
                        'page' => 'Verifikator'
                    ];
        
            $this->template->load('layout/template', 'master/V_verifikator', $data);
        }

    // 02-01-2021
    public function tarif()
    {
        $data = ['menu' => 'Master',
                 'page' => 'Tarif'
                ];
    
        $this->template->load('layout/template', 'master/V_tarif', $data);
    }

    // 02-01-2021
    public function data_asuransi()
    {
        $data = ['menu' => 'Master Asuransi',
                 'page' => 'Data Asuransi'
                ];
    
        $this->template->load('layout/template', 'master/asuransi/V_data_asuransi', $data);
    }    

    // 05-02-2021
    public function tampil_data_asuransi()
    {
        $list = $this->M_master->get_data_asuransi();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_asuransi'];
            $tbody[]    = $o['alamat'];
            $tbody[]    = $o['email'];
            $tbody[]    = $o['no_telepon'];
            $tbody[]    = $o['singkatan'];
            $tbody[]    = "<span style='cursor:pointer' title='Edit' class='mr-3 text-primary edit-asu' data-toggle='tooltip' title='Edit' data-id='".$o['id_asuransi']."' nama_asuransi='".$o['nama_asuransi']."' alamat='".$o['alamat']."' email='".$o['email']."' no_telepon='".$o['no_telepon']."' singkatan='".$o['singkatan']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' data-toggle='tooltip' title='Hapus' class='text-danger hapus-asu' data-id='".$o['id_asuransi']."' nama='".$o['nama_asuransi']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $tbody[]    = "<div><button class='btn btn-primary'>Lihat</button></div>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_asuransi(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_asuransi(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 09-02-2021
    public function simpan_data_asu()
    {
        $aksi      = $this->input->post('aksi');

        $id_asu    = $this->input->post('id_asu');

        $nama_asu  = $this->input->post('nama_asu');
        $email     = $this->input->post('email');
        $kontak    = $this->input->post('kontak');
        $alamat    = $this->input->post('alamat');
        $singkatan = $this->input->post('singkatan');

        $data = ['nama_asuransi'  => $nama_asu,
                 'email'          => $email,
                 'no_telepon'     => $kontak,
                 'alamat'         => $alamat,
                 'singkatan'      => $singkatan,
                 'add_time'       => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_asuransi', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_asuransi', $data, array('id_asuransi' => $id_asu));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_asuransi', array('id_asuransi' => $id_asu));
        }

        echo json_encode($aksi);
    }

    public function dok_underwriting()
    {
        $data = ['menu' => 'Master Asuransi',
                 'page' => 'Dokumen Underwriting'
                ];
    
        $this->template->load('layout/template', 'master/asuransi/V_dokumen_underwriting', $data);
    }

    // 05-02-2021
    public function tampil_dok_udw()
    {
        $list = $this->M_master->get_data_dok_udw();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['jenis_dokumen'];
            $tbody[]    = "<span style='cursor:pointer' title='Edit' class='mr-3 text-primary edit' data-toggle='tooltip' title='Edit' data-id='".$o['id_dok_underwriting']."' jenis_dokumen='".$o['jenis_dokumen']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' data-toggle='tooltip' title='Hapus' class='text-danger hapus' data-id='".$o['id_dok_underwriting']."' jenis_dokumen='".$o['jenis_dokumen']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_dok_udw(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_dok_udw(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data dok_udw
    public function simpan_data_dok_udw()
    {
        $aksi           = $this->input->post('aksi');
        $id_dok_udw     = $this->input->post('id_dok_udw');
        $nama_dok_udw   = $this->input->post('nama_dok_udw');

        $data = ['jenis_dokumen'    => $nama_dok_udw,
                 'add_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        // cari data
        $cr = $this->M_master->cari_data('m_dok_underwriting', ['LOWER(jenis_dokumen)' => strtolower($nama_dok_udw)])->num_rows();

        if ($cr > 0) {
            $status = "ada";
        } else {
            $status = "tidak";
        }

        if ($aksi == 'Tambah') {
            if ($status == "tidak") {
                $this->M_master->input_data('m_dok_underwriting', $data);
            }
        } elseif ($aksi == 'Ubah') {
            if ($status == "tidak") {
                $this->M_master->ubah_data('m_dok_underwriting', $data, array('id_dok_underwriting' => $id_dok_udw));
            }
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_dok_underwriting', array('id_dok_underwriting' => $id_dok_udw));
        }

        echo json_encode(['status' => $status]);
    }

    // 05-02-2021
    public function status_underwriting()
    {
        $data = ['menu' => 'Master Asuransi',
                 'page' => 'Status Underwriting'
                ];
    
        $this->template->load('layout/template', 'master/asuransi/V_status_underwriting', $data);
    }

    // 05-02-2021
    public function tampil_status_udw()
    {
        $list = $this->M_master->get_data_status_udw();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['status_underwriting'];
            $tbody[]    = "<span style='cursor:pointer' title='Edit' class='mr-3 text-primary edit' data-toggle='tooltip' title='Edit' data-id='".$o['id_status_underwriting']."' status='".$o['status_underwriting']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' data-toggle='tooltip' title='Hapus' class='text-danger hapus' data-id='".$o['id_status_underwriting']."' status='".$o['status_underwriting']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $tbody[]    = "<div><button class='btn btn-primary'>Lihat</button></div>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_status_udw(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_status_udw(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data status_udw
    public function simpan_data_status_udw()
    {
        $aksi               = $this->input->post('aksi');
        $id_status_udw      = $this->input->post('id_status_udw');
        $nama_status_udw    = $this->input->post('status_udw');

        $data = ['status_underwriting'  => $nama_status_udw,
                 'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        // cari data
        $cr = $this->M_master->cari_data('m_status_underwriting', ['LOWER(status_underwriting)' => strtolower($nama_status_udw)])->num_rows();

        if ($cr > 0) {
            $status = "ada";
        } else {
            $status = "tidak";
        }

        if ($aksi == 'Tambah') {
            if ($status == "tidak") {
                $this->M_master->input_data('m_status_underwriting', $data);
            }
        } elseif ($aksi == 'Ubah') {
            if ($status == "tidak") {
                $this->M_master->ubah_data('m_status_underwriting', $data, array('id_status_underwriting' => $id_status_udw));
            }
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_status_underwriting', array('id_status_underwriting' => $id_status_udw));
        }

        echo json_encode(['status' => $status]);
    }

    // 21-02-21
    public function jenis_produk()
    {
        $data = ['menu' => 'Master Asuransi',
                 'page' => 'Jenis Produk'
                ];
    
        $this->template->load('layout/template', 'master/asuransi/V_jenis_produk', $data);
    }

    // menampilkan list jenis_produk 
    public function tampil_data_jenis_produk()
    {
        $list = $this->M_master->get_data_jenis_produk();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['jenis_produk'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_jenis_produk']."' jenis_produk='".$o['jenis_produk']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_jenis_produk']."' jenis_produk='".$o['jenis_produk']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_jenis_produk(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_jenis_produk(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data jenis_produk
    public function simpan_data_jenis_produk()
    {
        $aksi               = $this->input->post('aksi');
        $id_jenis_produk    = $this->input->post('id_jenis_produk');
        $jenis_produk       = $this->input->post('nama_jenis_produk');

        $data = ['jenis_produk'     => $jenis_produk,
                 'add_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_jenis_produk', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_jenis_produk', $data, array('id_jenis_produk' => $id_jenis_produk));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_jenis_produk', array('id_jenis_produk' => $id_jenis_produk));
        }

        echo json_encode($aksi);
    }

    // 21-02-21
    public function jenis_resiko()
    {
        $data = ['menu' => 'Master Asuransi',
                 'page' => 'Jenis Resiko'
                ];

        $this->template->load('layout/template', 'master/asuransi/V_jenis_resiko', $data);
    }

    // menampilkan list jenis_resiko 
    public function tampil_data_jenis_resiko()
    {
        $list = $this->M_master->get_data_jenis_resiko();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['tampil_otomatis'] == 1) {
                $sts_tampil = "<span style='font-size:13px;' class='badge badge-primary'>Ya</span>";
            } else {
                $sts_tampil = "<span style='font-size:13px;' class='badge badge-secondary'>Tidak</span>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['jenis_resiko'];
            $tbody[]    = $sts_tampil;
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_jenis_resiko']."' jenis_resiko='".$o['jenis_resiko']."' tampil_otomatis='".$o['tampil_otomatis']."'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='text-danger hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_jenis_resiko']."' jenis_resiko='".$o['jenis_resiko']."'><i class='mdi mdi-delete mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_jenis_resiko(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_jenis_resiko(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // aksi proses simpan data jenis_resiko
    public function simpan_data_jenis_resiko()
    {
        $aksi               = $this->input->post('aksi');
        $id_jenis_resiko    = $this->input->post('id_jenis_resiko');
        $jenis_resiko       = $this->input->post('nama_jenis_resiko');
        $tampil_otomatis    = $this->input->post('tampil_otomatis');

        $data = ['jenis_resiko'     => $jenis_resiko,
                'tampil_otomatis'  => $tampil_otomatis,
                'add_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_jenis_resiko', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_jenis_resiko', $data, array('id_jenis_resiko' => $id_jenis_resiko));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_jenis_resiko', array('id_jenis_resiko' => $id_jenis_resiko));
        }

        echo json_encode($aksi);
    }
}

/* End of file C_master.php */
