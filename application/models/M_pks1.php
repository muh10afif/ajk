<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_pks extends CI_Model {

    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    public function get_data_order($tabel, $field, $order)
    {
        $this->db->order_by($field, $order);
        
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

    // 07-02-2021
    public function tampil_status_dok($id_asuransi)
    {
        $this->db->select("s.id_asuransi, s.nama_asuransi, t.id_status_underwriting, t.status_underwriting, string_agg(u.jenis_dokumen, ', ') jenis_dokumen");
        $this->db->from('tr_dok_underwriting as d');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');
        $this->db->join('m_dok_underwriting as u', 'id_dok_underwriting', 'inner');
        $this->db->join('m_status_underwriting as t', 'id_status_underwriting', 'inner');

        if ($id_asuransi != '') {
            $this->db->where('s.id_asuransi', $id_asuransi);
        }
        
        $this->db->group_by('s.id_asuransi');
        $this->db->group_by('t.id_status_underwriting');
        $this->db->order_by('s.nama_asuransi', 'asc');

        return $this->db->get();
        
    }

    // 08-02-2021
    public function get_data_penawaran()
    {
        $this->_get_datatables_query_penawaran();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_penawaran = [null, 'p.nomor_penawaran', 'b.nama_bpr', 'p.kode_klausul', 'p.status'];
    var $kolom_cari_penawaran  = ['LOWER(p.nomor_penawaran)', 'LOWER(b.nama_bpr)', 'LOWER(p.kode_klausul)', 'p.status'];
    var $order_penawaran       = ['p.nomor_penawaran' => 'desc'];

    public function _get_datatables_query_penawaran()
    {
        $this->db->select('p.nomor_penawaran, p.status, p.dokumen, p.kode_klausul, b.nama_bpr, p.id_penawaran');
        $this->db->from('tr_penawaran as p'); 
        $this->db->join('m_bpr as b', 'id_bpr', 'inner');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_penawaran;

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

            $kolom_order = $this->kolom_order_penawaran;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_penawaran)) {
            
            $order = $this->order_penawaran;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_penawaran()
    {
        $this->db->select('p.nomor_penawaran, p.status, p.dokumen, p.kode_klausul, b.nama_bpr, p.id_penawaran');
        $this->db->from('tr_penawaran as p'); 
        $this->db->join('m_bpr as b', 'id_bpr', 'inner');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_penawaran()
    {
        $this->_get_datatables_query_penawaran();

        return $this->db->get()->num_rows();
        
    }

    // 08-02-2021
    public function get_data_pks()
    {
        $this->_get_datatables_query_pks();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_pks = [null, 'p.nomor_pks', 'r.nama_bpr', 'b.nomor_penawaran', 'r.email', 'r.kontak', 'r.alamat', 's.komisi_broker'];
    var $kolom_cari_pks  = ['LOWER(p.nomor_pks)', 'LOWER(r.nama_bpr)', 'LOWER(b.nomor_penawaran)', 'LOWER(r.email)', 'r.kontak', 'LOWER(r.alamat)', 's.komisi_broker'];
    var $order_pks       = ['p.nomor_pks' => 'desc'];

    public function _get_datatables_query_pks()
    {
        $this->db->select('p.nomor_pks, r.nama_bpr, p.id_pks, s.komisi_broker, b.nomor_penawaran, r.email, r.kontak, r.alamat');
        $this->db->from('tr_pks as p'); 
        $this->db->join('tr_penawaran as b', 'id_penawaran', 'inner');
        $this->db->join('m_bpr as r', 'id_bpr', 'inner');
        $this->db->join('tr_soc as s', 'id_soc', 'inner');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_pks;

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

            $kolom_order = $this->kolom_order_pks;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_pks)) {
            
            $order = $this->order_pks;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_pks()
    {
        $this->db->select('p.nomor_pks, r.nama_bpr, p.id_pks, s.komisi_broker, b.nomor_penawaran, r.email, r.kontak, r.alamat');
        $this->db->from('tr_pks as p'); 
        $this->db->join('tr_penawaran as b', 'id_penawaran', 'inner');
        $this->db->join('m_bpr as r', 'id_bpr', 'inner');
        $this->db->join('tr_soc as s', 'id_soc', 'inner');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_pks()
    {
        $this->_get_datatables_query_pks();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_asuransi.php */
