<script src="/js/vote.js"></script>
<div class="index-banner">
    <img src="/img/baymax.jpg" />
</div>
 <div class="container">
	<?php if(count($votes) != 0): ?>
	<?php foreach($votes as $vote): ?>
    <figure class="index-vote">
        <div class="row title-bar">
            <div class="col-xs-10">
                <h3><?php echo $vote["title"] ?></h3>
            </div>
            <div class="col-xs-2">
                <button type="button" class="btn btn-success btn-block"><span class="glyphicon glyphicon-star"></span> 关注此投票</button>
            </div>
        </div>
        <div class="row author">
            <div class="col-xs-12">
                <img class="avatar" src="/img/defaultavatar.png" />
                <span class="tagline">发起者：User</span>
            </div>
        </div>
        <div class="row product">
            <table>
            <?php foreach($vote["options"] as $option ): ?>
                <td>
                    <div class="product-item-vote">
                        <div class="vote-img" style="height: <?= 60 / count($vote["options"]) ?>vw; width: <?= 60 / count($vote["options"]) ?>vw; background-image: url('<?php echo substr($option["path"],1) ?>')"></div>
                        <div class="product-content vote-meter">
                            <span class="vote-meter-fill" style="width: 40%"></span>
                            <h5><a href="#"><?php $option["title"] ?></a></h5>
                            <p>选项描述</p>
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" value="vote" data-title="<?php echo $vote["title"] ?>" data-imgurl="<?php echo substr($option["path"],1) ?>">
                                投票
                            </button>
                        </div>
                    </div>
                </td>
            <?php endforeach; ?>
            </table>
        </div>
    </figure>
	<?php endforeach; ?>
	<?php endif; ?>
	<div class="modal fade" id="myModal" tabindex="-1" rel="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
