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
    
    public function AddProduct() {
//        if(!$this->auth->IsStaff()) {
//            return;
//        }
        $this->tmpl->Header('admin');
        $this->tmpl->Content('admin_menu_tmpl.php',
                array('addproduct_url' => HREF('admin', 'addproduct')));
        $this->tmpl->Content('admin_add_product_tmpl.php',
                array('cats' => $this->db->AllCategories()));
        $this->tmpl->Footer();
    }
    
    public function AddProduct2() {
//        if(!$this->auth->IsStaff()) {
//            return;
//        }
        $pro = new Product();
        $pro->setName($_POST['pro_name']);
        $pro->setDescription($_POST['pro_description']);
        $pro->setAvailable($_POST['pro_available']);
        $pro->setPrice($_POST['pro_price']);
        $pro->setSim($_POST['pro_sim']);
        $pro->setCategory($_POST['cat_id']);
        if(isset($_POST['pro_wifi'])) {
            $pro->setWifi(true);
        } else {
            $pro->setWifi(false);
        }
        if(isset($_POST['pro_3g'])) {
            $pro->set3G(true);
        } else {
            $pro->set3G(false);
        }
        if(isset($_POST['pro_touch'])) {
            $pro->setTouch(true);
        } else {
            $pro->setTouch(false);
        }
        if(isset($_POST['pro_camera'])) {
            $pro->setCamera(true);
        } else {
            $pro->setCamera(false);
        }
        
        $allowedExts = array("jpg", "jpeg", "gif", "png");
        $expl = explode(".", $_FILES["file"]["name"]);
        $extension = end($expl);
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "image/pjpeg"))
        && ($_FILES["file"]["size"] < 2000000)
        && in_array($extension, $allowedExts)) {
            $thumb = time().'_'.$_FILES["file"]["name"];
            move_uploaded_file($_FILES["file"]["tmp_name"], LoadSetting('upload_folder').$thumb);
            $pro->setThumb(LoadSetting('location').'upload/'.$thumb);
            echo LoadSetting('location').'upload/'.$thumb;
        }
        var_dump($_FILES['file']);
        if(!$this->db->InsertEntry($pro)) {
            echo $this->db->Error();
        }
    }
    
    public function AddCat() {
        $this->tmpl->Header('Add catergory');
        $data = array('addcat_url' => HREF('admin', 'addcat2'),
            'cats' => $this->db->AllCategories());
        $this->tmpl->Content('admin_add_cat_tmpl.php', $data);
        $this->tmpl->Footer();
    }
    
    public function AddCat2() {
        if(isset($_POST['save_cat'])) {
            if(strlen($_POST['cat_name'])) {
                $cat = new Category();
                $cat->setName($_POST['cat_name']);
                if(!isset($_POST['cat_is_main'])) {
                    $cat->setMain(false);
                    $cat->setParent($_POST['cat_parent']);
                }
                $cat->setMain(true);
                if($this->db->InsertEntry($cat)) {
                    $this->tmpl->Header('Insert thanh cong');
                } else {
                    $this->tmpl->Header('Insert that bai');
                    $this->tmpl->Content('error_tmpl.php',
                            array('error' => $this->db->Error()));
                }
            }
        }
        $this->tmpl->Footer();
    }
}
?>
