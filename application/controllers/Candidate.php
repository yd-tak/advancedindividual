<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('candidate_model');
        $this->_defaultview=[
        	'objectname'=>'Candidate',
        	'breadcrumbs'=>[
        		'Candidate'
        	]
        ];
    }

    public function search() {
    	$view=$this->_defaultview;
    	$view['breadcrumbs'][]='Search Candidate';
    	$view['pagename']='Search Candidate';
        $view['candidates'] = $this->candidate_model->gettbl()->get()->result();
        $view['content']=$this->load->view('candidate/search', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }

    public function add() {
        $input = $this->input->post();
        $this->candidate_model->add_candidate($input);
        redirect('candidate/search');
    }

    public function edit($id) {
        $input = $this->input->post();
        $this->candidate_model->edit_candidate($id, $input);
        redirect('candidate/search');
    }

    public function delete() {
        $input=$this->input->post();
        $this->candidate_model->delete_candidate($input['id']);
        redirect('candidate/search');
    }
}
?>
