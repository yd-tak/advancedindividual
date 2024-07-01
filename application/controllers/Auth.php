<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function signin() {
        $post=$this->input->post();
        $err="";
        $failed=false;
        
        if(isset($post['signin'])){
            try{
                $user=$this->db->select('u.*,ur.name role')->where('u.username',$post['username'])->from('users u')->join('user_roles ur','u.roleid=ur.id')->where('u.isactive',1)->get()->row();
                if($user==null){
                    throw new Exception("User not found");
                }
                $checkpass=md5($user->salt.$post['password'].$user->salt);
                if($checkpass!=$user->password){
                    throw new Exception("User not found / Wrong Password");
                }
                $this->session->set_userdata('login',(object)[
                    'username'=>$user->username,
                    'name'=>$user->name,
                    'role'=>$user->role
                ]);
                redirect('dashboard');
            }
            catch(Exception $e){
                $err=$e->getMessage();
                $failed=true;
            }
            
        }
        
        $this->load->view('signin',['err'=>$err,'failed'=>$failed]);
    }
    public function signout(){
        $this->session->unset_userdata('login');
        redirect("auth/signin");
    }

    
}
?>
