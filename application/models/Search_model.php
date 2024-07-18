<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {
    public function runai($datas,$searchdescription){
        $run=$this->openai_core->searchData($datas,$searchdescription);
        if(isset($run->json_lastmessage) && $run->json_lastmessage){
            $airesult=$run->json_lastmessage;
        }
        else{
            $airesult=[];
        }
        return $airesult;
        
    }
    public function run($keywords,$type=''){
        if(!is_array($keywords)){
            $keywords=[$keywords];
        }
        foreach($keywords as $i=>$keyword){
            $keywords[$i]=strtolower($keyword);
        }
        // pre($keywords);
        $searchresults=[];
        if(empty($type) || $type=='candidate'){
            $this->db->select("'candidate' as type,id,firstname,lastname,email,phone,concat(firstname,' ',lastname) as title,concat('candidate/view/',id) as uri")->from("candidates");
            foreach($keywords as $keyword){
                $this->db->or_group_start()
                    ->like("lower(email)",$keyword)->or_like("lower(phone)",$keyword)->or_like("lower(concat(firstname,' ',lastname))",$keyword)->or_like("lower(concat(lastname,' ',firstname))",$keyword)
                ->group_end();
            }
            $candidates=$this->db->get()->result();
            
            $this->db->select("'candidate' as type,c.id,c.firstname,c.lastname,c.email,c.phone,ce.degree,ce.fieldparse as field,ce.institution,concat(c.firstname,' ',c.lastname) as title,concat('candidate/view/',c.id) as uri")->from("candidate_educations ce")->join("candidates c","ce.candidateid=c.id");
            foreach($keywords as $keyword){
                $this->db->or_group_start()
                    ->like("lower(ce.degree)",$keyword)->or_like("lower(ce.fieldparse)",$keyword)->or_like("lower(ce.institution)",$keyword)
                ->group_end();
            }
            $candidatesedu=$this->db->get()->result();
            // pre($candidatesedu);
            // echo $this->db->last_query();exit;
            $this->db->select("'candidate' as type,c.id,c.firstname,c.lastname,c.email,c.phone,cw.company,cw.position,concat(c.firstname,' ',c.lastname) as title,concat('candidate/view/',c.id) as uri")->from("candidate_workexps cw")->join("candidates c","cw.candidateid=c.id");
            foreach($keywords as $keyword){
                $this->db->or_group_start()
                    ->like("lower(cw.company)",$keyword)->or_like("lower(cw.position)",$keyword)
                ->group_end();
            }
            $candidateswork=$this->db->get()->result();
            
            $this->db->select("'candidate' as type,c.id,c.firstname,c.lastname,c.email,c.phone,cs.skillparse as skill,concat(c.firstname,' ',c.lastname) as title,concat('candidate/view/',c.id) as uri")->from("candidate_skills cs")->join("candidates c","cs.candidateid=c.id");
            foreach($keywords as $keyword){
                $this->db->or_like("lower(cs.skillparse)",$keyword);
            }
            $candidatesskill=$this->db->get()->result();

            $searchresults=array_merge($searchresults,$candidates,$candidatesedu,$candidateswork,$candidatesskill);
        }
        if(empty($type) || $type=='vacancy'){
            $this->db->select("'vacancy' as type,v.id,v.title,concat('vacancy/view/',v.id) as uri")->from("vacancies v");
            foreach($keywords as $keyword){
                $this->db->or_like("lower(v.title)",$keyword);
            }
            $vacancies=$this->db->get()->result();

            $vacancyskills=$this->db->select("'vacancy' as type,v.id,v.title,s.name as skill,concat('vacancy/view/',v.id) as uri")->from("vacancy_skills vs")->from("vacancies v","vs.vacancyid=v.id")->join("skills s","vs.skillid=s.id");
            foreach($keywords as $keyword){
                $this->db->or_like("lower(s.name)",$keyword);
            }
            $vacancyskills=$this->db->get()->result();

            $searchresults=array_merge($searchresults,$vacancies,$vacancyskills);
            
        }
        
        // pre($searchresults);
        $searchresults=$this->highlightSearchResult($keywords,$searchresults);
        // pre($searchresults);
        return array_values($searchresults);
    }
    private function highlightSearchResult($keywords,$searchresult){
        $f_searchresult=[];
        foreach($searchresult as $row){
            $row->desc='';
            if($row->type=='candidate'){
                $row->kiicon='ki-user';
            }
            else{
                $row->kiicon='ki-abstract-20';
            }
            $arr=get_object_vars($row);
            foreach($arr as $key=>$val){
                if(in_array($key, ['type','title','uri']))
                    continue;
                $val=strtolower($val);
                foreach($keywords as $keyword){
                    if(str_contains($val, $keyword)){
                        if(empty($row->desc))
                            $row->desc=ucwords($key).': '.ucwords(str_replace($keyword, "<b style='text-transform:uppercase;font-size:16px;'>".$keyword."</b>", $val));
                        else
                            $row->desc.="<br>".ucwords($key).': '.ucwords(str_replace($keyword, "<b style='text-transform:uppercase;font-size:16px;'>".$keyword."</b>", $val));
                        // if(!isset($f_searchresult[$row->uri])){
                        $f_searchresult[$row->uri]=$row;
                        // }
                    }
                }
            }
        }
        return $f_searchresult;
    }
    public function recentViews($userid){
        $recentviews=$this->db->where('userid',$userid)->order_by('viewdt desc')->limit(10)->get('recent_views')->result();
        return $recentviews;
    }
    public function logView($userid,$object,$objectid,$objectname,$uri){
        $kiicon='ki-abstract-33';
        switch($object){
            case 'Candidate':
                $kiicon='ki-user';
                break;
            case 'Vacancy':
                $kiicon='ki-abstract-33';
                break;
        }
        $checkView=$this->db->where([
            'userid'=>$userid,
            'uri'=>$uri
        ])->get('recent_views')->row();
        if($checkView!=null){
            $this->db->where('id',$checkView->id)->set([
                'objectname'=>$objectname,
                'viewdt'=>now()
            ])->update('recent_views');
        }
        else{
            $this->db->insert('recent_views',[
                'userid'=>$userid,
                'object'=>$object,
                'objectid'=>$objectid,
                'objectname'=>$objectname,
                'uri'=>$uri,
                'kiicon'=>$kiicon,
                'viewdt'=>now()
            ]);
        }
        return true;
    }
}
?>
