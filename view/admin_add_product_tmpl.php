<div class="content">
    <form action="<?php echo HREF('admin', 'addproduct2');?>" method="POST" enctype="multipart/form-data">
        <div>
            <label for="pro_name_id">Ten san pham:</label>
            <input type="text" name="pro_name" id="pro_name_id"/>
        </div>
        <div>
            <label for="pro_description_id">Mo ta san pham:</label>
            <input type="text" name="pro_description" id="pro_description_id"/>
        </div>
        <div>
            <label for="pro_available_id">So luong hien co:</label>
            <input type="text" name="pro_available" id="pro_available_id"/>
        </div>
        <div>
            <label for="pro_price_id">Don gia:</label>
            <input type="text" name="pro_price" id="pro_price_id"/>VND
        </div>
        <div>
            <label for="pro_sim_id">Nhieu SIM:</label>
            <select id="pro_sim_id" name="pro_sim">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>            
        </div>
        <div>
            <label for="pro_touch_id">Man hinh cam ung:</label>
            <input type="checkbox" name="pro_touch" id="pro_touch_id" value="1"/>
        </div>
        <div>
            <label for="pro_camera_id">Carema:</label>
            <input type="checkbox" name="pro_camera" id="pro_camera_id" value="1"/>
        </div>
        <div>
            <label for="pro_wifi_id">Wifi:</label>
            <input type="checkbox" name="pro_wifi" id="pro_wifi_id" value="1"/>
        </div>
        <div>
            <label for="pro_3g_id">3G:</label>
            <input type="checkbox" name="pro_3g" id="pro_3g_id" value="1"/>
        </div>
        <div>
            <label for="cat1">Loai:</label>
            <select id="cat1" name="cat_id">
<?php
foreach ($cats as $key => $cat) {
    if($cat->getMain()) {
        unset($cats[$key]);
        echo '<optgroup label="'.$cat->getName().'">';
        foreach ($cats as $c) {
            if($c->getParent() == $cat->getId())
                echo '  <option value="'.$c->getId().'">'.$c->getName().'</option>';
        }
        echo '</optgroup>';
    }
}
?>
            </select>
        </div>
        <div>
            <label for="thumb">Hinh dai dien:</label>
            <input type="file" name="file" id="thumb"/>
        </div>
        <input type="submit" value="Submit"/>
    </form>
</div>