<div class="container">
    <center><h3><?php echo $vote['title'] ?></h3></center>
    <div class="row product" style="margin-top:10px; margin-bottom:10px">
        <div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3">
            <img class="img-circle" style="max-height:50px" src="<?php echo $vote['owneravatar'] ?>"/>
            <span class="tagline">By: <?php echo $vote['ownername'] ?></span>
        </div>	

        <div class="col-md-3 col-sm-3">
        <?php echo form_open("/vote/follow") ?>
                <input type="text" name="voteid" value="<?php echo $vote['id'] ?>" style="display: none">
                <input type="text" name="srcurl" value="/vote/view/<?php echo $vote['id'] ?>" style="display: none">
        <button type="button submit" class="btn btn-success btn-block"
        <?php 
            if ($userid == -1)
                echo "disabled='disabled'";
        ?>
        >
        <?php 
            if ($vote['follow'] == 1)
                echo "取消关注";
            else
                echo "关注投票";
        ?>
        </button>
        <?php echo form_close() ?>
        </div>				
    </div>
	<div class="row product">
   		<?php foreach($vote['options'] as $option): ?>
		<div class="col-md-6 col-sm-6">
			<div class="product-item-vote">
				<div class="product-thumb">
					<img src="<?php echo substr($option['path'], 1) ?>" alt="">
				</div>
            	<div class="product-content">
					<h5><a href="#"><?php echo $option['title'] ?></a></h5>
					<ul class="progress-bars">
                        <li>
                            <div class="progress">
                                <div class="progress-bar comments" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                <span class="comments">6<i class="fa fa-heart"></i></span>
                            </div>
                        </li>
                    </ul>
                    <p><?php echo $option["desc"] ?></p>
                </div>
         	</div>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" value="vote" data-title="<?php echo $vote["title"] ?>" data-imgurl="<?php echo substr($option["path"],1) ?>" data-voteid="<?php echo $vote['id'] ?>" data-optionid="<?php echo $option['id']?>"
                <?php 
                if ($userid == -1 or $vote['participate'] == 1 or $vote['status'] == 0)
                    echo "disabled='disabled'";
                ?>
                >
                <?php
                if ($vote['participate'] == 1)
                    echo "已投票";
                else if ($vote['status'] == 0)
                    echo "已关闭";
                else 
                    echo "投票";
                ?>
            </button>
        </div>
    	<?php endforeach; ?>
	</div>
    <div class="modal fade" id="myModal" tabindex="-1" rol="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel"></h3>
                </div>
                <?php echo form_open("/vote/vote_comment") ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6"><h4>你选择的是：</h4></div>
                        <div class="col-xs-6 col-md-3">
                            <a href="#" class="thumbnail">
                                <img id="modalimg" src="" >
                            </a>
                        </div>
                    </div>
                    <input id="modalvoteid" type="text" name="voteid" value="" style="display: none">
                    <input id="modaloptionid" type="text" name="optionid" value="" style="display: none">
                    <input id="modalsrcurl" type="text" name="srcurl" value="" style="display: none">
                    <textarea class="form-control" rows="3" placeholder="亲，点评一下吧~" name="comment"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button submit" class="btn btn-promary">提交</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <ul class="media-list">
    <?php foreach ($vote['comments'] as $comment): ?>
    <li class="media">
        <div class="media-left">
            <a href="#">
                <img class="media-object" src="<?php echo $comment['owneravatar'] ?>" alt="" style="width: 4em; height:4em; max-width: 100px;" >
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $comment['ownername'] ?></h4>
            <?php echo $comment["content"] ?>
        </div>
    </li>
    <?php endforeach; ?>
    </ul>

</div>
<link rel="stylesheet" href="/css/viewvote.css">
<link rel="stylesheet" href="/css/normalize.min.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/templatemo-misc.css">
<link rel="stylesheet" href="/css/templatemo-style.css">
<script type="text/javascript" src="/js/vote.js"></script>
