<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        if($this->uri->segment(1)!=="auth" && !($this->uri->segment(1)=="vacancy") && in_array($this->uri->segment(2),['apply','applyp','complete','completep'])){
            if(!$this->session->has_userdata('login')){
                redirect("auth/signin");
            }
        }
    }
}
