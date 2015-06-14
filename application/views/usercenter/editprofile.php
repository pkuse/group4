<div class="col-md-9 col-lg-9 col-xs-12 col-sm-9">
<div class="container">
    <!--页面的！真正内容~在此-->
    <h2>个人信息修改</h2>
    <hr/>
    <div class="col-md-5">
        
        <h4 style="margin-top:1em">修改头像</h4>
        <?php echo form_open_multipart('page/haha') ?>
        <a href="#"  class="thumbnail">
            <label for="pic1" class="sr-only">修改头像</label>
            <input type="file" name="new_avatar" onchange="javascript:setImagePreview(this,localImag1,preview1);" value="修改头像" required>
            <p style="margin-top:1em"class="help-block">头像预览</p>
            <div id="localImag1" >  
                <img id="preview1" alt="" class="img-thumbnail"/>  
            </div> 
        </a>
        <input type="submit" value="保存头像"/>
        <?php echo form_close() ?>
        <?php echo form_open("page/submit_edit") ?>
        <h4 style="margin-top:2em">修改信息</h4>
        <p style="margin-top:1em">昵称</p>
        <input type="text" name="user_name" pattern="[a-zA-Z0-9_]{5,12}" title="用户名只能是包含字母数字和下划线的5到12位字符串" value="<?php echo $username ?>">
        <p style="margin-top:1em">邮箱</p>
        <input type="email" autocomplete="on" name="user_email" value="<?php echo $useremail ?>"/>
        <p style="margin-top:1em">签名</p>
        <textarea rows="5" cols="60" name="user_desc" placeholder="签名："><?php echo $userdesc ?></textarea>
        <h2>其他信息</h2>
        <p style="margin-top:1em">生日</p>
        <input type="date" name="user_birthday"/>
        <p style="margin-top:1em">地址</p>
        <input type="text" name="location"/>
        <p></p>
        <input type="submit" value="保存修改"/>
        <?php echo form_close() ?>
    </div>
</div>
</div>
</div>
<br/><br/><br/>