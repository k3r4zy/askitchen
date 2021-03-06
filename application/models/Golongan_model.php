<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Golongan_model extends CI_Model
{

    public $table = 'golongan';
    public $id = 'kdgol';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get sample
    function get_sample($kode)
    {
        // $this->db->query("select skdgol2, s.kdbar, g.nama where s.kdgol2 = g.kdgol2 and s.kdgol2 = '$kode'")
        $this->db->select('stock.kdgol, stock.kdgol2, stock.kdbar, stock.gambar, golongan2.nama')
            ->from('stock')
            ->join('golongan2', 'stock.kdgol2 = golongan2.kdgol2')
            ->group_by('stock.kdgol2')
            ->having('stock.kdgol', $kode)
            ->order_by('stock.kdgol2', 'ASC');
        return $this->db->get()->result();
    }

    // get sub category
    function get_sub_category($kode)
    {
        $this->db->select('kdgol2, nama')
            ->from('golongan2')
            ->where('kdgol', $kode)
            ->order_by('kdgol2', 'ASC');
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by sub-id
    function get_by_subid($id)
    {
        $this->db->where('kdgol2', $id);
        return $this->db->get('golongan2')->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kdgol', $q);
        $this->db->or_like('nama', $q);
        // $this->db->or_like('detail', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kdgol', $q);
        $this->db->or_like('nama', $q);
        // $this->db->or_like('detail', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Golongan_model.php */
/* Location: ./application/models/Golongan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-05 15:06:21 */
/* http://harviacode.com */