<?php 

//Tìm kiếm theo các chỉ mục: name, available, price (a->b) , sim, touch, camera, wifi, pro_3g, cat_id
    echo ' 
            <div class ="content">
                <form method="GET" action = "'.  LoadSetting('location').'">
                    <input type="hidden" name="controller" value="ViewProduct"/>
                    <input type="hidden" name="action" value="Filter"/>
                    Mục<select name = "filter_cat">';
    
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
    echo '
            </select>
                    Price from<select name ="filter_price1">
                                <option>0</option>
                                <option selected="selected">50000</option>
                                <option>100000</option>
                                <option>1000000</option>
                                <option>10000000</option>
                            </select>
                    To<select name ="filter_price2">
                                <option>0</option>
                                <option>50000</option>
                                <option>100000</option>
                                <option>1000000</option>
                                <option selected="selected">10000000</option>
                            </select>
                    Sim
                    <select name ="filter_sim">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                    Touch<input type ="checkbox" name ="filter_touch" value="1"/>
                    Camera<input type ="checkbox" name ="filter_camera" value="1"/>
                    Wifi<input type ="checkbox" name ="filter_wifi" value="1"/>
                    3g<input type ="checkbox" name ="filter_3g" value="1"/>
                    <input type ="submit" name ="filter_submit" value ="Tìm"/>
                    <input type="hidden" name="filter_offset" value="'.$filter_offset.'"/> 
                    <input type="hidden" name="filter_limit" value="'.$filter_limit.'"/>';
                    if($filter_offset>0)
                        echo '<a href="'.$filter_url.'&filter_offset='.($filter_offset-$filter_limit).'" style="color: #000">Pre </a>';
                    if(count($products)==10 && !isset($filter_isIndex))
                       
                       // if($filter_nextable == 1)
                            echo '<a href="'.$filter_url.'&filter_offset='.($filter_offset+$filter_limit).'"  style="color: #000">Next</a>';
                    echo '
                </form>
            </div>
        ';
                 
?>
