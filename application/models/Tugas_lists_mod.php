<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tugas_lists_mod extends CI_Model
{

    public $table = 'tb_tugas_lists';
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
	$this->db->or_like('dari', $q);
	$this->db->or_like('kepada', $q);
	$this->db->or_like('prioritas', $q);
	$this->db->or_like('subject_kepentingan', $q);
	$this->db->or_like('deskripsi', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('status_selesai', $q);
	$this->db->or_like('member_id', $q);
	$this->db->or_like('admin_id', $q);
	$this->db->or_like('date_input', $q);
	$this->db->or_like('date_finish', $q);
	$this->db->or_like('data', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('dari', $q);
	$this->db->or_like('kepada', $q);
	$this->db->or_like('prioritas', $q);
	$this->db->or_like('subject_kepentingan', $q);
	$this->db->or_like('deskripsi', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('status_selesai', $q);
	$this->db->or_like('member_id', $q);
	$this->db->or_like('admin_id', $q);
	$this->db->or_like('date_input', $q);
	$this->db->or_like('date_finish', $q);
	$this->db->or_like('data', $q);
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

/* End of file Tugas_lists_mod.php */
/* Location: ./application/models/Tugas_lists_mod.php */
