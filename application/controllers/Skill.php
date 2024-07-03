<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function ajax_search() {
    	$input=$this->input->get();
        $results=$this->db->select('id,name as text')->like('name',$input['search'])->where('type',$input['type'])->get('skills')->result();
        echo json_encode(['results'=>$results]);
    }
    
}
?>
