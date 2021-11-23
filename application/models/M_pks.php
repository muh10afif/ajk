<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_pks extends CI_Model
{
  public function get_data_pks()
  {
      $this->_get_datatables_query_pks();

      if ($this->input->post('length') != -1) {
          $this->db->limit($this->input->post('length'), $this->input->post('start'));

          return $this->db->get()->result_array();
      }
  }

  var $kolom_order_pks = [null, 'k.nomor_pks', 'p.nomor_penawaran', 'b.nama_bpr', 's.nama_asuransi'];
  var $kolom_cari_pks  = ['LOWER(k.nomor_pks)', 'LOWER(p.nomor_penawaran)', 'LOWER(b.nama_bpr)', 'LOWER(s.nama_asuransi)'];
  var $order_pks       = ['k.id_pks' => 'desc'];

  public function _get_datatables_query_pks()
  {
    // $this->db->select('tp.id_pks, tp.nomor_pks, mb.nama_bpr, tp2.nomor_penawaran, mb.email, mb.kontak, mb.alamat');
    // $this->db->from('tr_pks tp');
    // $this->db->join('m_bpr mb','tp.id_bpr = mb.id_bpr', 'left');
    // $this->db->join('tr_soc ts','tp.id_soc = ts.id_soc', 'left');
    // $this->db->join('tr_penawaran tp2','tp.id_penawaran = tp2.id_penawaran','left');

    $this->db->select('k.id_pks, k.nomor_pks, p.nomor_penawaran, b.nama_bpr, s.nama_asuransi');
    $this->db->from('tr_pks k');
    $this->db->join('tr_penawaran p','id_penawaran','inner');
    $this->db->join('m_bpr b', 'id_bpr', 'inner');
    $this->db->join('m_asuransi s', 'id_asuransi', 'inner');

    $b = 0;

    $input_cari = strtolower(isset($_POST['search']['value']));
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
    $this->db->select('k.id_pks, k.nomor_pks, p.nomor_penawaran, b.nama_bpr, s.nama_asuransi');
    $this->db->from('tr_pks k');
    $this->db->join('tr_penawaran p','id_penawaran','inner');
    $this->db->join('m_bpr b', 'id_bpr', 'inner');
    $this->db->join('m_asuransi s', 'id_asuransi', 'inner');

    return $this->db->count_all_results();
  }

  public function jumlah_filter_pks()
  {
      $this->_get_datatables_query_pks();

      return $this->db->get()->num_rows();
  }

  public function get_data_per_id($value='')
  {
    $this->db->select('*');
    $this->db->from('tr_pks tp');
    $this->db->join('tr_soc ts','tp.id_soc = ts.id_soc', 'inner');
    $this->db->join('tr_penawaran tp2','tp.id_penawaran = tp2.id_penawaran','inner');
    $this->db->where('tp.id_pks', $value);
    $data = $this->db->get();
    return $data->row();
  }

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

    var $kolom_order_asuransi = [null, 's.nama_asuransi', 'p.jenis_produk'];
    var $kolom_cari_asuransi  = ['LOWER(s.nama_asuransi)', 'LOWER(p.jenis_produk)'];
    var $order_asuransi       = ['s.nama_asuransi' => 'asc'];

    public function _get_datatables_query_asuransi()
    {

        // $this->db->select("s.id_asuransi, s.nama_asuransi, string_agg(DISTINCT p.jenis_produk, ', ') jenis_produk");
        $this->db->select("s.id_asuransi, s.nama_asuransi, p.jenis_produk, p.id_jenis_produk");
        $this->db->from('tr_jenis_resiko as jr');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');
        $this->db->join('m_jenis_produk as p', 'id_jenis_produk', 'inner');
        $this->db->group_by('s.id_asuransi');
        $this->db->group_by('p.id_jenis_produk');
        
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
        // $this->db->select("s.id_asuransi, s.nama_asuransi, string_agg(DISTINCT p.jenis_produk, ', ') jenis_produk");
        $this->db->select("s.id_asuransi, s.nama_asuransi, p.jenis_produk, p.id_jenis_produk");
        $this->db->from('tr_jenis_resiko as jr');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');
        $this->db->join('m_jenis_produk as p', 'id_jenis_produk', 'inner');
        $this->db->group_by('s.id_asuransi');
        $this->db->group_by('p.id_jenis_produk');

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
        $this->db->select('p.nomor_penawaran, p.status, p.dokumen, p.kode_klausul, b.nama_bpr, p.id_penawaran, s.nama_asuransi');
        $this->db->from('tr_penawaran as p'); 
        $this->db->join('m_bpr as b', 'id_bpr', 'inner');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');
        
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
        $this->db->select('p.nomor_penawaran, p.status, p.dokumen, p.kode_klausul, b.nama_bpr, p.id_penawaran, s.nama_asuransi');
        $this->db->from('tr_penawaran as p'); 
        $this->db->join('m_bpr as b', 'id_bpr', 'inner');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_penawaran()
    {
        $this->_get_datatables_query_penawaran();

        return $this->db->get()->num_rows();
        
    }

    // 28-02-21
    public function get_sel_asuransi()
    {
        $this->db->select('k.id_asuransi');
        $this->db->from('tr_klausul as k'); 
        $this->db->group_by('k.id_asuransi');
        $st = $this->db->get()->result_array();

        if (!empty($st)) {
            $ay = array();
            foreach ($st as $b) {
                $ay[] = $b['id_asuransi'];
            }

            $im           = implode(',',$ay);
            $id_asuransi  = explode(',',$im); 
        }
        
        $this->db->from('m_asuransi');
        if (!empty($id_asuransi)) {
            $this->db->where_not_in('id_asuransi', $id_asuransi);
        }
        
        return $this->db->get();
        
    }

    public function cari_jenis_produk($id_asuransi)
    {
        $this->db->distinct();
        $this->db->select('id_jenis_produk, jenis_produk');
        $this->db->from('tr_jenis_resiko');
        $this->db->join('m_jenis_produk', 'id_jenis_produk', 'inner');
        $this->db->where('id_asuransi', $id_asuransi);
        $st = $this->db->get()->result_array();
        
        $ay = array();
        foreach ($st as $b) {
            $ay[] = $b['id_jenis_produk'];
        }

        $im                 = implode(',',$ay);
        $id_jenis_produk    = explode(',',$im); 

        $this->db->select('jenis_produk, id_jenis_produk');
        $this->db->from('m_jenis_produk');

        if (!empty($st)) {
            $this->db->where_not_in('id_jenis_produk', $id_jenis_produk);
        }
        
        return $this->db->get();
    }

    public function cari_jenis_produk_2($id_asuransi, $id_jenis_produk)
    {
        $this->db->distinct();
        $this->db->select('id_jenis_produk, jenis_produk');
        $this->db->from('tr_jenis_resiko');
        $this->db->join('m_jenis_produk', 'id_jenis_produk', 'inner');
        $this->db->where('id_asuransi', $id_asuransi);
        $this->db->where('id_jenis_produk !=', $id_jenis_produk);
        $st = $this->db->get()->result_array();
        
        $ay = array();
        foreach ($st as $b) {
            $ay[] = $b['id_jenis_produk'];
        }

        $im                 = implode(',',$ay);
        $id_jenis_produk    = explode(',',$im); 

        $this->db->select('jenis_produk, id_jenis_produk');
        $this->db->from('m_jenis_produk');

        if (!empty($st)) {
            $this->db->where_not_in('id_jenis_produk', $id_jenis_produk);
        }
        
        return $this->db->get();
    }

    // 03-02-2021
    public function cari_data_klausul($id_asuransi)
    {
        $this->db->distinct();
        $this->db->select('kode_klausul');
        $this->db->from('tr_penawaran');
        $st = $this->db->get()->result_array();
        
        $ay = array();
        foreach ($st as $b) {
            $ay[] = $b['kode_klausul'];
        }

        $im            = implode(',',$ay);
        $kd_klausul    = explode(',',$im); 

        $this->db->distinct();
        $this->db->select('kode_klausul');
        $this->db->from('tr_klausul');
        $this->db->where('id_asuransi', $id_asuransi);

        if (!empty($st)) {
            $this->db->where_not_in('kode_klausul', $kd_klausul);
        }
        
        return $this->db->get();
    }

    // 01-04-2021
    public function cari_data_klausul_2($id_asuransi, $kd_klausul)
    {
        $this->db->distinct();
        $this->db->select('kode_klausul');
        $this->db->from('tr_penawaran');
        $this->db->where('kode_klausul !=', $kd_klausul);
        $st = $this->db->get()->result_array();
        
        $ay = array();
        foreach ($st as $b) {
            $ay[] = $b['kode_klausul'];
        }

        $im            = implode(',',$ay);
        $kd_klausul    = explode(',',$im); 

        $this->db->distinct();
        $this->db->select('kode_klausul');
        $this->db->from('tr_klausul');
        $this->db->where('id_asuransi', $id_asuransi);

        if (!empty($st)) {
            $this->db->where_not_in('kode_klausul', $kd_klausul);
        }
        
        return $this->db->get();
    }

    // 31-03-2021
    public function cari_jenis_tanggung($id_jenis_tanggung, $id_asuransi, $id_jenis_produk)
    {
        $this->db->select('id_jenis_tanggung');
        $this->db->from('tr_jenis_resiko');
        $this->db->where('id_asuransi', $id_asuransi);
        $this->db->where('id_jenis_produk', $id_jenis_produk);
        $this->db->where('id_jenis_tanggung', $id_jenis_tanggung);
        $this->db->group_by('id_jenis_tanggung');
        
        return $this->db->get();
    }

    // 31-03-2021
    public function cari_jenis_resiko($id_jenis_resiko, $id_asuransi, $id_jenis_produk)
    {
        $this->db->select('t.id_jenis_resiko');
        $this->db->from('tr_jenis_resiko as t');
        $this->db->join('m_jenis_resiko as j', 'id_jenis_resiko', 'inner');
        $this->db->where('t.id_asuransi', $id_asuransi);
        $this->db->where('t.id_jenis_produk', $id_jenis_produk);
        $this->db->where('t.id_jenis_resiko', $id_jenis_resiko);
        $this->db->where('j.tampil_otomatis', 0);
        $this->db->group_by('t.id_jenis_resiko');
        
        return $this->db->get();
    }

    // 31-03-2021
    public function cari_detail_syarat_ptg($id_klausul)
    {
        $this->db->select('*');
        $this->db->from('tr_klausul as k');
        $this->db->join('syarat_pertanggungan as p', 'id_syarat_pertanggungan', 'inner');
        $this->db->where('k.id_klausul', $id_klausul);
        
        return $this->db->get();
    }

    // 01-04-2021
    public function usia_tpu($id_asuransi, $kd_tpu)
    {
        $this->db->select('usia');
        $this->db->from('tr_tarif_perusia');
        $this->db->where('id_asuransi', $id_asuransi);
        $this->db->where('kode_tarif_perusia', $kd_tpu);
        $this->db->group_by('usia');
        $this->db->order_by('usia', 'asc');
        
        return $this->db->get();
    }

    // 01-04-2021
    public function thn_tpu($id_asuransi, $kd_tpu)
    {
        $this->db->select('masa_tahun');
        $this->db->from('tr_tarif_perusia');
        $this->db->where('id_asuransi', $id_asuransi);
        $this->db->where('kode_tarif_perusia', $kd_tpu);
        $this->db->group_by('masa_tahun');
        $this->db->order_by('masa_tahun', 'asc');
        
        return $this->db->get();
    }

    // 01-04-2021
    public function cari_produk_resiko($id_asuransi, $id_jenis_produk)
    {
        $this->db->select('k.*');
        $this->db->from('tr_jenis_resiko as r');
        $this->db->join('tr_klausul as k', 'id_klausul', 'inner');
        $this->db->where('r.id_asuransi', $id_asuransi);
        $this->db->where('r.id_jenis_produk', $id_jenis_produk);
        
        return $this->db->get();
    }

    // 01-04-2021
    public function cari_detail_resiko($id_asuransi, $id_jenis_produk)
    {
        $this->db->select("s.id_asuransi, s.nama_asuransi, string_agg(DISTINCT p.jenis_produk, ', ') jenis_produk, string_agg(DISTINCT t.jenis_tanggung, ', ') jenis_tanggung, string_agg(DISTINCT r.jenis_resiko, ', ') jenis_resiko");
        $this->db->from('tr_jenis_resiko as jr');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');
        $this->db->join('m_jenis_produk as p', 'id_jenis_produk', 'inner');
        $this->db->join('m_jenis_tanggung as t', 'id_jenis_tanggung', 'inner');
        $this->db->join('m_jenis_resiko as r', 'id_jenis_resiko', 'inner');
        $this->db->where('jr.id_asuransi', $id_asuransi);
        $this->db->where('jr.id_jenis_produk', $id_jenis_produk);
        $this->db->group_by('s.id_asuransi');
        $this->db->group_by('p.id_jenis_produk');
        
        return $this->db->get();
    }

    // 01-04-2021
    public function cari_detail_penawaran($id_penawaran)
    {
        $this->db->select('s.nama_asuransi, b.nama_bpr, t.*');
        $this->db->from('tr_penawaran as t');
        $this->db->join('m_asuransi as s', 'id_asuransi', 'inner');
        $this->db->join('m_bpr as b', 'id_bpr', 'inner');
        $this->db->where('t.id_penawaran', $id_penawaran);
        
        return $this->db->get();
    }

}

?>
