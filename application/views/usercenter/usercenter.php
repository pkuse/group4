<div class="row ">
	<div class ="col-md-3 col-lg-3 col-xs-12 col-sm-3"  style="border:1px solid #ddd;padding-right:0px;padding-left:0px">
		<div align ="center" style="margin: 3em 1em">
		<!-- <img  style="width:50%" id="head" class="img-thumbnail" alt="头像" src="<?php echo $avatar ?>"/> -->
		<img  style="width:50%; border-radius: 50%;"id="head" class="img-thumbnail"alt="" src="<?php echo $avatar ?>"/>
		</div>
		<h4 style="text-align: center"><?php echo $username ?> 的个人主页</h4>
		<p style="text-align: center"><?php echo $userdesc ?></p>
		<hr />
		<ul class="nav nav-list " style="text-align: center ">
		<!-- style="border-top: 1px solid #ddd ;background-color:#ddd" -->
			<li >
				<a href="/index.php/page/userinfo"><p>个人信息</p></a>
			</li>
			<li><a href="/index.php/page/followhistory"><p>关注的投票</p></a></li>	
			<li><a href="/index.php/page/votehistory"><p>参与的投票</p></a></li>
			<li><a href="/index.php/page/publishhistory"><p>发布的投票</p></a></li>
		</ul>
	</div>
	<div class="col-md-9 col-lg-9 hidden-xs col-sm-9">
	<div class="container">
		<h2>个人信息</h2>
		<hr/>
		<a class="hidden-lg hidden-md" href="/index.php/page/phonecenter"><p>返回主页</p></a>
		<table id="baseInf">
			<tr>
				<p style="margin-top:1em">帐号: <?php echo $username ?></p>
			</tr>
			<tr>
				<p style="margin-top:1em">邮箱: <?php echo $useremail ?></p>
			</tr>
			<tr>
				<p style="margin-top:1em">
					<textarea font="微软雅黑" rows="5" cols="60" readonly="readonly" id="description3" placeholder="签名:"><?php echo $userdesc ?></textarea>
                </p>
			</tr>
		</table>
		<p></p>
		<h2>其他信息</h2>
		<hr/>
		<table id="moreInf">
			<tr>
				<p style="margin-top:1em">生日:</p>
			</tr>
			<tr>
				<p style="margin-top:1em">性别:</p>
			</tr>
			<tr>
				<p style="margin-top:1em">所在地:</p>
			</tr>
		</table>
		<form type="input" action="/index.php/page/editprofile" method="get">
			<input style="margin-top:2em" type="submit" value="修改信息">
		</form>
	</div>
</div>
</div>

<br/><br/><br/>
