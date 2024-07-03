<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interview extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('interview_model');
        $this->load->model('vacancy_model');
        $this->load->model('candidate_model');
        $this->_defaultview=[
        	'objectname'=>'AI Interview',
        	'breadcrumbs'=>[
        		'AI Interview'
        	]
        ];
        $this->load->model("openai_core");
    }
    public function view($vcid,$testid=false){
        $this->detail($vcid,$testid,false);
    }
    public function run($vcid,$testid=false){
        $this->detail($vcid,$testid,true);
        
    }
    public function detail($vcid,$testid=false,$isuser=false){
        $view=$this->_defaultview;
        
        $vc=$this->vacancy_model->getvc($vcid);
        $candidate=$this->candidate_model->get($vc->candidateid);
        // pre($vc);
        $view['isuser']=$isuser;
        $view['vc']=$vc;
        // pre($vc->tests);
        $view['candidate']=$candidate;
        $view['type']='interview';
        $view['istest']=($testid==false)?0:1;
        $view['currtestid']=$testid;
        if($isuser)
            $view['pagename']=$view['breadcrumbs'][]='['.$vc->vacancy.'] Do Interview - '.$candidate->name;
        else
            $view['pagename']=$view['breadcrumbs'][]='['.$vc->vacancy.'] View Interview - '.$candidate->name;
        $view['content']=$this->load->view('interview/detail-interview', $view,true);
        $this->load->view('layouts/master',['view'=>$view,'hideheader'=>true]);
    }
    public function loadinterviewchats($vcid){
        $input=$this->input->get();
        
        if(isset($input['start'])){
            $this->db->trans_start();
            $this->interview_model->start($vcid);
            $this->db->trans_complete();
        }
        
        $vc=$this->vacancy_model->getvc($vcid);
        $candidate=$this->candidate_model->get($vc->candidateid);

        $interviewchats=$this->load->view('interview/interview-chats',['title'=>'Interview','vc'=>$vc,'htmlid'=>'interview-content','candidate'=>$candidate],true);
        echo json_encode(['html'=>$interviewchats]);
    }
     public function loadtestchats($vcid,$testid){
        $input=$this->input->get();
        
        if(isset($input['start'])){
            $this->db->trans_start();
            $this->interview_model->starttest($vcid,$testid);
            $this->db->trans_complete();
        }
        
        $vct=$this->db->where('vcid',$vcid)->where('testid',$testid)->get('vc_tests')->row();
        $vc=$this->vacancy_model->getvc($vcid);
        $test=$vc->tests[$testid];
        $candidate=$this->candidate_model->get($vc->candidateid);

        $testchats=$this->load->view('interview/test-chats',['title'=>$test->test,'test'=>$test,'testid'=>$testid,'vc'=>$vc,'htmlid'=>$testid,'candidate'=>$candidate],true);
        echo json_encode(['html'=>$testchats]);
    }
    public function replyinterview(){
        $input=$this->input->post();
        $this->db->trans_start();
        $response=$this->interview_model->reply($input['vcid'],$input['message']);
        if(isset($response->json_lastmessage) && $response->json_lastmessage){
            $this->interview_model->finishinterview($input['vcid'],$response->json_lastmessage);
            $this->vacancy_model->calcavgscore($input['vcid']);
        }
        $this->db->trans_complete();
        echo json_encode(['replyresponse'=>$response->lastmessage]);
    }
    public function replytest(){
        $input=$this->input->post();
        $this->db->trans_start();
        $vct=$this->db->where('vcid',$input['vcid'])->where('testid',$input['testid'])->get('vc_tests')->row();
        $response=$this->interview_model->replytest($vct->id,$input['message']);
        if(isset($response->json_lastmessage) && $response->json_lastmessage){
            $this->interview_model->finishtest($vct->id,$response->json_lastmessage);
            $this->vacancy_model->calcavgscore($input['vcid']);
        }
        $this->db->trans_complete();
        echo json_encode(['replyresponse'=>$response->lastmessage]);
    }
    public function result($vcid){
        $view=$this->_defaultview;
        
        $result=$this->interview_model->getresult($vcid);
        // pre($result);
        $view['vc']=$result['vc'];
        $view['interview']=$result['interview'];
        $view['tests']=$result['tests'];
        $view['pagename']=$view['breadcrumbs'][]='['.$result['vc']->vacancy.'] Result Interview & Test - '.$result['vc']->candidate;
        $view['content']=$this->load->view('interview/result-interview', $view,true);
        $this->load->view('layouts/master',['view'=>$view,'hideheader'=>true]);
    }
}
?>
