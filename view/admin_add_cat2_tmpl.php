<?php
if ($ok) {
    echo '<b style="font-color: blue;">Them thanh cong</b>';
} else {
    echo '<b style="font-color: red;">Them that bai'.$error.'</b>';    
}
?>
<br/>
<a href="<?php echo HREF('admin', 'addcat');?>">Nhap vao day de tro ve trang truoc</a>
