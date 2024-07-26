<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Speech extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Speech_model');
    }

    public function index()
    {
        // putenv("GOOGLE_APPLICATION_CREDENTIALS=".base_url('advin-430506-337b39c20ec5.json'));
        echo "GAC: ".getenv("GOOGLE_APPLICATION_CREDENTIALS");
        $this->load->view('speechtotext');
    }

    public function recognize()
    {
        $result = $this->Speech_model->recognize_audio();
        echo json_encode($result);
    }
    public function test(){
        $result=$this->Speech_model->test_audio();
    }
}
