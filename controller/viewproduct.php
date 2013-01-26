<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ViewProduct extends Controller {
    public function Index() {
        $this->tmpl->Header('Product');
        
        $product = $this->db->RecentProducts(9);
        
        $cats = $this->db->AllCategories();
        $data = array('products' => $product, 'newvar' => 'aaaaasdsddssa',
                'cats' => $cats,
                'filter_url' => HREF('ViewProduct', 'Filter'),
                'filter_offset' => 0,
                'filter_limit' => 9,
                'filter_isIndex' => 0);
        $this->tmpl->Content('form_filter_tmpl.php', $data);  
        if ($product) {
            $this->tmpl->Content(Template::$Index, $data);        
        }
        $this->tmpl->Footer();
    }
    
    public function Filter() {
        $this->tmpl->Header('Product');
        $filter_price1 = 0; 
        $filter_price2 = 0; 
        $filter_cat_id = 7;
        $filter_sim = 0; 
        $filter_touch = 0; 
        $filter_wifi =0; 
        $filter_3g = 0;
        $filter_camera = 0; 
        $offset = 0; 
        $limit = 9;
        
        
        if(isset($_GET['filter_price1'])) $filter_price1   = $_GET['filter_price1'];
        if(isset($_GET['filter_price2'])) $filter_price2   = $_GET['filter_price2'];
        if(isset($_GET['filter_cat'])) $filter_cat_id   = $_GET['filter_cat'];
        if(isset($_GET['filter_sim'])) $filter_sim = $_GET['filter_sim'];
        if(isset($_GET['filter_touch'])) $filter_touch = $_GET['filter_touch'];
        if(isset($_GET['filter_wifi'])) $filter_wifi = $_GET['filter_wifi'];
        if(isset($_GET['filter_3g'])) $filter_3g = $_GET['filter_3g'];
        if(isset($_GET['filter_camera'])) $filter_camera = $_GET['filter_camera'];
        if(isset($_GET['filter_limit'])) $limit = $_GET['filter_limit'];
        if(!isset($_GET['filter_submit'])) {
            $offset = $_GET['filter_offset'];
        }
        
        $product = $this->db->ProductsFilter($filter_price1, $filter_price2, $filter_sim, $filter_touch, 
                $filter_camera, $filter_wifi, $filter_3g, $filter_cat_id ,$offset, $limit);
        
        $cats = $this->db->AllCategories();
        
        $query = array('$filter_price1' => $filter_price1, 
            'filter_price2' => $filter_price2, 
            'filter_sim' => $filter_sim, 
            'filter_touch' => $filter_touch, 
            'filter_camera' => $filter_camera, 
            'filter_wifi' => $filter_wifi, 
            'filter_3g' => $filter_3g, 
            'filter_cat_id' => $filter_cat_id, 
            'filter_limit' => $limit);
        $data = array('products' => $product, 
            'cats' => $cats,
            'filter_url' => HREF('ViewProduct', 'Filter', $query), 
            'filter_offset' => $offset,
            'filter_limit' => $limit);
        
        $this->tmpl->Content('form_filter_tmpl.php', $data);  
        
        if ($product) {
            $data = array('products' => $product, 
                'cats' => $cats,
                'filter_url' => HREF('ViewProduct', 'Filter', $query),
                'filter_offset' => $offset,
                'filter_limit' => $limit);
             $this->tmpl->Content(Template::$Index, $data); 
        }
        
        $this->tmpl->Footer();
    }
    
    public function Detail() {
        
    }
}
?>