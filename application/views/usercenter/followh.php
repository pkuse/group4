<div class="col-md-9 col-lg-9 col-xs-12 col-sm-9">
	<div class="container">
		<h2>关注的投票</h2>
		<hr/>
		<a class="hidden-lg hidden-md" href="/index.php/page/phonecenter"><p>返回主页</p></a>
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
				<div class="caption" style="height:200px">
					<h3><a href=""><?php echo $vote["title"] ?></a></h3>
					<p>描述：<?php echo $vote["desc"] ?></p>
					<p style="font-size:80%">
						<span class="glyphicon glyphicon-user"></span>
						125&nbsp
						<span class="glyphicon glyphicon-comment"></span>
						36&nbsp
						<span class="glyphicon glyphicon-star"></span>
						57&nbsp
                    </p>
                    <a href="#">取消关注</a>
				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
</div>
</div>
</div>
<br/><br/><br/>






