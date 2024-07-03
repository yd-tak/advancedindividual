<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('location_model');
        $this->_defaultview = [
            'objectname' => 'Location',
            'breadcrumbs' => [
                'Location'
            ]
        ];
    }

    public function search() {
        $view = $this->_defaultview;
        $view['breadcrumbs'][] = 'Search Location';
        $view['pagename'] = 'Search Location';
        $view['locations'] = $this->location_model->gettbl()->get()->result();
        $view['content'] = $this->load->view('location/search', $view, true);
        $this->load->view('layouts/master', ['view' => $view]);
    }

    public function add() {
        $location_data = $this->input->post();
        if (!empty($location_data)) {
            $this->location_model->add_location($location_data);
            redirect('location/search');
        }
    }

    public function edit($location_id) {
        $location_data = $this->input->post();
        if (!empty($location_data)) {
            $this->location_model->edit_location($location_id, $location_data);
            redirect('location/search');
        }
    }

    public function delete($location_id) {
        $this->location_model->delete_location($location_id);
        redirect('location/search');
    }
}
