<script src="/js/vote.js"></script>
 <div class="container">
    <div class="row">
    	<div class="col-md-12">
			<img src="/img/baymax.jpg" alt="">
		</div>
	</div>
	<hr />
	<?php if(count($votes) != 0): ?>
	<?php foreach($votes as $vote): ?>
	<div class="row product">
		<center><h3><?php echo $vote["title"] ?></h3></center>
		<div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3">
			<img style="max-height:50px" src="/img/defaultavatar.png">
			<span class="tagline">By: User</span>
		</div>
		<div class="col-md-2 col-sm-2">
			<button type="button" class="btn btn-success btn-block">关注此投票</button>
		</div>
	</div>
	<div class="row product">
		<?php foreach($vote["options"] as $option ): ?>
		<div class="col-md-6 col-sm-6">
			<div class="product-item-vote">
				<div class="product-thumb">
					<img src=<?php echo substr($option["path"],1) ?> alt="">
				</div>
				<div class="product-content">
					<h5><a href="#"><?php $option["title"] ?></a></h5>
					<ul class="process-bars">
						<li>
							<div class="process">
								<div class="process-bar" role="processbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="widt: 40%;" ></div>
								<span>4<i class="fa fa-heart"></i></span>
							</div>
						</li>
					</ul>
					<p>选项描述</p>
				</div>
				<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" value="vote" data-title="<?php echo $vote["title"] ?>" data-imgurl="<?php echo substr($option["path"],1) ?>">
				投票
				</button>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
	<div class="modal fade" id="myModal" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title" id="myModalLabel"></h3>
					<h4>你选择的是：<img id="modalimg" class="img-thumbnail" style="max-height:100px" src=""></h4>
				</div>
				<div class="modal-body">

					<textarea class="form-control" rows="3" placeholder="亲，点评一下吧~"></textarea>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-promary">提交</button>
				</div>
			</div>
		</div>
	</div>
</div>
