<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    // 07-02-2021
    // Menampilkan list udw
    public function get_data_udw()
    {
        $this->_get_datatables_query_udw();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_udw = [null, 's.nama_asuransi', 't.status_underwriting'];
    var $kolom_cari_udw  = ['LOWER(s.nama_asuransi)', 'LOWER(t.status_underwriting)'];
    var $order_udw       = ['s.nama_asuransi' => 'asc'];

    public function _get_datatables_query_udw()
    {
        // SELECT s.nama_asuransi, t.status_underwriting, string_agg(u.jenis_dokumen, ', ') jenis_dokumen
        // FROM tr_dok_underwriting as d 
        // INNER JOIN m_asuransi as s USING(id_asuransi)
        // INNER JOIN m_dok_underwriting as u USING(id_dok_underwriting)
        // INNER JOIN m_status_underwriting as t USING(id_status_underwriting)
        // GROUP BY s.nama_asuransi, t.status_underwriting
        // ORDER BY s.nama_asuransi asc

        $this->db->select("s.id_asuransi, s.nama_asuransi, t.id_status_underwriting, t.status_underwriting, string_agg(u.jenis_dokumen, ', ') jenis_dokumen");
        $this->db->from('tr_dok_underwriting as d');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');
        $this->db->join('m_dok_underwriting as u', 'id_dok_underwriting', 'inner');
        $this->db->join('m_status_underwriting as t', 'id_status_underwriting', 'inner');

        if ($this->input->post('id_asuransi') != '' ) {
            $this->db->where('s.id_asuransi', $this->input->post('id_asuransi'));
        }

        $this->db->group_by('s.id_asuransi');
        $this->db->group_by('t.id_status_underwriting');
        $this->db->order_by('s.nama_asuransi', 'asc');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_udw;

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

            $kolom_order = $this->kolom_order_udw;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_udw)) {
            
            $order = $this->order_udw;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_udw()
    {
        $this->db->select("s.id_asuransi, s.nama_asuransi, t.id_status_underwriting, t.status_underwriting, string_agg(u.jenis_dokumen, ', ') jenis_dokumen");
        $this->db->from('tr_dok_underwriting as d');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');
        $this->db->join('m_dok_underwriting as u', 'id_dok_underwriting', 'inner');
        $this->db->join('m_status_underwriting as t', 'id_status_underwriting', 'inner');

        if ($this->input->post('id_asuransi') != '' ) {
            $this->db->where('s.id_asuransi', $this->input->post('id_asuransi'));
        }

        $this->db->group_by('s.id_asuransi');
        $this->db->group_by('t.id_status_underwriting');
        $this->db->order_by('s.nama_asuransi', 'asc');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_udw()
    {
        $this->_get_datatables_query_udw();

        return $this->db->get()->num_rows();
        
    }

    // 07-02-2021
    public function get_status_belum($id_asuransi)
    {
        $this->db->select('s.id_status_underwriting, s.status_underwriting');
        $this->db->from('tr_dok_underwriting as t');
        $this->db->join('m_status_underwriting as s', 'id_status_underwriting', 'inner');
        $this->db->where('t.id_asuransi', $id_asuransi);
        $this->db->group_by('s.id_status_underwriting');
        $this->db->order_by('s.status_underwriting', 'asc');
        $st = $this->db->get()->result_array();

        if (!empty($st)) {
            $ay = array();
            foreach ($st as $b) {
                $ay[] = $b['id_status_underwriting'];
            }

            $im             = implode(',',$ay);
            $id_status_udw  = explode(',',$im); 
        }
        

        $this->db->select('id_status_underwriting, status_underwriting');
        $this->db->from('m_status_underwriting');
        if (!empty($id_status_udw)) {
            $this->db->where_not_in('id_status_underwriting', $id_status_udw);
        }
        $this->db->order_by('status_underwriting', 'asc');
        
        return $this->db->get();
        
    }
    
}

/* End of file M_transaksi.php */
