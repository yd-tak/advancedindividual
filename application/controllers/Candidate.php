<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidate extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('candidate_model');
        $this->_defaultview=[
        	'objectname'=>'Candidate',
        	'breadcrumbs'=>[
        		'Candidate'
        	]
        ];
    }

    public function search() {
        $input=$this->input->get();
        $view=$this->_defaultview;
        
        if(isset($input['keywords']) && !empty($input['keywords'])){
            $searchresults=$this->search_model->run($input['keywords'],'candidate');
            // pre($searchresults);
            $candidateids=[];
            foreach($searchresults as $row){
                $candidateids[]=$row->id;
            }
            $candidates=$this->candidate_model->gettbl()->where_in('c.id',$candidateids)->get()->result();
            foreach($candidates as $row){
                foreach($searchresults as $row2){
                    if($row->id==$row2->id){
                        $row->desc=$row2->desc;
                        break;
                    }
                }
            }
            $view['input']=$input;
        }
        else{
            $candidates=$this->candidate_model->gettbl()->get()->result();
        }
    	
    	$view['breadcrumbs'][]='Search Candidate';
    	$view['pagename']='Search Candidate';
        $view['candidates'] = $candidates;
        $view['content']=$this->load->view('candidate/search', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }

    public function add() {
        $input = $this->input->post();
        $this->candidate_model->add_candidate($input);
        redirect('candidate/search');
    }

    public function edit($id) {
        $input = $this->input->post();
        $this->candidate_model->edit_candidate($id, $input);
        redirect('candidate/search');
    }

    public function delete() {
        $input=$this->input->post();
        $this->candidate_model->delete_candidate($input['id']);
        redirect('candidate/search');
    }
    public function view($id){
        $candidate=$this->candidate_model->get($id);
        $this->search_model->logView(getLoginSession('id'),'Candidate',$candidate->id,$candidate->name,'candidate/view/'.$id);
        $view=$this->_defaultview;
        $view['breadcrumbs'][]='Search Candidate';
        $view['pagename']='Search Candidate';
        $view['candidate'] = $candidate;
        // pre($view['candidate']);
        $view['content']=$this->load->view('candidate/view', $view,true);
        $this->load->view('layouts/master', ['view'=>$view]);
    }
}
?>
