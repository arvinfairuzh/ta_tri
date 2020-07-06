<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_laporan_crane extends CI_Model
{

    public function __construct()
    {

        $this->load->database();

        $this->column_order = array('tanggal', 'validasi', 'id_se', 'id_spv', 'id_inspektor', 'id_gudang'); //field yang ada di table user
        $this->column_search = array('tanggal', 'validasi', 'id_se', 'id_spv', 'id_inspektor', 'id_gudang'); //field yang ada di table user
        $this->order = array('tanggal' => 'asc'); // default order 
        $this->table = "(SELECT laporan_crane.id, laporan_crane.tanggal, laporan_crane.validasi, master_status.nama as nama_status,
        se.nama as id_se, spv.nama as id_spv, inspektor.nama as id_inspektor, gudang.nama as id_gudang
        FROM laporan_crane
        LEFT JOIN master_status on laporan_crane.validasi = master_status.id
        LEFT JOIN pegawai se on laporan_crane.id_se = se.id
        LEFT JOIN pegawai spv on laporan_crane.id_spv = spv.id
        LEFT JOIN pegawai inspektor on laporan_crane.id_inspektor = inspektor.id
        LEFT JOIN pegawai gudang on laporan_crane.id_gudang = gudang.id
        WHERE laporan_crane.status = 'ENABLE') as tabledata";
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)

                    $this->db->group_end();
            }
            $i++;
        }



        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }



    function get_datatables()
    {

        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }



    function count_filtered()
    {

        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }



    public function count_all()
    {

        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    function get_data()
    {

        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
}
