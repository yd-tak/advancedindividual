<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('department_model');
        $this->_defaultview = [
            'objectname' => 'Department',
            'breadcrumbs' => [
                'Department'
            ]
        ];
    }

    public function search() {
        $view = $this->_defaultview;
        $view['breadcrumbs'][] = 'Search Department';
        $view['pagename'] = 'Search Department';
        $view['departments'] = $this->department_model->gettbl()->get()->result();
        $view['content'] = $this->load->view('department/search', $view, true);
        $this->load->view('layouts/master', ['view' => $view]);
    }

    public function add() {
        $department_data = $this->input->post();
        if (!empty($department_data)) {
            $this->department_model->add_department($department_data);
            redirect('department/search');
        }
    }

    public function edit($department_id) {
        $department_data = $this->input->post();
        if (!empty($department_data)) {
            $this->department_model->edit_department($department_id, $department_data);
            redirect('department/search');
        }
    }

    public function delete($department_id) {
        $this->department_model->delete_department($department_id);
        redirect('department/search');
    }
}
