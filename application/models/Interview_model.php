<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interview_model extends CI_Model {
    public function getresult($vcid){
        $vc=$this->db->select("vc.*,v.title vacancy,v.jobdesc,concat(c.firstname,' ',c.lastname) candidate")->where('vc.id',$vcid)->from('vc')->join('vacancies v','vc.vacancyid=v.id')->join('candidates c','vc.candidateid=c.id')->get()->row();
        $chats=$this->db->where('vcid',$vcid)->get('vc_interviews')->result();
        $interview=$this->db->where('vcid',$vcid)->where('stageid',2)->get('vc_stages')->row();
        if($interview->result!=null){
            $interview->json=json_decode($interview->result);
            $interview->jsonarr=get_object_vars($interview->json);
        }
        else{
            $interview->json=null;
            $interview->jsonarr=null;
        }
        // pre($interview->jsonarr);
        $interview->chats=$chats;
        $tests=$this->db->select('vct.*,t.name test')->where('vcid',$vcid)->from('vc_tests vct')->join('tests t','vct.testid=t.id')->get()->result();
        foreach($tests as $row){
            if($row->result!=null){
                $row->json=json_decode($row->result);
                $row->jsonarr=get_object_vars($row->json);
            }
            else{
                $row->json=null;
                $row->jsonarr=null;
            }
        }
        return [
            'vc'=>$vc,
            'interview'=>$interview,
            'tests'=>$tests
        ];
    }
    public function start($vcid){
        $vc=$this->db->select("vc.*,concat(c.firstname,' ',c.lastname) candidate,v.title vacancy")->from('vc')->join('candidates c','vc.candidateid=c.id')->join('vacancies v','vc.vacancyid=v.id')->where('vc.id',$vcid)->get()->row();

        if(!$vc->useaiinterview || $vc->aiinterviewstarted){
            return false;
        }
        $this->db->where('id',$vcid)->update('vc',['aiinterviewstarted'=>1]);
        $this->db->where('vcid',$vcid)->where('stageid',2)->update('vc_stages',['usecredit'=>getsetting('interview_credit')]);
        $this->_createaiinterview($vcid);
        $this->credit_model->credit(getsetting('interview_credit'),'vc_stages',$vcid,'AI Interview: '.$vc->candidate.' for '.$vc->vacancy);
        return true;
    }
    public function starttest($vcid,$testid){
        $vct=$this->db->select("vct.*,concat(c.firstname,' ',c.lastname) candidate,v.title vacancy,t.name test")->from('vc_tests vct')->join('vc','vct.vcid=vc.id')->join('candidates c','vc.candidateid=c.id')->join('vacancies v','vc.vacancyid=v.id')->join('tests t','vct.testid=t.id')->where('vcid',$vcid)->where('testid',$testid)->get()->row();
        $test=$this->db->where('id',$testid)->get('tests')->row();
        // pre($test);
        if($vct==null){
            $this->db->insert('vc_tests',[
                'vcid'=>$vcid,
                'testid'=>$testid,
                'createdt'=>date("Y-m-d H:i:s"),
                'usecredit'=>$test->test_credit
            ]);
            $vct=$this->db->where('vcid',$vcid)->where('testid',$testid)->get('vc_tests')->row();
        }
        // pre($vct);
        if($vct->test_assistantid==null){
            $this->_createaitester($vct->id);
            $this->credit_model->credit($test->test_credit,'vc_tests',$vct->id,'AI '.$test->name.': '.$vct->candidate.' for '.$vct->vacancy);
        }
        
        $this->_createaitest($vct->id);
        
        return true;
    }
    public function reply($vcid,$message){
        $this->load->model("openai_core");

        $this->db->insert('vc_interviews',[
            'vcid'=>$vcid,
            'createdt'=>date("Y-m-d H:i:s"),
            'actor'=>'candidate',
            'content'=>$message
        ]);
        
        $vc=$this->db->select("v.interview_assistantid,concat(c.firstname,' ',c.lastname) candidate,vc.interview_threadid")->from('vc')->join('vacancies v','vc.vacancyid=v.id')->join('candidates c',"vc.candidateid=c.id")->where('vc.id',$vcid)->get()->row();
        $this->openai_core->set_assistant($vc->interview_assistantid);
        $this->openai_core->set_thread($vc->interview_threadid);
        $run=$this->openai_core->run_message($message);
        if(isset($run->json_lastmessage) && $run->json_lastmessage){
            $run->lastmessage='Thank you, '.$vc->candidate.', for providing all the necessary information during the interview. Your data has been summarized and will be reviewed for further consideration. You will be notified of the outcome in due course. Good luck with your job application at '.getcompany('name').'!';
            $this->db->insert('vc_interviews',[
                'vcid'=>$vcid,
                'createdt'=>date("Y-m-d H:i:s"),
                'actor'=>'recruiter',
                'content'=>$run->lastmessage
            ]);
        }
        else{
            $this->db->insert('vc_interviews',[
                'vcid'=>$vcid,
                'createdt'=>date("Y-m-d H:i:s"),
                'actor'=>'recruiter',
                'content'=>$run->lastmessage
            ]);
        }
        return $run;

    }
    public function finishinterview($vcid,$json){
        $this->db->where('id',$vcid)->update('vc',[
            'aiinterviewdone'=>1,
            'asksalary'=>$json->expected_salary
        ]);
        $this->db->where('vcid',$vcid)->where('stageid',2)->update('vc_stages',[
            'score'=>$json->suitable_score,
            'grammar'=>$json->grammar_vocab_score,
            'aisuspect'=>$json->ai_probability,
            'datecompleted'=>date("Y-m-d"),
            'result'=>json_encode($json)
        ]);

        return true;
    }
    public function merge_cv_interview($vcid){
        $this->load->model("openai_core");
        $check=$this->db->where('vc.id',$vcid)->select('vc.candidateid,c.airesult,vcs.result')->from('vc')->join('candidates c','vc.candidateid=c.id')->join('vc_stages vcs','vc.id=vcs.vcid and vcs.stageid=2')->get()->row();
        // pre($check);
        $system="I have 2 JSON data, both are a JSON data of a Candidate applying for a Job Vacancy. The first one is their data parsed from their CV, the second one is their data received from interview. Please combine these 2 JSON to create one combined complete candidate JSON data.";
        $request="
        CV:
        ".$check->airesult."

        Interview:
        ".$check->result;
        $answer=$this->openai_core->do_chatjson($system,$request);
        //update candidates, candidate_workexps, candidate_educations, candidate_skills
        if($answer){
            $airesult=json_decode($answer);
            // pre($airesult);
            $u_candidate=[];
            $ib_ces=[];
            $ib_cws=[];
            $ib_certs=[];
            $ib_css=[];
            $ib_skills=[];
            $ib_fields=[];
            array_set($u_candidate,"firstname",$airesult->firstname);
            array_set($u_candidate,"lastname",$airesult->lastname);
            array_set($u_candidate,"address",$airesult->current_residency);
            array_set($u_candidate,"dob",$airesult->birth_date);
            array_set($u_candidate,"age",$airesult->age);
            array_set($u_candidate,"gender",strtolower($airesult->gender));

            foreach($airesult->education_history as $row){
                $row=sanitize_obj($row,[
                    'degree',
                    'institution_name',
                    'field_of_study',
                    'from_year',
                    'to_year',
                    'gpa',
                    'achievements'
                ]);
                if(isset($row->from_year)){
                    if(strtolower($row->from_year)=="present"){
                        $startyear=date("Y");
                    }
                    else{
                        $startyear=intval($row->from_year);
                    }
                }
                else{
                    $startyear="";
                }
                if(isset($row->to_year)){
                    if(strtolower($row->to_year)=="present"){
                        $toyear=date("Y");
                    }
                    else{
                        $toyear=intval($row->to_year);
                    }
                }
                else{
                    $toyear="";
                }
                if(isset($row->field_of_study) && !empty($row->field_of_study)){
                    $ib_fields[]=[
                        'name'=>$row->field_of_study
                    ];
                }
                $ib_ces[]=[
                    'candidateid'=>$check->candidateid,
                    'degree'=>$row->degree,
                    'institution'=>$row->institution_name,
                    'fieldparse'=>$row->field_of_study,
                    'startyear'=>$startyear,
                    'endyear'=>$toyear,
                    'gpa'=>$row->gpa,
                    'notes'=>$row->achievements
                ];
            }
            foreach($airesult->work_history as $row){
                $row=sanitize_obj($row,[
                    'company_name',
                    'job_position',
                    'salary',
                    'from_year',
                    'to_year',
                    'responsibilities',
                    'achievements'
                ]);
                
                if(isset($row->from_year)){
                    if(strtolower($row->from_year)=="present"){
                        $startyear=date("Y");
                    }
                    else{
                        $startyear=intval($row->from_year);
                    }
                }
                else{
                    $startyear="";
                }
                if(isset($row->to_year)){
                    if(strtolower($row->to_year)=="present"){
                        $toyear=date("Y");
                    }
                    else{
                        $toyear=intval($row->to_year);
                    }
                }
                else{
                    $toyear="";
                }
                $ib_cws[]=[
                    'candidateid'=>$check->candidateid,
                    'company'=>$row->company_name,
                    'position'=>$row->job_position,
                    'salary'=>$row->salary,
                    'startyear'=>$startyear,
                    'endyear'=>$toyear,
                    'responsibilities'=>$row->responsibilities,
                    'achievements'=>$row->achievements,
                ];
            }
            
            foreach($airesult->professional_certification as $row){
                $row=sanitize_obj($row,[
                    'certification',
                    'certified_year',
                    'certification_number'
                ]);
                
                $ib_ccs[]=[
                    'candidateid'=>$check->candidateid,
                    'certification'=>$row->certification,
                    'certifiedyear'=>intval($row->certified_year),
                    'certificatenum'=>$row->certification_number,
                    'createdt'=>$now
                ];
            }
            foreach($airesult->technical_skills as $skill){
                $ib_skills[]=[
                    'name'=>$skill,
                    'type'=>'Technical'
                ];
                $ib_css[]=[
                    'candidateid'=>$check->candidateid,
                    'skillparse'=>$skill
                ]; 
            }
            $this->db->where('id',$check->candidateid)->update('candidates',$u_candidate);
            if(!empty($ib_fields)){
                $this->db->replace_batch('studyfields',$ib_fields);
            }
            if(!empty($ib_ces)){
                $this->db->where('candidateid',$check->candidateid)->delete('candidate_educations');
                $this->db->insert_batch('candidate_educations',$ib_ces);
                $this->db->query("UPDATE candidate_educations ce join studyfields sf on ce.fieldparse=sf.name SET ce.fieldid=sf.id WHERE ce.candidateid=".$check->candidateid);
            }
            if(!empty($ib_cws)){
                $this->db->where('candidateid',$check->candidateid)->delete('candidate_workexps');
                $this->db->insert_batch('candidate_workexps',$ib_cws);
                $lastwork=$this->db->select('id')->from('candidate_workexps')->where('candidateid',$check->candidateid)->order_by('endyear desc,startyear desc')->limit(1)->get()->row();
                $this->db->where('id',$check->candidateid)->update('candidates',['lastworkexpid'=>$lastwork->id]);
            }
            if(!empty($ib_ccs)){
                $this->db->where('candidateid',$check->candidateid)->delete('candidate_certifications');
                $this->db->insert_batch('candidate_certifications',$ib_ccs);
            }
            if(!empty($ib_skills)){
                $this->db->replace_batch('skills',$ib_skills);
            }
            if(!empty($ib_css)){
                $this->db->where('candidateid',$check->candidateid)->delete('candidate_skills');
                $this->db->insert_batch('candidate_skills',$ib_css);
                $this->db->query("UPDATE candidate_skills cs join skills s on cs.skillparse=s.name and s.type='Technical' SET cs.skillid=s.id WHERE cs.candidateid=".$check->candidateid);
            }
        }

    }
    public function replytest($vctid,$message){
        $this->load->model("openai_core");

        $vct=$this->db->select("vct.*,concat(c.firstname,' ',c.lastname) candidate,t.name test,v.title vacancy,v.jobdesc")->from('vc_tests vct')->join('vc','vct.vcid=vc.id')->join('tests t','vct.testid=t.id')->join('vacancies v','vc.vacancyid=v.id')->join('candidates c',"vc.candidateid=c.id")->where('vct.id',$vctid)->get()->row();
        
        $this->db->insert('vc_test_details',[
            'vctestid'=>$vct->id,
            'createdt'=>date("Y-m-d H:i:s"),
            'actor'=>'candidate',
            'content'=>$message
        ]);
        
        $this->openai_core->set_assistant($vct->test_assistantid);
        $this->openai_core->set_thread($vct->test_threadid);
        $run=$this->openai_core->run_message($message);
        if(isset($run->json_lastmessage) && $run->json_lastmessage){
            $run->lastmessage='Thank you, '.$vct->candidate.', for answering all questions during the test. Your answers has been summarized and will be reviewed for further consideration. You will be notified of the outcome in due course. Good luck with your job application at '.getcompany('name').'!';
            $this->db->insert('vc_test_details',[
                'vctestid'=>$vct->id,
                'createdt'=>date("Y-m-d H:i:s"),
                'actor'=>'recruiter',
                'content'=>$run->lastmessage
            ]);
        }
        else{
            $this->db->insert('vc_test_details',[
                'vctestid'=>$vct->id,
                'createdt'=>date("Y-m-d H:i:s"),
                'actor'=>'recruiter',
                'content'=>$run->lastmessage
            ]);
        }
        return $run;

    }
    public function finishtest($vctid,$json){
        $vct=$this->db->where('id',$vctid)->get('vc_tests')->row();
        $test=$this->db->where('id',$vct->testid)->get('tests')->row();
        if($test->calcscore){
            $this->db->where('id',$vctid)->update('vc_tests',[
                'score'=>$json->score,
                'finishdt'=>date("Y-m-d H:i:s"),
                'result'=>json_encode($json),
                'analysis'=>$json->analysis
            ]);
        }
        else{
            $this->db->where('id',$vctid)->update('vc_tests',[
                'finishdt'=>date("Y-m-d H:i:s"),
                'result'=>json_encode($json)
            ]);
        }
        return true;
        
    }
    private function _createaiinterview($vcid){
        $this->load->model("openai_core");
        $vc=$this->db->select("v.interview_assistantid,concat(c.firstname,' ',c.lastname) candidate")->from('vc')->join('vacancies v','vc.vacancyid=v.id')->join('candidates c',"vc.candidateid=c.id")->where('vc.id',$vcid)->get()->row();
        $this->openai_core->set_assistant($vc->interview_assistantid);
        $run=$this->openai_core->create_interview($vc->candidate);
        // pre($run);
        $this->db->where('id',$vcid)->update('vc',['interview_threadid'=>$run->threadId]);
        $this->db->insert('vc_interviews',[
            'vcid'=>$vcid,
            'createdt'=>date("Y-m-d H:i:s"),
            'actor'=>'recruiter',
            'content'=>$run->lastmessage
        ]);
    }
    private function _createaitester($vctid){

        $this->load->model("openai_core");
        $vct=$this->db->select("vct.*,concat(c.firstname,' ',c.lastname) candidate,t.name test,t.prompt,v.interviewlang")->from('vc_tests vct')->join('vc','vct.vcid=vc.id')->join('tests t','vct.testid=t.id')->join('vacancies v','vc.vacancyid=v.id')->join('candidates c',"vc.candidateid=c.id")->where('vct.id',$vctid)->get()->row();
        // pre($vct);
        $assistant_id=$this->openai_core->create_tester($vct->test,$vct->prompt,$vct->interviewlang);
        $this->db->where('id',$vctid)->update('vc_tests',['test_assistantid'=>$assistant_id]);
    }
    private function _createaitest($vctid){
        $this->load->model("openai_core");
        $vct=$this->db->select("vct.*,concat(c.firstname,' ',c.lastname) candidate,t.name test")->from('vc_tests vct')->join('vc','vct.vcid=vc.id')->join('tests t','vct.testid=t.id')->join('vacancies v','vc.vacancyid=v.id')->join('candidates c',"vc.candidateid=c.id")->where('vct.id',$vctid)->get()->row();
        $this->openai_core->set_assistant($vct->test_assistantid);
        $run=$this->openai_core->create_test($vct->candidate,$vct->test);
        // pre($run);
        $this->db->where('id',$vctid)->update('vc_tests',['test_threadid'=>$run->threadId]);
        $this->db->insert('vc_test_details',[
            'vctestid'=>$vctid,
            'createdt'=>date("Y-m-d H:i:s"),
            'actor'=>'recruiter',
            'content'=>$run->lastmessage
        ]);
    }
    
}
?>
