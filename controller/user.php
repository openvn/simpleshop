<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Controller {
    public function Index() {
        
    }
    
    public function Register() {
        $this->tmpl->Header('Dang ky');
        $this->tmpl->Content('form_register_tmpl.php');
        $this->tmpl->Footer();
    }
    
    public function Register2() {
        if(!isset($_POST['Submit'])) {
            $this->tmpl->Header('Dang ky loi');
            $this->tmpl->Content('error_tmpl.php', array('error'=>'khong hop le'));
            $this->tmpl->Footer();
        }
        if($_POST['password'] != $_POST['confirmpassword']){
            $this->tmpl->Header('Dang ky loi');
            $this->tmpl->Content('error_tmpl.php', array('error'=>'2 mat khau khong khop.'));
            $this->tmpl->Footer();
            return;
        }
        $user = new Member();
        $user->setEmail($_POST['email']);
        $user->setPass($_POST['password']);
        $user->setFirstName($_POST['firstname']);
        $user->setAddress($_POST['address']);
        $user->setLastName($_POST['lastname']);
        $user->setPhone($_POST['phone']);
        $user->setAddress($_POST['address']);
        $user->setGender($_POST['gender']);
        if(!$this->db->InsertEntry($user)) {
            $this->tmpl->Header('Dang ky loi');
            $this->tmpl->Content('error_tmpl.php', array('error'=>  $this->db->Error()));
            $this->tmpl->Footer();            
        }
    }
    
    public function ticpost() {
        $this->tmpl->Header('Index');
        $this->tmpl->Content('ticket_post_tmpl.php',
        array('tic_post_url'=>  HREF('user', 'ticpost2')));
        $this->tmpl->Footer();
    }
    
    public function ticpost2(){
       if(isset($_POST['submit'])){
       $tic= new Ticket();
       $tic->setContent($_POST['tic_content']);
       if($this->auth->IsMember()){
           $mem=new Member();
           $memid=$mem->getId();
           $tic->setMember($memid);
       }
       $tic->setType($_POST['tic_type']);
       if($this->db->InsertEntry($tic)) {
                    $this->tmpl->Header('Insert thanh cong');
                } else {
                    $this->tmpl->Header('Insert that bai');
                    $this->tmpl->Content('error_tmpl.php',
                            array('error' => $this->db->Error()));
                }
       }
       if(isset($_POST['cancel']))
       {
           return;
       }
    }
    
    public function Inbox() {
        if(!$this->auth->IsMember()) {
            return;
        }
    }
    
    public function Loggin() {
        $this->tmpl->Header('Loggin');
        $this->tmpl->Content('form_loggin_tmpl.php');
        $this->tmpl->Footer();
    }
    
    public function Loggin2() {
        if($this->auth->MemberVerify($_POST['email'], $_POST['password'])) {
            $this->auth->MemberLoggin($_POST['email'], $_POST['password'], FALSE);
        }
    }
    
    public function Loggout() {
        $_SESSION['mem_logged'] = FALSE;
        $_SESSION['mem_info'] = NULL;
        unset($_SESSION['mem_logged']);
        unset($_SESSION['mem_info']);
    }

    public function Info() {
        $this->tmpl->Header('Info');
        if($this->auth->IsMember()) {
            var_dump($_SESSION['mem_info']);
        }
        $this->tmpl->Footer();
    }
}
?>
