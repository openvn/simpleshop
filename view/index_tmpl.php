<?php
foreach ($products as $key => $val) {
    echo '      <section class="group'.($key%3).'">
        <h1>'.$val->getName().'</h1>
        <img src="'.stripcslashes($val->getThumb()).'" width="51" height="52" alt="icons" class="icons" />
        <p>'.$val->getDescription().'</p>
        <a href="'. HREF('ViewProduct', 'Detail', array('id' => $val->getId()), LoadSetting('url_pretty')).'"><span class="button">Read more</span></a>
      </section>';
}
?>
