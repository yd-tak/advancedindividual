<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->_defaultview=[
        	'objectname'=>'Users',
        	'breadcrumbs'=>[
        		'Users'
        	]
        ];
    }

    public function search() {
        $input=$this->input->get();
    	$view=$this->_defaultview;
    	$view['breadcrumbs'][]='Search Users';
    	$view['pagename']='Search Users';
        $view['roles']=$this->db->get('user_roles')->result();
        $view['users']=$this->db->select("u.*,r.name role,(case when u.isactive then 'Active' else 'Inactive' end) status")->from('users u')->join('user_roles r','u.roleid=r.id')->get()->result();
        $view['content']=$this->load->view('users/search', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }
    public function add(){
        $input=$this->input->post();
        $this->user_model->add($input);
        redirect($this->input->server("HTTP_REFERER"));
    }
    public function edit(){
        $input=$this->input->post();
        $this->user_model->edit($input);
        redirect($this->input->server("HTTP_REFERER"));
    }
    
}
?>
