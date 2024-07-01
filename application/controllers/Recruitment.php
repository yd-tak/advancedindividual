<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('recruitment_model');
        $this->_defaultview=[
        	'objectname'=>'Recruitment',
        	'breadcrumbs'=>[
        		'Recruitment'
        	]
        ];
    }
    public function viewstage($stageid){
        $stage=$this->recruitment_model->get($stageid);
        echo json_encode(['stage'=>$stage]);
    }
    public function addstage() {
        $input = $this->input->post();
        $this->recruitment_model->add_stage($input);
        redirect('recruitment/setting');
    }

    public function editstage($id) {
        $input = $this->input->post();
        $this->recruitment_model->edit_stage($id, $input);
        redirect('recruitment/setting');
    }

    public function deletestage() {
        $input=$this->input->post();
        // pre($input);
        $this->recruitment_model->delete_stage($input['id']);
        redirect('recruitment/setting');
    }
    public function setting(){
        $view=$this->_defaultview;
        $view['breadcrumbs'][]='Recruitment Setting';
        $view['pagename']='Recruitment Setting';
        $view['stages']=$this->recruitment_model->get_active_stages();
        $view['content']=$this->load->view('recruitment/setting',$view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }
    public function offering_template($language='english'){
        $view=$this->_defaultview;
        $view['breadcrumbs'][]='Offering Letter Template';
        $view['pagename']='Offering Letter Template Setting';
        $view['language']=$language;
        if($language=='english'){
            $language2='indonesia';
        }
        else{
            $language2='english';
        }
        $view['language2']=$language2;
        $view['template']=getsetting('offering_template_'.$language);
        $view['content']=$this->load->view('recruitment/offering_template',$view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }
    public function offering_templatep(){
        $input=$this->input->post();
        $this->db->where('param','offering_template_'.$input['language'])->update('setting',['val'=>$input['val']]);
        redirect($this->input->server("HTTP_REFERER"));
    }
    public function generate_offering_template($language){
        $template=$this->recruitment_model->generate_offering_template($language);
        echo json_encode(['template'=>$template]);
    }
}
?>
