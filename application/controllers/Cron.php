<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use OpenAI;
// use OpenAI\Client;
class Cron extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('openai_core');
        $this->load->model('vacancy_model');
        $this->load->model('interview_model');
        $this->load->model('candidate_model');
        
    }
    public function startInterview(){
        $vcs=$this->db->select('vc.*')->from("vc")->join('vacancies v','vc.vacancyid=v.id')->join('vc_stages vcs','vc.lastvcstageid=vcs.id')->join("candidates c","vc.candidateid=c.id")->where('vcs.stageid',2)->where('vc.aiinterviewstarted',0)->limit(5)->get()->result();

        $vacancyids=[];
        foreach($vcs as $row){
            if(!in_array($row->vacancyid, $vacancyids))
                $vacancyids[]=$row->vacancyid;
        }
        $vacancytests=$this->db->where_in('vacancyid',$vacancyids)->get('vacancy_tests')->result();
        $vacancytestmap=[];
        foreach($vacancytests as $row){
            if(!isset($vacancytestmap[$row->vacancyid])){
                $vacancytestmap[$row->vacancyid]=[];
            }
            $vacancytestmap[$row->vacancyid][]=$row->testid;
        }
        foreach($vcs as $row){
            $vcid=$row->id;
            $this->db->trans_start();
            $this->interview_model->start($vcid);
            if(isset($vacancytestmap[$row->vacancyid])){
                foreach($vacancytestmap[$row->vacancyid] as $testid){
                    $this->interview_model->createtester($vcid,$testid);
                    $this->interview_model->starttest($vcid,$testid);
                }
            }
            $this->db->trans_complete();    
        }
        
    }
    public function sendInterviewEmail(){
        $candidates=$this->db->select("v.title,vc.id,c.email,concat(c.firstname,' ',c.lastname) name,vc.interviewurisent")->from('vc')->join('vacancies v','vc.vacancyid=v.id')->join('vc_stages vcs','vc.lastvcstageid=vcs.id')->join("candidates c","vc.candidateid=c.id")->where("vc.interviewurisent",0)->where('vcs.stageid',2)->limit(5)->get()->result();
        // pre($candidates);
        foreach($candidates as $row){
            $subject=getCompany('name').' - Interview Invitation for '.$row->title.' position';
            $interviewurl=site_url('interview/run/'.$row->id);
            $message="<p>Dear <strong>".$row->name."</strong>,</p>
    
            <p>Thank you for your interest in the <strong>".$row->title."</strong> role at <strong>".getCompany('name')."</strong>. We are pleased to invite you to participate in our AI-based interview process.</p>
            
            <p><strong>Interview Details:</strong></p>
            <ul>
                <li><strong>Interview URL:</strong> <a href='".$interviewurl."'>Click here to start your interview</a></li>
            </ul>
            
            <p>To ensure a smooth and fair interview process, please follow these guidelines:</p>
            <ol>
                <li><strong>Device Requirement:</strong> Use a laptop, computer, or tablet to complete the interview. Mobile phones are not allowed.</li>
                <li><strong>Browser Setting:</strong> Go full screen on your browser during the interview.</li>
                <li><strong>Monitoring:</strong> Your actions will be tracked. Navigating away from the browser or switching tabs will be recorded and will result in a deduction in your score.</li>
                <li><strong>AI Tool Usage:</strong> Using AI tools to answer questions will be detected and will result in automatic disqualification.</li>
            </ol>
            
            <p>We appreciate your cooperation in adhering to these guidelines to maintain the integrity of the interview process.</p>
            
            <p>Please make sure you are in a quiet environment with a stable internet connection at the scheduled time.</p>
            
            <p>We look forward to your participation and wish you the best of luck.</p>
            
            <p>Best regards,</p>
            <p>
                HR<br>
                ".getCompany('name')."
            </p>";
            // echo $subject."<br>".$message;exit;
            sendHelperEmail($row->email,$subject,$message);
            $this->db->where('id',$row->id)->update('vc',['interviewurisent'=>($row->interviewurisent+1)]);
            echo $row->email." sent<br>";
            flush();ob_flush();
        }
    }
}
?>
