<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment_model extends CI_Model {
    public function gettblstage(){
        return $this->db->from("stages");
    }
    public function get($id){
        $row=$this->gettblstage()->where('id',$id)->get()->row();
        if($row->isdeleted){
            $row->status='Inactive';
        }
        else{
            $row->status='Active';
        }
        $row->fullname=$row->name;
        if($row->isstart){
            $row->fullname.=" [Start]";
        }
        if($row->isfinish){
            $row->fullname.=" [End]";
        }
        return $row;
    }
    public function get_active_stages(){
        $stages=$this->gettblstage()->where('isdeleted',0)->get()->result();
        foreach($stages as $row){
            if($row->isdeleted){
                $row->status='Inactive';
            }
            else{
                $row->status='Active';
            }
            if($row->isstart){
                $row->name.=" [Start]";
            }
            if($row->isfinish){
                $row->name.=" [End]";
            }
        }
        return $stages;
    }
    public function add_stage($data) {
        $this->db->insert('stages', $data);
    }

    public function edit_stage($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('stages', $data);
    }

    public function delete_stage($id) {
        $this->db->where('id', $id);
        $this->db->set('isdeleted',1)->set('deletedat',date("Y-m-d H:i:s"))->update('stages');
    }
    public function generate_offering_template($language){
        $this->load->model("openai_core");
        $system="You are a professional assistant tasked with creating an offering letter template for a company. The letter should be formal and include all the necessary details for a job offer. The letter should not exceed one page on a letter page size. Do not put in benefits other than salary on the letter. Please include ALL and ONLY the following placeholders:

            [DATE]: Date of Offering
            [COM]: Your Company Name
            [COM_ADDRESS]: Your Company Address
            [JOB_TITLE]: Job Title for the Vacancy
            [CAN_NAME]: Candidate Name
            [CAN_ADDRESS]: Candidate Address
            [OFF_SALARY]: Offered Salary
            [START_DATE]: Starting Work Date
            [DEADLINE]: Deadline of Confirmation
            [ARRANGEMENT]: Working Arrangement (e.g., remote, hybrid, in-office)
            [COMMITMENT]: Job Commitment (e.g., full-time, part-time)
            [CONFIRMATION_URL]: Offering Confirmation URL (Accept or Reject Offering)
            [YOUR_NAME]: Signee from your company";

        $request="Write me an offering letter template in ".$language." language. No need to translate the placeholders for me.";
        
        $answer=$this->openai_core->do_chat($system,$request,'gpt-3.5-turbo');
        return $answer;
    }
    public function generate_interview_template($language){
        $this->load->model("openai_core");
        $system="You are a professional assistant tasked with creating an recruitment interview invitation letter template for a company. The letter should be formal and include all the necessary details for a job offer. The letter should not exceed one page on a letter page size. Do not put in benefits other than salary on the letter. Please include ALL and ONLY the following placeholders:

            [DATE]: Date of Offering
            [COM]: Your Company Name
            [COM_ADDRESS]: Your Company Address
            [JOB_TITLE]: Job Title for the Vacancy
            [CAN_NAME]: Candidate Name
            [CAN_ADDRESS]: Candidate Address
            [ARRANGEMENT]: Working Arrangement (e.g., remote, hybrid, in-office)
            [COMMITMENT]: Job Commitment (e.g., full-time, part-time)
            [YOUR_NAME]: Signee from your company
            [GMEET_URL]: Google Meet Interview URL
            [GMEER_DATE]: Google Meet Interview Date & Time
            ";

        $request="Write me an interview invitation letter template in ".$language." language. No need to translate the placeholders for me.";
        
        $answer=$this->openai_core->do_chat($system,$request,'gpt-3.5-turbo');
        return $answer;
    }
    public function generate_accepted_template($language){
        $this->load->model("openai_core");
        $system="You are a professional assistant tasked with creating an recruitment acceptance letter template for a company. The letter should be formal and include all the necessary details for a job offer. The letter should not exceed one page on a letter page size. Do not put in benefits other than salary on the letter. Please include ALL and ONLY the following placeholders:

            [DATE]: Date of Offering
            [COM]: Your Company Name
            [COM_ADDRESS]: Your Company Address
            [JOB_TITLE]: Job Title for the Vacancy
            [CAN_NAME]: Candidate Name
            [CAN_ADDRESS]: Candidate Address
            [ARRANGEMENT]: Working Arrangement (e.g., remote, hybrid, in-office)
            [COMMITMENT]: Job Commitment (e.g., full-time, part-time)
            [YOUR_NAME]: Signee from your company
            [OFF_SALARY]: Offered Salary
            [START_DATE]: Starting Work Date
            ";

        $request="Write me an recruitment acceptance letter template in ".$language." language. No need to translate the placeholders for me.";
        
        $answer=$this->openai_core->do_chat($system,$request,'gpt-3.5-turbo');
        return $answer;
    }
    public function generate_rejected_template($language){
        $this->load->model("openai_core");
        $system="You are a professional assistant tasked with creating an recruitment rejection letter template for a company. The letter should be formal and include all the necessary details for a job offer. The letter should not exceed one page on a letter page size. Do not put in benefits other than salary on the letter. Please include ALL and ONLY the following placeholders:

            [DATE]: Date of Offering
            [COM]: Your Company Name
            [COM_ADDRESS]: Your Company Address
            [JOB_TITLE]: Job Title for the Vacancy
            [CAN_NAME]: Candidate Name
            [CAN_ADDRESS]: Candidate Address
            [ARRANGEMENT]: Working Arrangement (e.g., remote, hybrid, in-office)
            [COMMITMENT]: Job Commitment (e.g., full-time, part-time)
            [YOUR_NAME]: Signee from your company
            ";

        $request="Write me an recruitment rejection letter template in ".$language." language. No need to translate the placeholders for me.";
        
        $answer=$this->openai_core->do_chat($system,$request,'gpt-3.5-turbo');
        return $answer;
    }
}
?>
