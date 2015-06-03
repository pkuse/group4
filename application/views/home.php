 <div class="container">
    <div class="row">
    	<div class="col-md-12">
			<img src="/img/baymax.jpg" alt="">
		</div>
	</div>
	<hr />
	<?php foreach($votes as $vote): ?>
	<div class="row product">
		<center><h3><?php echo $vote->title ?></h3></center>
		<?php foreach($vote->items as $item ): ?>
		<div class="col-md-6 col-sm-6">
			<div class="product-item-vote">
				<h5><a href="#"><?php $item->name ?></a></h5>
				<span class="tagline"><?php $vote->owner ?></span>
				<ul class="process-bars">
					<div class="process">
						<div class="process-bar" role="processbar" aria-valuenow=<?php echo $item->supporters/$vote->participant ?> aria-valuemin="0" aria-valuemax="100" style="widt: 40%;" ></div>
						<span><?php echo $item->supporters ?><i class="fa fa-heart"></span>
					</div>
				</ul>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php endforeach; ?>
</div>
