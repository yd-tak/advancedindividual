<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancy extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('vacancy_model');
        $this->_defaultview=[
        	'objectname'=>'Job Vacancy',
        	'breadcrumbs'=>[
        		'Job Vacancy'
        	]
        ];
        $this->load->model("openai_core");
    }

    public function search() {
        $input=$this->input->get();
    	$view=$this->_defaultview;
    	$view['pagename']=$view['breadcrumbs'][]='Search Job Vacancy';
        $view['vacancies'] = $this->vacancy_model->gets($input);
        // pre($view['vacancies']);
        $view['content']=$this->load->view('vacancy/search', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }
    public function new(){
        $view=$this->_defaultview;
        $prep=$this->vacancy_model->prep_new();
        $view+=$prep;
        $tests=$this->db->get('tests')->result();
        $view['tests']=$tests;
        $view['creditbalance']=$this->credit_model->getbalance();
        $view['pagename']=$view['breadcrumbs'][]='Add New Vacancy';
        $view['content']=$this->load->view('vacancy/new', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }
    public function view($id){
        $view=$this->_defaultview;
        $vacancy=$this->vacancy_model->get($id);
        $this->search_model->logView(getLoginSession('id'),'Vacancy',$vacancy->id,$vacancy->title,'vacancy/view/'.$id);
        $view['vacancy']=$vacancy;
        $view['pagename']=$view['breadcrumbs'][]='View Vacancy - '.$vacancy->title;
        $view['content']=$this->load->view('vacancy/view', $view,true);
        $this->load->view('layouts/master',['view'=>$view]);
    }
    public function viewstage($id,$stageid){
        $view=$this->_defaultview;
        $input=$this->input->get();
        $vacancy=$this->vacancy_model->get($id,$input);
        // pre($vacancy);
        $stage=$this->db->where('id',$stageid)->get('stages')->row(0);
        $stages=$this->db->order_by('no')->get('stages')->result();
        $this->search_model->logView(getLoginSession('id'),'Vacancy',$vacancy->id,$vacancy->title.' - '.$stage->name,'vacancy/viewstage/'.$id.'/'.$stageid);
        $view['get']=$input;
        $view['vacancy']=$vacancy;
        $view['stage']=$stage;
        $view['stages']=$stages;
        $view['pagename']="View Vacancy - ".$vacancy->title." [".$stage->name."]";
        $view['breadcrumbs'][]='View Vacancy - '.$vacancy->title;
        $view['breadcrumbs'][]=$stage->name;
        $view['content']=$this->load->view('vacancy/viewstage', $view,true);
        $this->load->view('layouts/master',['view'=>$view]);
    }
    public function add() {
        $input = $this->input->post();
        // pre($input);
        $this->db->trans_start();
        $id=$this->vacancy_model->add($input);
        $this->set_ai_interviewer($id);
        $this->db->trans_complete();
        // redirect('vacancy/view/'.$id);
    }
    public function set_ai_interviewer($id){
        $vacancy=$this->vacancy_model->gettbl()->where('v.id',$id)->get()->row();
        $assistant_id=$this->openai_core->create_interviewer($vacancy->title,$this->company_model->get(),$vacancy->jobdesc,$vacancy->interviewlang);
        $this->db->where('id',$id)->update('vacancies',['interview_assistantid'=>$assistant_id]);
    }
    
    public function update($id){
        $view=$this->_defaultview;
        $prep=$this->vacancy_model->prep_new();
        $view+=$prep;
        $vacancy=$this->vacancy_model->get($id);
        // pre($vacancy);
        $tests=$this->db->get('tests')->result();
        $view['tests']=$tests;
        $view['vacancy']=$vacancy;
        $view['creditbalance']=$this->credit_model->getbalance();
        $view['pagename']=$view['breadcrumbs'][]='Edit Vacancy';
        $view['content']=$this->load->view('vacancy/update', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }
    public function edit() {
        $input = $this->input->post();
        $this->vacancy_model->edit($input);
        $this->session->set_flashdata('success', "Edit Vacancy Success");
        redirect('vacancy/search');
    }

    public function delete() {
        $input=$this->input->post();
        $this->vacancy_model->delete($input['id']);
        redirect('vacancy/search');
    }
    public function viewvc($vcid){
        $this->load->model("candidate_model");
        $vc=$this->vacancy_model->gettblvc()->where('vc.id',$vcid)->get()->row();
        $candidate=$this->candidate_model->get($vc->candidateid);

        if($vc->cvresult!==null){
            $vc->cvresult=json_decode($vc->cvresult);
        }
        else{
            $vc->cvresult=(object)[
                'evaluation'=>'',
                'explanation'=>''
            ];
        }
        // pre($vc);
        $stage=$this->db->where('id',$vc->stageid)->get('stages')->row();
        $stages=$this->db->order_by('no')->get('stages')->result();
        $html=$this->load->view('vacancy/vc-modal',['vc'=>$vc,'candidate'=>$candidate,'stages'=>$stages,'stage'=>$stage],true);
        echo json_encode(['html'=>$html]);
    }
    public function confirm_offering($vcid){
        $view=$this->_defaultview;
        $vc=$this->vacancy_model->getvc($vcid);
        $vacancy=$this->vacancy_model->get($vc->vacancyid);

        $view['vacancy']=$vacancy;
        $view['vc']=$vc;
        $view['pagename']=$view['breadcrumbs'][]='Confirm Your Offering - '.$vacancy->title;
        $view['content']=$this->load->view('vacancy/confirm-offering', $view,true);
        $this->load->view('layouts/master',['view'=>$view,'hideheader'=>true,'hidesidebar'=>true]);
    }
    public function apply($id,$status=false){
        $view=$this->_defaultview;

        $vacancy=$this->vacancy_model->get($id);
        $view['vacancy']=$vacancy;
        if($status){
            $view['status']=$status;
        }
        $view['pagename']=$view['breadcrumbs'][]='Apply for Vacancy - '.$vacancy->title;
        $view['content']=$this->load->view('vacancy/apply', $view,true);
        $this->load->view('layouts/master',['view'=>$view,'hideheader'=>true,'hidesidebar'=>true]);
    }
    public function applyp(){
        $this->load->model("candidate_model");
        $input=$this->input->post();
        $config['upload_path']          = './assets/uploads/cvs/';
        $config['allowed_types']        = 'pdf';
        
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect($this->input->server('HTTP_REFERER'));
        }
        $uploaddata = $this->upload->data();
        $cv=$uploaddata['file_name'];
        $cvpath=$config['upload_path'].$cv;
        $input['cvfile']=$cv;
        $this->db->trans_start();
        $candidateid=$this->vacancy_model->add_new_candidate($input,$cvpath);
        $this->candidate_model->parse_airesult($candidateid);
        $candidate=$this->db->where('id',$candidateid)->get('candidates')->result();
        $vc=$this->db->where('vacancyid',$input['vacancyid'])->where('candidateid',$candidateid)->get('vc')->row();
        $this->vacancy_model->scorecv($vc->id,$candidate->airesult);

        $this->db->trans_complete();
        redirect("vacancy/complete/".$vc->id);

    }
    public function complete($vcid){
        $this->load->model("candidate_model");
        $view=$this->_defaultview;
        $vc=$this->db->where('id',$vcid)->get('vc')->row();
        $vacancy=$this->vacancy_model->get($vc->vacancyid);
        $candidate=$this->candidate_model->get($vc->candidateid);
        $degrees=$this->db->get('degrees')->result();
        $view['vacancy']=$vacancy;
        $view['candidate']=$candidate;
        $view['degrees']=$degrees;
        // echo json_encode($candidate);
        // pre($view['candidate']);
        $view['vcid']=$vcid;
        $view['pagename']=$view['breadcrumbs'][]='Complete your CV - '.$vacancy->title;
        $view['content']=$this->load->view('vacancy/complete', $view,true);
        $this->load->view('layouts/master',['view'=>$view,'hideheader'=>true,'hidesidebar'=>true]);
    }
    public function completep(){
        $this->load->model("candidate_model");
        $input=$this->input->post();
            
        $vcid=$input['vcid'];
        unset($input['vcid']);
        // pre($input);
        $vc=$this->db->where('id',$vcid)->get('vc')->row();

        $this->db->trans_start();
        $candidatefull=$this->candidate_model->complete($vcid,$vc->candidateid,$input);
        $this->vacancy_model->scorecv($vc->id,json_encode($candidatefull));
        $this->db->trans_complete();
        redirect("vacancy/apply/".$vc->vacancyid.'/success');

    }
    public function accept_vcs(){
        $input=$this->input->post();
        $this->db->trans_start();
        $input['acceptedby']='recruiter';
        $result=$this->vacancy_model->acceptvcs($input);
        $this->db->trans_complete();
        echo json_encode($input);
    }
    public function reject_vcs(){
        $input=$this->input->post();
        $this->db->trans_start();
        $input['rejectedby']='recruiter';
        $result=$this->vacancy_model->rejectvcs($input);
        $this->db->trans_complete();
        echo json_encode($input);
    }
    public function reject_offering(){
        $input=$this->input->post();
        // pre($input);
        $input['vcsids']=[$input['vcsid']];
        $this->db->trans_start();
        $input['rejectedby']='candidate';
        $result=$this->vacancy_model->rejectvcs($input);
        $this->db->trans_complete();
        redirect($this->input->server("HTTP_REFERER"));
    }
    public function accept_offering(){
        $input=$this->input->post();
        // pre($input);
        $input['stageid']=8;
        $input['vcsids']=[$input['vcsid']];
        $this->db->trans_start();
        $input['acceptedby']='candidate';
        // pre($input);
        $result=$this->vacancy_model->acceptvcs($input);
        $this->db->trans_complete();
        redirect($this->input->server("HTTP_REFERER"));
    }
    public function generate_jobdesc(){
        $input=$this->input->get();
        $jobdesc=$this->vacancy_model->generate_jobdesc($input);
        echo json_encode(['jobdesc'=>$jobdesc]);
    }
    public function offer_vc(){
        $input=$this->input->post();
        $this->db->trans_start();
        $this->vacancy_model->offer_vc($input);
        $this->db->trans_complete();
        echo json_encode(['message'=>'offered']);
    }
    public function view_offered($vcid){
        // $view=$this->_defaultview;
        // $view['pagename']=$view['breadcrumbs'][]='View Offering Letter';
        // $view['pdfpath']='assets/offering/vc-'.$vcid.'.pdf';
        // $view['content']=$this->load->view('vacancy/view-offered', $view,true);
        // $this->load->view('layouts/master',['view'=>$view,'hideheader'=>true]);
        $this->vacancy_model->create_offering_pdf($vcid);
    }
    public function userinterview_vc(){
        $input=$this->input->post();
        $this->db->trans_start();
        $this->vacancy_model->userinterview_vc($input);
        $this->db->trans_complete();
        echo json_encode(['message'=>'sent']);
    }
    public function view_userinterview($vcid){
        $vc=$this->db->where('id',$vcid)->get('vc')->row();
        redirect($vc->meet_uri);
    }
}
?>
