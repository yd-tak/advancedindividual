<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct() {
        parent::__construct();
        $this->_defaultview=[
        	'objectname'=>'Dashboard',
        	'breadcrumbs'=>[
        		'Dashboard'
        	]
        ];
    }
	public function index()
	{
		$this->load->model('candidate_model');
		$this->load->model('credit_model');
		$this->load->model('interview_model');
		$this->load->model('recruitment_model');
		$countcandidates=$this->db->select('count(id) countdata')->get('candidates')->row()->countdata;
		$countcandidatestages=$this->db->select("ifnull(s.name,'Undefined') as stage,count(vc.id) countdata")->from('vc')->join('stages s','vc.lastvcstageid=s.id','left')->group_by("1")->get()->result();
		$countcandidatedepts=$this->db->select("ifnull(d.name,'Undefined') as department,count(vc.id) countdata")->from('vc')->join('vacancies v','vc.vacancyid=v.id')->join('departments d','v.departmentid=d.id','left')->group_by("1")->get()->result();
		$countvacancies=$this->db->select("count(id) countdata")->get('vacancies')->row()->countdata;
		$countvacancydepts=$this->db->select("ifnull(d.name,'Undefined') as department, count(v.id) countdata")->from("vacancies v")->join("departments d","v.departmentid=d.id","left")->group_by('1')->get()->result();
		$topvacancies=$this->db->select("v.id,v.title,d.name,count(vc.id) countdata")->from("vacancies v")->join("departments d","v.departmentid=d.id","left")->join("vc","v.id=vc.vacancyid")->group_by('1')->order_by("count(vc.id) desc")->limit(5)->get()->result();
		$timetohire=$this->db->select("avg(a.mindaytook) avgdata")->from("(SELECT v.id vacancyid,datediff(v.createdate,min(vc.createdt)) mindaytook from vacancies v join vc on v.id=vc.vacancyid join vc_stages vcs on vc.id=vcs.vcid and vcs.stageid=8 group by 1 having count(vc.id)>0) a")->get()->result();
		$timetohiredepts=$this->db->select("a.department,avg(a.mindaytook) avgdata")->from("(SELECT ifnull(d.name,'Undefined') department,datediff(v.createdate,min(vcs.createdt)) mindaytook from vacancies v left join departments d on v.departmentid=d.id join vc on v.id=vc.vacancyid join vc_stages vcs on vc.id=vcs.vcid and vcs.stageid=8 group by 1 having count(vc.id)>0) a")->group_by('1')->get()->result();
		$query=$this->db->select("ifnull(sum(case when vcs.stageid=7 then 1 else 0 end),0) accepted,ifnull(sum(case when vcs.stageid=8 and vcs.result='Offer Rejected' then 1 else 0 end),0) rejected")->from("vc_stages vcs")->get()->row();
		$offeracceptancerate=$query->accepted/($query->accepted+$query->rejected);
		$query=$this->db->select("ifnull(d.name,'Undefined') department,ifnull(sum(case when vcs.stageid=7 then 1 else 0 end),0) accepted,ifnull(sum(case when vcs.stageid=8 and vcs.result='Offer Rejected' then 1 else 0 end),0) rejected")->from("vc_stages vcs")->join('vc','vcs.vcid=vc.id')->join('vacancies v','vc.vacancyid=v.id')->join('departments d','v.departmentid=d.id','left')->group_by('1')->get()->result();
		// pre($query);
		$offeracceptanceratedepts=[];
		foreach($query as $row){
			if(($row->accepted+$row->rejected)==0){
				$row->offeracceptancerate=0;
			}
			$row->offeracceptancerate=$row->accepted/($row->accepted+$row->rejected);
			$offeracceptanceratedepts[]=$row;
		}
		$countinterviewsdone=$this->db->select("count(id) countdata,sum(usecredit) sumdata")->where('result is not null')->where("stageid",2)->get('vc_stages')->row()->countdata;
		$countinterviewdonedepts=$this->db->select("ifnull(d.name,'Undefined') department,count(vcs.id) countdata,sum(vcs.usecredit) sumdata")->where("vcs.result is not null")->where("vcs.stageid",2)->from("vc_stages vcs")->join('vc','vcs.vcid=vc.id')->join('vacancies v','vc.vacancyid=v.id')->join("departments d","v.departmentid=d.id","left")->group_by("1")->get()->result();
		$countinterviewsongoing=$this->db->select("count(id) countdata")->where('result is null')->where("usecredit >",0)->where("stageid",2)->where("datecompleted is null")->get('vc_stages')->row()->countdata;

		$currentCredit=$this->credit_model->getBalance();//return currentBalance 

		$view=$this->_defaultview;
		$view+=[
			'countcandidates'=>$countcandidates,
			'countcandidatestages'=>$countcandidatestages,
			'countcandidatedepts'=>$countcandidatedepts,
			'countvacancies'=>$countvacancies,
			'countvacancydepts'=>$countvacancydepts,
			'topvacancies'=>$topvacancies,
			'timetohire'=>$timetohire,
			'timetohiredepts'=>$timetohiredepts,
			'offeracceptancerate'=>$offeracceptancerate,
			'offeracceptanceratedepts'=>$offeracceptanceratedepts,
			'countinterviewsdone'=>$countinterviewsdone,
			'countinterviewdonedepts'=>$countinterviewdonedepts,
			'countinterviewsongoing'=>$countinterviewsongoing
		];
    	$view['breadcrumbs'][]='Dashboard';
    	$view['pagename']='Dashboard';
        $view['content']=$this->load->view('dashboard', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
	}
}
