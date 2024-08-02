<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use OpenAI;
// use OpenAI\Client;
class Tools extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('openai_core');
        $this->load->model('vacancy_model');
        $this->load->model('interview_model');
        $this->load->model('candidate_model');
        
    }
    public function reset_interview($vcid){
        $vc=$this->db->where('id',$vcid)->get('vc')->row();
        $this->db->where('id',$vcid)->update('vc',[
            'aiinterviewstarted'=>0,
            'aiinterviewdone'=>0,
            'interviewurisent'=>0,
            'interview_threadid'=>null,
            'avgscore'=>$vc->cvscore
        ]);
        $this->db->where('vcid',$vcid)->delete('vc_interviews');
        $this->db->where('vcid',$vcid)->where('stageid',2)->delete('vc_stages');
        $this->interview_model->start($vcid);
    }
    public function test_gmeet(){
        $this->load->model('gcp_model');
        $summary = 'Interview Invitation 31 Jul 2024 | Flutter Developer | PT PASSION ABADI KORPORA';
        $description = 'Hi Yudhistira, you are invited for user interview for Flutter Developer position at 31 Jul 2024';

        $event = $this->gcp_model->create_space_sample();

        pre($event);
    }
    public function apppath(){
        echo APPPATH;
    }
    public function deletecandidate($id){
        $this->db->trans_start();
        $vcs=$this->db->where('candidateid',$id)->get('vc')->result();
        $vcids=[];
        foreach($vcs as $row){
            $vcids[]=$row->id;
        }
        $this->db->where('id',$id)->delete('candidates');
        $this->db->where('candidateid',$id)->delete('candidate_awards');
        $this->db->where('candidateid',$id)->delete('candidate_certifications');
        $this->db->where('candidateid',$id)->delete('candidate_educations');
        $this->db->where('candidateid',$id)->delete('candidate_projects');
        $this->db->where('candidateid',$id)->delete('candidate_refs');
        $this->db->where('candidateid',$id)->delete('candidate_skills');
        $this->db->where('candidateid',$id)->delete('candidate_socmeds');
        $this->db->where('candidateid',$id)->delete('candidate_volunteerworks');
        $this->db->where('candidateid',$id)->delete('candidate_workexps');
        $this->db->where_in('id',$vcids)->delete('vc');
        $this->db->where_in('vcid',$vcids)->delete('vc_interviews');
        $this->db->where_in('vcid',$vcids)->delete('vc_interviews');
        $this->db->where_in('vcid',$vcids)->delete('vc_stages');
        $vctests=$this->db->where_in('vcid',$vcids)->get('vc_tests')->result();
        $vctestids=[];
        foreach($vctests as $row){
            $vctestids[]=$row->id;
        }
        if(!empty($vctestids))
            $this->db->where_in('vctestid',$vctestids)->delete('vc_test_details');
        $this->db->where_in('vcid',$vcids)->delete('vc_tests');
        $this->db->trans_complete();
        echo "DELETE $id SUCCESS";
    }
    
    public function universalsearch(){
        $get=$this->input->get();
        $searchresults=$this->search_model->run($get['keyword']);
        // pre($searchresults);
        $html=$this->load->view('universal-search-result',['searchresults'=>$searchresults],true);
        echo json_encode(['html'=>$html]);
    }
    public function sendemail(){
        sendHelperEmail("yudhistiradewanata@gmail.com","Account Verification New","Hi nice to meet you, i am Advin AI");
    }
    public function get_text_normalizer() {
        $assistant=$this->openai_core->text_normalizer();
        // pre($response);
        return $assistant;
    }
    public function get_cv_parser(){
        $assistant=$this->openai_core->cv_parser();
        // pre($assistant);
        return $assistant;
    }
    public function save_assistant($assistant_id){
        $assistant=$this->openai_core->save_assistant($assistant_id);
        // pre($assistant);
        return $assistant;
    }
    public function convert_cv($inputfile,$outputfile){
        ob_start();
        $command=('/Library/Frameworks/Python.framework/Versions/3.12/bin/python3 /applications/ampps/www/aihr/readpdf.py '.$inputfile.' '.$outputfile);
        passthru($command);
        $output = ob_get_clean(); 
        return $output;
        // echo $output;
    }
    public function test_run_ai($inputfilename,$type,$doPython=0){
        $outputfile='cv-read-result.txt';
        if($doPython){
            $this->convert_cv($inputfilename.".".$type,$outputfile);
        }
        $filecontent=file_get_contents($outputfile);
        echo $filecontent;
        $this->openai_core->run_extract_cv($filecontent);
    }
    public function set_ai_interviewer($id){
        $vacancy=$this->vacancy_model->gettbl()->where('v.id',$id)->get()->row();
        $assistant_id=$this->openai_core->create_interviewer($vacancy->title,$this->company_model->get(),$vacancy->jobdesc,$vacancy->interviewlang);
        $this->db->where('id',$id)->update('vacancies',['interview_assistantid'=>$assistant_id]);
    }
    public function create_interview($vcid){
        $vc=$this->vacancy_model->gettblvc()->select("v.interview_assistantid,concat(c.firstname,' ',c.lastname) fullname")->where('vc.id',$vcid)->get()->row();
        $this->openai_core->set_assistant($vc->interview_assistantid);
        $run=$this->openai_core->create_interview($vc->fullname,$vc->cvresult);
        pre($run);
    }
    public function get_interview_messages($vcid){
        $vc=$this->vacancy_model->gettblvc()->select("v.interview_assistantid,vc.interview_threadid")->where('vc.id',$vcid)->get()->row();
        $this->openai_core->set_assistant($vc->interview_assistantid);
        $this->openai_core->set_thread($vc->interview_threadid);
        $messages=$this->openai_core->_get_messages();
        pre($messages);

    }
    public function get_test_messages($vctid){
        $vct=$this->db->where('id',$vctid)->get('vc_tests')->row();
        $this->openai_core->set_assistant($vct->test_assistantid);
        $this->openai_core->set_thread($vct->test_threadid);
        $messages=$this->openai_core->_get_messages();
        pre($messages);

    }
    public function check_test_status($vctid){
        $vct=$this->db->where('id',$vctid)->get('vc_tests')->row();
        // pre($vct);
        $this->openai_core->set_assistant($vct->test_assistantid);
        $this->openai_core->set_thread($vct->test_threadid);
        $messages=$this->openai_core->_get_messages();
        $this->db->trans_start();
        foreach($messages as $row){
            $json=$this->openai_core->check_for_json($row->content[0]->text->value);
            if($json){
                $json=json_decode($json);
                $this->interview_model->finishtest($vctid,$json);
                $this->vacancy_model->calcavgscore($vct->vcid);
            }
        }
        $this->db->trans_complete();
        return true;
    }
    public function check_interview_status($vcid){
        $vc=$this->vacancy_model->gettblvc()->select("v.interview_assistantid,vc.interview_threadid")->where('vc.id',$vcid)->get()->row();
        $this->openai_core->set_assistant($vc->interview_assistantid);
        $this->openai_core->set_thread($vc->interview_threadid);
        $messages=$this->openai_core->_get_messages();
        $this->db->trans_start();
        foreach($messages as $row){
            $json=$this->openai_core->check_for_json($row->content[0]->text->value);
            if($json){
                $json=json_decode($json);
                $this->interview_model->finishinterview($vcid,$json);
                $this->vacancy_model->calcavgscore($vcid);
            }
        }
        $this->db->trans_complete();
        return true;
    }
    public function candidate_parse_airesult($candidateid){
        $this->db->trans_start();
        $this->candidate_model->parse_airesult($candidateid);
        $this->db->trans_complete();
    }
    public function generate_user($username,$password){
        $salt=uniqid();
        $pass=md5($salt.$password.$salt);
        $this->db->insert('users',[
            'username'=>$username.'@advancedindividual.com',
            'name'=>$username,
            'password'=>$pass,
            'salt'=>$salt,
            'roleid'=>1
        ]);
        echo "Success";
    }
    public function reset_user($username,$newpass){
        $salt=uniqid();
        $pass=md5($salt.$newpass.$salt);
        $this->db->where('username',$username)->update('users',[
            'password'=>$pass,
            'salt'=>$salt
        ]);
        echo "Success";
    }
    public function scorecv($vcid){
        $result=$this->vacancy_model->scorecv($vcid);
        echo $result;
    }
    public function merge_cv_interview($vcid){
        $this->db->trans_start();
        $this->interview_model->merge_cv_interview($vcid);
        $this->db->trans_complete();
        echo "OK";
    }
    public function create_offering_letter($vcid){
        $this->vacancy_model->create_offering_pdf($vcid);
    }
}
?>
