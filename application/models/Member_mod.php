<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_mod extends CI_Model
{

    public $table = 'tb_member';
    public $id = 'id';
    public $order = 'DESC';

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
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('jabatan', $q);
	$this->db->or_like('nick_name', $q);
	$this->db->or_like('alamat_rumah', $q);
	$this->db->or_like('telp_aktif', $q);
	$this->db->or_like('telp_saudara', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('foto_diri', $q);
	$this->db->or_like('foto_ktp', $q);
	$this->db->or_like('nama_subkontraktor', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('jabatan', $q);
	$this->db->or_like('nick_name', $q);
	$this->db->or_like('alamat_rumah', $q);
	$this->db->or_like('telp_aktif', $q);
	$this->db->or_like('telp_saudara', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('foto_diri', $q);
	$this->db->or_like('foto_ktp', $q);
	$this->db->or_like('nama_subkontraktor', $q);
	$this->db->or_like('status', $q);
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

/* End of file Member_mod.php */
/* Location: ./application/models/Member_mod.php */
