<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancy_model extends CI_Model {
    public function gettbl(){
        return $this->db->select("v.*,jr.name jobrole,jc.name jobcommitment,l.name location,d.name department,u.username creator")->from("vacancies v")->join("job_roles jr","v.jobroleid=jr.id")->join("job_commitment jc","v.jobcommitmentid=jc.id")->join("locations l","v.locationid=l.id","left")->join("departments d","v.departmentid=d.id","left")->join("users u","v.createdby=u.id","left");
    }
    public function gettblskill(){
        return $this->db->select("vs.*,s.type,s.name skill")->from("vacancy_skills vs")->join("skills s","vs.skillid=s.id");
    }
    public function gettbltest(){
        return $this->db->select("vt.*,t.name test")->from("vacancy_tests vt")->join("tests t","vt.testid=t.id");
    }
    public function gettblvcinterview(){
        return $this->db->select("vci.*")->from("vc_interviews vci")->join("vc","vci.vcid=vc.id");
    }
    public function gettblvctest(){
        return $this->db->select("vct.*,t.name test")->from("vc_tests vct")->join("tests t","vct.testid=t.id");
    }
    public function gettblvctestdetail(){
        return $this->db->select("vctd.*,t.name test")->from("vc_test_details vctd")->join("vc_tests vct","vctd.vctestid=vct.id")->join("tests t","vct.testid=t.id");
    }
    
    public function gettblvc(){
        return $this->db->select("vc.*,v.title as vacancy,concat(c.firstname,' ',c.lastname) name,c.email,c.phone,c.address,c.gender,c.age,c.workexp,s.name laststage,vcs.stageid,concat(cw.position,'<br>',cw.company,'<br>',ifnull(cw.startyear,''),' sd ',ifnull(cw.endyear,'')) lastworkexp,vcs.score")->from("vc")->join('vacancies v','vc.vacancyid=v.id')->join("candidates c","vc.candidateid=c.id")->join("vc_stages vcs","vc.lastvcstageid=vcs.id","left")->join("stages s","vcs.stageid=s.id","left")->join("candidate_workexps cw","c.lastworkexpid=cw.id","left");
    }
    public function gettblvcstage(){
        return $this->db->select("vcs.*,s.name stage")->from("vc_stages vcs")->join("vc","vcs.vcid=vc.id")->join("stages s","vcs.stageid=s.id");
    }
    public function getvc($vcid){
        $vc=$this->gettblvc()->where('vc.id',$vcid)->get()->row();
        $interviews=$this->gettblvcinterview()->where('vci.vcid',$vc->id)->get()->result();
        $vcts=$this->gettblvctest()->where('vct.vcid',$vc->id)->get()->result();
        $vctds=$this->gettblvctestdetail()->where('vct.vcid',$vc->id)->get()->result();
        $stages=$this->gettblvcstage()->where('vcs.vcid',$vc->id)->get()->result();
        $vc->interviews=$interviews;
        if($vc->aiinterviewstarted==null){
            $vc->interviewstatus="Not Done";
        }
        else{
            $vc->interviewstatus="Done";
        }
        foreach($vcts as $row){
            $row->chats=[];
            foreach($vctds as $rowd){
                if($row->id==$rowd->vctestid){
                    $row->chats[]=$rowd;
                }
            }
        }
        $vts=$this->gettbltest()->where('vt.vacancyid',$vc->vacancyid)->get()->result();
        // pre($vts);
        $vtmap=[];
        foreach($vts as $row){
            $row->thread=null;
            foreach($vcts as $rowt){
                if($row->testid==$rowt->testid){
                    $row->thread=$rowt;
                    break;
                }
            }
            if($row->thread==null || $row->thread->result==null){
                $row->teststatus="Not Done";
            }
            else{
                $row->teststatus="Done";
            }
            $vtmap[$row->testid]=$row;
        }
        $vc->tests=$vtmap;
        // pre($vtmap);
        $vc->stages=$stages;
        return $vc;   
    }
    public function gets($get){
        $db=$this->gettbl();
        if(isset($get['status']) && !empty($get['status'])){
            
        }
        $vacancies=$db->get()->result();
        $vids=[];
        foreach($vacancies as $row){
            $row->vc_pending=0;
            $row->vc_interviewing=0;
            $row->vc_onprocess=0;
            $row->vc_hired=0;
            $row->vc_rejected=0;
            $row->creditused=0;
            $vids[]=$row->id;
        }
        if(!empty($vids)){
            $count_vcs=$this->db->select("vc.vacancyid,
                sum(case when vcs.stageid=1 then 1 else 0 end) vc_pending,
                sum(case when vcs.stageid=2 then 1 else 0 end) vc_interviewing,
                sum(case when vcs.stageid>2 and s.isfinish=0 then 1 else 0 end) vc_onprocess,
                sum(case when s.isfinish=1 then 1 else 0 end) vc_hired,
                sum(case when s.isfinish=2 then 1 else 0 end) vc_rejected
            ")->where_in('vc.vacancyid',$vids)->from('vc')->join('vc_stages vcs','vc.lastvcstageid=vcs.id')->join('stages s','vcs.stageid=s.id')->group_by('vc.vacancyid')->get()->result();
            $credit_vcs=$this->db->select("vc.vacancyid,sum(vcs.usecredit) creditused_vcs")->from("vc_stages vcs")->join("vc","vcs.vcid=vc.id")->where_in("vc.vacancyid",$vids)->group_by("vc.vacancyid")->get()->result();
            $credit_tests=$this->db->select("vc.vacancyid,sum(vct.usecredit) creditused_test")->from("vc_tests vct")->join("vc","vct.vcid=vc.id")->where_in("vc.vacancyid",$vids)->group_by("vc.vacancyid")->get()->result();

        }
        else{
            $count_vcs=[];
            $credit_vcs=[];
            $credit_tests=[];
        }
        foreach($vacancies as $row){
            foreach($count_vcs as $row2){
                if($row->id==$row2->vacancyid){
                    $row->vc_pending=$row2->vc_pending;
                    $row->vc_interviewing=$row2->vc_interviewing;
                    $row->vc_onprocess=$row2->vc_onprocess;
                    $row->vc_hired=$row2->vc_hired;
                    $row->vc_rejected=$row2->vc_rejected;
                    break;
                }
            }
            foreach($credit_vcs as $row2){
                if($row->id==$row2->vacancyid){
                    $row->creditused+=$row2->creditused_vcs;
                    break;
                }
            }
            foreach($credit_tests as $row2){
                if($row->id==$row2->vacancyid){
                    $row->creditused+=$row2->creditused_test;
                    break;
                }
            }
        }
        return $vacancies;
    }
    public function get($id,$get=[]){
        $vacancy=$this->gettbl()->where('v.id',$id)->get()->row();
        $vacancy->skills=$this->gettblskill()->where("vs.vacancyid",$id)->get()->result();
        // pre($vacancy->skills);
        $vacancy->tests=$this->gettbltest()->where("vt.vacancyid",$id)->get()->result();

        if($vacancy->minage==null && $vacancy->maxage==null){
            $vacancy->age='No Age Restriction';
        }
        elseif($vacancy->minage!=null && $vacancy->maxage==null){
            $vacancy->age="Min ".$vacancy->minage." y.o.";
        }
        elseif($vacancy->minage==null && $vacancy->maxage!=null){
            $vacancy->age="Max ".$vacancy->maxage." y.o.";
        }
        else{
            $vacancy->age=$vacancy->minage." y.o. to ".$vacancy->maxage." y.o.";
        }
        if($vacancy->minworkexp==null && $vacancy->maxworkexp==null){
            $vacancy->workexp='No Experience Preference';
        }
        elseif($vacancy->minworkexp!=null && $vacancy->maxworkexp==null){
            $vacancy->workexp="Min ".$vacancy->minworkexp." years";
        }
        elseif($vacancy->minworkexp==null && $vacancy->maxworkexp!=null){
            $vacancy->workexp="Max ".$vacancy->maxworkexp." years";
        }
        else{
            $vacancy->workexp=$vacancy->minworkexp." to ".$vacancy->maxworkexp." years";
        }
        $vacancy->techskills=[];
        $vacancy->softskills=[];
        $vacancy->certifications=[];
        $vacancy->languages=[];
        $tests=[];
        foreach($vacancy->skills as $row){
            switch($row->type){
                case 'Technical':
                    $vacancy->techskills[]=$row->skill;
                    break;
                case 'Soft':
                    $vacancy->softskills[]=$row->skill;
                    break;
                case 'Language':
                    $vacancy->languages[]=$row->skill;
                    break;
                case 'Certification':
                    $vacancy->certifications[]=$row->skill;
                    break;
            }
        }
        foreach($vacancy->tests as $row){
            $tests[]=$row->test;
        }
        $vacancy->techskill_str=implode(", ", $vacancy->techskills);
        $vacancy->softskill_str=implode(", ", $vacancy->softskills);
        $vacancy->language_str=implode(", ", $vacancy->languages);
        $vacancy->certification_str=implode(", ", $vacancy->certifications);
        $vacancy->test_str=implode(", ", $tests);
        $candidates=$this->gettblvc()->where("vc.vacancyid",$id)->get()->result();
        if(isset($get['aidescription']) && !empty(trim($get['aidescription']))){
            $airesult=$this->search_model->runai($candidates,$get['aidescription']);
            // pre($airesult->result);
            $airesultmap=[];
            foreach($airesult->result as $row){
                // pre($row);
                $airesultmap[$row->id]=$row->reason;
            }
            if(empty($airesultmap)){
                $candidates=[];
            }
            else{
                $candidates=$this->gettblvc()->where("vc.vacancyid",$id)->where_in("vc.id",array_keys($airesultmap))->get()->result();
                foreach($candidates as $row){
                    $row->reason=$airesultmap[$row->id];
                }
            }

        }

        $vcsinfo=$this->db->select("count(vc.id) countid,sum(vcs.usecredit) sumusecredit")->from("vc")->join("vc_stages vcs","vc.id=vcs.vcid")->where("vc.vacancyid",$id)->where('vcs.usecredit >',0)->get()->row();
        $vacancy->countcandidate=count($candidates);

        $stages=$this->db->where('isdeleted',0)->order_by('no')->get('stages')->result();
        $stagemap=[];
        foreach($stages as $row){
            $row->candidates=[];
            $stagemap[$row->id]=$row;
        }
        foreach($candidates as $row){
            $stagemap[$row->stageid]->candidates[]=$row;
        }
        $vacancy->stages=$stagemap;

        $vacancy->totalcredit=$vcsinfo->sumusecredit;
        $vacancy->aiprocessed=$vcsinfo->countid;
        
        // $vacancy->vcs=$vcs;
        // pre($vacancy->vcs);
        return $vacancy;
    }
    public function prep_new(){
        $jobcommitments=$this->db->get('job_commitment')->result();
        $locations=$this->db->get('locations')->result();
        $jobroles=$this->db->get('job_roles')->result();
        $degrees=$this->db->get('degrees')->result();
        $departments=$this->db->get('departments')->result();
        $techskills=$this->db->where('type','Technical')->limit(100)->get('skills')->result();
        // $techskills=[];
        $softskills=$this->db->where('type','Soft')->get('skills')->result();
        $langskills=$this->db->where('type','Language')->get('skills')->result();
        $certskills=$this->db->where('type','Certification')->get('skills')->result();
        return [
            'jobcommitments'=>$jobcommitments,
            'locations'=>$locations,
            'jobroles'=>$jobroles,
            'degrees'=>$degrees,
            'departments'=>$departments,
            'techskills'=>$techskills,
            'softskills'=>$softskills,
            'langskills'=>$langskills,
            'certskills'=>$certskills
        ];
    }
    public function add($data){
        $data['jobdesc']=trim($data['jobdesc']);
        $tests=$data['tests'];
        unset($data['tests']);
        if($data['workexperience']){
            list($data['minworkexp'],$data['maxworkexp'])=explode("-",$data['workexperience']);    
        }
        else{
            $data['minworkexp']=0;
            $data['maxworkexp']=100;
        }
        // $data['createdby']=$this->login->id;
        $data['createdby']=1;
        $data['createdat']=date("Y-m-d H:i:s");
        $data['status']="Open";
        $data['opendate']=date("Y-m-d");

        $techskillids=autocreate_select_options($data['techskills'],'skills','name',['type'=>'Technical']);
        $softskillids=autocreate_select_options($data['softskills'],'skills','name',['type'=>'Soft']);
        $langskillids=autocreate_select_options($data['langskills'],'skills','name',['type'=>'Language']);
        $certskillids=autocreate_select_options($data['certskills'],'skills','name',['type'=>'Certification']);

        unset($data['minworkexp']);
        unset($data['techskills']);
        unset($data['softskills']);
        unset($data['langskills']);
        unset($data['certskills']);
        unset($data['workexperience']);

        $this->db->insert('vacancies',$data);
        $vacancyid=$this->db->insert_id();
        $ib_vt=[];
        foreach($tests as $testid){
            $ib_vt[]=[
                'vacancyid'=>$vacancyid,
                'testid'=>$testid
            ];
        }
        $ib_vs=[];
        foreach($techskillids as $skillid){
            $ib_vs[]=[
                'vacancyid'=>$vacancyid,
                'skillid'=>$skillid,
                'proficiency'=>0
            ];
        }
        foreach($softskillids as $skillid){
            $ib_vs[]=[
                'vacancyid'=>$vacancyid,
                'skillid'=>$skillid,
                'proficiency'=>0
            ];
        }
        foreach($langskillids as $skillid){
            $ib_vs[]=[
                'vacancyid'=>$vacancyid,
                'skillid'=>$skillid,
                'proficiency'=>0
            ];
        }
        foreach($certskillids as $skillid){
            $ib_vs[]=[
                'vacancyid'=>$vacancyid,
                'skillid'=>$skillid,
                'proficiency'=>0
            ];
        }
        // pre($ib_vs);
        if(!empty($ib_vt)){
            $this->db->insert_batch('vacancy_tests',$ib_vt);
        }
        if(!empty($ib_vs)){
            $this->db->insert_batch('vacancy_skills',$ib_vs);
        }
        // pre($data);
        return $vacancyid;
    }
    public function acceptvcs($post){
        $today=date("Y-m-d");
        $now=date("Y-m-d H:i:s");
        $vcss=$this->db->where_in('id',$post['vcsids'])->get('vc_stages')->result();
        // pre($vcss);
        $ub_vcs=[];
        $ib_vcs=[];

        foreach($vcss as $row){
            $ub_vcs[]=[
                'id'=>$row->id,
                'datecompleted'=>$today,
                'updatedt'=>$now
            ];
            $ib_vcs[]=[
                'vcid'=>$row->vcid,
                'stageid'=>$post['stageid'],
                'dateentered'=>$today,
                'score'=>$row->score,
                'createdt'=>$now
            ];
        }
        if(!empty($ub_vcs)){
            $this->db->update_batch('vc_stages',$ub_vcs,'id');
        }
        if(!empty($ib_vcs)){
            $this->db->insert_batch('vc_stages',$ib_vcs);
        }
        $this->db->query("update vc set lastvcstageid=(select max(id) from vc_stages where vcid=vc.id)");
        return true;
    }
    public function rejectvcs($post){
        $today=date("Y-m-d");
        $now=date("Y-m-d H:i:s");
        $stage=$this->db->where('isfinish',2)->get('stages')->row();
        $vcss=$this->db->where_in('id',$post['vcsids'])->get('vc_stages')->result();
        $ub_vcs=[];
        $ib_vcs=[];

        foreach($vcss as $row){
            $ub_vcs[]=[
                'id'=>$row->id,
                'datecompleted'=>$today,
                'updatedt'=>$now
            ];
            $ib_vcs[]=[
                'vcid'=>$row->vcid,
                'stageid'=>$stage->id,
                'dateentered'=>$today,
                'datecompleted'=>$today,
                'score'=>$row->score,
                'result'=>$post['rejectreason'],
                'createdt'=>$now,
                'updatedt'=>$now
            ];
        }
        if(!empty($ub_vcs)){
            $this->db->update_batch('vc_stages',$ub_vcs,'id');
        }
        if(!empty($ib_vcs)){
            $this->db->insert_batch('vc_stages',$ib_vcs);
        }
        $this->db->query("update vc set lastvcstageid=(select max(id) from vc_stages where vcid=vc.id)");
        return true;
    }
    public function calcavgscore($vcid){
        $penalty=getsetting('aisuspect_penalty');
        $totalscore=0;
        $countscore=0;
        $cv=$this->db->select('cvscore')->where('id',$vcid)->get('vc')->row();
        if($cv->cvscore!=null){
            $totalscore+=$cv->cvscore;
            $countscore++;
        }
        $interview=$this->db->select('score,aisuspect')->where('stageid',2)->where('vcid',$vcid)->where('datecompleted is not null')->get('vc_stages')->row();
        if($interview!=null){
            $totalscore+=calc_netscore($interview->score,$interview->aisuspect,$penalty);
            $countscore++;
        }
        $tests=$this->db->select('score,aisuspect')->where('vcid',$vcid)->where('finishdt is not null')->where('score is not null')->get('vc_tests')->result();
        foreach($tests as $row){
            $totalscore+=calc_netscore($row->score,$row->aisuspect,$penalty);
            $countscore++;
        }
        $avgscore=$totalscore/$countscore;
        $this->db->where('id',$vcid)->update('vc',['avgscore'=>$avgscore]);
        return $avgscore;
    }
    public function add_new_candidate($post,$cvpath){
        $this->load->model("openai_core");
        // pre($cvpath,1);
        $cvtext=$this->utilities->extractPdf($cvpath);
        $run=$this->openai_core->parseCV($cvtext);
        if(isset($run->json_lastmessage) && $run->json_lastmessage){
            $airesult=json_encode($run->json_lastmessage);
        }
        else{
            $airesult='';
        }
        // pre($run->json_lastmessage,1);
        $this->db->insert('candidates',[
            'firstname'=>$post['firstname'],
            'lastname'=>$post['lastname'],
            'email'=>$post['email'],
            'phone'=>$post['phone'],
            'status'=>'Available',
            'createdate'=>date("Y-m-d"),
            'useai'=>1,
            'airesult'=>$airesult,
            'cvfile'=>$post['cvfile']
        ]);
        $candidateid=$this->db->insert_id();
        $this->db->insert('vc',[
            'candidateid'=>$candidateid,
            'vacancyid'=>$post['vacancyid'],
            // 'asksalary'=>$post['asksalary'],
            'status'=>'In Progress',
            'application'=>$post['application'],
            'createdt'=>date("Y-m-d H:i:s"),
            'useaiinterview'=>1
        ]);
        $vcid=$this->db->insert_id();
        $this->db->insert('vc_stages',[
            'vcid'=>$vcid,
            'stageid'=>1,
            'dateentered'=>date("Y-m-d"),
            'createdt'=>date("Y-m-d H:i:s")
        ]);
        $vcsid=$this->db->insert_id();
        $this->db->where('id',$vcid)->update('vc',[
            'lastvcstageid'=>$vcsid
        ]);
        return $candidateid;
    }
    public function generate_jobdesc($get){
        $company=getcompany();
        if(isset($get['locationid']) && !empty($get['locationid'])){
            $data=$this->db->where('id',$get['locationid'])->get('locations')->row();
            $location=$data->city.", ".$data->province.", ".$data->country;
        }
        else{
            $location=$company->city.", ".$company->province.", ".$company->country;
        }
        if(isset($get['jobcommitmentid']) && !empty($get['jobcommitmentid'])){
            $data=$this->db->where('id',$get['jobcommitmentid'])->get('job_commitment')->row();
            $jobcommitment=$data->name;
        }
        else{
            $jobcommitment="Not Defined";
        }
        if(isset($get['departmentid']) && !empty($get['departmentid'])){
            $data=$this->db->where('id',$get['departmentid'])->get('departments')->row();
            $department=$data->name;
        }
        else{
            $department="Not Defined";
        }
        $gender=ucwords(sanitize_elm($get,'gender','','No Preference'));
        $minage=sanitize_elm($get,'minage',' yeas old','No Preference');
        $maxage=sanitize_elm($get,'maxage',' years old','No Preference');
        $mindegree=sanitize_elm($get,'mindegree','','No Preference');
        $workexp=sanitize_elm($get,'workexperience',' years','No Preference');
        $skillids=[];
        $techskills=[];
        $softskills=[];
        $langskills=[];
        $certskills=[];
        if(isset($get['techskills'])){
            foreach($get['techskills'] as $skillid){
                if(is_numeric($skillid)){
                    $skillids[]=$skillid;
                }
                else{
                    $techskills[]=$skillid;
                }
            }
            if(!empty($skillids)){
                $datas=$this->db->where_in('id',$skillids)->get('skills')->result();
                if(!empty($datas)){
                    foreach($datas as $row){
                        $techskills[]=$row->name;
                    }
                }
            }
        }
        $techskills=implode(",",$techskills);

        $skillids=[];
        if(isset($get['softskills'])){
            foreach($get['softskills'] as $skillid){
                if(is_numeric($skillid)){
                    $skillids[]=$skillid;
                }
                else{
                    $softskills[]=$skillid;
                }
            }
            if(!empty($skillids)){
                $datas=$this->db->where_in('id',$skillids)->get('skills')->result();
                if(!empty($datas)){
                    foreach($datas as $row){
                        $softskills[]=$row->name;
                    }
                }
            }
        }
        $softskills=implode(",",$softskills);

        $skillids=[];
        if(isset($get['langskills'])){
            foreach($get['langskills'] as $skillid){
                if(is_numeric($skillid)){
                    $skillids[]=$skillid;
                }
                else{
                    $langskills[]=$skillid;
                }
            }
            if(!empty($skillids)){
                $datas=$this->db->where_in('id',$skillids)->get('skills')->result();
                if(!empty($datas)){
                    foreach($datas as $row){
                        $langskills[]=$row->name;
                    }            
                }
            }
        }
        $langskills=implode(",",$langskills);

        $skillids=[];
        if(isset($get['certskills'])){
            foreach($get['certskills'] as $skillid){
                if(is_numeric($skillid)){
                    $skillids[]=$skillid;
                }
                else{
                    $certskills[]=$skillid;
                }
            }
            if(!empty($skillids)){
                $datas=$this->db->where_in('id',$skillids)->get('skills')->result();
                if(!empty($datas)){
                    foreach($datas as $row){
                        $certskills[]=$row->name;
                    }
                }
            }
        }
        $certskills=implode(",",$certskills);
        $system='You are an expert HR Recruiter with 10+ years of experience in recruitment. You have been hiring and recruiting people in all kind of industry and are very familiar with very fast type of employment. Your task is to write me a job description, qualification and responsibilites for an open job vacancy in my company, i will put this job description on my website. Please be detailed, and engaging. The candidate will be asked to upload a CV on a form provided on my website. No need to mention about my company information (logo, email, phone) other than my company name and brand name.';
        $request="
        Write me a job description for this job vacancy:
         - Company Name: ".$company->name.".
         - Brand Name: ".$company->brand.".
         - Location: ".$location.".
         - Industry: ".$company->industry.".
         - Job Position: ".$get['title'].".
         - Commitment Type: ".$jobcommitment.".
         - Work Arrangement: ".ucwords($get['arrangement']).".
         - Department: ".$department.".
         - Gender: ".$gender.".
         - Min Age: ".$minage.".
         - Max Age: ".$maxage.".
         - Min Education: ".$mindegree.".
         - Work Experience: ".$workexp." in similar industries or similar job position.
         - Technical Skills: ".$techskills.".
         - Soft Skills: ".$softskills.".
         - Language Proficiencies: ".$langskills.".
         - Certifications: ".$certskills.".
         
         Using your expertise in Recruitment, please add more qualifications and skills requirement other than the one i will mention so that i can get better candidates related to the job vacancy.
         Write me the job description in language: ".$get['interviewlang'].".";
        
        $answer=$this->openai_core->do_chat($system,$request);
        return $answer;
         // echo json_encode(['request'=>$request,'jobdesc'=>$answer]);
        // pre($response);
    }
    public function scorecv($vcid,$cvdata){
        $vc=$this->db->where('id',$vcid)->get('vc')->row();
        $vacancy=$this->db->where('id',$vc->vacancyid)->get('vacancies')->row();
        $candidate=$this->db->where('id',$vc->candidateid)->get('candidates')->row();

        $system='You are an expert HR Recruiter with 10+ years of experience in recruitment. You have been hiring and recruiting people in all kind of industry and are very familiar with very fast type of employment. Your task is to score a candidate CV in JSON to a provided Job vacancy to determine how well suited the candidate is based on their CV information. Follow this scoring metrics:
        - 100 = Extraordinary Candidate, the candidate CV fulfill all requirements on the vacancy, have work experience in same industries and job position, and have education background that fits the requirements. In other words the candidate is excellent or perhaps over qualified.
        - 80 = Very Good Candidate, the candidate CV fulfill 90 percent of the job requirements. Candidate have work experience in same industries and job position, have required education background.
        - 70 = Good Candidate, the candidate CV fulfill 80 percent of the job requirements. Have work experience in similar industries and similar job position, have required education background.
        - 60 = Mediocre Candidate, the candidate CV fulfill only 60 percent of the job requirements. Have little experience in similar industries and similar job position. Have similar education background to the vacancy.
        - 40 = Bad Candidate, the candidate CV fulfill only 30 percent of the job requirements. Have no experience in similar industries, but have similar education background to the vacancy.
        - 0 = Rejected Candidate, the candidate CV does not match the job description, it will be disastrous to hire this person for the vacancy.

        Give your score, evaluation, and explanation of the evaluation in this EXACT JSON format:

        {
            "cvscore":"",
            "evaluation":"",
            "explanation":""
        }';
        $request="
        JOB DESCRIPTION:
        ".$vacancy->jobdesc."

        CV:
        ".$cvdata."
        ";
        
        $answer=$this->openai_core->do_chatjson($system,$request);
        $json=json_decode($answer);
        $this->db->where('id',$vcid)->update('vc',[
            'cvscore'=>$json->cvscore,
            'avgscore'=>$json->cvscore,
            'cvresult'=>json_encode($json)
        ]);
        return $answer;
    }
    public function offer_vc($post){
        $vcid=$post['id'];
        $startworkdate=$post['startworkdate'];
        $offersalary=$post['offersalary'];

        $offerdate=date("Y-m-d");
        $offerdeadlinedt=new DateTime($offerdate);
        $deadline=getsetting("offering_deadline");
        $offerdeadlinedt->modify("+".$deadline." day");
        $offerdeadline=$offerdeadlinedt->format("Y-m-d");
        
        $this->db->where('id',$vcid)->update('vc',[
            'offersalary'=>$offersalary,
            'startworkdate'=>$startworkdate,
            'offerdate'=>$offerdate,
            'offerdeadline'=>$offerdeadline,
            'isoffered'=>1
        ]);
        $this->create_offering_letter($vcid);
        $this->send_offering_letter($vcid);
    }
    public function create_offering_letter($vcid){
        $vc=$this->getvc($vcid);
        $vacancy=$this->get($vc->vacancyid);
        $company=getcompany();
        $template=getsetting('offering_template_'.strtolower($vacancy->interviewlang));
        $template=str_replace_multiple($template,[
            '[DATE]'=>$vc->offerdate,
            '[COM]'=>$company->name,
            '[COM_ADDRESS]'=>$company->city.', '.$company->province.', '.$company->country,
            '[JOB_TITLE]'=>$vacancy->title,
            '[CAN_NAME]'=>$vc->name,
            '[CAN_ADDRESS]'=>$vc->address,
            '[OFF_SALARY]'=>number_format($vc->offersalary),
            '[START_DATE]'=>$vc->startworkdate,
            '[DEADLINE]'=>$vc->offerdeadline,
            '[ARRANGEMENT]'=>$vacancy->arrangement,
            '[COMMITMENT]'=>$vacancy->jobcommitment,
            '[YOUR_NAME]'=>$this->session->login->name
        ]);
        $this->db->where('id',$vcid)->update('vc',[
            'offerletter'=>$template
        ]);
        return true;
    }
    public function send_offering_letter($vcid){
        $vc=$this->db->select("v.title,vc.id,c.email,concat(c.firstname,' ',c.lastname) name,vc.interviewurisent,vc.offerletter")->from('vc')->join('vacancies v','vc.vacancyid=v.id')->join('vc_stages vcs','vc.lastvcstageid=vcs.id')->join("candidates c","vc.candidateid=c.id")->where('vc.id',$vcid)->get()->row();
        if($vc->offerletter!=null){
            $subject=getCompany('name').' - Offering Letter for '.$vc->title.' Job Position';
            sendHelperEmail($vc->email,$subject,$vc->offerletter);
        }
    }
    public function create_offering_pdf($vcid){
        $vc=$this->db->where('id',$vcid)->get('vc')->row();
        $this->utilities->savetopdf($vc->offerletter,'vc-'.$vc->id);
    }
    
}
?>
