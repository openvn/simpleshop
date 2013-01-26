<div class="content">
    <form method="POST" action="<?php echo $addcat_url;?>">
        Ten: <input type="text" name="cat_name"/>
        Chinh : <input type="checkbox" id="checkbox" name="cat_is_main" onchange="Toogle();"/>
            <select id="select" name="cat_parent">
<?php
foreach ($cats as $key => $cat) {
    if($cat->getMain()) {
        unset($cats[$key]);
        echo '  <option value="'.$cat->getId().'">'.$cat->getName().'</option>';
    }
}
?>
            </select>
        <input type="submit" name="save_cat" value="Save"/>
    </form>
</div>
<script type="text/javascript">
    function Toogle() {
        if(document.getElementById('checkbox').checked) {
            document.getElementById('select').style.visibility = 'hidden';
        } else {
            document.getElementById('select').style.visibility = 'visible';
        }
    }
</script>id