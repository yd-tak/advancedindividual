<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {
    private $_params=[];
    public function __construct(){
        parent::__construct();
        $params=$this->db->get('setting')->result();
        // pre($params);
        foreach($params as $row){
            $this->_params[$row->param]=$row->val;
        }

    } 
    public function get($param=null){
        if($param==null){
            return (object)$this->_params;
        }
        else
            return $this->_params[$param];
    }
}
?>
