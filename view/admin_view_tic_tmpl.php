<div class="content">
    <form action="view_all_tic_url">
        <br>
        
    <?php
        foreach($tic as $t)
        {
            echo '<div style="border:5px solid gray;">
                    <label>'.$t->getContent().'</label>
                        <br>
                    <a href="'.  HREF('admin', 'replytic').'"><input type="button" value="Trả lời"/></a>
                  </div>
                  <br>';
                  
        }
    ?>
    </form>
</div>