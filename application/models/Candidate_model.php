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
        // pre($candidate);
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
                        'name'=>filter_string($row->field_of_study)
                    ];
                }
                $ib_ces[]=[
                    'candidateid'=>$id,
                    'degree'=>filter_string($row->degree),
                    'institution'=>filter_string($row->institution_name),
                    'fieldparse'=>filter_string($row->field_of_study),
                    'startyear'=>$startyear,
                    'endyear'=>$toyear,
                    'gpa'=>$row->gpa,
                    'notes'=>filter_string($row->achievements)
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
                    'company'=>filter_string($row->company_name),
                    'position'=>filter_string($row->job_position),
                    'salary'=>$row->salary,
                    'startyear'=>$startyear,
                    'endyear'=>$toyear,
                    'responsibilities'=>filter_string($row->responsibilities),
                    'achievements'=>filter_string($row->achievements),
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
                    'certification'=>filter_string($row->certification),
                    'certifiedyear'=>intval($row->certified_year),
                    'certificatenum'=>$row->certification_number,
                    'createdt'=>$now
                ];
            }
            foreach($airesult->technical_skills as $skill){
                $ib_skills[]=[
                    'name'=>filter_string($skill),
                    'type'=>'Technical'
                ];
                $ib_css[]=[
                    'candidateid'=>$id,
                    'skillparse'=>filter_string($skill)
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
    public function complete($vcid,$candidateid,$post){
        $this->db->where('id',$candidateid)->update('candidates',[
            'firstname'=>$post['firstname'],
            'lastname'=>$post['lastname'],
            'email'=>$post['email'],
            'phone'=>$post['phone'],
            'gender'=>$post['gender'],
            'dob'=>$post['dob'],
            'age'=>$post['age'],
            'workexp'=>$post['workexp'],
            'address'=>$post['address']
        ]);
        $this->db->where('id',$vcid)->update('vc',['isconfirmed'=>1]);
        $ib_works=[];
        $lastworkexpyear=0;
        if(!empty($post['workexps'])){
            foreach($post['workexps']['company'] as $i=>$company){
                $ib_works[]=[
                    'candidateid'=>$candidateid,
                    'company'=>$company,
                    'position'=>$post['workexps']['position'][$i],
                    'startyear'=>$post['workexps']['startyear'][$i],
                    'endyear'=>$post['workexps']['endyear'][$i],
                    'responsibilities'=>$post['workexps']['responsibilities'][$i],
                    'achievements'=>$post['workexps']['achievements'][$i]
                ];
                if($post['workexps']['endyear'][$i]>$lastworkexpyear){
                    $lastworkexpyear=$post['workexps']['endyear'][$i];
                }
            }
        }
        $ib_educations=[];
        $ib_fieldparse=[];
        if(!empty($post['educations'])){
            foreach($post['educations']['institution'] as $i=>$institution){
                $ib_fieldparse[]=[
                    'name'=>$post['educations']['field'][$i]
                ];
                $ib_educations[]=[
                    'candidateid'=>$candidateid,
                    'institution'=>$institution,
                    'degree'=>$post['educations']['degree'][$i],
                    'fieldparse'=>$post['educations']['field'][$i],
                    'startyear'=>$post['educations']['startyear'][$i],
                    'endyear'=>$post['educations']['endyear'][$i],
                    'gpa'=>$post['educations']['gpa'][$i],
                    'notes'=>$post['educations']['notes'][$i]
                ];
            }
        }
        $ib_skills=[];
        $ib_skillparse=[];
        if(!empty($post['skills'])){
            foreach($post['skills']['skill'] as $i=>$skill){
                $ib_skillparse[]=[
                    'name'=>$skill,
                    'type'=>'Technical'
                ];
                $ib_skills[]=[
                    'candidateid'=>$candidateid,
                    'skillparse'=>$skill,
                    'proficiencylevel'=>$post['skills']['proficiencylevel'][$i]
                ];
            }
        }
        if(!empty($ib_fieldparse)){
            $this->db->replace_batch('studyfields',$ib_fieldparse);
        }
        if(!empty($ib_skillparse)){
            $this->db->replace_batch('skills',$ib_skillparse);
        }
        if(!empty($ib_works)){
            $this->db->where('candidateid',$candidateid)->delete('candidate_workexps');
            $this->db->insert_batch('candidate_workexps',$ib_works);
            $lastworkexp=$this->db->where('candidateid',$candidateid)->where('endyear',$lastworkexpyear)->get('candidate_workexps')->row();
            $this->db->where('id',$candidateid)->update('candidates',['lastworkexpid'=>$lastworkexp->id]);
        }
        if(!empty($ib_educations)){
            $this->db->where('candidateid',$candidateid)->delete('candidate_educations');
            $this->db->insert_batch('candidate_educations',$ib_educations);
            $this->db->query("UPDATE candidate_educations ce join studyfields sf on ce.fieldparse=sf.name SET ce.fieldid=sf.id WHERE ce.candidateid=".$candidateid);
        }
        if(!empty($ib_skills)){
            $this->db->where('candidateid',$candidateid)->delete('candidate_skills');
            $this->db->insert_batch('candidate_skills',$ib_skills);
            $this->db->query("UPDATE candidate_skills cs join skills s on cs.skillparse=s.name and s.type='Technical' SET cs.skillid=s.id WHERE cs.candidateid=".$candidateid);

        }
        $candidatefull=[
            'firstname'=>$post['firstname'],
            'lastname'=>$post['lastname'],
            'email'=>$post['email'],
            'phone'=>$post['phone'],
            'gender'=>$post['gender'],
            'dob'=>$post['dob'],
            'age'=>$post['age'],
            'workexps'=>$post['workexp'],
            'address'=>$post['address'],
            'education_history'=>$ib_educations,
            'work_history'=>$ib_works,
            'technical_skills'=>$ib_skills
        ];
        return $candidatefull;
    }    
    public function getjson($id){
        $candidate=$this->db->select('firstname,lastname,email,phone,gender,dob,age,marriage_status,workexp,address')->where('id',$id)->get('candidates')->row();
        $candidate->workexps=$this->db->select('company,position,salary,startyear,endyear,responsibilities,achievements')->where('candidateid',$id)->get('candidate_workexps')->result();
        $candidate->educations=$this->db->select('degree,institution,fieldparse as field,startyear,endyear,gpa,notes')->where('candidateid',$id)->get('candidate_educations')->result();
        $candidate->skills=$this->db->select('skillparse as skill,proficiencylevel')->where('candidateid',$id)->get('candidate_skills')->result();

        return json_encode($candidate);
    }
}
?>
