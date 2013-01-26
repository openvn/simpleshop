<div class="content">
    <form method="POST" action="<?php echo $tic_post_url?>">
        Loại yêu cầu:
        <select size="1" id="tic_type" name="tic_type">
            <option value="1">Yêu cầu chung</option>
            <option value="2">Yêu cầu thanh toán</option>
            <option value="3">Yêu cầu tư vấn, hỗ trợ</option>
            <option value="4">Phàn nàn</option>
        </select>
        </br>
        Type your comment here:
        </br>
        <textarea rows="5" cols="50" name="tic_content">
        </textarea>
        </br>
        <input type="submit" name="submit" style="width:80px" value="Post"></input>
        <input type="button" name="cancel" style="width:80px" value="Cancel"></input>
    </form>
</div>