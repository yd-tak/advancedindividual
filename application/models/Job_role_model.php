<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_role_model extends CI_Model {
    public function gettbl() {
        // Adjust this method as needed for your application, e.g., if joining with other tables.
        return $this->db->select('jp.*')->from('job_roles jp');
    }

    public function add_position($data) {
        // Insert a new job position into the database
        return $this->db->insert('job_roles', $data);
    }

    public function edit_position($position_id, $data) {
        // Update an existing job position in the database
        $this->db->where('id', $position_id);
        return $this->db->update('job_roles', $data);
    }

    public function delete_position($position_id) {
        // Delete a job position from the database
        $this->db->where('id', $position_id);
        return $this->db->delete('job_roles');
    }
}
