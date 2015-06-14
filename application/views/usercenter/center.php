<div class="row ">
	<div class ="col-md-3 col-lg-3 hidden-xs col-sm-3"  style="border:1px solid #ddd;padding-right:0px;padding-left:0px">
		<div align ="center" style="margin: 3em 1em"><img  style="width:50%" id="head" class="img-thumbnail" alt="头像" src="<?php echo $avatar ?>"/></div>
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
