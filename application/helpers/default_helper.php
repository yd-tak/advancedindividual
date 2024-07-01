<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
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
    $CI = get_instance();
    if(!empty($datas)){

        $ib_newdata=[];
        foreach($datas as $data){
            $newdata=$defaultrow;
            $newdata[$colname]=$data;
            $ib_newdata[]=$newdata;
        }
        // pre($ib_newdata);
        $CI->db->insert_batch($tblname,$ib_newdata);
        $inserted=$CI->db->where_in($colname,$datas)->get($tblname)->result();
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
    $CI = get_instance();
    return $CI->company_model->get($param);
}
function getsetting($param=null){
    $CI = get_instance();
    return $CI->setting_model->get($param);
}
function calc_netscore($score,$aisuspect,$penalty){
    $netscore=(1-($aisuspect*$penalty/10))*$score;
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