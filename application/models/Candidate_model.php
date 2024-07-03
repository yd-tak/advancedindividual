<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate_model extends CI_Model {
    public function gettbl(){
        return $this->db->select("c.*,concat(cw.position,'<br>',cw.company,'<br>',cw.startyear,' sd ',cw.endyear) lastworkexp")->from("candidates c")->join('candidate_workexps cw','c.lastworkexpid=cw.id','left');
    }
    public function gettblworkexp(){
        return $this->db->select('cw.*')->from('candidate_workexps cw')->join('candidates c','cw.candidateid=c.id');
    }
    public function gettbleducation(){
        return $this->db->select('ce.*,sf.name field')->from('candidate_educations ce')->join('candidates c','ce.candidateid=c.id')->join('studyfields sf','ce.fieldid=sf.id','left');
    }
    public function gettblskill(){
        return $this->db->select('cs.*,s.name skill,s.type')->from('candidate_skills cs')->join('candidates c','cs.candidateid=c.id')->join('skills s','cs.skillid=s.id','left');
    }
    public function gettblproject(){
        return $this->db->select('cp.*')->from('candidate_projects cp')->join('candidates c','cp.candidateid=c.id');
    }
    public function gettblsocmed(){
        return $this->db->select('cs.*')->from('candidate_socmeds cs')->join('candidates c','cs.candidateid=c.id');
    }
    public function get($id){
        $candidate=$this->gettbl()->where('c.id',$id)->get()->row();
        $candidate->name=$candidate->firstname." ".$candidate->lastname;
        $candidate->workexps=$this->gettblworkexp()->where('c.id',$id)->get()->result();
        $candidate->educations=$this->gettbleducation()->where('c.id',$id)->get()->result();
        $candidate->socmeds=$this->gettblsocmed()->where('c.id',$id)->get()->result();
        $candidate->projects=$this->gettblproject()->where('c.id',$id)->get()->result();
        $candidate->skills=$this->gettblskill()->where('c.id',$id)->get()->result();
        $candidate->techskills=[];
        $candidate->softskills=[];
        $candidate->languages=[];
        $candidate->certifications=[];
        $candidate->otherskills=[];
        foreach($candidate->skills as $row){
            switch($row->type){
                case 'Technical':
                    $candidate->techskills[]=$row->skill;
                    break;
                case 'Soft':
                    $candidate->softskills[]=$row->skill;
                    break;
                case 'Language':
                    $candidate->languages[]=$row->skill;
                    break;
                case 'Certification':
                    $candidate->certifications[]=$row->skill;
                    break;
                default:
                    $candidate->otherskills[]=$row->skill;
                    break;
            }
        }
        return $candidate;
    }
    public function add_candidate($data) {
        $this->db->insert('candidates', $data);
    }

    public function edit_candidate($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('candidates', $data);
    }

    public function delete_candidate($id) {
        $this->db->where('id', $id);
        $this->db->delete('candidates');
    }
    public function parse_airesult($id){
        $candidate=$this->db->where('id',$id)->get('candidates')->row();
        $now=date("Y-m-d H:i:s");
        if($candidate->airesult!=null && !$candidate->aiparsed){
            $airesult=json_decode($candidate->airesult);
            $u_candidate=['aiparsed'=>true];
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
                    'candidateid'=>$id,
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
                    'candidateid'=>$id,
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
                    'candidateid'=>$id,
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
                    'candidateid'=>$id,
                    'skillparse'=>$skill
                ]; 
            }
            $this->db->where('id',$id)->update('candidates',$u_candidate);
            if(!empty($ib_fields)){
                $this->db->replace_batch('studyfields',$ib_fields);
            }
            if(!empty($ib_ces)){
                $this->db->insert_batch('candidate_educations',$ib_ces);
                $this->db->query("UPDATE candidate_educations ce join studyfields sf on ce.fieldparse=sf.name SET ce.fieldid=sf.id WHERE ce.candidateid=".$id);
            }
            if(!empty($ib_cws)){
                $this->db->insert_batch('candidate_workexps',$ib_cws);
                $lastwork=$this->db->select('id')->from('candidate_workexps')->where('candidateid',$id)->order_by('endyear desc,startyear desc')->limit(1)->get()->row();
                $this->db->where('id',$id)->update('candidates',['lastworkexpid'=>$lastwork->id]);
            }
            if(!empty($ib_ccs)){
                $this->db->insert_batch('candidate_certifications',$ib_ccs);
            }
            if(!empty($ib_skills)){
                $this->db->replace_batch('skills',$ib_skills);
            }
            if(!empty($ib_css)){
                $this->db->insert_batch('candidate_skills',$ib_css);
                $this->db->query("UPDATE candidate_skills cs join skills s on cs.skillparse=s.name and s.type='Technical' SET cs.skillid=s.id WHERE cs.candidateid=".$id);
            }
        }
    }
    public function transform_to_ai_result(){
        
    }    
}
?>
