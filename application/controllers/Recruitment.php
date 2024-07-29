<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment extends MY_Controller {

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
    public function recruitment_template($templatecode,$language='english'){
        $view=$this->_defaultview;
        // $templatecode='';
        switch($templatecode){
            case 'offering_template':
                $pagename='Offering Letter Template';
                break;
            case 'rejected_template':
                $pagename='Rejection Letter Template';
                break;
            case 'accepted_template':
                $pagename='Acceptance Letter Template';
                break;
            case 'interview_template':
                $pagename='Interview Letter Template';
                break;

        }
        $view['breadcrumbs'][]=$pagename;
        $view['pagename']=$pagename;
        $view['language']=$language;
        if($language=='english'){
            $language2='indonesia';
        }
        else{
            $language2='english';
        }
        $view['language2']=$language2;
        $view['templatecode']=$templatecode;
        $view['template']=getsetting($templatecode.'_'.$language);
        $view['content']=$this->load->view('recruitment/recruitment_template',$view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }
    public function recruitment_templatep(){
        $input=$this->input->post();
        $this->db->where('param',$input['templatecode'].'_'.$input['language'])->update('setting',['val'=>$input['val']]);
        redirect($this->input->server("HTTP_REFERER"));
    }
    public function generate_recruitment_template($templatecode,$language){
        switch($templatecode){
            case 'offering_template':
                $template=$this->recruitment_model->generate_offering_template($language);
                break;
            case 'accepted_template':
                $template=$this->recruitment_model->generate_accepted_template($language);
                break;
            case 'rejected_template':
                $template=$this->recruitment_model->generate_rejected_template($language);
                break;
            case 'interview_template':
                $template=$this->recruitment_model->generate_interview_template($language);
                break;
        }
        echo json_encode(['template'=>$template]);
    }
}
?>
