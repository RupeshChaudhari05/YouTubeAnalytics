<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function add($data) {
		$this->db->insert('Employees', $data);
		return $this->db->insert_id();
	}

	public function update($where, $data) {
		return $this->db->update('Employees', $data, $where);
	}

	public function delete($where) {
		return $this->db->delete('Employees', $where);
	}

	public function get($where = 0) {
		if($where) 
			$this->db->where($where);
		$query = $this->db->get('Employees');
		return $query->row();
	}

	public function get_all($where = 0, $order_by_column = 0, $order_by = 0) {
		if($where) 
			$this->db->where($where);
		if($order_by_column and $order_by) 
			$this->db->order_by($order_by_column, $order_by);
		$query = $this->db->get('Employees');
		return $query->result();
	}

	public function get_num_rows($where = 0) {
		if($where) 
			$this->db->where($where);
		$query = $this->db->get('Employees');		
		return $query->num_rows();
	}

	public function add_batch($data) {
		return $this->db->insert_batch('Employees', $data);
	}

   public function login_user($username, $password) {
        $this->db->where('Email', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('Employees');
        return $query->row();
    }

}