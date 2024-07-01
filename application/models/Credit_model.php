<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credit_model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    } 
    private function _get_balance($balancedate=false){
        $this->db->select("sum(debit-credit) balance");
        if($balancedate){
            $this->db->where("date(balancedt)<",$balancedate);
        }
        $cb=$this->db->get("credit_balances")->row();
        return $cb->balance;
    }
    public function getHistory($params){
        $startbalance=0;
        if(isset($params['startdate']) && !empty($params['startdate'])){
            $startbalance=$this->_get_balance($params['startdate']);
            $this->db->where("date(balancedt)>=",$params['startdate']);
        }
        if(isset($params['enddate']) && !empty($params['enddate'])){
            $this->db->where("date(balancedt)<=",$params['enddate']);
        }
        $balances=$this->db->order_by('balancedt')->get('credit_balances')->result();
        $open=$startbalance;
        foreach($balances as $i=>$row){
            $row->open=$open;
            $row->close=$open+$row->debit-$row->credit;
            $open=$row->close;
        }
        return $balances;
    }
    public function credit($amount,$associatedwith,$associatedid,$note){
        $this->db->insert('credit_balances',[
            'balancedt'=>date("Y-m-d H:i:s"),
            'associatedwith'=>$associatedwith,
            'associatedid'=>$associatedid,
            'note'=>$note,
            'credit'=>$amount
        ]);
        return $this->db->insert_id();
    }
    public function debit($amount,$associatedwith,$associatedid,$note){
        $this->db->insert('credit_balances',[
            'balancedt'=>date("Y-m-d H:i:s"),
            'associatedwith'=>$associatedwith,
            'associatedid'=>$associatedid,
            'note'=>$note,
            'debit'=>$amount
        ]);
        return $this->db->insert_id();
    }
    public function getBalance(){
        return $this->_get_balance();
    }
}
?>
