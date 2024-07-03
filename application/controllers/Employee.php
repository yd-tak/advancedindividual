<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('department_model');
        $this->load->model('job_role_model');
        $this->load->model('location_model');
        $this->_defaultview=[
            'objectname'=>'Employee',
            'breadcrumbs'=>[
                'Employee'
            ]
        ];
    }

    public function search() {
        $view=$this->_defaultview;
        $view['breadcrumbs'][]='Search Employee';
        $view['pagename']='Search Employee';
        $view['employees'] = $this->employee_model->gettbl()->select('d.name department,l.name location,jp.name job_role')->get()->result();
        $view['departments'] = $this->department_model->gettbl()->get()->result();
        $view['job_roles'] = $this->job_role_model->gettbl()->get()->result();
        $view['locations'] = $this->location_model->gettbl()->get()->result();
        $view['content']=$this->load->view('employee/search', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }

    public function add() {
        $employee_data = $this->input->post();
        $this->employee_model->add_employee($employee_data);
        redirect('employee/search');
    }

    public function edit($employee_id) {
        $employee_data = $this->input->post();
        $this->employee_model->edit_employee($employee_id, $employee_data);
        redirect('employee/search');
    }

    public function delete($employee_id) {
        $this->employee_model->delete_employee($employee_id);
        redirect('employee/search');
    }
}
?>
