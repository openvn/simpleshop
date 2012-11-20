<?php

class Template {

    static $Index = 'index_tmpl.php';
    static $Contact = 'contact_tmpl.php';
    static $AuthRegister = 'auth_reg_tmpl.php';
    static $AuthLoggin = 'auth_loggin_tmpl.php';
    static $Cart = 'cart_tmpl.php';
    static $CheckOut = 'order_create_tmpl.php';
    static $OrderStatus = 'order_stt_tmpl.php';
    //admin function page template
    static $ProductList = 'pro_list_tmpl.php';
    static $ProductDetail = 'pro_detail_tmpl.php';
    static $OrderList = 'order_list_tmpl.php';
    static $OrderDetail = 'order_detail_tmpl.php';
    static $MemberList = 'mem_list_tmpl.php';
    static $MemberDetail = 'mem_detail_tmpl.php';
    static $CategoryList = 'cat_list_tmpl.php';
    static $CategoryDetail = 'cat_detail_tmpl.php';
    static $DealList = 'deal_list_tmpl.php';
    static $DealDetail = 'deal_detail_tmpl.php';
    static $TicketList = 'ticket_list_tmpl.php';
    static $TicketDetail = 'ticket_detail_tmpl.php';

    public function Header($title) {
        echo '<!doctype html>  
<head>
  <meta charset="UTF-8" />
  <title>'. $title .'</title>
  <link rel="icon" href="images/favicon.gif" type="image/x-icon" />
  <!--[if lt IE 9]>
  <script src="js/html5.js"></script>
  <![endif]-->
  <link rel="shortcut icon" href="images/favicon.gif" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" type="text/css" href="css/menu.css" />
  <script src="js/jquery.min.js"></script>
  <script src="js/slides.min.jquery.js"></script>
  <script>
    $(function(){
    	$("#slides").slides({
    		preload: true,
    		preloadImage: "images/loading.gif",
    		play: 5000,
    		pause: 2500,
    		hoverPause: true
    	});
    });
  </script>
</head>
<body>
  <!--start container-->
  <div id="container">
    <!--start header-->
    <header>
      <!--start logo-->
      <a href="#" id="logo"><img src="images/logo.png" width="221" height="130" alt="logo" /></a>    
      <!--end logo-->
      <!--start nav bar-->
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Contact</a></li>
          '. $this->LoginBar() .'
        </ul>
      </nav>
      <!--end nav bar-->
      <!--end header-->
    </header>';
    }

    public function Footer() {
        echo '  </div>
            <!--end container-->
            <!--start footer-->
	<footer>
    <div class="container">
      <section class="footer_left">
        <h3>Contact information:
          <span>Lorem ipsum dolor sit amet</span>
          <span>Lorem ipsum dolor sit amet</span>
        </h3>
      </section>
      <section class="footer_left">
        <h3>Website:
          <span>Lorem ipsum dolor sit amet</span>
          <span>Lorem ipsum dolor sit amet</span>
        </h3>
      </section>
      <aside class="footer_left">
        <h3>Lorem ipsum:
          <span>Lorem ipsum dolor sit amet</span>
          <span>Lorem ipsum dolor sit amet</span>
        </h3>
      </aside>
      <img src="images/contact-us.png" width="240" height="230" alt="contact" class="picture_footer" />
      <div id="FooterTwo"> © 2011 Online solutions </div>
      <div id="FooterTree"> Valid html5 / design and code by <a href="http://www.marijazaric.com">marija zaric - creative simplicity</a> </div>
    </div>
  </footer>
  <!--end footer-->
  <!-- Free template distributed by http://freehtml5templates.com -->  
</body>
</html>';
    }
    
    /**
     * 
     * @param Category[] $cats
     */
    public function Menu($cats) {
        echo '    <!--start menu-->
    <div id="cssmenu">
      <ul>';
        $current_cat = 0;
        if(isset($_GET['cat'])) {
            $current_cat = $_GET['cat'];
        }
        foreach ($cats as $key => $cat) {
            if($cat->getMain()) {
                echo '<li class="has-sub'.($cat->getId() == $current_cat ? ' active' : '').'"><a href="index.html"><span>'.
                        $cat->getName() .'Home</span></a><ul>';
                unset($cats[$key]);
                foreach ($cats as $k => $v) {
                    if($v->getParent() == $cat->getId()) {
                        echo '<li><a href="#"><span>'.
                                $v->getName().'Product 1</span></a></li>';
                        unset($cats[$k]);
                    }
                }
                echo '</ul></li>';
            }
        }
        echo '      </ul>
    </div>
    <!--end menu-->';
    }
    /**
     * 
     * @param Announcement $ann
     */
    public function Announcement(Announcement $ann) {
        echo '    <!--start holder-->
    <div class="holder_content1">
      <section class="group3">
        <h1>Latest news</h1>
        <img src="images/icon3.png" width="51" height="52" alt="icons" class="icons" />
        <article>
          <h2>'. $ann->getDescription().'</h2>
          <p>'. $ann->getContent().'</p>
        </article>
      </section>
    </div>
    <!--end holder-->';
    }

    /**
     * 
     * @param Deal[] $deals
     */
    public function Deal($deals) {
        echo '    <!--start intro-->
    <section id="intro">
      <div id="slides">
        <div class="slides_container">';
        foreach ($deals as $deal) {
            echo '<img src="' . $deal->getBanner() .'" width="960" height="300" alt="baner" />';
        }
        echo '        </div>
      </div>
    </section>
    <!--end intro-->';
    }

    public function LoginBar() {
        if(isset($_SESSION['mem_email']) && isset($_SERVER['mem_id'])) {
            return '<li><a href="' .HREF('profile', 'index',NULL,
                    LoadSetting('url_pretty')) . '">'.$_SESSION['mem_email'].'</a></li>';
        }
        return '<li><a href="' .HREF('auth', 'loggin', NULL,
                LoadSetting('url_pretty')) . '">Loggin</a></li>';;
    }
    /**
     * 
     * @param string $view
     * @param array $data
     */
    function Content($view, $data = NULL) {
        if(!is_null($data) && count($data) > 0) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        include $view;
    }
    function NotFound() {
        echo '404 Not Found.';
    }
}

?>
