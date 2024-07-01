<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {
    public function gettbl() {
        // This example assumes a simple structure. Adjust the join as needed for your application.
        return $this->db->from('departments');
    }

    public function add_department($data) {
        // Insert a new department into the database
        return $this->db->insert('departments', $data);
    }

    public function edit_department($department_id, $data) {
        // Update an existing department in the database
        $this->db->where('id', $department_id);
        return $this->db->update('departments', $data);
    }

    public function delete_department($department_id) {
        // Delete a department from the database
        $this->db->where('id', $department_id);
        return $this->db->delete('departments');
    }
}
