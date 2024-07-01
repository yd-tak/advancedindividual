<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {
    public function gettbl() {
        // Perform a left join with the users table
        return $this->db->select('e.*')->from('employees e')->join('users u', 'e.userid = u.id', 'left')->join('departments d','e.departmentid=d.id')->join('job_roles jp','e.jobpositionid=jp.id')->join('locations l','e.locationid=l.id');
    }

    public function add_employee($data) {
        // Insert a new employee into the database
        return $this->db->insert('employees', $data);
    }

    public function edit_employee($employee_id, $data) {
        // Update an existing employee in the database
        $this->db->where('id', $employee_id);
        return $this->db->update('employees', $data);
    }

    public function delete_employee($employee_id) {
        // Delete an employee from the database
        $this->db->where('id', $employee_id);
        return $this->db->delete('employees');
    }

}
