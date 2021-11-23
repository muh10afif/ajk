<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

    // 01-02-2021
    public function cari_username($username)
    {
        $this->db->select('u.username, u.id_bpr, l.id_level, l.level, u.id_asuransi, s.nama_asuransi, b.nama_bpr, u.sha');
        $this->db->from('m_user as u');
        $this->db->join('m_level as l', 'l.id_level = u.id_level', 'inner');
        $this->db->join('m_bpr as b', 'b.id_bpr = u.id_bpr', 'left');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'left');
        $this->db->where('username', $username);
        
        return $this->db->get();
    }

}

/* End of file M_login.php */
