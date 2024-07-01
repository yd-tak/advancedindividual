<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model {
    public function gettbl() {
        // Adjust this method as needed for your application, e.g., if joining with other tables.
        return $this->db->from('locations');
    }

    public function add_location($data) {
        // Insert a new location into the database
        return $this->db->insert('locations', $data);
    }

    public function edit_location($location_id, $data) {
        // Update an existing location in the database
        $this->db->where('id', $location_id);
        return $this->db->update('locations', $data);
    }

    public function delete_location($location_id) {
        // Delete a location from the database
        $this->db->where('id', $location_id);
        return $this->db->delete('locations');
    }
}
