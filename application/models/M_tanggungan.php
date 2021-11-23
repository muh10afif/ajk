<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tanggungan extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->id_level     = $this->session->userdata('id_level');
        $this->id_asuransi  = $this->session->userdata('id_asuransi');
        $this->id_bpr       = $this->session->userdata('id_bpr');
    }

    // 06-05-2020
        
        // data tertanggung awal
            // Menampilkan list tertanggung_total
            public function get_data_tertanggung_total()
            {
                $this->_get_datatables_query_tertanggung_total();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_tertanggung_total = [null, 'p.nomor_pks', 'b.nama_bpr'];
            var $kolom_cari_tertanggung_total  = ['LOWER(p.nomor_pks)', 'LOWER(b.nama_bpr)'];
            var $order_tertanggung_total       = ['p.nomor_pks' => 'desc'];

            public function _get_datatables_query_tertanggung_total()
            {
                // $this->db->select('s.id_spk, b.id_bpr, s.no_spk, b.nama_bpr, (SELECT count(p.id_debitur) as tot_debitur FROM pertanggungan as p JOIN m_debitur as d ON d.id_debitur = p.id_debitur WHERE d.id_spk = s.id_spk)');
                // $this->db->from('m_spk as s');
                // $this->db->join('m_bpr as b', 's.id_bpr = b.id_bpr', 'inner'); 

                $this->db->select('p.nomor_pks, b.id_bpr, b.nama_bpr, p.id_pks');
                $this->db->from('tr_pks as p');
                $this->db->join('tr_penawaran as r', 'id_penawaran', 'inner');
                $this->db->join('m_bpr as b', 'id_bpr', 'inner');

                if ($this->id_level == 4) {
                    $this->db->where('r.id_asuransi', $this->id_asuransi);
                }
                if ($this->id_level == 3) {
                    $this->db->where('b.id_bpr', $this->id_bpr);
                }
                
                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_tertanggung_total;

                foreach ($kolom_cari as $cari) {
                    if ($input_cari) {
                        if ($b === 0) {
                            $this->db->group_start();
                            $this->db->like($cari, $input_cari);
                        } else {
                            $this->db->or_like($cari, $input_cari);
                        }

                        if ((count($kolom_cari) - 1) == $b ) {
                            $this->db->group_end();
                        }
                    }

                    $b++;
                }

                if (isset($_POST['order'])) {

                    $kolom_order = $this->kolom_order_tertanggung_total;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_tertanggung_total)) {
                    
                    $order = $this->order_tertanggung_total;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_tertanggung_total()
            {
                $this->db->select('p.nomor_pks, b.id_bpr, b.nama_bpr, p.id_pks');
                $this->db->from('tr_pks as p');
                $this->db->join('tr_penawaran as r', 'id_penawaran', 'inner');
                $this->db->join('m_bpr as b', 'id_bpr', 'inner');

                if ($this->id_level == 4) {
                    $this->db->where('r.id_asuransi', $this->id_asuransi);
                }
                if ($this->id_level == 3) {
                    $this->db->where('b.id_bpr', $this->id_bpr);
                }

                return $this->db->count_all_results();
            }

            public function jumlah_filter_tertanggung_total()
            {
                $this->_get_datatables_query_tertanggung_total();

                return $this->db->get()->num_rows();
                
            }


        // master debitur
            // Menampilkan list debitur
            public function get_data_debitur()
            {
                $this->_get_datatables_query_debitur();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_debitur = [null,'p.kode_tertanggung', 'd.nama_lengkap'];
            var $kolom_cari_debitur  = ['LOWER(p.kode_tertanggung)', 'LOWER(d.nama_lengkap)'];
            var $order_debitur       = ['p.kode_tertanggung' => 'desc'];

            public function _get_datatables_query_debitur()
            {
                // $this->db->select('p.id_pertanggungan, p.kode_tertanggung, p.uang_pertanggungan, d.nama_lengkap, s.status_cash, l.status_lengkap_dokumen');
                // $this->db->from('pertanggungan as p');
                // $this->db->join('m_debitur as d', 'id_debitur', 'inner');
                // $this->db->join('m_status_cash as s', 'id_status_cash', 'inner');
                // $this->db->join('m_status_lengkap_dokumen as l', 'id_status_lengkap_dokumen', 'inner');
                
                // $id_spk = $this->input->post('id_spk');

                // if ($id_spk) {
                //     $this->db->where('d.id_pks', $id_spk);
                // }

                $this->db->select("p.id_pertanggungan, p.kode_tertanggung, d.nama_lengkap, string_agg(DISTINCT jp.jenis_produk, ', ') jenis_produk, string_agg(DISTINCT jt.jenis_tanggung, ', ') jenis_tanggung, string_agg(DISTINCT jr.jenis_resiko, ', ') jenis_resiko, ld.status_lengkap_dokumen, st.id_status_tertanggung, st.status_tertanggung, sum(t.uang_ptg) as total_uang_ptg, p.forward_asuransi, p.validasi_dokumen, p.id_status_lengkap_dokumen");
                $this->db->from('pertanggungan as p');
                $this->db->join('m_status_lengkap_dokumen as ld', 'id_status_lengkap_dokumen', 'inner');
                $this->db->join('m_status_tertanggung as st', 'id_status_tertanggung', 'inner');
                $this->db->join('m_debitur as d', 'id_debitur', 'inner');
                $this->db->join('tr_resiko_ptg as t', 'kode_tertanggung', 'inner');
                $this->db->join('m_jenis_produk as jp', 'id_jenis_produk', 'inner');
                $this->db->join('m_jenis_resiko as jr', 'id_jenis_resiko', 'inner');
                $this->db->join('m_jenis_tanggung as jt', 'id_jenis_tanggung', 'inner');
                $this->db->group_by('d.id_debitur');
                $this->db->group_by('p.id_pertanggungan');
                $this->db->group_by('ld.id_status_lengkap_dokumen');
                $this->db->group_by('st.id_status_tertanggung');
                $this->db->where('d.id_pks', $this->input->post('id_pks'));
                
                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_debitur;

                foreach ($kolom_cari as $cari) {
                    if ($input_cari) {
                        if ($b === 0) {
                            $this->db->group_start();
                            $this->db->like($cari, $input_cari);
                        } else {
                            $this->db->or_like($cari, $input_cari);
                        }

                        if ((count($kolom_cari) - 1) == $b ) {
                            $this->db->group_end();
                        }
                    }

                    $b++;
                }

                if (isset($_POST['order'])) {

                    $kolom_order = $this->kolom_order_debitur;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_debitur)) {
                    
                    $order = $this->order_debitur;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_debitur()
            {
                $this->db->select("p.id_pertanggungan, p.kode_tertanggung, d.nama_lengkap, string_agg(DISTINCT jp.jenis_produk, ', ') jenis_produk, string_agg(DISTINCT jt.jenis_tanggung, ', ') jenis_tanggung, string_agg(DISTINCT jr.jenis_resiko, ', ') jenis_resiko, ld.status_lengkap_dokumen, st.id_status_tertanggung, st.status_tertanggung, sum(t.uang_ptg) as total_uang_ptg, p.forward_asuransi, p.validasi_dokumen, p.id_status_lengkap_dokumen");
                $this->db->from('pertanggungan as p');
                $this->db->join('m_status_lengkap_dokumen as ld', 'id_status_lengkap_dokumen', 'inner');
                $this->db->join('m_status_tertanggung as st', 'id_status_tertanggung', 'inner');
                $this->db->join('m_debitur as d', 'id_debitur', 'inner');
                $this->db->join('tr_resiko_ptg as t', 'kode_tertanggung', 'inner');
                $this->db->join('m_jenis_produk as jp', 'id_jenis_produk', 'inner');
                $this->db->join('m_jenis_resiko as jr', 'id_jenis_resiko', 'inner');
                $this->db->join('m_jenis_tanggung as jt', 'id_jenis_tanggung', 'inner');
                $this->db->group_by('d.id_debitur');
                $this->db->group_by('p.id_pertanggungan');
                $this->db->group_by('ld.id_status_lengkap_dokumen');
                $this->db->group_by('st.id_status_tertanggung');
                $this->db->where('d.id_pks', $this->input->post('id_pks'));

                return $this->db->count_all_results();
            }

            public function jumlah_filter_debitur()
            {
                $this->_get_datatables_query_debitur();

                return $this->db->get()->num_rows();
                
            }

            // 24-03-2021
            public function get_data_debitur_as()
            {
                $this->_get_datatables_query_debitur_as();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_debitur_as = [null, 'p.kode_tertanggung', 'd.nama_lengkap', 'total_uang_ptg', 'jenis_tanggung', 'jenis_resiko'];
            var $kolom_cari_debitur_as  = ['LOWER(p.kode_tertanggung)', 'LOWER(d.nama_lengkap)'];
            var $order_debitur_as       = ['p.kode_tertanggung' => 'desc'];

            public function _get_datatables_query_debitur_as()
            {
                $this->db->select("p.id_pertanggungan, p.kode_tertanggung, d.nama_lengkap, string_agg(DISTINCT jp.jenis_produk, ', ') jenis_produk, string_agg(DISTINCT jt.jenis_tanggung, ', ') jenis_tanggung, string_agg(DISTINCT jr.jenis_resiko, ', ') jenis_resiko, ld.status_lengkap_dokumen, st.status_tertanggung, sum(t.uang_ptg) as total_uang_ptg, p.forward_asuransi, p.validasi_dokumen");
                $this->db->from('pertanggungan as p');
                $this->db->join('m_status_lengkap_dokumen as ld', 'id_status_lengkap_dokumen', 'inner');
                $this->db->join('m_status_tertanggung as st', 'id_status_tertanggung', 'inner');
                $this->db->join('m_debitur as d', 'id_debitur', 'inner');
                $this->db->join('tr_resiko_ptg as t', 'kode_tertanggung', 'inner');
                $this->db->join('m_jenis_produk as jp', 'id_jenis_produk', 'inner');
                $this->db->join('m_jenis_resiko as jr', 'id_jenis_resiko', 'inner');
                $this->db->join('m_jenis_tanggung as jt', 'id_jenis_tanggung', 'inner');
                $this->db->group_by('d.id_debitur');
                $this->db->group_by('p.id_pertanggungan');
                $this->db->group_by('ld.id_status_lengkap_dokumen');
                $this->db->group_by('st.id_status_tertanggung');
                $this->db->where('d.id_pks', $this->input->post('id_pks'));

                if ($this->id_level == 4) {
                    $this->db->where('p.forward_asuransi', 1);
                }
                
                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_debitur_as;

                foreach ($kolom_cari as $cari) {
                    if ($input_cari) {
                        if ($b === 0) {
                            $this->db->group_start();
                            $this->db->like($cari, $input_cari);
                        } else {
                            $this->db->or_like($cari, $input_cari);
                        }

                        if ((count($kolom_cari) - 1) == $b ) {
                            $this->db->group_end();
                        }
                    }

                    $b++;
                }

                if (isset($_POST['order'])) {

                    $kolom_order = $this->kolom_order_debitur_as;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_debitur_as)) {
                    
                    $order = $this->order_debitur_as;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_debitur_as()
            {
                $this->db->select("p.id_pertanggungan, p.kode_tertanggung, d.nama_lengkap, string_agg(DISTINCT jp.jenis_produk, ', ') jenis_produk, string_agg(DISTINCT jt.jenis_tanggung, ', ') jenis_tanggung, string_agg(DISTINCT jr.jenis_resiko, ', ') jenis_resiko, ld.status_lengkap_dokumen, st.status_tertanggung, sum(t.uang_ptg) as total_uang_ptg, p.forward_asuransi, p.validasi_dokumen");
                $this->db->from('pertanggungan as p');
                $this->db->join('m_status_lengkap_dokumen as ld', 'id_status_lengkap_dokumen', 'inner');
                $this->db->join('m_status_tertanggung as st', 'id_status_tertanggung', 'inner');
                $this->db->join('m_debitur as d', 'id_debitur', 'inner');
                $this->db->join('tr_resiko_ptg as t', 'kode_tertanggung', 'inner');
                $this->db->join('m_jenis_produk as jp', 'id_jenis_produk', 'inner');
                $this->db->join('m_jenis_resiko as jr', 'id_jenis_resiko', 'inner');
                $this->db->join('m_jenis_tanggung as jt', 'id_jenis_tanggung', 'inner');
                $this->db->group_by('d.id_debitur');
                $this->db->group_by('p.id_pertanggungan');
                $this->db->group_by('ld.id_status_lengkap_dokumen');
                $this->db->group_by('st.id_status_tertanggung');
                $this->db->where('d.id_pks', $this->input->post('id_pks'));

                if ($this->id_level == 4) {
                    $this->db->where('p.forward_asuransi', 1);
                }

                return $this->db->count_all_results();
            }

            public function jumlah_filter_debitur_as()
            {
                $this->_get_datatables_query_debitur_as();

                return $this->db->get()->num_rows();
                
            }

        // menampilkan list debitur menurut SPK
        public function get_debitur_tanggungan($id_spk,$id_bpr)
        {
            $this->db->select('*');
            $this->db->from('pertanggungan as p');
            $this->db->join('m_debitur as d', 'd.id_debitur = p.id_debitur', 'inner');
            $this->db->where('d.id_pks', $id_spk);
            
            $a = $this->db->get()->result();
            
            $ay = array();
            foreach ($a as $b) {
                $ay[] = $b->id_debitur;
            }

            $im         = implode(',',$ay);
            $id_debitur = explode(',',$im); 

            $this->db->select('*');
            $this->db->from('m_debitur');
            $this->db->where('id_pks', $id_spk);
            
            if (!empty($a)) {
                $this->db->where_not_in('id_debitur', $id_debitur);
            }
            
            return $this->db->get();
            
        }

    // 16-02-21
    public function cari_data_asuransi($id_pks)
    {
        $this->db->select('e.id_asuransi');
        $this->db->from('tr_pks p');
        $this->db->join('tr_penawaran e', 'id_penawaran', 'inner');
        $this->db->where('p.id_pks', $id_pks);
        
        return $this->db->get();
        
    }

    // 16-02-21
    public function cari_status_udw($kode_udw, $id_pl, $id_um, $id_asuransi)
    {
        $this->db->select('u.status_underwriting, u.id_status_underwriting');
        $this->db->from('tr_underwriting t');
        $this->db->join('m_status_underwriting u', 'id_status_underwriting', 'inner');
        $this->db->where('t.id_plafond', $id_pl);
        $this->db->where('t.id_usia_masuk', $id_um);
        $this->db->where('t.id_asuransi', $id_asuransi);
        $this->db->where('t.kode_underwriting', $kode_udw);
        
        return $this->db->get();
    }

    // 16-02-21
    public function cari_dok_cbc($id_sts_udw, $id_asuransi)
    {
        $this->db->select('u.id_dok_underwriting, d.jenis_dokumen');
        $this->db->from('tr_dok_underwriting u');
        $this->db->join('m_dok_underwriting d', 'id_dok_underwriting', 'inner');
        $this->db->where('u.id_status_underwriting', $id_sts_udw);
        $this->db->where('u.id_asuransi', $id_asuransi);
        $this->db->order_by('u.id_dok_underwriting', 'asc');
        
        return $this->db->get();
        
    }

    // 03-03-2021
    public function cari_id_asuransi($id_pks)
    {
        $this->db->select('i.id_asuransi, i.nama_asuransi');
        $this->db->from('tr_pks as p');
        $this->db->join('tr_penawaran as r', 'id_penawaran', 'inner');
        $this->db->join('m_asuransi as i', 'id_asuransi', 'inner');
        $this->db->where('p.id_pks', $id_pks);
        
        return $this->db->get();
    }

    // 03-03-2021
    public function cari_jenis_produk($id_asuransi)
    {
        $this->db->distinct();
        $this->db->select('p.jenis_produk, p.id_jenis_produk');
        $this->db->from('tr_jenis_resiko as j');
        $this->db->join('m_jenis_produk as p', 'id_jenis_produk', 'inner');
        $this->db->where('j.id_asuransi', $id_asuransi);
        $this->db->order_by('p.id_jenis_produk', 'asc');
        
        return $this->db->get();
        
    }

    // 03-03-2021
    public function cari_jenis_tanggung($id_asuransi)
    {
        $this->db->distinct();
        $this->db->select('p.jenis_tanggung, p.id_jenis_tanggung');
        $this->db->from('tr_jenis_resiko as j');
        $this->db->join('m_jenis_tanggung as p', 'id_jenis_tanggung', 'inner');
        $this->db->where('j.id_asuransi', $id_asuransi);
        $this->db->order_by('p.id_jenis_tanggung', 'asc');
        
        return $this->db->get();
        
    }

    // 03-03-2021
    public function cari_jenis_tanggung_2($id_asuransi, $id_jenis_produk)
    {
        $this->db->distinct();
        $this->db->select('p.jenis_tanggung, p.id_jenis_tanggung');
        $this->db->from('tr_jenis_resiko as j');
        $this->db->join('m_jenis_tanggung as p', 'id_jenis_tanggung', 'inner');
        $this->db->where('j.id_asuransi', $id_asuransi);
        $this->db->where('j.id_jenis_produk', $id_jenis_produk);
        $this->db->order_by('p.id_jenis_tanggung', 'asc');
        
        return $this->db->get();
        
    }

    // 03-03-2021
    public function cari_jenis_resiko($id_asuransi)
    {
        $this->db->distinct();
        $this->db->select('p.jenis_resiko, p.id_jenis_resiko');
        $this->db->from('tr_jenis_resiko as j');
        $this->db->join('m_jenis_resiko as p', 'id_jenis_resiko', 'inner');
        $this->db->where('j.id_asuransi', $id_asuransi);
        $this->db->order_by('p.id_jenis_resiko', 'asc');
        
        return $this->db->get();
        
    }

    // 03-03-2021
    public function cari_jenis_resiko_nol($id_asuransi)
    {
        $this->db->distinct();
        $this->db->select('p.jenis_resiko, p.id_jenis_resiko');
        $this->db->from('tr_jenis_resiko as j');
        $this->db->join('m_jenis_resiko as p', 'id_jenis_resiko', 'inner');
        $this->db->where('j.id_asuransi', $id_asuransi);
        $this->db->where('p.tampil_otomatis', 0);
        $this->db->order_by('p.id_jenis_resiko', 'asc');
        
        return $this->db->get();
        
    }

    // 03-03-2021
    public function cari_kode($wh)
    {
        $this->db->select('k.kode_underwriting, k.kode_tarif_perusia, k.kode_klausul');
        $this->db->from('tr_jenis_resiko as t');
        $this->db->join('tr_klausul as k', 'id_klausul', 'inner');
        $this->db->where('t.id_asuransi', $wh['id_asuransi']);
        $this->db->where('t.id_jenis_produk', $wh['id_jenis_produk']);
        $this->db->where('t.id_jenis_tanggung', $wh['id_jenis_tanggung']);
        $this->db->where('t.id_jenis_resiko', $wh['id_jenis_resiko']);
        
        return $this->db->get();
    }

    // 08-03-2021
    public function cari_data_ptg($id_ptg)
    {
        $this->db->select('d.nama_lengkap, d.nik, d.usia, p.kode_tertanggung, d.id_debitur');
        $this->db->from('pertanggungan as p');
        $this->db->join('m_debitur as d', 'id_debitur', 'inner');
        $this->db->where('id_pertanggungan', $id_ptg);
        
        return $this->db->get();
    }

    // 08-03-2021
    public function cari_jenis_ptg($kode_ptg)
    {
        $this->db->select('t.id_jenis_tanggung, t.jenis_tanggung');
        $this->db->from('tr_resiko_ptg as r');
        $this->db->join('m_jenis_tanggung as t', 'id_jenis_tanggung', 'inner');
        $this->db->where('r.kode_tertanggung', $kode_ptg);
        $this->db->group_by('t.id_jenis_tanggung');

        return $this->db->get();
        
    }

    // 08-03-2021
    public function cari_jenis_resiko_2($kode_ptg)
    {
        $this->db->select('t.id_jenis_resiko, t.jenis_resiko');
        $this->db->from('tr_resiko_ptg as r');
        $this->db->join('m_jenis_resiko as t', 'id_jenis_resiko', 'inner');
        $this->db->where('r.kode_tertanggung', $kode_ptg);
        $this->db->group_by('t.id_jenis_resiko');

        return $this->db->get();
        
    }

    public function cari_jenis_resiko_3($kode_ptg)
    {
        $this->db->select('t.id_jenis_resiko, t.jenis_resiko, r.id_status_cash');
        $this->db->from('tr_resiko_ptg as r');
        $this->db->join('m_jenis_resiko as t', 'id_jenis_resiko', 'inner');
        $this->db->where('r.kode_tertanggung', $kode_ptg);
        $this->db->group_by('t.id_jenis_resiko');
        $this->db->group_by('r.id_status_cash');

        return $this->db->get();
        
    }

    // 08-03-2021
    public function cari_tr_jenis_resiko($kode_ptg, $id_jenis_ttg, $id_jenis_resiko)
    {
        $this->db->select('c.id_status_cash, c.status_cash, s.status_underwriting, r.id_resiko_ptg, r.premi, r.uang_ptg, r.masa_asuransi, r.id_status_cash, r.*');
        $this->db->from('tr_resiko_ptg as r');
        $this->db->join('m_status_cash as c', 'id_status_cash', 'inner');
        $this->db->join('m_status_underwriting as s', 'id_status_underwriting', 'inner');
        $this->db->where('r.kode_tertanggung', $kode_ptg);
        $this->db->where('r.id_jenis_tanggung', $id_jenis_ttg);
        $this->db->where('r.id_jenis_resiko', $id_jenis_resiko);
        
        return $this->db->get();
    }

    // 08-03-2021
    public function cari_dokumen_cbc($id_resiko_ptg)
    {
        $this->db->select('d.jenis_dokumen, c.id_dokumen_cbc, c.*');
        $this->db->from('dokumen_cbc as c');
        $this->db->join('m_dok_underwriting as d', 'id_dok_underwriting', 'inner');
        if ($id_resiko_ptg != '') {
            $this->db->where('c.id_resiko_ptg', $id_resiko_ptg);
        }
        $this->db->order_by('c.id_dokumen_cbc', 'asc');
        
        return $this->db->get();
        
    }

    // 26-03-2021
    public function cari_dokumen_tambahan($id_resiko_ptg)
    {
        $this->db->select('c.*');
        $this->db->from('dokumen_tambahan as c');
        if ($id_resiko_ptg != '') {
            $this->db->where('c.id_resiko_ptg', $id_resiko_ptg);
        }
        $this->db->order_by('c.id_dokumen_tambahan', 'asc');
        
        return $this->db->get();
        
    }

    // 08-03-2021
    public function cari_pks_bpr($kode)
    {
        $this->db->select('k.nomor_pks, b.nama_bpr, k.id_pks, b.id_bpr');
        $this->db->from('pertanggungan as p');
        $this->db->join('m_debitur as d', 'id_debitur', 'inner');
        $this->db->join('tr_pks as k', 'id_pks', 'inner');
        $this->db->join('tr_penawaran as n', 'id_penawaran', 'inner');
        $this->db->join('m_bpr as b', 'id_bpr', 'inner');
        $this->db->where('p.kode_tertanggung', $kode);
        
        return $this->db->get();
    }

    // 23-03-2021
    public function cari_dokumen_ptg($id_ptg)
    {
        $this->db->select('*');
        $this->db->from('dokumen');
        if ($id_ptg) {
            $this->db->where('id_pertanggungan', $id_ptg);
        }
        $this->db->order_by('id_dokumen', 'asc');
        
        
        return $this->db->get();
    }

    // 24-03-2021
    public function cari_id_resiko_ptg($id_ptg)
    {
        $this->db->select('r.id_resiko_ptg');
        $this->db->from('pertanggungan as p');
        $this->db->join('tr_resiko_ptg as r', 'kode_tertanggung', 'inner');
        $this->db->where('p.id_pertanggungan', $id_ptg);
        $this->db->where('r.id_status_cash', 2);
        
        return $this->db->get();
    }

    // 25-03-2021
    public function cari_resiko_ptg($kd_ptg)
    {
        $this->db->select('r.*, j.jenis_produk, t.jenis_tanggung, jr.jenis_resiko, sp.id_status_polish, sp.status_polish, c.status_cash, c.id_status_cash, kr.jenis_kredit');
        $this->db->from('tr_resiko_ptg as r');
        $this->db->join('m_jenis_produk as j', 'id_jenis_produk', 'inner');
        $this->db->join('m_jenis_tanggung as t', 'id_jenis_tanggung', 'inner');
        $this->db->join('m_jenis_resiko as jr', 'id_jenis_resiko', 'inner');
        $this->db->join('m_jenis_kredit as kr', 'id_jenis_kredit', 'inner');
        $this->db->join('m_status_cash as c', 'id_status_cash', 'inner');
        $this->db->join('m_status_polish as sp', 'id_status_polish', 'left');
        $this->db->where('r.kode_tertanggung', $kd_ptg);
        $this->db->order_by('r.id_resiko_ptg', 'asc');
        
        return $this->db->get();
    }

    
    // 25-03-2021
    public function cari_detail_resiko($id_resiko_ptg)
    {
        $this->db->select('r.*, d.nama_lengkap, j.jenis_produk, t.jenis_tanggung, jr.jenis_resiko, sp.id_status_polish, sp.status_polish, c.status_cash, c.id_status_cash, k.jenis_kredit, sd.status_underwriting');
        $this->db->from('tr_resiko_ptg as r');
        $this->db->join('m_debitur as d', 'id_debitur', 'inner');
        $this->db->join('m_jenis_produk as j', 'id_jenis_produk', 'inner');
        $this->db->join('m_jenis_tanggung as t', 'id_jenis_tanggung', 'inner');
        $this->db->join('m_jenis_kredit as k', 'id_jenis_kredit', 'inner');
        $this->db->join('m_jenis_resiko as jr', 'id_jenis_resiko', 'inner');
        $this->db->join('m_status_cash as c', 'id_status_cash', 'inner');
        $this->db->join('m_status_polish as sp', 'id_status_polish', 'left');
        $this->db->join('m_status_underwriting as sd', 'id_status_underwriting', 'inner');
        $this->db->where('r.id_resiko_ptg', $id_resiko_ptg);
        $this->db->order_by('r.id_resiko_ptg', 'asc');
        
        return $this->db->get();
    }

    // 29-03-2021
    public function detail_data_ptg($id_ptg)
    {
        $this->db->select('p.*, s.status_lengkap_dokumen, t.status_tertanggung, d.nama_lengkap, d.id_debitur, p.kode_tertanggung');
        $this->db->from('pertanggungan as p');
        $this->db->join('m_debitur as d', 'id_debitur', 'inner');
        $this->db->join('m_status_lengkap_dokumen as s', 'id_status_lengkap_dokumen', 'inner');
        $this->db->join('m_status_tertanggung as t', 'id_status_tertanggung', 'inner');
        $this->db->where('p.id_pertanggungan', $id_ptg);

        return $this->db->get();
    }

    // 29-03-2021
    public function detail_debitur($id_debitur)
    {
        $this->db->select('d.nama_lengkap, p1.nama_provinsi as t_provinsi_rumah, p2.nama_provinsi as t_provinsi_kantor,  p3.nama_provinsi as t_provinsi_korespondensi, k1.nama_kota_kab as t_kota_kab_rumah, k2.nama_kota_kab as t_kota_kab_kantor, k3.nama_kota_kab as t_kota_kab_korespondensi, c1.nama_kecamatan as t_kecamatan_rumah, c2.nama_kecamatan as t_kecamatan_kantor, c3.nama_kecamatan as t_kecamatan_korespondensi, d.*');
        $this->db->from('m_debitur as d');
        $this->db->join('m_provinsi as p1', 'p1.id_provinsi = d.provinsi_rumah', 'left');
        $this->db->join('m_provinsi as p2', 'p2.id_provinsi = d.provinsi_korespondensi', 'left');
        $this->db->join('m_provinsi as p3', 'p3.id_provinsi = d.provinsi_kantor', 'left');
        $this->db->join('m_kecamatan as c1', 'c1.id_kecamatan = d.kecamatan_rumah', 'left');
        $this->db->join('m_kecamatan as c2', 'c2.id_kecamatan = d.kecamatan_korespondensi', 'left');
        $this->db->join('m_kecamatan as c3', 'c3.id_kecamatan = d.kecamatan_kantor', 'left');
        $this->db->join('m_kota_kab as k1', 'k1.id_kota_kab = d.kota_kab_rumah', 'left');
        $this->db->join('m_kota_kab as k2', 'k2.id_kota_kab = d.kota_kab_korespondensi', 'left');
        $this->db->join('m_kota_kab as k3', 'k3.id_kota_kab = d.kota_kab_kantor', 'left');
        
        $this->db->where('d.id_debitur', $id_debitur);
        
        return $this->db->get();
    }

    // 30-03-2021
    public function get_data_polish_total()
    {
        $this->_get_datatables_query_polish_total();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_polish_total = [null, 'p.nomor_pks', 'b.nama_bpr'];
    var $kolom_cari_polish_total  = ['LOWER(p.nomor_pks)', 'LOWER(b.nama_bpr)'];
    var $order_polish_total       = ['p.nomor_pks' => 'desc'];

    public function _get_datatables_query_polish_total()
    {
        $this->db->select('p.nomor_pks, b.id_bpr, b.nama_bpr, p.id_pks');
        $this->db->from('tr_pks as p');
        $this->db->join('tr_penawaran as r', 'id_penawaran', 'inner');
        $this->db->join('m_bpr as b', 'id_bpr', 'inner');

        if ($this->id_level == 4) {
            $this->db->where('r.id_asuransi', $this->id_asuransi);
        }
        if ($this->id_level == 3) {
            $this->db->where('b.id_bpr', $this->id_bpr);
        }
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_polish_total;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_polish_total;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_polish_total)) {
            
            $order = $this->order_polish_total;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_polish_total()
    {
        $this->db->select('p.nomor_pks, b.id_bpr, b.nama_bpr, p.id_pks');
        $this->db->from('tr_pks as p');
        $this->db->join('tr_penawaran as r', 'id_penawaran', 'inner');
        $this->db->join('m_bpr as b', 'id_bpr', 'inner');

        if ($this->id_level == 4) {
            $this->db->where('r.id_asuransi', $this->id_asuransi);
        }
        if ($this->id_level == 3) {
            $this->db->where('b.id_bpr', $this->id_bpr);
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_polish_total()
    {
        $this->_get_datatables_query_polish_total();

        return $this->db->get()->num_rows();
        
    }

    // 30-03-2021
    public function get_data_debitur_polish()
    {
        $this->_get_datatables_query_debitur_polish();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_debitur_polish = [null, 'p.kode_tertanggung', 'd.nama_lengkap', 'g.certified_number', 'e.uang_ptg', 'e.premi', 's.status_cash', 'j.jenis_resiko'];
    var $kolom_cari_debitur_polish  = ['p.kode_tertanggung', 'd.nama_lengkap', 'g.certified_number', 'e.uang_ptg', 'e.premi', 's.status_cash', 'j.jenis_resiko'];
    var $order_debitur_polish       = ['g.id_polish' => 'asc'];

    public function _get_datatables_query_debitur_polish()
    {
        $this->db->select('p.id_pertanggungan, p.kode_tertanggung, e.*, s.*, u.*, p.*, d.nama_lengkap, g.*, j.jenis_resiko, t.jenis_tanggung');
        $this->db->from('pertanggungan as p');
        $this->db->join('m_debitur as d', 'id_debitur', 'inner');
        $this->db->join('tr_resiko_ptg as e', 'kode_tertanggung', 'inner');
        $this->db->join('tr_polish as g', 'id_resiko_ptg', 'inner');
        $this->db->join('m_status_cash as s', 'id_status_cash', 'inner');
        $this->db->join('m_status_underwriting as u', 'id_status_underwriting', 'inner');
        $this->db->join('m_jenis_tanggung as t', 'id_jenis_tanggung', 'inner');
        $this->db->join('m_jenis_resiko as j', 'id_jenis_resiko', 'inner');
        $this->db->where('d.id_pks', $this->input->post('id_pks'));
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_debitur_polish;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_debitur_polish;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_debitur_polish)) {
            
            $order = $this->order_debitur_polish;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_debitur_polish()
    {
        $this->db->select('p.id_pertanggungan, p.kode_tertanggung, e.*, s.*, u.*, p.*, d.nama_lengkap, g.*, j.jenis_resiko, t.jenis_tanggung');
        $this->db->from('pertanggungan as p');
        $this->db->join('m_debitur as d', 'id_debitur', 'inner');
        $this->db->join('tr_resiko_ptg as e', 'kode_tertanggung', 'inner');
        $this->db->join('tr_polish as g', 'id_resiko_ptg', 'inner');
        $this->db->join('m_status_cash as s', 'id_status_cash', 'inner');
        $this->db->join('m_status_underwriting as u', 'id_status_underwriting', 'inner');
        $this->db->join('m_jenis_tanggung as t', 'id_jenis_tanggung', 'inner');
        $this->db->join('m_jenis_resiko as j', 'id_jenis_resiko', 'inner');
        $this->db->where('d.id_pks', $this->input->post('id_pks'));

        return $this->db->count_all_results();
    }

    public function jumlah_filter_debitur_polish()
    {
        $this->_get_datatables_query_debitur_polish();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_tanggungan.php */
