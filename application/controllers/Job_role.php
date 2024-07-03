<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_role extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('job_role_model');
        $this->load->model('department_model');
        $this->_defaultview = [
            'objectname' => 'Job Role',
            'breadcrumbs' => [
                'Job Role'
            ]
        ];
    }

    public function search() {
        $view = $this->_defaultview;
        $view['breadcrumbs'][] = 'Search Job Role';
        $view['pagename'] = 'Search Job Role';
        $view['job_roles'] = $this->job_role_model->gettbl()->get()->result();
        $view['departments']=$this->department_model->gettbl()->get()->result();
        $view['content'] = $this->load->view('job_role/search', $view, true);
        $this->load->view('layouts/master', ['view' => $view]);
    }

    public function add() {
        $position_data = $this->input->post();
        if (!empty($position_data)) {
            $this->job_role_model->add_position($position_data);
            redirect('job_role/search');
        }
    }

    public function edit($position_id) {
        $position_data = $this->input->post();
        if (!empty($position_data)) {
            $this->job_role_model->edit_position($position_id, $position_data);
            redirect('job_role/search');
        }
    }

    public function delete($position_id) {
        $this->job_role_model->delete_position($position_id);
        redirect('job_role/search');
    }
}
