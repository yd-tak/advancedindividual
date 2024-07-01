<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('credit_model');
        $this->_defaultview=[
        	'objectname'=>'Credit',
        	'breadcrumbs'=>[
        		'Credit'
        	]
        ];
    }

    public function statements() {
        $input=$this->input->get();
    	$view=$this->_defaultview;
    	$view['breadcrumbs'][]='Credit Statements';
    	$view['pagename']='Credit Statements';
        $view['creditbalance']=$this->credit_model->getbalance();
        $view['cbs'] = $this->credit_model->getHistory($input);
        $view['content']=$this->load->view('credit/statements', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }

    
}
?>
