<div class="col-md-9 col-lg-9 col-xs-12 col-sm-9">
	<div class="container">
		<h2>个人信息</h2>
		<hr/>
		<a class="hidden-lg hidden-md" href="/index.php/page/usercenter"><p>返回主页</p></a>
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

