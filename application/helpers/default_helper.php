<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function getRequestMethod()
{
    $method=$_SERVER['REQUEST_METHOD'];
    return strtolower($method);
}
function getLoginSession($key=null)
{
    $ci=&get_instance();
    $login=$ci->session->userdata('login');
    $ret=false;
    if(isset($login->$key)){
        $ret=$login->$key;
    }
    return $ret;
}

function pre($data, $next = 0)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if (!$next) {
        exit;
    }
}
function filter_select_option_ids($options){
    $newdatas=[];
    $ids=[];
    
    foreach($options as $val){
        if(is_numeric($val)){
            $ids[]=$val;
        }
        else{
            $newdatas[]=$val;
        }
    }
    // pre($ids);
    return [
        'ids'=>$ids,
        'newdatas'=>$newdatas
    ];
}
function insert_select_options($tblname,$datas,$colname='name',$defaultrow=[]){
    $ci=&get_instance();
    if(!empty($datas)){

        $ib_newdata=[];
        foreach($datas as $data){
            $newdata=$defaultrow;
            $newdata[$colname]=$data;
            $ib_newdata[]=$newdata;
        }
        // pre($ib_newdata);
        $ci->db->insert_ignore_batch($tblname,$ib_newdata);
        $inserted=$ci->db->where_in($colname,$datas)->get($tblname)->result();
        // pre($inserted);
        $newids=[];
        foreach($inserted as $row){
            $newids[]=$row->id;
        }
        return $newids;
    }
    else{
        return [];
    }
}

function autocreate_select_options($options,$tblname,$colname='name',$defaultrow=[]){
    $datas=filter_select_option_ids($options);
    $newids=insert_select_options($tblname,$datas['newdatas'],$colname,$defaultrow);
    $optionids=$datas['ids'];
    if(!empty($newids)){
        foreach($newids as $newid){
            $optionids[]=$newid;
        }
    }
    return $optionids;
}
function ym($date,$format="M y"){
    $dt=new DateTime($date);
    return $dt->format($format);
}
function y($date){
    return substr($date,0,4);
}
function hi($date,$format="H:i"){
    $dt=new DateTime($date);
    return $dt->format($format);
}
function ymd($date,$format="d M y"){
    $dt=new DateTime($date);
    return $dt->format($format);
}
function getcompany($param=null){
    $ci=&get_instance();
    return $ci->company_model->get($param);
}
function getsetting($param=null){
    $ci=&get_instance();
    return $ci->setting_model->get($param);
}
function calc_netscore($score,$aisuspect,$penalty){
    $netscore=(1-($aisuspect*$penalty/3))*$score;
    return $netscore;
}
function sanitize_elm($arr,$elm,$append="",$default=""){
    if(!isset($arr[$elm]) || $arr[$elm]===null || $arr[$elm]===false || $arr[$elm]===''){
        return $default;
    }
    else{
        return $arr[$elm].$append;
    }
}
function sanitize_obj($obj,$keys,$default=""){
    foreach($keys as $key){
        if(!isset($obj->$key)){
            $obj->$key=$default;
        }
    }
    return $obj;
}
function sanitize($str,$ret=""){
    if(!isset($str) || $str==null || $str==false){
        return $ret;
    }
    else return $str;
}
function array_set(&$arr,$key,$val){
    if($val!=null && $val!==false && $val!==""){
        $arr[$key]=$val;
    }
}
function jsonkey($str){
    return ucwords(str_replace("_", " ", $str));
}
function associatedwith($str){
    return ucwords(str_replace("_", " ", $str));
}
function str_replace_multiple($str,$findreplaces){
    $resultstr=$str;
    foreach($findreplaces as $search=>$replace){
        $resultstr=str_replace($search, $replace, $resultstr);
    }
    return $resultstr;
}
function showFlashData(){
    $ci=&get_instance();
    if ($ci->session->flashdata('warning')){
        echo '<div class="alert alert-warning">WARNING: '.ucwords($ci->session->flashdata('warning')).'</div>';
    }
    if ($ci->session->flashdata('error')){
        echo '<div class="alert alert-danger">ERROR:'.ucwords($ci->session->flashdata('error')).'</div>';
    }
    if ($ci->session->flashdata('success')){
        echo '<div class="alert alert-success">SUCCESS: '.ucwords($ci->session->flashdata('success')).'</div>';
    }
}
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function getRecentViews($userid){
    $ci=&get_instance();
    $recentViews=$ci->search_model->recentViews($userid);
    return $recentViews;
}
function now(){
    return date("Y-m-d H:i:s");
}
function getCreditBalance(){
    $ci=&get_instance();
    $balance=$ci->db->select("ifnull(sum(debit)-sum(credit),0) balance")->get("credit_balances")->row();
    return $balance->balance;
}
function sendHelperEmail($recipient,$subject,$message){
    $ci=&get_instance();
    // pre($ci->config->item('email'));
    $ci->load->library('email');
    $config=$ci->config->item('email');
    $ci->email->initialize($config);
    $ci->email->from($config['smtp_user'], 'Advin');
    $ci->email->to($recipient);
    $ci->email->subject($subject);
    $ci->email->message($message);

    return $ci->email->send();
}
function filter_string($data){
    if(is_string($data)){
        return $data;
    }
    else{
        return '';
    }
}
function get_notifs(){
    $ci=&get_instance();
    $notifs=$ci->db->order_by('notifdt desc')->limit(20)->get('notifs')->result();
    return $notifs;
}