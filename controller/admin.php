<?php

class Admin extends Controller {
    public function Index() {
        if(!$this->auth->IsStaff())
            echo 'logout';
        var_dump($_SESSION['staff_info']);
    }
    
    public function Loggin() {
        $this->tmpl->Header('Staff Loggin');
        $data = array('url' => HREF('admin', 'loggin2', NULL, LoadSetting('url_pretty')));
        $this->tmpl->Content(Template::$LogginForm, $data);
        $this->tmpl->Footer();
    }
    
    public function Loggin2() {
        $ok = $this->auth->StaffLoggin($_POST['email'], $_POST['password'], FALSE);
        if($ok) {
            $this->tmpl->Header('Loggin success!');
            echo 'ok';
        } else {
            $this->tmpl->Header('Loggin Fail!');
            echo 'Loggin Fail!';
        }
        $this->tmpl->Footer();
    }

        public function AddStaff() {
        $staff = new Staff();
        $staff->setAddress('123 viet nam');
        $staff->setBirth(new DateTime('2000-01-01'));
        $staff->setEmail('admin@admin.com');
        $staff->setFirstName('tom');
        $staff->setGender(true);
        $staff->setKind(1);
        $staff->setLastName('Criuse');
        $staff->setPass('1234567890');
        $staff->setPhone('0909090909');
        if($this->db->InsertEntry($staff))
            echo 'ok';
    }
}
?>
