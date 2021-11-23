<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->posisi       = $this->session->userdata('posisi');
        $this->nama_jabatan = $this->session->userdata('nama_jabatan');
        $this->id_pegawai   = $this->session->userdata('id_pegawai');
    }

    // 05-04-2020

        // mencari username
        public function cari_username($username)
        {
            $this->db->select('*');
            $this->db->from('m_user as u');
            $this->db->join('m_pegawai as p', 'p.id_pegawai = u.id_pegawai', 'inner');
            $this->db->join('m_posisi as o', 'o.id_posisi = p.id_posisi', 'left');
            $this->db->join('m_jabatan as j', 'j.id_jabatan = p.id_jabatan', 'inner');
            $this->db->where('u.username', $username);
            
            return $this->db->get();
        }

    // Akhir 05-04-2020
}

/* End of file M_login.php */
