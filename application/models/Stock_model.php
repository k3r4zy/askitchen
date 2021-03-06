<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock_model extends CI_Model
{

    public $table = 'stock';
    public $id = 'kdbar';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('kdbar, nama, kdgol2, format(hjual,0,"id") as hjual, pnj, lbr, tgi, gambar');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get data by category
    function get_by_category($limit, $start = 0, $code)
    {
        $this->db->select('kdbar, nama, format(hjual,0,"de") as hjual, pnj, lbr, tgi, gambar');
        // $this->db->where('kdgol2', $code);
        $this->db->like('kdgol', $code);
        $this->db->or_like('kdgol2', $code);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data by food category
    function get_by_food_category($limit, $start = 0, $tag)
    {
        $this->db->select('kdbar, nama, format(hjual,0,"de") as hjual, pnj, lbr, tgi, gambar');
        // $this->db->where('kdgol2', $code);
        $this->db->like('tag', $tag);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get data by brand
    function get_by_brand($limit, $start = 0, $code, $brand)
    {
        $this->db->where($this->kdgol2, $code);
        $this->db->where($this->merk, $brand);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->row();
    }

    // get related product
    function get_related($kode, $kdbar)
    {
        $this->db->select('kdbar, nama, format(hjual,0,"id") as hjual, pnj, lbr, tgi, gambar')
            ->from('stock')
            ->where('kdgol2', $kode)
            ->where('kdbar !=', $kdbar)
            ->order_by('kdbar', 'ASC');
        return $this->db->get()->result();
    }

    // get random product
    function get_random_products($kode, $kdbar)
    {
        $this->db->select('kdbar, nama, format(hjual,0,"id") as hjual, pnj, lbr, tgi, gambar')
            ->from('stock')
            ->where('kdgol2', $kode)
            ->where('kdbar !=', $kdbar)
            ->order_by('kdbar', 'ASC');
        return $this->db->get()->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kdbar', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('kdgol', $q);
        $this->db->or_like('kdgol2', $q);
        $this->db->or_like('pnj', $q);
        $this->db->or_like('lbr', $q);
        $this->db->or_like('tgi', $q);
        $this->db->or_like('listrik', $q);
        $this->db->or_like('kapasitas', $q);
        $this->db->or_like('gas', $q);
        $this->db->or_like('berat', $q);
        $this->db->or_like('fitur', $q);
        $this->db->or_like('disc', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        
        $this->db->select('kdbar, nama, format(hjual,0,"id") as hjual, pnj, lbr, tgi, gambar');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kdbar', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('kdgol', $q);
        $this->db->or_like('kdgol2', $q);
        $this->db->or_like('pnj', $q);
        $this->db->or_like('lbr', $q);
        $this->db->or_like('tgi', $q);
        $this->db->or_like('listrik', $q);
        $this->db->or_like('kapasitas', $q);
        $this->db->or_like('gas', $q);
        $this->db->or_like('berat', $q);
        $this->db->or_like('fitur', $q);
        $this->db->or_like('disc', $q);
	    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // get global price range
    function get_global_price_range()
    {
        $this->db->select('MIN(hjual) as hmin, MAX(hjual) as hmax');
        return $this->db->get($this->table)->result();
    }

    // get price range by category
    function get_price_range($code)
    {
        $this->db->select('MIN(hjual) as hmin, MAX(hjual) as hmax');
        $this->db->where('kdgol2', $code);
        return $this->db->get($this->table)->result();
    }

    // get item reviews
    function get_reviews($code)
    {
        $this->db->select('comment');
        $this->db->order_by('timestamp', 'DESC');
        $this->db->where('kdbar', $code);
        return $this->db->get('reviews')->result();
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

/* End of file Stock_model.php */
/* Location: ./application/models/Stock_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-05 15:06:53 */
/* http://harviacode.com */