<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    // 28-01-2021
    public function get_data_user()
    {
        $this->_get_datatables_query_user();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));

            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_user = [null, 'mu.nama_pic', null, 'ml.level', 'mu.username', 'mu.status'];
    var $kolom_cari_user  = ['LOWER(mu.nama_pic)', null, 'LOWER(ml.level)', 'LOWER(mu.username)', 'mu.status'];
    var $order_user       = ['mu.id_user' => 'desc'];

    public function _get_datatables_query_user()
    {
        $this->db->select('mu.id_user, mu.username, mu.nama_pic, mb.id_bpr, mb.nama_bpr, ml.level, ml.id_level, s.nama_asuransi, s.id_asuransi, mu.status');
        $this->db->from('m_user mu');
        $this->db->join('m_bpr mb','id_bpr', 'left');
        $this->db->join('m_asuransi s','id_asuransi', 'left');
        $this->db->join('m_level ml','id_level', 'inner');

        if ($this->input->post('level')) {
            $this->db->where('mu.id_level', $this->input->post('level'));
        }

        $b = 0;

        $input_cari = strtolower(isset($_POST['search']['value']));
        $kolom_cari = $this->kolom_cari_user;

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

            $kolom_order = $this->kolom_order_user;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

        } elseif (isset($this->order_user)) {

            $order = $this->order_user;
            $this->db->order_by(key($order), $order[key($order)]);

        }

    }

    public function jumlah_semua_user()
    {
        $this->db->select('mu.id_user, mu.username, mu.nama_pic, mb.id_bpr, mb.nama_bpr, ml.level, ml.id_level, s.nama_asuransi, s.id_asuransi, mu.status');
        $this->db->from('m_user mu');
        $this->db->join('m_bpr mb','id_bpr', 'left');
        $this->db->join('m_asuransi s','id_asuransi', 'left');
        $this->db->join('m_level ml','id_level', 'inner');

        if ($this->input->post('level')) {
            $this->db->where('mu.id_level', $this->input->post('level'));
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_user()
    {
        $this->_get_datatables_query_user();

        return $this->db->get()->num_rows();

    }

}

/* End of file M_user.php */
