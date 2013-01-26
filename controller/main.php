<?php

require_once 'controller.php';

class Main extends Controller {
    public function Index() {
        $this->tmpl->Header('Index');
        $deals = $this->db->RecentDeals(4);
        if($deals) {
            $this->tmpl->Deal($deals);
        }
        $cats = $this->db->AllCategories();
        if($cats) {
            $this->tmpl->Menu($cats);
        }
        $anns = $this->db->RecentAnnouncements(1);
        if($anns) {
            $this->tmpl->Announcement($anns[0]);
        }
        $products = $this->db->RecentProducts(4);
        if($products) {
            $data = array('products' => $products);
            $this->tmpl->Content(Template::$Index, $data);
        }
        $this->tmpl->Footer();
    }
    public function Dog() {
        echo 'dogggggggg!';
    }
    public function Cat() {
        echo 'cqqqqqqqqqqqqqqqqt';
    }
}
?>
