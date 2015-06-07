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
		<?php foreach($vote["options"] as $option ): ?>
		<div class="col-md-6 col-sm-6">
			<div class="product-item-vote">
				<div class="product-thumb">
					<img src=<?php echo substr($option["path"],1) ?> alt="">
				</div>
				<div class="product-content">
					<h5><a href="#"><?php $option["title"] ?></a></h5>
					<span class="tagline"><?php $vote["ownername"] ?></span>
					<ul class="process-bars">
						<li>
							<div class="process">
								<div class="process-bar" role="processbar" aria-valuenow=<?php echo $option["support"]/100 ?> aria-valuemin="0" aria-valuemax="100" style="widt: 40%;" ></div>
								<span><?php echo $option["support"] ?><i class="fa fa-heart"></i></span>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endforeach; ?>
	<?php endif; ?>
</div>
