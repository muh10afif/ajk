<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pertanggungan extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_tanggungan', 'M_master'));

        $this->id_level     = $this->session->userdata('id_level');
        $this->id_asuransi  = $this->session->userdata('id_asuransi');
        $this->id_bpr       = $this->session->userdata('id_bpr');
    }
    

    // 24-04-2020

        public function index()
        {
            $data = ['menu'         => 'Pertanggungan',
                     'page'         => 'Pertanggungan',
                     'provinsi'     => $this->M_master->get_data_order('m_provinsi', 'nama_provinsi', 'desc')->result_array(),
                     'jns_kredit'   => $this->M_master->get_data_order('m_jenis_kredit', 'jenis_kredit', 'asc')->result_array(),
                     'jenis_resiko' => $this->M_master->get_data_order('m_jenis_resiko', 'jenis_resiko', 'asc')->result_array(),
                     'jns_tanggung' => $this->M_master->get_data_order('m_jenis_tanggung', 'jenis_tanggung', 'asc')->result_array(),
                     'jenis_produk'  => $this->M_master->get_data_order('m_jenis_produk', 'jenis_produk', 'asc')->result_array()
                    ];
        
            $this->template->load('layout/template', 'pertanggungan/V_pertanggungan', $data);
        }

        // menampilkan data dokumen
        public function tampil_dok_syarat()
        {
            echo json_encode(['data' => 0]);
        }

    public function random()
    {
        $a  = strtoupper(bin2hex(random_bytes(2)));

        $dt = date("dmy", now('Asia/Jakarta'));

        echo "TTG$dt$a";
    }

    // 06-05-2020
        
        // menampilkan halaman data pertanggungan awal 
        public function tampil_data_awal_tertanggung()
        {
            $list = $this->M_tanggungan->get_data_tertanggung_total();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $this->db->select('p.id_pertanggungan, p.kode_tertanggung');
                $this->db->from('pertanggungan as p');
                $this->db->join('m_debitur as d', 'id_debitur', 'inner');
                $this->db->where('d.id_pks', $o['id_pks']);
                if ($this->id_level == 4) {
                    $this->db->where('p.forward_asuransi', 1);  
                }

                $a = $this->db->get()->result_array();

                $lod = '<button class="btn" style="background-color: #eb5905; color:white;" id="lod_'.$o['id_pks'].'" type="button" disabled hidden><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>';

                $form = "<form method='POST' action='".base_url("C_pertanggungan/lihat_debitur_ptg")."'> <input type='hidden' name='id_pks' value='".$o['id_pks']."'> <input type='hidden' name='id_bpr' value='".$o['id_bpr']."'> <input type='hidden' name='nomor_pks' value='".$o['nomor_pks']."'> <input type='hidden' name='nama_bpr' value='".$o['nama_bpr']."'> <button type='submit' class='btn lihat-debitur1' style='background-color: #02a4af; color:white;'>Lihat Debitur</button></form>";

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nomor_pks'];
                $tbody[]    = $o['nama_bpr'];
                $tbody[]    = "<div align='center'>".count($a)."</div>";
                $tbody[]    = $form;
                // $tbody[]    = "<a href='".base_url("C_pertanggungan/lihat_debitur_ptg/".$o['id_pks']."/".$o['id_bpr'])."'><button class='btn lihat-debitur1' id='lih_".$o['id_pks']."' style='background-color: #02a4af; color:white;' data-id='".$o['id_pks']."' id_bpr='".$o['id_bpr']."' nomor_pks='".$o['nomor_pks']."' nama_bpr='".$o['nama_bpr']."'>Lihat Debitur</button></a>";
                $data[]     = $tbody;
            }

            
            $array = array(
                'status' => 'awal'
            );
            
            $this->session->set_userdata( $array );
            

            $output = [ "draw"             => $_POST['draw'],
                        "recordsTotal"     => $this->M_tanggungan->jumlah_semua_tertanggung_total(),
                        "recordsFiltered"  => $this->M_tanggungan->jumlah_filter_tertanggung_total(),   
                        "data"             => $data
                    ];

            echo json_encode($output);
        }

        // 03-02-2021
        public function lihat_debitur_ptg()
        {
            $st         = $this->session->userdata('status');
            $id_pks     = $this->session->userdata('id_pks');
            $id_bpr     = $this->session->userdata('id_bpr');
            $nomor_pks  = $this->session->userdata('nomor_pks');
            $nama_bpr   = $this->session->userdata('nama_bpr');

            if ($st == 'hasil') {

                $id_pks     = $id_pks;
                $id_bpr     = $id_bpr;
                $nomor_pks  = $nomor_pks;
                $nama_bpr   = $nama_bpr;   

            } else {

                $id_pks     = $this->input->post('id_pks');
                $id_bpr     = $this->input->post('id_bpr');
                $nomor_pks  = $this->input->post('nomor_pks');
                $nama_bpr   = $this->input->post('nama_bpr');

                $sess_f = [ 'id_pks'    => $id_pks,
                            'id_bpr'    => $id_bpr,
                            'nomor_pks' => $nomor_pks,
                            'nama_bpr'  => $nama_bpr
                          ];

                $this->session->set_userdata($sess_f);

            }
            
            $data = [   'menu'      => 'Pertanggungan',
                        'page'      => 'Lihat Debitur PTG',
                        'id_pks'    => $id_pks,
                        'id_bpr'    => $id_bpr,
                        'nomor_pks' => $nomor_pks,
                        'nama_bpr'  => $nama_bpr
                    ];
            
            $this->template->load('layout/template', 'pertanggungan/V_detail_deb', $data);
        }

        // 03-02-2021
        public function tambah_data_ptg()
        {
            $id_pks     = $this->input->post('id_pks');
            $id_bpr     = $this->input->post('id_bpr');
            $nomor_pks  = $this->input->post('nomor_pks');
            $nama_bpr   = $this->input->post('nama_bpr');

            // cari id asuransi
            $cr = $this->M_tanggungan->cari_id_asuransi($id_pks)->row_array();

            $id_asuransi = $cr['id_asuransi'];

            // jenis tanggung
            $jml = $this->M_tanggungan->cari_jenis_tanggung($id_asuransi);

            $jml_jt = count($jml->result_array());

            if ($jml_jt > 1) {
                $arr_jt = $jml->result_array();    
            } else {
                $arr_jt = $jml->row_array();
            }
            
            $data = [   'menu'          => 'Pertanggungan',
                        'page'          => 'Tambah PTG',
                        'id_pks'        => $id_pks,
                        'id_bpr'        => $id_bpr,
                        'nomor_pks'     => $nomor_pks,
                        'nama_bpr'      => $nama_bpr,
                        'id_asuransi'   => $id_asuransi,
                        'provinsi'     => $this->M_master->get_data_order('m_provinsi', 'nama_provinsi', 'desc')->result_array(),
                        'jns_kredit'    => $this->M_master->get_data_order('m_jenis_kredit', 'jenis_kredit', 'asc')->result_array(),
                        'jenis_produk'  => $this->M_tanggungan->cari_jenis_produk($id_asuransi)->result_array(),
                        'jenis_tanggung'=> $arr_jt,
                        'jml_jenis_jt'  => $jml_jt,
                        'jenis_resiko'  => $this->M_tanggungan->cari_jenis_resiko($id_asuransi)->result_array(),
                        'jenis_resiko_1'=> $this->M_tanggungan->cari_jenis_resiko_nol($id_asuransi)->result_array(),
                        'jns_tanggung'  => $this->M_master->get_data_order('m_jenis_tanggung', 'jenis_tanggung', 'asc')->result_array(),
                        'debitur'       => $this->M_master->cari_data_order('m_debitur', ['id_pks' => $id_pks], 'nama_lengkap', 'asc')->result_array()
                    ];
            
            $this->template->load('layout/template', 'pertanggungan/V_tambah_ptg', $data);
        }

        // 01-04-2021
        public function ambil_jenis_ptg()
        {
            $id_asuransi     = $this->input->post('id_asuransi');
            $id_jenis_produk = $this->input->post('id_jenis_produk');
            
            $jml = $this->M_tanggungan->cari_jenis_tanggung_2($id_asuransi, $id_jenis_produk);

            $jml_jt = count($jml->result_array());

            if ($jml_jt > 1) {
                $arr_jt = $jml->result_array();    
            } else {
                $arr_jt = $jml->row_array();
            }

            $nm = $arr_jt['jenis_tanggung'];

            echo json_encode(['jenis_ptg' => $nm]);
        }

        // menampilkan halaman detail debitur
        public function halaman_detail_debitur()
        {
            $id_spk = $this->input->post('id_spk');
            $id_bpr = $this->input->post('id_bpr');

            // cari data
            $cr1 = $this->M_master->cari_data('m_bpr', array('id_bpr' => $id_bpr))->row_array();

            $cr2 = $this->M_master->cari_data('m_spk', array('id_spk' => $id_spk))->row_array();

            // list debitur menurut spk yg blm ada
            $deb = $this->M_tanggungan->get_debitur_tanggungan($id_spk,$id_bpr)->result_array();

            // cari id asuransi
            $as = $this->M_tanggungan->cari_data_asuransi($id_spk)->row_array();

            $option = '';

            foreach ($deb as $l) {
                $option .= "<option value='".$l['id_debitur']."'>".$l['nama_lengkap']."</option>";
            }

            $data = ['nama_bpr'     => $cr1['nama_bpr'],
                     'no_spk'       => $cr2['no_spk'],
                     'debitur'      => $option,
                     'id_asuransi'  => $as['id_asuransi']
                    ];

            echo json_encode($data);
        }

        // menampilkan data debitur
        public function tampil_data_debitur()
        {
            $list = $this->M_tanggungan->get_data_debitur();

            $data = array();

            $no   = $this->input->post('start');

            $tot_up = 0;
            $no =1;
            foreach ($list as $v) {
                $tbody = array();

                if ($v['status_lengkap_dokumen'] == 'Lengkap' || $v['id_status_lengkap_dokumen'] == 5) {
                    $e = "badge-primary";
                } elseif ($v['status_lengkap_dokumen'] == '-') {
                    $e = "badge-light";
                } else {
                    $e = "badge-danger";
                }

                if ($v['validasi_dokumen'] == 1 && $v['status_lengkap_dokumen'] == 'Lengkap' && $v['id_status_tertanggung'] == 1) {
                    $hd = "";
                } else {
                    $hd = "hidden";
                }

                if ($v['forward_asuransi'] == 1) {
                    $fwd    = "<span style='font-size:13px;' class='badge badge-primary font-weight-bold mr-2'>Telah Dikirm</span>";
                    $l_fwd  = "<span style='cursor:pointer' class='mr-1 text-danger forward-asuransi' data-id='".$v['id_pertanggungan']."' isi='0' data-toggle='tooltip' title='Batal Forward Asuransi' $hd><i class='mdi mdi-file-restore mdi-24px'></i></span>";
                } else {
                    $fwd = "<span style='font-size:13px;' class='badge badge-light font-weight-bold'><i class='mdi mdi-minus'></i></span>";
                    $l_fwd  = "<span style='cursor:pointer' class='mr-1 text-primary forward-asuransi' data-id='".$v['id_pertanggungan']."' isi='1' data-toggle='tooltip' title='Forward Asuransi' $hd><i class='mdi mdi-file-send mdi-24px'></i></span>";
                }

                // $ic = $v['status_polish'];

                // if ($v['status_polish'] == 'Terbit') {
                //     $bdg = "badge-primary";
                // } else if ($v['status_polish'] == 'Tolak') {
                //     $bdg = "badge-danger";
                // } else if ($v['status_polish'] == 'Dokumen Tambahan') {
                //     $bdg = "badge-warning text-white";
                // } else if ($v['status_polish'] == null) {
                //     $bdg = "badge-light";
                //     $ic  = "<i class='mdi mdi-minus'></i>";
                // }

                if ($v['validasi_dokumen'] == 1) {
                    $vl = "<span style='font-size:14px; cursor:pointer' class='badge badge-success text-white mr-2 dokumen' data-id='".$v['id_pertanggungan']."'>Valid</span>";
                } else {
                    $vl = '';
                }

                if ($v['id_status_tertanggung'] == 1) {
                    $st_t = "<span style='font-size:14px;' class='badge badge-success text-white'>".ucwords($v['status_tertanggung'])."</span>";
                } else {
                    $st_t = "<span style='font-size:14px;' class='badge badge-danger text-white'>".ucwords($v['status_tertanggung'])."</span>";
                }

                $tbody[] = "<div align='center'>".$no++.".</div>";
                $tbody[] = $v['kode_tertanggung'];
                $tbody[] = $v['nama_lengkap'];
                $tbody[] = "<div align='right'>".number_format($v['total_uang_ptg'],0,'.','.')."</div>";
                // $tbody[] = "<span style='font-size:13px; cursor:pointer' class='badge $bdg font-weight-bold'>".$ic."</span>";
                $tbody[] = $st_t;
                $tbody[] = $fwd;
                // $tbody[] = $v['jenis_produk'];
                // $tbody[] = $v['jenis_tanggung'];
                // $tbody[] = $v['jenis_resiko'];
                $tbody[] = "<span style='font-size:14px; cursor:pointer' class='badge $e mr-1 dokumen'  data-id='".$v['id_pertanggungan']."'>".$v['status_lengkap_dokumen']."</span> $vl";
                $tbody[] = "$l_fwd <a href='".base_url()."C_pertanggungan/detail_ptg/".$v['id_pertanggungan']."' class='mr-1 text-warning'> <span data-toggle='tooltip' title='Detail'><i class='mdi mdi-information-outline mdi-24px'></i></span></a><a href='".base_url()."C_pertanggungan/edit_ptg/".$v['id_pertanggungan']."'  class='mr-1 text-primary edit-tanggungan' data-id='".$v['id_pertanggungan']."' data-toggle='tooltip' title='Edit'><i class='mdi mdi-pencil mdi-24px'></i></a><span style='cursor:pointer' data-toggle='tooltip' class='text-danger hapus-tanggungan' data-id='".$v['id_pertanggungan']."' kode_tertanggung='".$v['kode_tertanggung']."' data-toggle='tooltip' title='Hapus'><i class='mdi mdi-delete mdi-24px'></i></span>";
                $data[]  = $tbody; 

                $tot_up += $v['total_uang_ptg'];
            }

            $output = [ "draw"                  => $_POST['draw'],
                        "recordsTotal"          => $this->M_tanggungan->jumlah_semua_debitur(),
                        "recordsFiltered"       => $this->M_tanggungan->jumlah_filter_debitur(),   
                        "data"                  => $data,
                        "total_tertanggung"     => count($list),
                        "total_pertertanggungan"=> "Rp. ".number_format($tot_up,0,'.','.')
                      ];

            echo json_encode($output);
        }

        // 29-03-2021
        public function detail_ptg($id_ptg)
        {
            $cr = $this->M_tanggungan->cari_data_ptg($id_ptg)->row_array();

            $kd = $cr['kode_tertanggung'];

            $dt = $this->M_tanggungan->cari_pks_bpr($kd)->row_array();

            // cari kode
            $ck = $this->M_tanggungan->cari_resiko_ptg($kd)->row_array();

            // nama projek
            $cr = $this->M_tanggungan->cari_id_asuransi($dt['id_pks'])->row_array();
            $nm_asuransi = $cr['nama_asuransi'];
            
            $data = [   'menu'          => 'Pertanggungan',
                        'page'          => 'Detail PTG',
                        'id_data_ptg'   => $id_ptg,
                        'ptg'           => $cr,
                        'kd_ptg'        => $kd,
                        'jenis_ptg'     => $this->M_tanggungan->cari_jenis_ptg($kd)->result_array(),
                        'jenis_resiko'  => $this->M_tanggungan->cari_jenis_resiko_2($kd)->result_array(),
                        'nomor_pks'     => $dt['nomor_pks'],
                        'nama_bpr'      => $dt['nama_bpr'],
                        'id_pks'        => $dt['id_pks'],
                        'id_bpr'        => $dt['id_bpr'],
                        'ptg'           => $this->M_tanggungan->detail_data_ptg($id_ptg)->row_array(),
                        'crp'           => $ck,
                        'nm_asuransi'   => $nm_asuransi,
                        'dokumen_ptg'   => $this->M_master->cari_data('dokumen', ['id_pertanggungan' => $id_ptg])->result_array()
                    ];
            
            $this->template->load('layout/template', 'pertanggungan/V_detail_ptg', $data);
        }

        // 30-03-2021
        public function edit_ptg($id_ptg)
        {
            $cr = $this->M_tanggungan->cari_data_ptg($id_ptg)->row_array();

            $kd         = $cr['kode_tertanggung'];
            $id_debitur = $cr['id_debitur'];

            $dt = $this->M_tanggungan->cari_pks_bpr($kd)->row_array();

            // cari kode
            $ck = $this->M_tanggungan->cari_resiko_ptg($kd)->row_array();

            // nama projek
            $cr = $this->M_tanggungan->cari_id_asuransi($dt['id_pks'])->row_array();
            $nm_asuransi = $cr['nama_asuransi'];
            $id_asuransi = $cr['id_asuransi'];

            $jml = $this->M_tanggungan->cari_jenis_tanggung($id_asuransi);

            $jml_jt = count($jml->result_array());

            if ($jml_jt > 1) {
                $arr_jt = $jml->result_array();    
            } else {
                $arr_jt = $jml->row_array();
            }
            
            $data = [   'menu'          => 'Pertanggungan',
                        'page'          => 'Edit PTG',
                        'id_data_ptg'   => $id_ptg,
                        'ptg'           => $cr,
                        'kd_ptg'        => $kd,
                        'jenis_ptg'     => $this->M_tanggungan->cari_jenis_ptg($kd)->result_array(),
                        'jenis_resiko'  => $this->M_tanggungan->cari_jenis_resiko_2($kd)->result_array(),
                        'nomor_pks'     => $dt['nomor_pks'],
                        'nama_bpr'      => $dt['nama_bpr'],
                        'id_pks'        => $dt['id_pks'],
                        'id_bpr'        => $dt['id_bpr'],
                        'ptg'           => $this->M_tanggungan->detail_data_ptg($id_ptg)->row_array(),
                        'crp'           => $ck,
                        'nm_asuransi'   => $nm_asuransi,
                        'id_asuransi'   => $id_asuransi,
                        'deb'           => $this->M_tanggungan->detail_debitur($id_debitur)->row_array(),
                        'dokumen_ptg'   => $this->M_master->cari_data('dokumen', ['id_pertanggungan' => $id_ptg])->result_array(),
                        'provinsi'     => $this->M_master->get_data_order('m_provinsi', 'nama_provinsi', 'desc')->result_array(),
                        'jns_kredit'    => $this->M_master->get_data_order('m_jenis_kredit', 'jenis_kredit', 'asc')->result_array(),
                        'jenis_produk'  => $this->M_tanggungan->cari_jenis_produk($id_asuransi)->result_array(),
                        'jenis_tanggung'=> $arr_jt,
                        'jml_jenis_jt'  => $jml_jt,
                        'jenis_resiko'  => $this->M_tanggungan->cari_jenis_resiko($id_asuransi)->result_array(),
                        'jenis_resiko_1'=> $this->M_tanggungan->cari_jenis_resiko_nol($id_asuransi)->result_array(),
                        'jns_tanggung'  => $this->M_master->get_data_order('m_jenis_tanggung', 'jenis_tanggung', 'asc')->result_array(),
                        'debitur'       => $this->M_master->cari_data_order('m_debitur', ['id_pks' => $dt['id_pks']], 'nama_lengkap', 'asc')->result_array()
                    ];

            $this->template->load('layout/template', 'pertanggungan/V_edit_ptg', $data);
        }

        // 30-03-2021
        public function simpan_edit_ptg()
        {
            $aksi_tambah_debitur                = $this->input->post('aksi_tambah_debitur');
            $id_data_per                        = $this->input->post('id_ptg');
            $kd_ptg                             = $this->input->post('kd_ptg');
            $id_debitur                         = $this->input->post('id_debitur');
            $id_asuransi                        = $this->input->post('id_asuransi');

            $nik                                = $this->input->post('nik');
            $nama_lengkap                       = $this->input->post('nama_lengkap');
            $jenis_kelamin                      = $this->input->post('jenis_kelamin');
            $tempat_lahir                       = $this->input->post('tempat_lahir');
            $tgl_lahir                          = ($this->input->post('tgl_lahir') == '') ? null : $this->input->post('tgl_lahir');
            $jenis_identitas                    = $this->input->post('jenis_identitas');
            $no_identitas                       = $this->input->post('no_identitas');
            $status_nikah                       = $this->input->post('status_nikah');
            $warga_negara                       = $this->input->post('warga_negara');
            $negara_wna                         = $this->input->post('negara_wna');
            $agama                              = $this->input->post('agama');
            $alamat_rumah                       = $this->input->post('alamat_rumah');
            $kode_pos_rumah                     = $this->input->post('kode_pos_rumah');
            $alamat_korespondensi               = $this->input->post('alamat_korespon');
            $kode_pos_korespondensi             = $this->input->post('kode_pos_korespon');
            $kontak                             = $this->input->post('kontak');
            $email                              = $this->input->post('email');
            $pekerjaan                          = $this->input->post('pekerjaan');
            $bagian                             = $this->input->post('bagian');
            $alamat_kantor                      = $this->input->post('alamat_kantor');
            $kode_pos_kantor                    = $this->input->post('kode_pos_kantor');
            $tujuan_beli_asuransi               = $this->input->post('tujuan_beli_asuransi');
            $sumber_dana_pembelian              = $this->input->post('sumber_dana_beli');
            $sumber_dana_pembelian_lainnya      = $this->input->post('sdb_lainnya');
            $pengahasilan_per_tahun             = $this->input->post('penghasilan_tahun');
            $sumber_dana_penghasilan            = $this->input->post('sumber_dana_penghasilan');
            $sumber_dana_penghasilan_lainnya    = $this->input->post('sdp_lainnya');
            $id_spk                             = $this->input->post('id_pks');
            $add_time                           = date("Y-m-d H:i:s", now('Asia/Jakarta'));

            $sts_ktp                            = $this->input->post('sts_ktp');

            $ty_1                               = $this->input->post('ty_1');
            $ty_2                               = $this->input->post('ty_2');
            $ty_3                               = $this->input->post('ty_3');
            
            if ($aksi_tambah_debitur == 'tambah_debitur') {

                $data   =  ['alamat_korespondensi'              => $alamat_korespondensi,
                            'kode_pos_korespondensi'            => $kode_pos_korespondensi,
                            'kontak'                            => $kontak,
                            'email'                             => $email,
                            'pekerjaan'                         => $pekerjaan,
                            'bagian'                            => $bagian,
                            'alamat_kantor'                     => $alamat_kantor,
                            'kode_pos_kantor'                   => $kode_pos_kantor,
                            'tujuan_beli_asuransi'              => $tujuan_beli_asuransi,
                            'sumber_dana_pembelian'             => $sumber_dana_pembelian,
                            'sumber_dana_pembelian_lainnya'     => $sumber_dana_pembelian_lainnya,
                            'pengahasilan_per_tahun'            => $pengahasilan_per_tahun,
                            'sumber_dana_penghasilan'           => $sumber_dana_penghasilan,
                            'sumber_dana_penghasilan_lainnya'   => $sumber_dana_penghasilan_lainnya,
                            'id_pks'                            => $id_spk,
                            'add_time'                          => $add_time
                        ];

                $data['nik']            = $nik;
                $data['nama_lengkap']   = $nama_lengkap;
                $data['tempat_lahir']   = $tempat_lahir;
                $data['jenis_kelamin']  = $jenis_kelamin;
                $data['tgl_lahir']      = date("Y-m-d", strtotime($tgl_lahir));

                if ($sts_ktp == 'ya') {

                    $data['jenis_identitas']    = $jenis_identitas;
                    $data['no_identitas']       = $no_identitas;
                    $data['status_nikah']       = ($status_nikah == null) ? null : $status_nikah;
                    $data['warga_negara']       = $warga_negara;
                    $data['negara_wna']         = $negara_wna;
                    $data['agama']              = $agama;
                    $data['alamat_rumah']       = $alamat_rumah;
                    $data['kode_pos_rumah']     = $kode_pos_rumah;
                    
                }

                // cari usia
                $awal   = date("Y-m-d", strtotime($tgl_lahir));
                $akhir  = date("Y-m-d", now('Asia/Jakarta'));
                $periode_awal   = new DateTime($awal);
                $periode_akhir  = new DateTime($akhir);
                
                $usia = $periode_akhir->diff($periode_awal);

                $data['usia'] = $usia->y;

                // input ke debitur
                $this->M_master->input_data('m_debitur', $data);
                $id_debitur = $this->db->insert_id();

                $nama_debitur = $nama_lengkap;
                $usia         = $usia->y;
                $nik          = $nik;

            } else {

                $id_debitur = $id_debitur;

                // cari nama debitur
                $cr_nama = $this->M_master->cari_data('m_debitur', ['id_debitur' => $id_debitur])->row_array();

                $nama_debitur = $cr_nama['nama_lengkap'];
                $usia         = $cr_nama['usia'];
                $nik          = $cr_nama['no_identitas'];
                
            }

            // Data Asuransi - Data Kesehatan
            $tinggi_badan                   = $this->input->post('tinggi_badan');
            $berat_badan                    = $this->input->post('berat_badan');
            $tanya_kesehatan_1              = $this->input->post('tanya_kesehatan_1');
            $tanya_kesehatan_2              = $this->input->post('tanya_kesehatan_2');
            $tanya_kesehatan_3              = $this->input->post('tanya_kesehatan_3');
            $tanya_kesehatan_1_sts          = (($this->input->post('ty_1') == 'ya') ? 1 : 0);
            $tanya_kesehatan_2_sts          = (($this->input->post('ty_2') == 'ya') ? 1 : 0);
            $tanya_kesehatan_3_sts          = (($this->input->post('ty_3') == 'ya') ? 1 : 0);
            $tanya_hamil                    = $this->input->post('tanya_hamil');
            $hamil_anak_ke                  = $this->input->post('hamil_anak_ke');
            $add_time                       = date("Y-m-d H:i:s", now('Asia/Jakarta'));

            $data_per   = [ 
                            'id_debitur'                    => $id_debitur,
                            'tinggi_badan'                  => ($tinggi_badan == '') ? null : $tinggi_badan,
                            'berat_badan'                   => ($berat_badan == '') ? null : $berat_badan,
                            'tanya_kesehatan_1'             => ($tanya_kesehatan_1 == '') ? null : $tanya_kesehatan_1,
                            'tanya_kesehatan_2'             => ($tanya_kesehatan_2 == '') ? null : $tanya_kesehatan_2,
                            'tanya_kesehatan_3'             => ($tanya_kesehatan_3 == '') ? null : $tanya_kesehatan_3,
                            'tanya_kesehatan_1_sts'         => $tanya_kesehatan_1_sts,
                            'tanya_kesehatan_2_sts'         => $tanya_kesehatan_2_sts,
                            'tanya_kesehatan_3_sts'         => $tanya_kesehatan_3_sts,
                            'tanya_hamil'                   => $tanya_hamil,
                            'hamil_anak_ke'                 => ($hamil_anak_ke == '') ? null : $hamil_anak_ke,
                            'edit_time'                     => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                        ];

            // kondisi ada penyakit
            if ($ty_1 == 'ya' || $ty_2 == 'ya' || $ty_3 == 'ya') {
                $data_per['id_status_tertanggung'] = 2;
            } else {
                $data_per['id_status_tertanggung'] = 1;
            }
        
            // ubah data pertanggungan
            $this->M_master->ubah_data('pertanggungan', $data_per, ['id_pertanggungan' => $id_data_per]);

            $jenis_resiko   = $this->input->post('jenis_resiko');
            $jenis_ptg      = $this->input->post('jenis_ptg');

            $cari_d = $this->M_master->cari_data('m_jenis_resiko', ['tampil_otomatis' => 1])->result_array();

            if ($jenis_resiko) {
                $jenis_resiko = $jenis_resiko;
            } else {
                $jenis_resiko = [];
            }

            foreach ($cari_d as $c) {
                array_push($jenis_resiko, $c['id_jenis_resiko']);
            }

            foreach ($jenis_ptg as $j_ptg) {
                $id_jenis_ptg = $j_ptg;
                
                foreach ($jenis_resiko as $j_rso) {
                    $id_jenis_rso = $j_rso;
            
                    $id = $id_jenis_ptg.$id_jenis_rso;

                    $id_jenis_kredit                = $this->input->post("id_jenis_kredit");
                    $id_jenis_produk                = $this->input->post("id_jenis_produk");
                    $id_jenis_tanggung              = $id_jenis_ptg;
                    $id_jenis_resiko                = $id_jenis_rso;
                    $uang_pertanggungan             = $this->input->post("uang_pertanggungan_$id");
                    $bunga                          = $this->input->post("bunga_$id");
                    $tgl_akad                       = $this->input->post("tgl_akad_$id");
                    $masa_asuransi                  = $this->input->post("masa_asuransi_$id");
                    $periode_asuransi_akhir         = $this->input->post("periode_asuransi_akhir_$id");
                    $periode_asuransi_awal          = $this->input->post("periode_asuransi_awal_$id");

                    // menentukan status cash CAC dan CBC
                    $up      = ($uang_pertanggungan == '') ? 0 : $uang_pertanggungan;

                    if ($up <= 100000000) {
                        $id_pl = 1;
                    } elseif ($up <= 200000000) {
                        $id_pl = 2;
                    } else {
                        $id_pl = 3;
                    }

                    if ($usia <= 35) {
                        $id_um = 1;
                    } elseif ($usia <= 45) {
                        $id_um = 2;
                    } else {
                        $id_um = 3;
                    }

                    // cari kode underwiting
                    $where = [  'id_asuransi'         => $id_asuransi,
                                'id_jenis_produk'     => $id_jenis_produk,
                                'id_jenis_tanggung'   => $id_jenis_ptg,
                                'id_jenis_resiko'     => $id_jenis_rso
                                ];

                    $kd = $this->M_tanggungan->cari_kode($where)->row_array();

                    $kode_udw = $kd['kode_underwriting'];
                    $kode_tfu = $kd['kode_tarif_perusia'];

                    // $cr_udw = "cr_udw".$id;
                    // cari status udw
                    $cr_udw = $this->M_tanggungan->cari_status_udw($kode_udw, $id_pl, $id_um, $id_asuransi)->row_array();

                    $sts_udw    = $cr_udw['status_underwriting'];
                    $id_sts_udw = $cr_udw['id_status_underwriting'];

                    if ($sts_udw == 'CAC') {
                        $id_status_cash             = 1;
                        $nm_status_cash             = 'CAC';
                        $id_status_lengkap_dokumen  = 3;
                        $id_status_polish           = 1;

                    } else {
                        $id_status_cash             = 2;
                        $nm_status_cash             = 'CBC';
                        $id_status_lengkap_dokumen  = 2;
                        $id_status_polish           = 0;
                    }
                    
                    $id_status_cash = $id_status_cash;

                    // cari tarif perusia
                    $cr_tf = $this->M_master->cari_data('tr_tarif_perusia', ['usia' => $usia, 'masa_tahun' => $masa_asuransi, 'id_asuransi' => $id_asuransi, 'kode_tarif_perusia' => $kode_tfu])->row_array();

                    // premi
                    $premi = $uang_pertanggungan * $cr_tf['tarif'];

                    // input data
                    $data_resiko_ptg = ['id_debitur'                => $id_debitur,
                                        'id_jenis_kredit'           => $id_jenis_kredit,
                                        'id_jenis_tanggung'         => $id_jenis_ptg,
                                        'id_jenis_resiko'           => $id_jenis_resiko,
                                        'uang_ptg'                  => $uang_pertanggungan,
                                        'bunga'                     => $bunga,
                                        'tgl_akad'                  => $tgl_akad,
                                        'periode_asuransi_awal'     => $periode_asuransi_awal,
                                        'periode_asuransi_akhir'    => $periode_asuransi_akhir,
                                        'masa_asuransi'             => $masa_asuransi,
                                        'id_status_cash'            => $id_status_cash,
                                        'premi'                     => $premi,
                                        'id_status_underwriting'    => $id_sts_udw,
                                        'kode_tertanggung'          => $kd_ptg,
                                        'id_jenis_produk'           => $id_jenis_produk,
                                        'id_status_polish'          => $id_status_polish
                                        ];

                    // cari data di resiko ptg
                    $cr_ptg = $this->M_master->cari_data('tr_resiko_ptg', ['id_jenis_tanggung' => $id_jenis_ptg, 'id_jenis_resiko' => $id_jenis_rso, 'kode_tertanggung' => $kd_ptg]);

                    $crow = $cr_ptg->row_array();

                    if ($cr_ptg->num_rows() > 0) {

                        $data_resiko_ptg['edit_time'] = date("Y-m-d H:i:s", now('Asia/Jakarta'));

                        $this->M_master->ubah_data('tr_resiko_ptg', $data_resiko_ptg, ['id_resiko_ptg' => $crow['id_resiko_ptg']]);

                        if ($crow['id_status_underwriting'] != $id_sts_udw) {

                            if ($id_status_cash == 2) {

                                // cari data
                                $cdc = $this->M_master->cari_data('dokumen_cbc', ['id_resiko_ptg' => $crow['id_resiko_ptg']])->result_array();

                                foreach ($cdc as $cd) {
                                    $path = "./uploads/dokumen_cbc/".$cd['dokumen'];
                                    unlink($path); 
                                }

                                // hapus data
                                $this->db->delete('dokumen_cbc', ['id_resiko_ptg' => $crow['id_resiko_ptg']]);

                            }
                            
                        } 
                    
                    } else {
                        $data_resiko_ptg['add_time'] = date("Y-m-d H:i:s", now('Asia/Jakarta'));

                        $this->M_master->input_data('tr_resiko_ptg', $data_resiko_ptg);
                        $id_resiko_ptg = $this->db->insert_id();

                        $list_dok = $this->M_tanggungan->cari_dok_cbc($id_sts_udw, $id_asuransi)->result_array();

                        if ($id_status_cash == 2) {
                            foreach ($list_dok as $d) {

                                $data_dok_cbc = ['id_dok_underwriting'  => $d['id_dok_underwriting'],
                                                'id_resiko_ptg'        => $id_resiko_ptg,
                                                'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                                ];

                                $this->M_master->input_data('dokumen_cbc', $data_dok_cbc);

                            }
                        }
                    }
                    
                }

            }

            // cari dokumen null
            $ca = $this->M_master->cari_data('dokumen', ['dokumen' => null, 'id_pertanggungan' => $id_data_per])->num_rows();

            $cr = $this->M_tanggungan->cari_id_resiko_ptg($id_data_per)->result_array();

            $isi_valid = [];
            foreach ($cr as $e) {

                $cg = $this->M_master->cari_data('dokumen_cbc', ['dokumen' => null, 'id_resiko_ptg' => $e['id_resiko_ptg']])->num_rows();

                if ($cg > 0) {
                    array_push($isi_valid, $cg);
                }
                
            }

            if ($ca > 0) {
                $id_status_lengkap_dokumen = 2;
            } else {
                if (empty($isi_valid)) {
                    $id_status_lengkap_dokumen = 1;
                } else {
                    $id_status_lengkap_dokumen = 2;
                }
            }

            // update kelengkapan
            $this->M_master->ubah_data('pertanggungan', ['id_status_lengkap_dokumen' => $id_status_lengkap_dokumen], ['id_pertanggungan' => $id_data_per]);

            redirect("C_pertanggungan/detail_ptg/$id_data_per", 'refresh');

        }

        // 29-03-2021
        public function form_detail_debitur()
        {
            $id_debitur = $this->input->post('id_debitur');

            $data = ['id_debitur'   => $id_debitur,
                     'deb'          => $this->M_tanggungan->detail_debitur($id_debitur)->row_array()
                    ];
            
            $this->load->view('pertanggungan/V_detail_debitur_ptg', $data);
            
        }

        // 24-03-2021
        public function tampil_data_debitur_as()
        {
            $list = $this->M_tanggungan->get_data_debitur_as();

            $data = array();

            $no   = $this->input->post('start');

            $tot_up = 0;
            $no =1;
            foreach ($list as $v) {
                $tbody = array();

                $tbody[] = "<div align='center'>".$no++.".</div>";
                $tbody[] = $v['kode_tertanggung'];
                $tbody[] = $v['nama_lengkap'];
                $tbody[] = "Rp. ".number_format($v['total_uang_ptg'],0,'.','.');
                $tbody[] = $v['jenis_tanggung'];
                $tbody[] = $v['jenis_resiko'];
                $tbody[] = "<a href='".base_url()."C_pertanggungan/approve/".$v['id_pertanggungan']."'><span style='cursor:pointer' class='mr-3 text-primary approve' data-id='".$v['id_pertanggungan']."' data-toggle='tooltip' title='Approve Tertanggung'><i class='mdi mdi-checkbox-multiple-marked mdi-24px'></i></span></a><span style='cursor:pointer' class='mr-2 text-success detail-tanggungan' data-id='".$v['id_pertanggungan']."' data-toggle='tooltip' title='Detail'><i class='mdi mdi-information-outline mdi-24px'></i></span>";
                $data[]  = $tbody; 

                $tot_up += $v['total_uang_ptg'];
            }

            $output = [ "draw"                  => $_POST['draw'],
                        "recordsTotal"          => $this->M_tanggungan->jumlah_semua_debitur_as(),
                        "recordsFiltered"       => $this->M_tanggungan->jumlah_filter_debitur_as(),   
                        "data"                  => $data,
                        "total_tertanggung"     => count($list),
                        "total_pertertanggungan"=> "Rp. ".number_format($tot_up,0,'.','.')
                      ];

            echo json_encode($output);
        }

        // 24-03-2021
        public function approve($id_ptg)
        {
            $id_pks     = $this->session->userdata('id_pks');
            $id_bpr     = $this->session->userdata('id_bpr');
            $nomor_pks  = $this->session->userdata('nomor_pks');
            $nama_bpr   = $this->session->userdata('nama_bpr');

            // cari data
            $cr     = $this->M_master->cari_data('pertanggungan', ['id_pertanggungan' => $id_ptg])->row_array();
            $cr2    = $this->M_master->cari_data('m_debitur', ['id_debitur' => $cr['id_debitur']])->row_array();

            $data = [   'menu'          => 'Pertanggungan',
                        'page'          => 'Approve PTG',
                        'id_ptg'        => $id_ptg,
                        'id_pks'        => $id_pks,
                        'id_bpr'        => $id_bpr,
                        'nomor_pks'     => $nomor_pks,
                        'nama_bpr'      => $nama_bpr,
                        'kode_ptg'      => $cr['kode_tertanggung'],
                        'nama_deb'      => $cr2['nama_lengkap'],
                        'st_approve'    => $this->M_master->get_data('m_status_polish')->result_array()
                    ];
            
            $this->template->load('layout/template', 'pertanggungan/V_approve', $data);
        }

        // 25-03-2021
        public function tampil_approve()
        {
            $kode_ptg = $this->input->post('kode_ptg');

            $list = $this->M_tanggungan->cari_resiko_ptg($kode_ptg)->result_array();

            $no = 1;
            foreach ($list as $v) {
                $tbody = array();

                if ($v['id_status_polish'] == 1) {
                    $sp = "badge-success";
                } elseif ($v['id_status_polish'] == 2) {
                    $sp = "badge-danger";
                } else {
                    $sp = "badge-warning";
                }

                if ($v['id_status_cash'] == 1) {
                    $sp1    = "badge-primary";
                    $hd     = 'hidden';
                    $hd1    = '';
                } else {
                    $sp1    = "badge-warning";
                    $hd     = '';
                    $hd1    = 'hidden';
                }

                $tbody[] = "<div align='center'>".$no++.".</div>";
                $tbody[] = $v['jenis_produk'];
                $tbody[] = $v['jenis_tanggung'];
                $tbody[] = $v['jenis_resiko'];
                $tbody[] = "<div class='text-right'>".number_format($v['uang_ptg'],0,'.','.')."</div>";
                $tbody[] = "<span style='font-size:14px;' class='badge $sp1 text-white font-weight-bold'>".$v['status_cash']."</span>";
                $tbody[] = "<span style='font-size:14px;' class='badge $sp text-white font-weight-bold'>".$v['status_polish']."</span>";
                $tbody[] = "<span style='cursor:pointer' class='mr-2 text-primary konfirm' data-id='".$v['id_resiko_ptg']."' data-toggle='tooltip' title='Approve' $hd><i class='mdi mdi-check-circle mdi-24px'></i></span><span style='cursor:pointer' class='text-success detail' data-id='".$v['id_resiko_ptg']."' data-toggle='tooltip' title='Detail'><i class='mdi mdi-information-outline mdi-24px'></i></span>";
                $data[]  = $tbody; 
            }

            if ($list) {
                echo json_encode(array('data'=> $data));
            }else{
                echo json_encode(array('data'=> 0));
            }
            
        }

        // 25-03-2021
        public function tampil_detail_approve()
        {
            $id_resiko_ptg = $this->input->post('id_resiko_ptg');
            
            $cr = $this->M_tanggungan->cari_detail_resiko($id_resiko_ptg)->row_array();

            $cr_dok = $this->M_master->cari_data('dokumen_tambahan', ['id_resiko_ptg' => $id_resiko_ptg]);

            $div = "";
            $i=0;  
            foreach ($cr_dok->result_array() as $d) {
                
                if ($i == 0) {
                    $div .= "<div class='row'><div class='col-sm-9'><input type='text' class='form-control dok_tambahan' style='font-size: 14px;' name='dok_tambahan[]' value='".$d['nama_dokumen']."'> </div><div class='col-sm-3 text-left'><button type='button' class='btn btn-success add_form_field'>Tambah</button></div></div>";
                } else {
                    $div .= "<div class='row f_delete$i mt-1'><div class='col-sm-9'><input type='text' class='form-control dok_tambahan' style='font-size: 14px;' name='dok_tambahan[]' value='".$d['nama_dokumen']."'> </div><div class='col-sm-3 text-left'><button type='button' class='btn btn-danger delete' data-id='$i'>Hapus</button></div></div>";
                }

                $i++;
            }

            $data = [   't_kode_ttg'        => $cr['kode_tertanggung'],                
                        't_nama_debitur'    => $cr['nama_lengkap'],        
                        't_jenis_kredit'    => $cr['jenis_kredit'],    
                        't_jenis_produk'    => $cr['jenis_produk'],    
                        't_tertanggung'     => $cr['jenis_tanggung'],
                        't_jenis_resiko'    => $cr['jenis_resiko'],       
                        't_uang_ptg'        => number_format($cr['uang_ptg'],0,'.','.'),
                        't_masa_asuransi'   => $cr['masa_asuransi'],     
                        't_premi'           => number_format($cr['premi'],0,'.','.'),  
                        't_status_udw'      => $cr['status_underwriting'],   
                        't_status_polish'   => $cr['status_polish'],
                        'c_dok_tmb'         => $cr_dok->num_rows(),
                        'id_status_cash'    => $cr['id_status_cash'],
                        'id_status_polish'  => $cr['id_status_polish'],
                        'html_dok_tambah'   => $div
                    ];

            echo json_encode($data);
        }

        // 25-03-2021
        public function tampil_dokumen_as()
        {
            $id_resiko_ptg = $this->input->post('id_resiko_ptg');

            $list = $this->M_tanggungan->cari_dokumen_cbc($id_resiko_ptg)->result_array();

            $no =1;
            foreach ($list as $v) {
                $tbody = array();

                $tbody[] = "<div align='center'>".$no++.".</div>";
                $tbody[] = ucwords($v['jenis_dokumen']);
                $tbody[] = "<a href='".base_url()."C_pertanggungan/download_dokumen_cbc/".$v['id_dokumen_cbc']."'><i class='fa fa-file-text-o fa-lg mr-2'></i>".$v['dokumen']."</a>";
                $data[]  = $tbody; 
            }

            if ($list) {
                echo json_encode(array('data'=> $data));
            }else{
                echo json_encode(array('data'=> 0));
            }
        }

        // 26-03-2021
        public function tampil_dokumen_tambahan()
        {
            $id_resiko_ptg = $this->input->post('id_resiko_ptg');

            $list = $this->M_tanggungan->cari_dokumen_tambahan($id_resiko_ptg)->result_array();

            $no =1;
            foreach ($list as $v) {
                $tbody = array();

                if ($v['dokumen']) {
                    $dok = "<a href='".base_url()."C_pertanggungan/download_dokumen_tambahan/".$v['id_dokumen_tambahan']."'><i class='fa fa-file-text-o fa-lg mr-2'></i>".$v['dokumen']."</a>";
                } else {
                    $dok = "Belum upload dokumen";
                }

                $tbody[] = "<div align='center'>".$no++.".</div>";
                $tbody[] = ucwords($v['nama_dokumen']);
                $tbody[] = $dok;
                $data[]  = $tbody; 
            }

            if ($list) {
                echo json_encode(array('data'=> $data));
            }else{
                echo json_encode(array('data'=> 0));
            }
        }

        // 25-03-2021
        public function simpan_approve()
        {
            $id_ptg         = $this->input->post('id_ptg');
            $id_resiko_ptg  = $this->input->post('id_resiko_ptg');
            $sel_approve    = $this->input->post('sel_approve');
            $dok_tambahan   = $this->input->post('dok_tambahan');

            if ($sel_approve == 3) {

                foreach ($dok_tambahan as $d) {
                    if ($d != '') {
                        $this->db->insert('dokumen_tambahan', ['nama_dokumen' => $d, 'id_resiko_ptg' => $id_resiko_ptg]);

                        $this->db->update('tr_resiko_ptg', ['id_status_polish' => $sel_approve], ['id_resiko_ptg' => $id_resiko_ptg]);
                        
                        $this->db->update('pertanggungan', ['id_status_lengkap_dokumen' => 4, 'validasi_dokumen' => 0], ['id_pertanggungan' => $id_ptg]);
                    }
                }
            
            } else {
                $this->db->update('tr_resiko_ptg', ['id_status_polish' => $sel_approve], ['id_resiko_ptg' => $id_resiko_ptg]);
            }

            if ($sel_approve == 1) {

                $a  = strtoupper(bin2hex(random_bytes(2)));

                $dt = date("dmy", now('Asia/Jakarta'));
        
                $cf = "CF$dt$a";
                
                $data   = [ 'id_resiko_ptg'     => $id_resiko_ptg,
                            'certified_number'  => $cf,
                            'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                        ];
                
                $this->db->insert('tr_polish', $data);
                
            }

            redirect("C_pertanggungan/approve/".$id_ptg);
        }

        // 24-03-2021
        public function ubah_forward_asuransi()
        {
            $id_ptg = $this->input->post('id_ptg');
            $isi    = $this->input->post('isi');

            $this->M_master->ubah_data('pertanggungan', ['forward_asuransi' => $isi], ['id_pertanggungan' => $id_ptg]);
            
            echo json_encode(['status' => TRUE]);
        }

        // 23-03-2021
        public function kelengkapan_dokumen($id_ptg)
        {
            $id_pks     = $this->session->userdata('id_pks');
            $id_bpr     = $this->session->userdata('id_bpr');
            $nomor_pks  = $this->session->userdata('nomor_pks');
            $nama_bpr   = $this->session->userdata('nama_bpr');

            $cr = $this->M_tanggungan->cari_data_ptg($id_ptg)->row_array();

            $kd = $cr['kode_tertanggung'];

            // cari status validasi dokumen
            $vl = $this->M_master->cari_data('pertanggungan', ['id_pertanggungan' => $id_ptg])->row_array();

            $data = [   'menu'          => 'Pertanggungan',
                        'page'          => 'Kelengkapan Dokumen',
                        'id_pks'        => $id_pks,
                        'id_bpr'        => $id_bpr,
                        'nomor_pks'     => $nomor_pks,
                        'nama_bpr'      => $nama_bpr,
                        'id_ptg'        => $id_ptg,
                        'jenis_ptg'     => $this->M_tanggungan->cari_jenis_ptg($kd)->result_array(),
                        'jenis_resiko'  => $this->M_tanggungan->cari_jenis_resiko_2($kd)->result_array(),
                        'kd_ptg'        => $kd,
                        'valid_dok'     => $vl['validasi_dokumen'],
                        'lengkap_dok'   => $vl['id_status_lengkap_dokumen']
                    ];
            
            $this->template->load('layout/template', 'pertanggungan/V_lengkap_dokumen', $data);
        }

        // 23-03-2021
        public function upload_dokumen_ptg()
        {
            $id_dok             = $this->input->post('id_dok');
            $id_ptg             = $this->input->post('id_ptg'); 
            $status_jenis_dok   = $this->input->post('status_jenis_dok'); 
            $halaman            = $this->input->post('halaman'); 

            // cari status dokumen
            $cr_st           = $this->M_master->cari_data('pertanggungan', ['id_pertanggungan' => $id_ptg])->row_array();
            $sts_lengkap_dok = $cr_st['id_status_lengkap_dokumen'];

            if ($status_jenis_dok == 'ptg') {
                $sjd = "";
                $tg  = "_tertanggung";
            } else if ($status_jenis_dok == 'cbc') {
                $sjd = "_cbc";
                $tg  = "_cbc";
            } else if ($status_jenis_dok == 'tambahan') {
                $sjd = "_tambahan";
                $tg  = "_tambahan";
            } 

            $cr = $this->M_master->cari_data("dokumen$sjd", ["id_dokumen$sjd" => $id_dok])->row_array();

            if ($cr['dokumen']) {
                $path = "./uploads/dokumen$tg/".$cr['dokumen'];
                unlink($path); 
            }
            
            $config['upload_path']      = "./uploads/dokumen$tg";
            $config['max_size']         = 5000;
            $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf|doc|docx';
            $this->load->library('upload', $config);

            $this->upload->do_upload("upload_dok");
            $r = $this->upload->data();

            if ($_FILES["upload_dok"]['name'] != "") {
                $nm = $r['file_name'];
            } else {
                $nm = null;
            }
            
            $this->M_master->ubah_data("dokumen$sjd", ["dokumen" => $nm, "flag_validasi" => 0], ["id_dokumen$sjd" => $id_dok]);

            // ubah status lengkap dokumen

                // cari yg belum ada dokumen
                $ca = $this->M_master->cari_data('dokumen', ['dokumen' => null, 'id_pertanggungan' => $id_ptg])->num_rows();

                // cari id resiko ptg
                $cr = $this->M_tanggungan->cari_id_resiko_ptg($id_ptg)->result_array();

                $isi_lengkap_dok = [];
                foreach ($cr as $e) {

                    $cg = $this->M_master->cari_data('dokumen_cbc', ['dokumen' => null, 'id_resiko_ptg' => $e['id_resiko_ptg']])->num_rows();

                    if ($cg > 0) {
                        array_push($isi_lengkap_dok, $cg);
                    }
                    
                }

                if ($sts_lengkap_dok == 4) {
                    $isi_tambahan = [];
                    foreach ($cr as $f) {
    
                        $cf = $this->M_master->cari_data('dokumen_tambahan', ['dokumen' => null, 'id_resiko_ptg' => $f['id_resiko_ptg']])->num_rows();
        
                        if ($cf > 0) {
                            array_push($isi_tambahan, $cf);
                        }
                        
                    }
                }

                if ($ca == 0) {
                    if (empty($isi_lengkap_dok)) {
                        // ubah status validasi dokumen
                        if ($sts_lengkap_dok == 4) {
                            if (empty($isi_tambahan)) {
                                $sts_l = 5;
                            } else {
                                $sts_l = 4;
                            }
                        } else {
                            $sts_l = 1;
                        }

                        $this->M_master->ubah_data('pertanggungan', ['id_status_lengkap_dokumen' => $sts_l, 'validasi_dokumen' => 0], ['id_pertanggungan' => $id_ptg]); 

                    } else {
                        $this->M_master->ubah_data('pertanggungan', ['id_status_lengkap_dokumen' => 2], ['id_pertanggungan' => $id_ptg]);
                    }
                } else {
                    $this->M_master->ubah_data('pertanggungan', ['id_status_lengkap_dokumen' => 2], ['id_pertanggungan' => $id_ptg]);
                }

            // akhir ubah status lengkap dokumen

            if ($halaman == 'upload') {
                redirect("C_pertanggungan/kelengkapan_dokumen/$id_ptg");
            } elseif ($halaman == 'edit') {
                redirect("C_pertanggungan/edit_ptg/$id_ptg");
            }

        }

        // 23-03-2021
        public function hapus_dokumen()
        {
            $id_dok             = $this->input->post('id_dok');
            $status_jenis_dok   = $this->input->post('status_jenis_dok'); 
            $id_ptg             = $this->input->post('id_ptg'); 

            // cari status dokumen
            $cr_st           = $this->M_master->cari_data('pertanggungan', ['id_pertanggungan' => $id_ptg])->row_array();
            $sts_lengkap_dok = $cr_st['id_status_lengkap_dokumen'];

            if ($status_jenis_dok == 'ptg') {
                $sjd = "";
                $tg  = "_tertanggung";
            } elseif ($status_jenis_dok == 'cbc') {
                $sjd = "_cbc";
                $tg  = "_cbc";
            } elseif ($status_jenis_dok == 'tambahan') {
                $sjd = "_tambahan";
                $tg  = "_tambahan";
            }
            
            $cr = $this->M_master->cari_data("dokumen$sjd", ["id_dokumen$sjd" => $id_dok])->row_array();

            $path = "./uploads/dokumen$tg/".$cr['dokumen'];
            unlink($path);

            $this->M_master->ubah_data("dokumen$sjd", ["dokumen" => null, "flag_validasi" => 0], ["id_dokumen$sjd" => $id_dok]);

            if ($sts_lengkap_dok == 4 || $sts_lengkap_dok == 5) {
                $val = 0;
                $fwd = 1;
                $ids = 4;
            } else {
                $val = 0;
                $fwd = 0;
                $ids = 2;
            }

            // ubah status
            $dt = [ 'validasi_dokumen'          => $val,
                    'forward_asuransi'          => $fwd,
                    'id_status_lengkap_dokumen' => $ids
                    ];

            $this->M_master->ubah_data('pertanggungan', $dt, ['id_pertanggungan' => $id_ptg]);

            echo json_encode(['status' => TRUE]);
        }

        // 10-02-2021
        public function ambil_masa_asuransi()
        {
            $awal   = date("Y-m-d", strtotime($this->input->post('periode_awal')));
            $akhir  = date("Y-m-d", strtotime($this->input->post('periode_akhir')));
            $periode_awal   = new DateTime($awal);
            $periode_akhir  = new DateTime($akhir);
            
            $umur = $periode_akhir->diff($periode_awal);

            echo json_encode(['tahun' => $umur->y]);
        }

        // 18-02-2021
        public function simpan_dokumen_cbc()
        {
            // $id_ptg         = $this->input->post('id_ptg');
            // $jml_dok        = $this->input->post('jml_dok');
            // $id_sts_udw     = $this->input->post('id_sts_udw_t');
            // $id_asuransi    = $this->input->post('id_asuransi_t');

            // $list_dok = $this->M_tanggungan->cari_dok_cbc($id_sts_udw, $id_asuransi)->result_array();

            // foreach ($list_dok as $d) {

            //     $config['upload_path']      = './uploads/dokumen_cbc';
            //     $config['max_size']         = 5000;
            //     $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf';
            //     // load library upload
            //     $this->load->library('upload', $config);

            //     $id_dok_udw = $d['id_dok_underwriting'];

            //     $this->upload->do_upload("file_$id_dok_udw");
            //     $result1 = $this->upload->data();

            //     $data_dok   = [ 'id_dok_underwriting'   => $d['id_dok_underwriting'],
            //                     'dokumen'               => $result1['file_name'],
            //                     'id_pertanggungan'      => $id_ptg
            //                 ];
                
            //     $this->db->insert('dokumen_cbc', $data_dok);
            // }

            $id_pks     = $this->input->post('id_pks');
            $id_bpr     = $this->input->post('id_bpr');
            $nomor_pks  = $this->input->post('nomor_pks');
            $nama_bpr   = $this->input->post('nama_bpr');
            
            $data = [   'menu'      => 'Pertanggungan',
                        'page'      => 'Lihat Debitur PTG',
                        'id_pks'    => $id_pks,
                        'id_bpr'    => $id_bpr,
                        'nomor_pks' => $nomor_pks,
                        'nama_bpr'  => $nama_bpr
                    ];
                    
            if (isset($_POST['kembali'])) {

                $sess_f = [ 'id_pks'    => $id_pks,
                            'id_bpr'    => $id_bpr,
                            'nomor_pks' => $nomor_pks,
                            'nama_bpr'  => $nama_bpr,
                            'status'    => 'hasil'
                          ];

                $this->session->set_userdata($sess_f);

                redirect('C_pertanggungan/lihat_debitur_ptg');
                
            } else {

                $id_data_per = $this->input->post('id_ptg');
                
                $cr = $this->M_tanggungan->cari_data_ptg($id_data_per)->row_array();

                $kd_ptg = $cr['kode_tertanggung'];

                $jenis_ptg      = $this->M_tanggungan->cari_jenis_ptg($kd_ptg)->result_array();
                $jenis_resiko   = $this->M_tanggungan->cari_jenis_resiko_2($kd_ptg)->result_array();

                foreach ($jenis_ptg as $j_ptg) {
                    $id_jenis_ptg = $j_ptg['id_jenis_tanggung'];
                    
                    foreach ($jenis_resiko as $j_rso) {
                        $id_jenis_rso = $j_rso['id_jenis_resiko'];
                
                        $id = $id_jenis_ptg.$id_jenis_rso;

                        $dr = $this->M_tanggungan->cari_tr_jenis_resiko($kd_ptg, $id_jenis_ptg, $id_jenis_rso)->row_array();

                        if ($dr['id_status_cash'] == 2) {
                            $dcbc = $this->M_tanggungan->cari_dokumen_cbc($dr['id_resiko_ptg'])->result_array();

                            $i = 1;
                            foreach ($dcbc as $d) {

                                $jns_dok    = $d['jenis_dokumen'];
                                $id_dok_cbc = $d['id_dokumen_cbc'];

                                $config['upload_path']      = './uploads/dokumen_cbc';
                                $config['max_size']         = 5000;
                                $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf|doc|docx';
                                // load library upload
                                $this->load->library('upload', $config);

                                $r = "result$i";

                                $this->upload->do_upload("$jns_dok".'_'."$id".'_'."$id_dok_cbc");
                                $$r = $this->upload->data();

                                $nm = "nama$i";

                                if ($_FILES["$jns_dok".'_'."$id".'_'."$id_dok_cbc"]['name'] != "") {
                                    $$nm = $$r['file_name'];
                                } else {
                                    $$nm = null;
                                }
                                
                                $this->M_master->ubah_data('dokumen_cbc', ['dokumen' => $$nm], ['id_dokumen_cbc' => $id_dok_cbc]);

                                $i++;
                            }
                        }

                    }
                }
                
                // $this->template->load('layout/template', 'pertanggungan/V_detail_deb', $data);
                
                $sess_f = [ 'id_pks'    => $id_pks,
                            'id_bpr'    => $id_bpr,
                            'nomor_pks' => $nomor_pks,
                            'nama_bpr'  => $nama_bpr,
                            'status'    => 'hasil'
                          ];
                
                $this->session->set_userdata( $sess_f );
                

                redirect('C_pertanggungan/lihat_debitur_ptg');

            }

        }

        // 10-02-2021
        public function tampilan_hasil_akhir()
        {
            $aksi_tambah_debitur                = $this->input->post('aksi_tambah_debitur');
            $id_debitur                         = $this->input->post('id_debitur');
            $id_asuransi                        = $this->input->post('id_asuransi');

            $nik                                = $this->input->post('nik');
            $nama_lengkap                       = $this->input->post('nama_lengkap');
            $jenis_kelamin                      = $this->input->post('jenis_kelamin');
            $tempat_lahir                       = $this->input->post('tempat_lahir');
            $tgl_lahir                          = ($this->input->post('tgl_lahir') == '') ? null : $this->input->post('tgl_lahir');
            $jenis_identitas                    = $this->input->post('jenis_identitas');
            $no_identitas                       = $this->input->post('no_identitas');
            $status_nikah                       = $this->input->post('status_nikah');
            $warga_negara                       = $this->input->post('warga_negara');
            $negara_wna                         = $this->input->post('negara_wna');
            $agama                              = $this->input->post('agama');
            $alamat_rumah                       = $this->input->post('alamat_rumah');
            $kode_pos_rumah                     = $this->input->post('kode_pos_rumah');
            $alamat_korespondensi               = $this->input->post('alamat_korespon');
            $kode_pos_korespondensi             = $this->input->post('kode_pos_korespon');
            $kontak                             = $this->input->post('kontak');
            $email                              = $this->input->post('email');
            $pekerjaan                          = $this->input->post('pekerjaan');
            $bagian                             = $this->input->post('bagian');
            $alamat_kantor                      = $this->input->post('alamat_kantor');
            $kode_pos_kantor                    = $this->input->post('kode_pos_kantor');
            $tujuan_beli_asuransi               = $this->input->post('tujuan_beli_asuransi');
            $sumber_dana_pembelian              = $this->input->post('sumber_dana_beli');
            $sumber_dana_pembelian_lainnya      = $this->input->post('sdb_lainnya');
            $pengahasilan_per_tahun             = $this->input->post('penghasilan_tahun');
            $sumber_dana_penghasilan            = $this->input->post('sumber_dana_penghasilan');
            $sumber_dana_penghasilan_lainnya    = $this->input->post('sdp_lainnya');
            $id_spk                             = $this->input->post('id_pks');
            $add_time                           = date("Y-m-d H:i:s", now('Asia/Jakarta'));

            $sts_ktp                            = $this->input->post('sts_ktp');

            $ty_1                               = $this->input->post('ty_1');
            $ty_2                               = $this->input->post('ty_2');
            $ty_3                               = $this->input->post('ty_3');
            
            if ($aksi_tambah_debitur == 'tambah_debitur') {

                $data   =  ['alamat_korespondensi'              => $alamat_korespondensi,
                            'kode_pos_korespondensi'            => $kode_pos_korespondensi,
                            'kontak'                            => $kontak,
                            'email'                             => $email,
                            'pekerjaan'                         => $pekerjaan,
                            'bagian'                            => $bagian,
                            'alamat_kantor'                     => $alamat_kantor,
                            'kode_pos_kantor'                   => $kode_pos_kantor,
                            'tujuan_beli_asuransi'              => $tujuan_beli_asuransi,
                            'sumber_dana_pembelian'             => $sumber_dana_pembelian,
                            'sumber_dana_pembelian_lainnya'     => $sumber_dana_pembelian_lainnya,
                            'pengahasilan_per_tahun'            => $pengahasilan_per_tahun,
                            'sumber_dana_penghasilan'           => $sumber_dana_penghasilan,
                            'sumber_dana_penghasilan_lainnya'   => $sumber_dana_penghasilan_lainnya,
                            'id_pks'                            => $id_spk,
                            'add_time'                          => $add_time
                        ];

                $data['nik']            = $nik;
                $data['nama_lengkap']   = $nama_lengkap;
                $data['tempat_lahir']   = $tempat_lahir;
                $data['jenis_kelamin']  = $jenis_kelamin;
                $data['tgl_lahir']      = date("Y-m-d", strtotime($tgl_lahir));

                if ($sts_ktp == 'ya') {

                    $data['jenis_identitas']    = $jenis_identitas;
                    $data['no_identitas']       = $no_identitas;
                    $data['status_nikah']       = ($status_nikah == null) ? null : $status_nikah;
                    $data['warga_negara']       = $warga_negara;
                    $data['negara_wna']         = $negara_wna;
                    $data['agama']              = $agama;
                    $data['alamat_rumah']       = $alamat_rumah;
                    $data['kode_pos_rumah']     = $kode_pos_rumah;
                    
                }

                // cari usia
                $awal   = date("Y-m-d", strtotime($tgl_lahir));
                $akhir  = date("Y-m-d", now('Asia/Jakarta'));
                $periode_awal   = new DateTime($awal);
                $periode_akhir  = new DateTime($akhir);
                
                $usia = $periode_akhir->diff($periode_awal);

                $data['usia'] = $usia->y;

                // input ke debitur
                $this->M_master->input_data('m_debitur', $data);
                $id_debitur = $this->db->insert_id();

                $nama_debitur = $nama_lengkap;
                $usia         = $usia->y;
                $nik          = $nik;

            } else {

                $id_debitur = $id_debitur;

                // cari nama debitur
                $cr_nama = $this->M_master->cari_data('m_debitur', ['id_debitur' => $id_debitur])->row_array();

                $nama_debitur = $cr_nama['nama_lengkap'];
                $usia         = $cr_nama['usia'];
                $nik          = $cr_nama['no_identitas'];
                
            }

            // Data Asuransi - Data Kesehatan

            $cara_bayar                     = $this->input->post('cara_bayar');
            $kredit_bank                    = $this->input->post('kredit_bank');
            $ahli_waris                     = $this->input->post('ahli_waris');
            $hubungan_ahli_waris            = $this->input->post('hubungan_ahli_waris');
            $tanya_data_asuransi            = $this->input->post('tanya_data_asuransi');
            $tanya_data_asuransi_jelaskan   = $this->input->post('tanya_data_asuransi_jelaskan');
            $tinggi_badan                   = $this->input->post('tinggi_badan');
            $berat_badan                    = $this->input->post('berat_badan');
            $tanya_kesehatan_1              = $this->input->post('tanya_kesehatan_1');
            $tanya_kesehatan_2              = $this->input->post('tanya_kesehatan_2');
            $tanya_kesehatan_3              = $this->input->post('tanya_kesehatan_3');
            $tanya_kesehatan_1_sts          = (($this->input->post('ty_1') == 'ya') ? 1 : 0);
            $tanya_kesehatan_2_sts          = (($this->input->post('ty_2') == 'ya') ? 1 : 0);
            $tanya_kesehatan_3_sts          = (($this->input->post('ty_3') == 'ya') ? 1 : 0);
            $tanya_hamil                    = $this->input->post('tanya_hamil');
            $hamil_anak_ke                  = $this->input->post('hamil_anak_ke');
            $add_time                       = date("Y-m-d H:i:s", now('Asia/Jakarta'));

            $data_per   = [ 
                            // 'uang_pertanggungan'            => ($uang_pertanggungan == '') ? null : $uang_pertanggungan,
                            // 'bunga'                         => ($bunga == '') ? null : $bunga,
                            // 'id_jenis_kredit'               => ($id_jenis_kredit == '') ? null : $id_jenis_kredit,
                            // 'id_jenis_tanggung'             => ($id_jenis_tanggung == '') ? null : $id_jenis_tanggung,
                            // 'masa_asuransi'                 => $masa_asuransi,
                            // 'periode_asuransi_akhir'        => $periode_asuransi_akhir,
                            // 'periode_asuransi_awal'         => $periode_asuransi_awal,
                            'cara_bayar'                    => $cara_bayar,
                            'kredit_bank'                   => $kredit_bank,
                            'ahli_waris'                    => $ahli_waris,
                            'hubungan_ahli_waris'           => $hubungan_ahli_waris,
                            'tanya_data_asuransi'           => $tanya_data_asuransi,
                            'tanya_data_asuransi_jelaskan'  => $tanya_data_asuransi_jelaskan,
                            'tinggi_badan'                  => ($tinggi_badan == '') ? null : $tinggi_badan,
                            'berat_badan'                   => ($berat_badan == '') ? null : $berat_badan,
                            'tanya_kesehatan_1'             => ($tanya_kesehatan_1 == '') ? null : $tanya_kesehatan_1,
                            'tanya_kesehatan_2'             => ($tanya_kesehatan_2 == '') ? null : $tanya_kesehatan_2,
                            'tanya_kesehatan_3'             => ($tanya_kesehatan_3 == '') ? null : $tanya_kesehatan_3,
                            'tanya_kesehatan_1_sts'         => $tanya_kesehatan_1_sts,
                            'tanya_kesehatan_2_sts'         => $tanya_kesehatan_2_sts,
                            'tanya_kesehatan_3_sts'         => $tanya_kesehatan_3_sts,
                            'tanya_hamil'                   => $tanya_hamil,
                            'hamil_anak_ke'                 => ($hamil_anak_ke == '') ? null : $hamil_anak_ke,
                            'add_time'                      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                          ];

            $a  = strtoupper(bin2hex(random_bytes(2)));

            $dt = date("dmy", now('Asia/Jakarta'));
    
            $kode_ttg = "TTG$dt$a";

            $data_per['id_debitur']         = $id_debitur;
            $data_per['kode_tertanggung']   = $kode_ttg;

            // kondisi ada penyakit
            if ($ty_1 == 'ya' || $ty_2 == 'ya' || $ty_3 == 'ya') {
                $data_per['id_status_tertanggung'] = 2;
            } else {
                $data_per['id_status_tertanggung'] = 1;
            }

            // input ke pertanggungan
            $this->M_master->input_data('pertanggungan', $data_per);
            $id_data_per = $this->db->insert_id();

            $config['upload_path']      = './uploads/dokumen_tertanggung';
            $config['max_size']         = 5000;
            $config['allowed_types']    = 'gif|jpg|jpeg|png|pdf';
            // load library upload
            $this->load->library('upload', $config);
            //
            $this->upload->do_upload('ktp_nasabah');
            $result2 = $this->upload->data();

            if ($_FILES["ktp_nasabah"]['name'] != "") {
                $nm2 = $result2['file_name'];
            } else {
                $nm2 = null;
            }

            $data_dok[] = ['nama_dokumen'       => 'ktp nasabah',
                           'dokumen'            => $nm2,
                           'id_pertanggungan'   => $id_data_per
                          ];
            //
            $this->upload->do_upload('upload_spajk');
            $result1 = $this->upload->data();

            if ($_FILES["upload_spajk"]['name'] != "") {
                $nm1 = $result1['file_name'];
            } else {
                $nm1 = null;
            }

            $data_dok[] = ['nama_dokumen'       => 'spajk',
                           'dokumen'            => $nm1,
                           'id_pertanggungan'   => $id_data_per
                          ];
            //
            $this->upload->do_upload('kartu_keluarga');
            $result3 = $this->upload->data();

            if ($_FILES["kartu_keluarga"]['name'] != "") {
                $nm3 = $result3['file_name'];
            } else {
                $nm3 = null;
            }

            $data_dok[] = ['nama_dokumen'       => 'kartu keluarga',
                           'dokumen'            => $nm3,
                           'id_pertanggungan'   => $id_data_per,
                          ];
            // 
            $this->upload->do_upload('ktp_ahli_waris');
            $result4 = $this->upload->data();

            if ($_FILES["ktp_ahli_waris"]['name'] != "") {
                $nm4 = $result4['file_name'];
            } else {
                $nm4 = null;
            }

            $data_dok[] = ['nama_dokumen'       => 'ktp ahli waris',
                           'dokumen'            => $nm4,
                           'id_pertanggungan'   => $id_data_per
                          ];

            $this->db->insert_batch('dokumen', $data_dok);
            
            $jenis_resiko   = $this->input->post('jenis_resiko');
            $jenis_ptg      = $this->input->post('jenis_ptg');

            $cari_d = $this->M_master->cari_data('m_jenis_resiko', ['tampil_otomatis' => 1])->result_array();

            if ($jenis_resiko) {
                $jenis_resiko = $jenis_resiko;
            } else {
                $jenis_resiko = [];
            }

            foreach ($cari_d as $c) {
                array_push($jenis_resiko, $c['id_jenis_resiko']);
            }

            foreach ($jenis_ptg as $j_ptg) {
                $id_jenis_ptg = $j_ptg;
                
                foreach ($jenis_resiko as $j_rso) {
                    $id_jenis_rso = $j_rso;
            
                    $id = $id_jenis_ptg.$id_jenis_rso;

                    $id_jenis_kredit                = $this->input->post("id_jenis_kredit");
                    $id_jenis_produk                = $this->input->post("id_jenis_produk");
                    $id_jenis_tanggung              = $id_jenis_ptg;
                    $id_jenis_resiko                = $id_jenis_rso;
                    $uang_pertanggungan             = $this->input->post("uang_pertanggungan_$id");
                    $bunga                          = $this->input->post("bunga_$id");
                    $tgl_akad                       = $this->input->post("tgl_akad_$id");
                    $masa_asuransi                  = $this->input->post("masa_asuransi_$id");
                    $periode_asuransi_akhir         = $this->input->post("periode_asuransi_akhir_$id");
                    $periode_asuransi_awal          = $this->input->post("periode_asuransi_awal_$id");

                    // menentukan status cash CAC dan CBC
                    $up      = ($uang_pertanggungan == '') ? 0 : $uang_pertanggungan;

                    if ($up <= 100000000) {
                        $id_pl = 1;
                    } elseif ($up <= 200000000) {
                        $id_pl = 2;
                    } else {
                        $id_pl = 3;
                    }

                    if ($usia <= 35) {
                        $id_um = 1;
                    } elseif ($usia <= 45) {
                        $id_um = 2;
                    } else {
                        $id_um = 3;
                    }

                    // cari kode underwiting
                    $where = ['id_asuransi'         => $id_asuransi,
                              'id_jenis_produk'     => $id_jenis_produk,
                              'id_jenis_tanggung'   => $id_jenis_ptg,
                              'id_jenis_resiko'     => $id_jenis_rso
                             ];

                    $kd = $this->M_tanggungan->cari_kode($where)->row_array();

                    $kode_udw = $kd['kode_underwriting'];
                    $kode_tfu = $kd['kode_tarif_perusia'];

                    // $cr_udw = "cr_udw".$id;
                    // cari status udw
                    $cr_udw = $this->M_tanggungan->cari_status_udw($kode_udw, $id_pl, $id_um, $id_asuransi)->row_array();

                    $sts_udw    = $cr_udw['status_underwriting'];
                    $id_sts_udw = $cr_udw['id_status_underwriting'];

                    if ($sts_udw == 'CAC') {
                        $id_status_cash             = 1;
                        $nm_status_cash             = 'CAC';
                        $id_status_lengkap_dokumen  = 3;
                        $id_status_polish           = 1;
                        $option = "";

                        $jml_dok = 0;
                    } else {
                        $id_status_cash             = 2;
                        $nm_status_cash             = 'CBC';
                        $id_status_lengkap_dokumen  = 2;
                        $id_status_polish           = 0;

                        // ambil list dokumen cbc
                        $list_dok = $this->M_tanggungan->cari_dok_cbc($id_sts_udw, $id_asuransi)->result_array();

                        $option = "";

                        foreach ($list_dok as $d) {
                            $nm         = $d['jenis_dokumen'];
                            $jns_dok    = str_replace(" ", "_", $d['jenis_dokumen']);
                            $name_d     = 'file_'.$d['id_dok_underwriting'];

                            $option .= "$nm <input type='file' name='$name_d' class='form-control mb-2'></input>";
                        }

                        $jml_dok = count($list_dok);
                    }
                    
                    $id_status_cash = $id_status_cash;

                    // $cr_tf  = "cr_tf".$id;
                    // $premi  = "premi".$id;

                    // cari tarif perusia
                    $cr_tf = $this->M_master->cari_data('tr_tarif_perusia', ['usia' => $usia, 'masa_tahun' => $masa_asuransi, 'id_asuransi' => $id_asuransi, 'kode_tarif_perusia' => $kode_tfu])->row_array();

                    // premi
                    $premi = $uang_pertanggungan * $cr_tf['tarif'];

                    // input data
                    $data_resiko_ptg = ['id_debitur'                => $id_debitur,
                                        'id_jenis_kredit'           => $id_jenis_kredit,
                                        'id_jenis_tanggung'         => $id_jenis_ptg,
                                        'id_jenis_resiko'           => $id_jenis_resiko,
                                        'uang_ptg'                  => $uang_pertanggungan,
                                        'bunga'                     => $bunga,
                                        'tgl_akad'                  => $tgl_akad,
                                        'periode_asuransi_awal'     => $periode_asuransi_awal,
                                        'periode_asuransi_akhir'    => $periode_asuransi_akhir,
                                        'masa_asuransi'             => $masa_asuransi,
                                        'id_status_cash'            => $id_status_cash,
                                        'premi'                     => $premi,
                                        'id_status_underwriting'    => $id_sts_udw,
                                        'kode_tertanggung'          => $kode_ttg,
                                        'id_jenis_produk'           => $id_jenis_produk,
                                        'id_status_polish'          => $id_status_polish,
                                        'add_time'                  => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                       ];

                    $this->M_master->input_data('tr_resiko_ptg', $data_resiko_ptg);
                    $id_resiko_ptg = $this->db->insert_id();

                    $list_dok = $this->M_tanggungan->cari_dok_cbc($id_sts_udw, $id_asuransi)->result_array();

                    if ($id_status_cash == 2) {
                        foreach ($list_dok as $d) {

                            $data_dok_cbc = ['id_dok_underwriting'  => $d['id_dok_underwriting'],
                                            'id_resiko_ptg'        => $id_resiko_ptg,
                                            'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                            ];

                            $this->M_master->input_data('dokumen_cbc', $data_dok_cbc);

                        }
                    }
                    
                }

            }

            // cari dokumen null
            $ca = $this->M_master->cari_data('dokumen', ['dokumen' => null, 'id_pertanggungan' => $id_data_per])->num_rows();

            $cr = $this->M_tanggungan->cari_id_resiko_ptg($id_data_per)->result_array();

            $isi_valid = [];
            foreach ($cr as $e) {

                $cg = $this->M_master->cari_data('dokumen_cbc', ['dokumen' => null, 'id_resiko_ptg' => $e['id_resiko_ptg']])->num_rows();

                if ($cg > 0) {
                    array_push($isi_valid, $cg);
                }
                
            }

            if ($ca > 0) {
                $id_status_lengkap_dokumen = 2;
            } else {
                if (empty($isi_valid)) {
                    $id_status_lengkap_dokumen = 1;
                } else {
                    $id_status_lengkap_dokumen = 2;
                }
            }

            // update kelengkapan
            $this->M_master->ubah_data('pertanggungan', ['id_status_lengkap_dokumen' => $id_status_lengkap_dokumen], ['id_pertanggungan' => $id_data_per]);

            // return json
            // $dt_json = ['status'            => true, 
            //             'sts_udw'           => $sts_udw, 
            //             'id_sts_udw'        => $id_sts_udw, 
            //             'nm_status_cash'    => $nm_status_cash, 
            //             'nama_debitur'      => $nama_debitur,
            //             'nik'               => $nik,
            //             'usia'              => $usia,
            //             'uang_ptg'          => "Rp. ".number_format($uang_pertanggungan,0,'.','.'),
            //             'premi'             => "Rp. ".number_format($premi,0,'.','.'),
            //             'list_dok_cbc'      => $option,
            //             'id_ptg'            => $id_data_per,
            //             'jml_dok'           => $jml_dok,
            //             'id_asuransi'       => $id_asuransi,
            //             'masa_asuransi'     => $masa_asuransi
            //             ];

            // $dt_json    = [ 'id_data_ptg'   => $id_data_per,
            //                 'menu'          => 'Pertanggungan',
            //                 'page'          => 'Hasil PTG',
            //                 'nama_debitur'  => $nama_debitur,
            //                 'nik'           => $nik,
            //                 'usia'          => $usia,
            //                 'kode_ttg'      => $kode_ttg,
            //                 'jenis_ptg'     => $jenis_ptg,
            //                 'jenis_resiko'  => $jenis_resiko
            //               ];

            // $this->template->load('layout/template', 'pertanggungan/V_hasil', $dt_json);

            redirect("C_pertanggungan/tampilan_hasil/$id_data_per", 'refresh');
            
        }

        // 23-03-2021
        public function tampil_dokumen_ptg()
        {
            $id_ptg = $this->input->post('id_ptg');

            $list = $this->M_tanggungan->cari_dokumen_ptg($id_ptg)->result_array();

            // cari data
            $cr = $this->M_master->cari_data('pertanggungan', ['id_pertanggungan' => $id_ptg])->row_array();

            $no =1;
            foreach ($list as $v) {
                $tbody = array();

                if ($v['flag_validasi'] == 1) {
                    $ck = 'checked';
                } else {
                    $ck = '';
                }

                if ($v['dokumen'] == null) {
                    $hd = 'hidden';
                } else {
                    $hd = '';
                }

                if ($cr['id_status_lengkap_dokumen'] == 4 || $cr['id_status_lengkap_dokumen'] == 5) {
                    $dis = 'disabled';
                } else {
                    $dis = '';
                }

                $tbody[] = "<div align='center'>".$no++.".</div>";
                $tbody[] = ucwords($v['nama_dokumen']);
                $tbody[] = "<button type='button' class='btn btn-primary btn-sm mr-2 upload' data-id='".$v['id_dokumen']."' jenis_dok='".ucwords($v['nama_dokumen'])."' id_ptg='".$id_ptg."' $dis>Upload</button><button type='button' class='btn btn-danger btn-sm mr-2 remove' data-id='".$v['id_dokumen']."' jenis_dok='".ucwords($v['nama_dokumen'])."' id_ptg='".$id_ptg."' status_jenis_dok='ptg' $hd $dis>Remove</button>";
                $tbody[] = "<a href='".base_url()."C_pertanggungan/download_dokumen_ptg/".$v['id_dokumen']."'><i class='fa fa-file-text-o fa-2x' $hd></i></a>";
                $tbody[] = "<input type='checkbox' name='validasi[]' value='".$v['id_dokumen']."' $ck $hd $dis>";
                $data[]  = $tbody; 
            }

            if ($list) {
                echo json_encode(array('data'=> $data));
            }else{
                echo json_encode(array('data'=> 0));
            }
            
        }

        // 23-03-2021
        public function download_dokumen_ptg($id_dok)
        {
            $cr = $this->M_master->cari_data('dokumen', ['id_dokumen' => $id_dok])->row_array();

            force_download("uploads/dokumen_tertanggung/".$cr['dokumen'],NULL);
        }

        // 23-03-2021
        public function download_dokumen_cbc($id_dok)
        {
            $cr = $this->M_master->cari_data('dokumen_cbc', ['id_dokumen_cbc' => $id_dok])->row_array();

            force_download("uploads/dokumen_cbc/".$cr['dokumen'],NULL);
        }

        // 26-03-2021
        public function download_dokumen_tambahan($id_dok)
        {
            $cr = $this->M_master->cari_data('dokumen_tambahan', ['id_dokumen_tambahan' => $id_dok])->row_array();

            force_download("uploads/dokumen_tambahan/".$cr['dokumen'],NULL);
        }

        // 23-03-2021
        public function simpan_validasi_dok()
        {
            $validasi   = $this->input->post('validasi');
            $cbc        = $this->input->post('cbc');
            $tambahan   = $this->input->post('tambahan');
            $id_ptg     = $this->input->post('id_ptg');

            // cari status dokumen
            $cr_st           = $this->M_master->cari_data('pertanggungan', ['id_pertanggungan' => $id_ptg])->row_array();
            $sts_lengkap_dok = $cr_st['id_status_lengkap_dokumen'];
            
            if ($sts_lengkap_dok == 5) {

                $cr = $this->M_tanggungan->cari_id_resiko_ptg($id_ptg)->result_array();

                foreach ($cr as $r) {
                    $this->db->update('dokumen_tambahan', ['flag_validasi'  => 0], ['id_resiko_ptg' => $r['id_resiko_ptg']]); 
                } 

                foreach ($tambahan as $t) {
                    $this->db->update('dokumen_tambahan', ['flag_validasi'  => 1], ['id_dokumen_tambahan' => $t]);                
                }

            } else {

                $this->db->update('dokumen', ['flag_validasi'  => 0], ['id_pertanggungan' => $id_ptg]);
                foreach ($validasi as $v) {
                    $this->db->update('dokumen', ['flag_validasi'  => 1], ['id_dokumen' => $v]);
                }

                // cari yg belum validasi
                $ca = $this->M_master->cari_data('dokumen', ['flag_validasi' => 0, 'id_pertanggungan' => $id_ptg])->num_rows();

                // cari id resiko ptg
                $cr = $this->M_tanggungan->cari_id_resiko_ptg($id_ptg)->result_array();

                foreach ($cr as $r) {
                    $this->db->update('dokumen_cbc', ['flag_validasi'  => 0], ['id_resiko_ptg' => $r['id_resiko_ptg']]);
                }

                foreach ($cbc as $c) {
                    $this->db->update('dokumen_cbc', ['flag_validasi'  => 1], ['id_dokumen_cbc' => $c]);                
                }
                
            }

            $isi_valid = [];
            foreach ($cr as $e) {

                $cg = $this->M_master->cari_data('dokumen_cbc', ['flag_validasi' => 0, 'id_resiko_ptg' => $e['id_resiko_ptg']])->num_rows();

                if ($cg > 0) {
                    array_push($isi_valid, $cg);
                }
                
            }

            $isi_dok_t = [];
            if ($sts_lengkap_dok == 5) {
                foreach ($cr as $f) {

                    $cf = $this->M_master->cari_data('dokumen_tambahan', ['flag_validasi' => 0, 'id_resiko_ptg' => $f['id_resiko_ptg']])->num_rows();
    
                    if ($cf > 0) {
                        array_push($isi_dok_t, $cf);
                    }
                    
                }
            }

            if ($ca == 0) {
                if (empty($isi_valid)) {
                    // ubah status validasi dokumen
                    if ($sts_lengkap_dok == 5) {
                        if (empty($isi_dok_t)) {
                            $val = 1;
                            $fwd = 1;
                        } else {
                            $val = 0;
                            $fwd = 1;
                        }
                    } else {
                        $val = 1;
                        $fwd = 0;
                    }

                    $this->M_master->ubah_data('pertanggungan', ['validasi_dokumen' => $val, 'forward_asuransi' => $fwd], ['id_pertanggungan' => $id_ptg]);

                } else {
                    $this->M_master->ubah_data('pertanggungan', ['validasi_dokumen' => 0, 'forward_asuransi' => 0], ['id_pertanggungan' => $id_ptg]);
                }
            } else {
                $this->M_master->ubah_data('pertanggungan', ['validasi_dokumen' => 0, 'forward_asuransi' => 0], ['id_pertanggungan' => $id_ptg]);
            }

            redirect("C_pertanggungan/kelengkapan_dokumen/$id_ptg");
        }

        public function tampilan_hasil($id_data_per)
        {
            $cr = $this->M_tanggungan->cari_data_ptg($id_data_per)->row_array();

            $kd = $cr['kode_tertanggung'];

            $dt = $this->M_tanggungan->cari_pks_bpr($kd)->row_array();

            $data = [   'menu'          => 'Pertanggungan',
                        'page'          => 'Tambah PTG',
                        'id_data_ptg'   => $id_data_per,
                        'ptg'           => $cr,
                        'kd_ptg'        => $kd,
                        'jenis_ptg'     => $this->M_tanggungan->cari_jenis_ptg($kd)->result_array(),
                        'jenis_resiko'  => $this->M_tanggungan->cari_jenis_resiko_2($kd)->result_array(),
                        'nomor_pks'     => $dt['nomor_pks'],
                        'nama_bpr'      => $dt['nama_bpr'],
                        'id_pks'        => $dt['id_pks'],
                        'id_bpr'        => $dt['id_bpr']
                    ];

            $this->template->load('layout/template', 'pertanggungan/V_hasil', $data);
        }

        // aksi simpan debitur
        public function simpan_data_debitur()
        {
            $aksi                   = $this->input->post('aksi');
            $id_debitur             = $this->input->post('id_debitur');
            $aksi_tambah_debitur    = $this->input->post('aksi_tambah_debitur');
            $id_pertanggungan       = $this->input->post('id_pertanggungan');

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

            $a  = strtoupper(bin2hex(random_bytes(2)));

            $dt = date("dmy", now('Asia/Jakarta'));
    
            $kode = "TTG$dt$a";

            if ($aksi_tambah_debitur == 'tambah_debitur') {

                $this->M_master->input_data('m_debitur', $data);
                
                $last_id_deb = $this->db->insert_id();

                if ($id_pertanggungan != '') {
                    $this->M_master->ubah_data('pertanggungan', array('id_debitur' => $last_id_deb), array('id_pertanggungan' => $id_pertanggungan));
                } else {
                   $this->M_master->input_data('pertanggungan', array('id_debitur' => $last_id_deb, 'kode_tertanggung' => $kode)); 
                }

            } else {

                // TTG020821JJUL

                $dt     = date("dmy", now('Asia/Jakarta'));

                $kode   = "TTG$dt$a";

                if ($id_pertanggungan != '') {
                    $this->M_master->ubah_data('pertanggungan', $data, array('id_pertanggungan' => $id_pertanggungan));
                } else {
                    $this->M_master->input_data('pertanggungan', array('id_debitur' => $id_debitur, 'kode_tertanggung' => $kode));
                }

            }

                

            $id_tanggungan = $this->db->insert_id();

            // if ($aksi == 'Tambah') {
            //     $this->M_master->input_data('m_debitur', $data);
            // } elseif ($aksi == 'Ubah') {
            //     $this->M_master->ubah_data('m_debitur', $data, array('id_debitur' => $id_debitur));
            // } elseif ($aksi == 'Hapus') {
            //     $this->M_master->hapus_data('m_debitur', array('id_debitur' => $id_debitur));
            // }

            echo json_encode(['id_tanggungan' => $id_tanggungan]);
            
        }

    // 07-05-2020

        // aksi hapus pertanggungan 
        public function hapus_tanggungan()
        {
            $id_pertanggungan = $this->input->post('id_tanggungan');
            $kode_tertanggung = $this->input->post('kode_tertanggung');

            // $this->db->trans_begin();
            // $rst1=  $this->utils->insert_function($data);
            // $rst2 =  $this->utils->update_function2($test);
            // if($this->db->trans_status() === FALSE || !isset($rst1) || !isset($rst2)){
            // $this->db->trans_rollback();
            // }else{
            // $this->db->trans_commit();
            // }
            
            $this->db->trans_begin();

            // cari
            $ca = $this->M_master->cari_data('dokumen', ['id_pertanggungan' => $id_pertanggungan])->result_array();

            foreach ($ca as $c) {
                $dok = $c['dokumen'];

                if ($dok) {
                    $path = "./uploads/dokumen_tertanggung/".$dok;
                    unlink($path); 
                }
                
            }

            $this->M_master->hapus_data('dokumen', array('id_pertanggungan' => $id_pertanggungan));

            // cari id resiko ptg
            $cr = $this->M_tanggungan->cari_id_resiko_ptg($id_pertanggungan)->result_array();

            foreach ($cr as $r) {

                // cari pada dokumen
                $cdo = $this->M_master->cari_data('dokumen_cbc', ['id_resiko_ptg' => $r['id_resiko_ptg']])->result_array();

                foreach ($cdo as $cc) {
                    $dok_p = $cc['dokumen'];
                    
                    if ($dok_p) {
                        $path_p = "./uploads/dokumen_cbc/".$dok_p;
                        unlink($path_p); 
                    }
                    
                }

                $this->M_master->hapus_data('dokumen_cbc', array('id_resiko_ptg' => $r['id_resiko_ptg']));

                // cari pada dokumen
                $cdt = $this->M_master->cari_data('dokumen_tambahan', ['id_resiko_ptg' => $r['id_resiko_ptg']])->result_array();

                if (!empty($cdt)) {
                    foreach ($cdt as $t) {
                        $dok_pt = $t['dokumen'];
                        
                        if ($dok_pt) {
                            $path_pt = "./uploads/dokumen_tambahan/".$dok_pt;
                            unlink($path_pt); 
                        }
                        
                    } 

                    $this->M_master->hapus_data('dokumen_cbc', array('id_resiko_ptg' => $r['id_resiko_ptg']));
                }

            }

            $this->M_master->hapus_data('pertanggungan', array('id_pertanggungan' => $id_pertanggungan));
            $this->M_master->hapus_data('tr_resiko_ptg', array('kode_tertanggung' => $kode_tertanggung));

            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }

            echo json_encode(['status' => TRUE]);
        }

        // simpan data asuransi
        public function simpan_data_asuransi()
        {
            $aksi               = $this->input->post('aksi');
            $id_pertanggungan   = $this->input->post('id_pertanggungan');

            $data = ['uang_pertanggungan'           => $this->input->post('uang_pertanggungan'),
                     'id_jenis_kredit'              => $this->input->post('id_jenis_kredit'),
                     'id_jenis_tanggung'            => $this->input->post('id_jenis_tanggung'),
                     'masa_asuransi'                => $this->input->post('masa_asuransi'),
                     'periode_asuransi_akhir'       => $this->input->post('periode_asuransi_akhir'),
                     'periode_asuransi_awal'        => $this->input->post('periode_asuransi_awal'),
                     'cara_bayar'                   => $this->input->post('cara_bayar'),
                     'kredit_bank'                  => $this->input->post('kredit_bank'),
                     'ahli_waris'                   => $this->input->post('ahli_waris'),
                     'hubungan_ahli_waris'          => $this->input->post('hubungan_ahli_waris'),
                     'tanya_data_asuransi'          => $this->input->post('tanya_data_asuransi'),
                     'tanya_data_asuransi_jelaskan' => $this->input->post('tanya_data_asuransi_jelaskan'),
                     'add_time'                     => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($id_pertanggungan != '') {
                $this->M_master->ubah_data('pertanggungan', $data, array('id_pertanggungan' => $id_pertanggungan));
            } else {
                $this->M_master->input_data('pertanggungan', $data);

                $id_pertanggungan = $this->db->insert_id();
            }

            echo json_encode(['id_tanggungan' => $id_pertanggungan]);

        }

    // 13-05-2020
        
        // menampilkan detail debitur 
        public function ambil_detail_debitur()
        {
            $id_debitur = $this->input->post('id_debitur');

            // cari data
            $cari = $this->M_master->cari_data('m_debitur', array('id_debitur' => $id_debitur))->row_array();

            // rumah
            if ($cari['provinsi_rumah'] != null) {
                $prov_rumah  = $this->M_master->cari_data('m_provinsi', array('id_provinsi' => $cari['provinsi_rumah']))->row_array();
                $prov_r = $prov_rumah['nama_provinsi'];
            } else {
                $prov_r = "-";
            }

            if ($cari['kota_kab_rumah'] != null) {
                $kab_rumah   = $this->M_master->cari_data('m_kota_kab', array('id_kota_kab' => $cari['kota_kab_rumah']))->row_array();
                $kab_r = $kab_rumah['nama_kota_kab'];
            } else {
                $kab_r = "-";
            }
            
            if ($cari['kecamatan_rumah'] != null) {
                $kec_rumah   = $this->M_master->cari_data('m_kecamatan', array('id_kecamatan' => $cari['kecamatan_rumah']))->row_array();
                $kec_r = $kec_rumah['nama_kecamatan'];
            } else {
                $kec_r = "-";
            }
            

            // korespondensi
            if ($cari['provinsi_korespondensi'] != null) {
                $prov_korespon  = $this->M_master->cari_data('m_provinsi', array('id_provinsi' => $cari['provinsi_korespondensi']))->row_array();
                $prov_ko = $prov_korespon['nama_provinsi'];
            } else {
                $prov_ko = "-";
            }

            if ($cari['kota_kab_korespondensi'] != null) {
                $kab_korespon   = $this->M_master->cari_data('m_kota_kab', array('id_kota_kab' => $cari['kota_kab_korespondensi']))->row_array();
                $kab_ko = $kab_korespon['nama_kota_kab'];
            } else {
                $kab_ko = "-";
            }

            if ($cari['kecamatan_korespondensi'] != null) {
                $kec_korespon   = $this->M_master->cari_data('m_kecamatan', array('id_kecamatan' => $cari['kecamatan_korespondensi']))->row_array();
                $kec_ko = $kec_korespon['nama_kecamatan'];
            } else {
                $kec_ko = "-";
            }
            

            // kantor
            if ($cari['provinsi_kantor'] != null) {
                $prov_kantor  = $this->M_master->cari_data('m_provinsi', array('id_provinsi' => $cari['provinsi_kantor']))->row_array();
                $prov_ka = $prov_kantor['nama_provinsi'];
            } else {
                $prov_ka = "-";
            }

            if ($cari['kota_kab_kantor'] != null) {
                $kab_kantor   = $this->M_master->cari_data('m_kota_kab', array('id_kota_kab' => $cari['kota_kab_kantor']))->row_array();
                $kab_ka = $kab_kantor['nama_kota_kab'];
            } else {
                $kab_ka = "-";
            }

            if ($cari['kecamatan_kantor'] != null) {
                $kec_kantor   = $this->M_master->cari_data('m_kecamatan', array('id_kecamatan' => $cari['kecamatan_kantor']))->row_array();
                $kec_ka = $kec_kantor['nama_kecamatan'];
            } else {
                $kec_ka = "-";
            }
            

            $dt = [ 'provinsi_rumah'    => $prov_r,
                    'kota_kab_rumah'    => $kab_r,
                    'kecamatan_rumah'   => $kec_r,
                    'provinsi_korespon' => $prov_ko,
                    'kota_kab_korespon' => $kab_ko,
                    'kecamatan_korespon'=> $kec_ko,
                    'provinsi_kantor'   => $prov_ka,
                    'kota_kab_kantor'   => $kab_ka,
                    'kecamatan_kantor'  => $kec_ka
                  ];

            array_push($cari, $dt);
            
            echo json_encode($cari);
        }

        // mencari untuk ajax
        public function cari_data_provinsi()
        {
            $id = $this->input->post('id');
            
            $prov = $this->M_master->cari_data('m_provinsi', array('id_provinsi' => $id))->row_array();

            echo json_encode(['provinsi' => $prov['nama_provinsi']]);
        }

        // simpan keterangan sehat
        public function simpan_ket_sehat()
        {
            $aksi               = $this->input->post('aksi');
            $id_pertanggungan   = $this->input->post('id_pertanggungan');

            $data = ['tinggi_badan'         => $this->input->post('tinggi_badan'),
                     'berat_badan'          => $this->input->post('berat_badan'),
                     'tanya_kesehatan_1'    => $this->input->post('tanya_kesehatan_1'),
                     'tanya_kesehatan_2'    => $this->input->post('tanya_kesehatan_2'),
                     'tanya_kesehatan_3'    => $this->input->post('tanya_kesehatan_3'),
                     'tanya_hamil'          => $this->input->post('tanya_hamil'),
                     'hamil_anak_ke'        => $this->input->post('hamil_anak_ke'),
                     'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                    ];

            if ($id_pertanggungan != '') {
                $this->M_master->ubah_data('pertanggungan', $data, array('id_pertanggungan' => $id_pertanggungan));
            } else {
                $this->M_master->input_data('pertanggungan', $data);

                $id_pertanggungan = $this->db->insert_id();
            }

            echo json_encode(['id_tanggungan' => $id_pertanggungan]);

        }

    // 28-04-2020
        
        // menampilkan data monitoring pertanggungan
        public function monitoring_pertanggungan()
        {
            $data = ['menu' => 'Monitoring Pertanggungan',
                     'page' => 'Monitoring Pertanggungan'
                    ];
        
            $this->template->load('layout/template', 'pertanggungan/V_mon_pertanggungan', $data);
        }

    // 08-02-2021
    public function terbit_polis()
    {
        $data = ['menu'         => 'Pertanggungan',
                 'page'         => 'Terbit Polish',
                ];
    
        $this->template->load('layout/template', 'pertanggungan/polish/V_terbit_polish', $data);
    }

    // 30-03-2021
    public function tampil_polish()
    {
        $list = $this->M_tanggungan->get_data_polish_total();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $this->db->select('p.id_pertanggungan, p.kode_tertanggung');
            $this->db->from('pertanggungan as p');
            $this->db->join('m_debitur as d', 'id_debitur', 'inner');
            $this->db->join('tr_resiko_ptg as e', 'kode_tertanggung', 'inner');
            $this->db->join('tr_polish as g', 'id_resiko_ptg', 'inner');
            $this->db->where('d.id_pks', $o['id_pks']);

            $a = $this->db->get()->result_array();

            $form = "<form method='POST' action='".base_url("C_pertanggungan/lihat_debitur_approve")."'> <input type='hidden' name='id_pks' value='".$o['id_pks']."'> <input type='hidden' name='id_bpr' value='".$o['id_bpr']."'> <input type='hidden' name='nomor_pks' value='".$o['nomor_pks']."'> <input type='hidden' name='nama_bpr' value='".$o['nama_bpr']."'> <button type='submit' class='btn lihat-debitur1' style='background-color: #02a4af; color:white;'>Lihat Debitur</button></form>";

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nomor_pks'];
            $tbody[]    = $o['nama_bpr'];
            $tbody[]    = "<div align='center'>".count($a)."</div>";
            $tbody[]    = $form;
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_tanggungan->jumlah_semua_polish_total(),
                    "recordsFiltered"  => $this->M_tanggungan->jumlah_filter_polish_total(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 30-03-2021
    public function lihat_debitur_approve()
    {
        $id_pks     = $this->input->post('id_pks');
        $id_bpr     = $this->input->post('id_bpr');
        $nomor_pks  = $this->input->post('nomor_pks');
        $nama_bpr   = $this->input->post('nama_bpr');
        
        $data = [   'menu'      => 'Pertanggungan',
                    'page'      => 'Lihat Debitur Approve',
                    'id_pks'    => $id_pks,
                    'id_bpr'    => $id_bpr,
                    'nomor_pks' => $nomor_pks,
                    'nama_bpr'  => $nama_bpr
                ];
        
        $this->template->load('layout/template', 'pertanggungan/V_detail_deb_approve', $data);
    }

    // 30-03-2021
    public function tampil_detail_debitur_approve()
    {
        $list = $this->M_tanggungan->get_data_debitur_polish();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['kode_tertanggung'];
            $tbody[]    = $o['nama_lengkap'];
            $tbody[]    = $o['certified_number'];
            $tbody[]    = $o['uang_ptg'];
            $tbody[]    = $o['premi'];
            $tbody[]    = $o['status_cash'];
            $tbody[]    = $o['jenis_tanggung'];
            $tbody[]    = $o['jenis_resiko'];
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_tanggungan->jumlah_semua_debitur_polish(),
                    "recordsFiltered"  => $this->M_tanggungan->jumlah_filter_debitur_polish(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }
    
}

/* End of file C_pertanggungan.php */
