<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

    // 29-04-2020

        public function cari_data($tabel, $where)
        {
            return $this->db->get_where($tabel, $where);
        }

        public function cari_data_order($tabel, $where, $field, $order)
        {
            $this->db->order_by($field, $order);

            return $this->db->get_where($tabel, $where);
        }

        public function get_data_order($tabel, $field, $order)
        {
            $this->db->order_by($field, $order);
            
            return $this->db->get($tabel);
        }

        public function get_data($tabel)
        {
            return $this->db->get($tabel);
        }

        public function input_data($tabel, $data)
        {
            $this->db->insert($tabel, $data);
        }

        public function ubah_data($tabel, $data, $where)
        {
            return $this->db->update($tabel, $data, $where);
        }

        public function hapus_data($tabel, $where)
        {
            $this->db->delete($tabel, $where);
        }

        // master negara
            // Menampilkan list negara
            public function get_data_negara()
            {
                $this->_get_datatables_query_negara();
        
                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }
        
            var $kolom_order_negara = [null, 'nama_negara'];
            var $kolom_cari_negara  = ['LOWER(nama_negara)'];
            var $order_negara       = ['nama_negara' => 'asc'];
        
            public function _get_datatables_query_negara()
            {
                $this->db->from('m_negara');
                
                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_negara;
        
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
        
                    $kolom_order = $this->kolom_order_negara;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_negara)) {
                    
                    $order = $this->order_negara;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }
        
            public function jumlah_semua_negara()
            {
                $this->db->from('m_negara');
        
                return $this->db->count_all_results();
            }
        
            public function jumlah_filter_negara()
            {
                $this->_get_datatables_query_negara();
        
                return $this->db->get()->num_rows();
                
            }

        // master provinsi
            // Menampilkan list provinsi
            public function get_data_provinsi()
            {
                $this->_get_datatables_query_provinsi();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_provinsi = [null, 'nama_provinsi'];
            var $kolom_cari_provinsi  = ['LOWER(nama_provinsi)'];
            var $order_provinsi       = ['nama_provinsi' => 'asc'];

            public function _get_datatables_query_provinsi()
            {
                $this->db->from('m_provinsi');
            
                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_provinsi;

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

                    $kolom_order = $this->kolom_order_provinsi;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_provinsi)) {
                    
                    $order = $this->order_provinsi;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_provinsi()
            {
                $this->db->from('m_provinsi');

                return $this->db->count_all_results();
            }

            public function jumlah_filter_provinsi()
            {
                $this->_get_datatables_query_provinsi();

                return $this->db->get()->num_rows();
                
            }

        // master kota/kab
            // Menampilkan list kota_kab
            public function get_data_kota_kab()
            {
                $this->_get_datatables_query_kota_kab();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_kota_kab = [null, 'p.nama_provinsi', 'k.nama_kota_kab'];
            var $kolom_cari_kota_kab  = ['LOWER(p.nama_provinsi)', 'LOWER(k.nama_kota_kab)'];
            var $order_kota_kab       = ['p.nama_provinsi' => 'asc'];

            public function _get_datatables_query_kota_kab()
            {
                $this->db->from('m_kota_kab as k');
                $this->db->join('m_provinsi as p', 'p.id_provinsi = k.id_provinsi', 'inner');

                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_kota_kab;

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

                    $kolom_order = $this->kolom_order_kota_kab;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_kota_kab)) {
                    
                    $order = $this->order_kota_kab;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_kota_kab()
            {
                $this->db->from('m_kota_kab as k');
                $this->db->join('m_provinsi as p', 'p.id_provinsi = k.id_provinsi', 'inner');

                return $this->db->count_all_results();
            }

            public function jumlah_filter_kota_kab()
            {
                $this->_get_datatables_query_kota_kab();

                return $this->db->get()->num_rows();
                
            }

        // master kecamatan
            // Menampilkan list kecamatan
            public function get_data_kecamatan()
            {
                $this->_get_datatables_query_kecamatan();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_kecamatan = [null, 'v.nama_provinsi', 'p.nama_kota_kab', 'k.nama_kecamatan'];
            var $kolom_cari_kecamatan  = ['LOWER(v.nama_provinsi)', 'p.nama_kota_kab', 'LOWER(k.nama_kecamatan)'];
            var $order_kecamatan       = ['v.nama_provinsi' => 'asc'];

            public function _get_datatables_query_kecamatan()
            {
                $this->db->from('m_kecamatan as k');
                $this->db->join('m_kota_kab as p', 'p.id_kota_kab = k.id_kota_kab', 'inner');
                $this->db->join('m_provinsi as v', 'v.id_provinsi = p.id_provinsi', 'inner');

                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_kecamatan;

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

                    $kolom_order = $this->kolom_order_kecamatan;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_kecamatan)) {
                    
                    $order = $this->order_kecamatan;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_kecamatan()
            {
                $this->db->from('m_kecamatan as k');
                $this->db->join('m_kota_kab as p', 'p.id_kota_kab = k.id_kota_kab', 'inner');
                $this->db->join('m_provinsi as v', 'v.id_provinsi = p.id_provinsi', 'inner');

                return $this->db->count_all_results();
            }

            public function jumlah_filter_kecamatan()
            {
                $this->_get_datatables_query_kecamatan();

                return $this->db->get()->num_rows();
                
            }
    
    // 30-04-2020

    // master jenis_kredit
        // Menampilkan list jenis_kredit
        public function get_data_jenis_kredit()
        {
            $this->_get_datatables_query_jenis_kredit();

            if ($this->input->post('length') != -1) {
                $this->db->limit($this->input->post('length'), $this->input->post('start'));
                
                return $this->db->get()->result_array();
            }
        }

        var $kolom_order_jenis_kredit = [null, 'jenis_kredit'];
        var $kolom_cari_jenis_kredit  = ['LOWER(jenis_kredit)'];
        var $order_jenis_kredit       = ['jenis_kredit' => 'asc'];

        public function _get_datatables_query_jenis_kredit()
        {
            $this->db->from('m_jenis_kredit');
            
            $b = 0;
            
            $input_cari = strtolower($_POST['search']['value']);
            $kolom_cari = $this->kolom_cari_jenis_kredit;

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

                $kolom_order = $this->kolom_order_jenis_kredit;
                $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                
            } elseif (isset($this->order_jenis_kredit)) {
                
                $order = $this->order_jenis_kredit;
                $this->db->order_by(key($order), $order[key($order)]);
                
            }
            
        }

        public function jumlah_semua_jenis_kredit()
        {
            $this->db->from('m_jenis_kredit');

            return $this->db->count_all_results();
        }

        public function jumlah_filter_jenis_kredit()
        {
            $this->_get_datatables_query_jenis_kredit();

            return $this->db->get()->num_rows();
            
        }

    // master jenis_tanggung
        // Menampilkan list jenis_tanggung
        public function get_data_jenis_tanggung()
        {
            $this->_get_datatables_query_jenis_tanggung();

            if ($this->input->post('length') != -1) {
                $this->db->limit($this->input->post('length'), $this->input->post('start'));
                
                return $this->db->get()->result_array();
            }
        }

        var $kolom_order_jenis_tanggung = [null, 'jenis_tanggung'];
        var $kolom_cari_jenis_tanggung  = ['LOWER(jenis_tanggung)'];
        var $order_jenis_tanggung       = ['jenis_tanggung' => 'asc'];

        public function _get_datatables_query_jenis_tanggung()
        {
            $this->db->from('m_jenis_tanggung');
            
            $b = 0;
            
            $input_cari = strtolower($_POST['search']['value']);
            $kolom_cari = $this->kolom_cari_jenis_tanggung;

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

                $kolom_order = $this->kolom_order_jenis_tanggung;
                $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                
            } elseif (isset($this->order_jenis_tanggung)) {
                
                $order = $this->order_jenis_tanggung;
                $this->db->order_by(key($order), $order[key($order)]);
                
            }
            
        }

        public function jumlah_semua_jenis_tanggung()
        {
            $this->db->from('m_jenis_tanggung');

            return $this->db->count_all_results();
        }

        public function jumlah_filter_jenis_tanggung()
        {
            $this->_get_datatables_query_jenis_tanggung();

            return $this->db->get()->num_rows();
            
        }

    
    // 04-05-2020

        // master spk
            // Menampilkan list spk
            public function get_data_spk()
            {
                $this->_get_datatables_query_spk();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_spk = [null, 's.no_spk', 'b.nama_bpr', 's.tgl_mulai', 's.tgl_berakhir'];
            var $kolom_cari_spk  = ['LOWER(s.no_spk)', 'LOWER(b.nama_bpr)', 'CAST(s.tgl_mulai as VARCHAR)', 'CAST(s.tgl_berakhir as VARCHAR)'];
            var $order_spk       = ['LOWER(s.no_spk)' => 'asc'];

            public function _get_datatables_query_spk()
            {
                $this->db->from('m_spk as s');
                $this->db->join('m_bpr as b', 'b.id_bpr = s.id_bpr', 'inner');  
                
                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_spk;

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

                    $kolom_order = $this->kolom_order_spk;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_spk)) {
                    
                    $order = $this->order_spk;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_spk()
            {
                $this->db->from('m_spk as s');
                $this->db->join('m_bpr as b', 'b.id_bpr = s.id_bpr', 'inner');  

                return $this->db->count_all_results();
            }

            public function jumlah_filter_spk()
            {
                $this->_get_datatables_query_spk();

                return $this->db->get()->num_rows();
                
            }

        // master bpr
            // Menampilkan list bpr
            public function get_data_bpr()
            {
                $this->_get_datatables_query_bpr();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_bpr = [null, 'b.nama_bpr', 'b.email', 'b.kontak', 'b.alamat'];
            var $kolom_cari_bpr  = ['LOWER(b.nama_bpr)', 'LOWER(b.email)', 'b.kontak', 'LOWER(b.alamat)'];
            var $order_bpr       = ['b.nama_bpr' => 'asc'];

            public function _get_datatables_query_bpr()
            {
                $this->db->from('m_bpr as b'); 
                
                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_bpr;

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

                    $kolom_order = $this->kolom_order_bpr;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_bpr)) {
                    
                    $order = $this->order_bpr;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_bpr()
            {
                $this->db->from('m_bpr as b');   

                return $this->db->count_all_results();
            }

            public function jumlah_filter_bpr()
            {
                $this->_get_datatables_query_bpr();

                return $this->db->get()->num_rows();
                
            }

        // master debitur_total
            // Menampilkan list debitur_total
            public function get_data_debitur_total()
            {
                $this->_get_datatables_query_debitur_total();

                if ($this->input->post('length') != -1) {
                    $this->db->limit($this->input->post('length'), $this->input->post('start'));
                    
                    return $this->db->get()->result_array();
                }
            }

            var $kolom_order_debitur_total = [null, 's.no_spk', 'b.nama_bpr', 'tot_debitur'];
            var $kolom_cari_debitur_total  = ['LOWER(s.no_spk)', 'LOWER(b.nama_bpr)'];
            var $order_debitur_total       = ['tot_debitur' => 'asc'];

            public function _get_datatables_query_debitur_total()
            {
                $this->db->select('p.id_pks, b.id_bpr, p.nomor_pks, b.nama_bpr, (SELECT count(d.id_debitur) as tot_debitur FROM m_debitur as d WHERE d.id_pks = p.id_pks)');
                $this->db->from('tr_pks as p');
                $this->db->join('tr_penawaran as s', 'id_penawaran', 'inner'); 
                $this->db->join('m_bpr as b', 'id_bpr', 'inner');
                
                $b = 0;
                
                $input_cari = strtolower($_POST['search']['value']);
                $kolom_cari = $this->kolom_cari_debitur_total;

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

                    $kolom_order = $this->kolom_order_debitur_total;
                    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
                    
                } elseif (isset($this->order_debitur_total)) {
                    
                    $order = $this->order_debitur_total;
                    $this->db->order_by(key($order), $order[key($order)]);
                    
                }
                
            }

            public function jumlah_semua_debitur_total()
            {
                $this->db->select('p.id_pks, b.id_bpr, p.nomor_pks, b.nama_bpr, (SELECT count(d.id_debitur) as tot_debitur FROM m_debitur as d WHERE d.id_pks = p.id_pks)');
                $this->db->from('tr_pks as p');
                $this->db->join('tr_penawaran as s', 'id_penawaran', 'inner'); 
                $this->db->join('m_bpr as b', 'id_bpr', 'inner');

                return $this->db->count_all_results();
            }

            public function jumlah_filter_debitur_total()
            {
                $this->_get_datatables_query_debitur_total();

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

            var $kolom_order_debitur = [null, 'nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'kontak', 'email'];
            var $kolom_cari_debitur  = ['nik', 'LOWER(nama_lengkap)', 'LOWER(jenis_kelamin)', 'LOWER(tempat_lahir)', 'CAST(tgl_lahir as VARCHAR)', 'kontak', 'LOWER(email)'];
            var $order_debitur       = ['nama_lengkap' => 'asc'];

            public function _get_datatables_query_debitur()
            {
                $this->db->select('*');
                $this->db->from('m_debitur');

                $id_spk = $this->input->post('id_spk');

                if ($id_spk) {
                    $this->db->where('id_pks', $id_spk);
                }
                
                
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
                $this->db->select('*');
                $this->db->from('m_debitur');

                $id_spk = $this->input->post('id_spk');

                if ($id_spk) {
                    $this->db->where('id_pks', $id_spk);
                }

                return $this->db->count_all_results();
            }

            public function jumlah_filter_debitur()
            {
                $this->_get_datatables_query_debitur();

                return $this->db->get()->num_rows();
                
            }

    // Menampilkan list asuransi
    public function get_data_asuransi()
    {
        $this->_get_datatables_query_asuransi();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_asuransi = [null, 'a.nama_asuransi', 'a.alamat', 'a.email', 'a.no_telepon'];
    var $kolom_cari_asuransi  = ['LOWER(a.nama_asuransi)', 'LOWER(a.alamat)', 'LOWER(a.email)', 'a.no_telepon'];
    var $order_asuransi       = ['a.nama_asuransi' => 'asc'];

    public function _get_datatables_query_asuransi()
    {
        $this->db->from('m_asuransi as a'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_asuransi;

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

            $kolom_order = $this->kolom_order_asuransi;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_asuransi)) {
            
            $order = $this->order_asuransi;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_asuransi()
    {
        $this->db->from('m_asuransi as a');   

        return $this->db->count_all_results();
    }

    public function jumlah_filter_asuransi()
    {
        $this->_get_datatables_query_asuransi();

        return $this->db->get()->num_rows();
        
    }
     
    // 05-02-2021
    // Menampilkan list asuransi
    public function get_data_dok_udw()
    {
        $this->_get_datatables_query_dok_udw();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_dok_udw = [null, 'a.jenis_dokumen'];
    var $kolom_cari_dok_udw  = ['LOWER(a.jenis_dokumen)'];
    var $order_dok_udw       = ['a.jenis_dokumen' => 'asc'];

    public function _get_datatables_query_dok_udw()
    {
        $this->db->from('m_dok_underwriting as a'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_dok_udw;

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

            $kolom_order = $this->kolom_order_dok_udw;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_dok_udw)) {
            
            $order = $this->order_dok_udw;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_dok_udw()
    {
        $this->db->from('m_dok_underwriting as a');   

        return $this->db->count_all_results();
    }

    public function jumlah_filter_dok_udw()
    {
        $this->_get_datatables_query_dok_udw();

        return $this->db->get()->num_rows();
        
    }

    // 05-02-2021
    // Menampilkan list asuransi
    public function get_data_status_udw()
    {
        $this->_get_datatables_query_status_udw();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_status_udw = [null, 'a.status_underwriting'];
    var $kolom_cari_status_udw  = ['LOWER(a.status_underwriting)'];
    var $order_status_udw       = ['a.status_underwriting' => 'asc'];

    public function _get_datatables_query_status_udw()
    {
        $this->db->from('m_status_underwriting as a'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_status_udw;

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

            $kolom_order = $this->kolom_order_status_udw;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_status_udw)) {
            
            $order = $this->order_status_udw;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_status_udw()
    {
        $this->db->from('m_status_underwriting as a');   

        return $this->db->count_all_results();
    }

    public function jumlah_filter_status_udw()
    {
        $this->_get_datatables_query_status_udw();

        return $this->db->get()->num_rows();
        
    }

    // 14-02-2021
    public function cari_list_bpr()
    {
        $this->db->select('id_bpr');
        $this->db->from('m_user');
        $this->db->where('id_bpr !=', null);
        $st = $this->db->get()->result_array();
        
        $ay = array();
        foreach ($st as $b) {
            $ay[] = $b['id_bpr'];
        }

        $im      = implode(',',$ay);
        $id_bpr  = explode(',',$im); 

        $this->db->select('*');
        $this->db->from('m_bpr');
        $this->db->where_not_in('id_bpr', $id_bpr);
        
        return $this->db->get();
        
    }

    // 14-02-2021
    public function cari_list_asuransi()
    {
        $this->db->select('id_asuransi');
        $this->db->from('m_user');
        $this->db->where('id_asuransi !=', null);
        $st = $this->db->get()->result_array();
        
        $ay = array();
        foreach ($st as $b) {
            $ay[] = $b['id_asuransi'];
        }

        $im      = implode(',',$ay);
        $id_as   = explode(',',$im); 

        $this->db->select('*');
        $this->db->from('m_asuransi');
        $this->db->where_not_in('id_asuransi', $id_as);
        
        return $this->db->get();
        
    }

    // 14-02-2021
    public function cari_data_level()
    {
        $this->db->select('*');
        $this->db->from('m_level');
        $this->db->where('id_level !=', 1);
        
        return $this->db->get();
        
    }

    // 21-02-21
    // Menampilkan list jenis_produk
    public function get_data_jenis_produk()
    {
        $this->_get_datatables_query_jenis_produk();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_jenis_produk = [null, 'jenis_produk'];
    var $kolom_cari_jenis_produk  = ['LOWER(jenis_produk)'];
    var $order_jenis_produk       = ['jenis_produk' => 'asc'];

    public function _get_datatables_query_jenis_produk()
    {
        $this->db->from('m_jenis_produk');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_jenis_produk;

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

            $kolom_order = $this->kolom_order_jenis_produk;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_jenis_produk)) {
            
            $order = $this->order_jenis_produk;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_jenis_produk()
    {
        $this->db->from('m_jenis_produk');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_jenis_produk()
    {
        $this->_get_datatables_query_jenis_produk();

        return $this->db->get()->num_rows();
        
    }

    // 21-02-21
    // Menampilkan list jenis_resiko
    public function get_data_jenis_resiko()
    {
        $this->_get_datatables_query_jenis_resiko();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_jenis_resiko = [null, 'jenis_resiko', 'CAST(tampil_otomatis as VARCHAR)'];
    var $kolom_cari_jenis_resiko  = ['LOWER(jenis_resiko)', 'CAST(tampil_otomatis as VARCHAR)'];
    var $order_jenis_resiko       = ['jenis_resiko' => 'asc'];

    public function _get_datatables_query_jenis_resiko()
    {
        $this->db->from('m_jenis_resiko');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_jenis_resiko;

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

            $kolom_order = $this->kolom_order_jenis_resiko;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_jenis_resiko)) {
            
            $order = $this->order_jenis_resiko;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_jenis_resiko()
    {
        $this->db->from('m_jenis_resiko');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_jenis_resiko()
    {
        $this->_get_datatables_query_jenis_resiko();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_master.php */
