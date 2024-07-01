<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use OpenAI;
// use OpenAI\Client;
class Tools extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('openai_core');
        $this->load->model('vacancy_model');
        $this->load->model('interview_model');
        $this->load->model('candidate_model');
        
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
    public function create_interview($vcid){
        $vc=$this->vacancy_model->gettblvc()->select("v.interview_assistantid,concat(c.firstname,' ',c.lastname) fullname")->where('vc.id',$vcid)->get()->row();
        $this->openai_core->set_assistant($vc->interview_assistantid);
        $run=$this->openai_core->create_interview($vc->fullname);
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
