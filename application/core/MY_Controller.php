<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $domainarr=explode('.',$_SERVER['HTTP_HOST'],2);
        $subdomain=$domainarr[0];
        if(in_array($subdomain,['www','advin','localhost'])){
            $subdomain='passionjewelry';
        }
        $selectdb=$this->load->database('select',true);
        $client=$selectdb->where('domain',$subdomain)->get('clients')->row();
        // echo $subdomain;exit;
        $this->db=$this->load->database($client->dbname,true);
        // echo $client->dbname;exit;
        if($this->uri->segment(1)!=="auth" && !($this->uri->segment(1)=="vacancy" && in_array($this->uri->segment(2),['apply','applyp','complete','completep','confirm_offering'])) && !$this->uri->segment(1)=="interview"){
            if(!$this->session->has_userdata('login')){
                redirect("auth/signin");
            }
        }
    }
}
