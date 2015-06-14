<div class="col-md-9 col-lg-9 col-xs-12 col-sm-9">
	<div class="container">
		<h2>参与的投票</h2>
		<hr/>
		<a class="hidden-lg hidden-md" href="/index.php/page/phonecenter"><p>返回主页</p></a>
<div class="row">
	<?php $i = 0 ?>
	<?php foreach ($votes as $vote): ?>
		<?php $i++ ?>
		<div class="col-md-3">
			<div class="thumbnail">
				<div class="carousel slide" id=<?php echo "carousel-".$i ?>>
					<ol class="carousel-indicators">
						<?php $option_count = count($vote["options"]) ?>
						<?php for ($k = 0; $k < $option_count; $k++): ?>
						<?php if ($k == 0): ?>
							<li class="active" data-slide-to=<?php echo $k ?> data-target=<?php echo "#carousel-".$i ?>></li>
						<?php else: ?>
							<li data-slide-to=<?php echo $k ?> data-target=<?php echo "#carousel-".$i ?>></li>
						<?php endif ?>
						<?php endfor ?>
					</ol>
					<div class="carousel-inner">
						<?php $j = 0 ?>
						<?php foreach ($vote["options"] as $option): ?>
							<?php $j++ ?>
							<?php if ($j == 1): ?>
								<div class="item active">
									<img alt="Options" src=<?php echo substr($option["path"], 1) ?> />
									<div class="carousel-caption">
										<p></p>
									</div>
								</div>
							<?php else: ?>
								<div class="item">
									<img alt="Options" src=<?php echo substr($option["path"], 1) ?> />
									<div class="carousel-caption">
										<p></p>
									</div>
								</div>
							<?php endif ?>
						<?php endforeach ?>
					</div>
					<a class="left carousel-control" href=<?php echo "#carousel-".$i ?> data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a> 
					<a class="right carousel-control" href=<?php echo "#carousel-".$i ?> data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
				<div class="caption">
					<h3><a href="/index.php/vote/view/<?php echo $vote["id"]?>"><?php echo $vote["title"] ?></a></h3>
					<p class="desc">描述：<?php echo $vote["desc"] ?></p>
					<p style="font-size:80%">
						<span class="glyphicon glyphicon-user"></span>
						<?php echo $vote['part_num'] ?>&nbsp
						<span class="glyphicon glyphicon-comment"></span>
						<?php echo $vote['comment_num'] ?>&nbsp
						<span class="glyphicon glyphicon-star"></span>
						<?php echo $vote['follow_num'] ?>&nbsp
                    </p>
					<p style="color:#3366CC; font-size:80%">我投给了选项<?php echo $vote['record']['option'] ?></p>
					<?php if ($vote['record']['comment'] != NULL): ?>
					<p style="color:#3366CC; font-size:80%">我的评论：<?php echo $vote['record']['comment'] ?></p>
					<?php endif ?>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
</div>
</div>
</div>
<br/><br/><br/>






