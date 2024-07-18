<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function add($post){
        $salt=uniqid();
        $pass=md5($salt.$post['password'].$salt);
        $username=$post['username'];
        $roleid=$post['roleid'];
        $this->db->insert('users',[
            'username'=>$username.'@advancedindividual.com',
            'name'=>$username,
            'password'=>$pass,
            'roleid'=>$roleid,
            'salt'=>$salt,
            'isactive'=>1
        ]);
        return $this->db->insert_id();
    }
    public function edit($post){
        $username=$post['username'];
        $roleid=$post['roleid'];
        $isactive=$post['isactive'];
        $u_users=[
            'username'=>$username,
            'name'=>$username,
            'roleid'=>$roleid,
            'isactive'=>$isactive
        ];
        if(!empty($post['password'])){
            $salt=uniqid();
            $pass=md5($salt.$post['password'].$salt);
            $u_users['password']=$pass;
            $u_users['salt']=$salt;
        }
        $this->db->where('id',$post['id'])->update('users',$u_users);
        return true;
    }
    public function saveResetToken($userId, $resetToken)
    {
        $data = [
            'reset_token' => $resetToken,
            'reset_token_expires' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        ];
        return $this->db->where('id', $userId)->update('users', $data);
    }
    public function saveEmailResetToken($email, $resetToken)
    {
        $data = [
            'reset_token' => $resetToken
        ];
        return $this->db->where('email', $email)->update('users', $data);
    }

    public function updatePassword($userId, $hashedPassword)
    {
        $data = [
            'password' => $hashedPassword,
            'reset_token' => null,
            'reset_token_expires' => null
        ];
        return $this->db->where('id', $userId)->update('users', $data);
    }
    public function getUserByResetToken($resetToken)
    {
        return $this->db->where('reset_token', $resetToken)
                        ->where('reset_token_expires >=', date('Y-m-d H:i:s'))
                        ->get('users')->row();
    }
    public function getUserByEmailResetToken($resetToken)
    {
        return $this->db->where('reset_token', $resetToken)
                        ->get('users')->row();
    }

}
?>
