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
                    'id'=>$user->id,
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
    public function forgotPassword()
    {
        // echo "AX";exit;
        if (getRequestMethod() == 'post') {
            $username = $this->input->post('username');
            // Validate email
            $user = $this->db->where('username',$username)->get('users')->row();
            if (!$user) {
                $this->session->set_flashdata('error', 'User not found.');
                redirect($this->input->server('HTTP_REFERER'));
            }

            // Generate reset token
            $resetToken = bin2hex(random_bytes(32));
            $resetUrl = site_url('auth/resetPassword/' . $resetToken);

            // Save reset token to the user record
            $this->user_model->saveResetToken($user->id, $resetToken);

            if (sendHelperEmail($user->username,'ADVIN - Password Reset Request',"Click this link to reset your password: <a href=\"$resetUrl\">$resetUrl</a>")) {
                $this->session->set_flashdata('success', 'Password reset link sent to your email.');
            } else {
                $this->session->set_flashdata('error', 'Failed to send password reset email.');
            }

            redirect($this->input->server('HTTP_REFERER'));
        }

        $this->load->view('forgot-password');
    }
    public function resetPassword($resetToken)
    {
        $user = $this->user_model->getUserByResetToken($resetToken);
        if (!$user) {
            $this->session->set_flashdata('error', 'Invalid or expired reset token.');
            redirect('auth/forgotPassword');
        }
        // pre($user);

        // Generate new password
        // $newPassword = bin2hex(random_bytes(4)); // 8 characters
        $newPassword = generateRandomString(8);
        $hashedPassword=md5($user->salt.$newPassword.$user->salt);

        // Update user's password
        $this->user_model->updatePassword($user->id, $hashedPassword);

        if (sendHelperEmail($user->username,"ADVIN - Your New Password","Your new password is: $newPassword")) {
            $this->session->set_flashdata('success', 'New password sent to your email.');
        } else {
            $this->session->set_flashdata('error', 'Failed to send new password email.');
        }

        redirect('auth/signin');
    }
    public function signout(){
        $this->session->unset_userdata('login');
        redirect("auth/signin");
    }

    
}
?>
