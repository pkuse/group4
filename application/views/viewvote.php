<div class="container">
    <center><h3><?php echo $vote['title'] ?></h3></center>
    <div class="row product" style="margin-top:10px; margin-bottom:10px">
        <div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3">
            <img class="img-circle" style="max-height:50px" src="<?php echo $vote['owneravatar'] ?>"/>
            <span class="tagline">By: <?php echo $vote['ownername'] ?></span>
        </div>			
        <div class="col-md-3 col-sm-3"><button type="button" class="btn btn-success btn-block">关注此投票</button></div>				
    </div>
	<div class="row product">
   		<?php foreach($vote['options'] as $option): ?>
		<div class="col-md-6 col-sm-6">
			<div class="product-item-vote">
				<div class="product-thumb">
					<img src="<?php echo substr($option['image'], 1) ?>" alt="">
				</div>
            	<div class="product-content">
					<h5><a href="#"><?php echo $option['title'] ?></a></h5>
					<ul class="progess-bars">
                                <li>
                                    <div class="progress">
                                        <div class="progress-bar comments" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                        <span class="comments">6<i class="fa fa-heart"></i></span>
                                    </div>
                                </li>
                    </ul>
					<ul class="progess-bars">
                        <li>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                                <span>4<i class="fa fa-heart"></i></span>
                            </div>
                        </li>                               
                    </ul>
                    <ul class="progess-bars">
                    	<li>
                        	<div class="progress">
                            	<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 50"></div>
                                <span>5<i class="fa fa-heart"></i></span>
                            </div>
                        </li>                               
                    </ul>
					<ul class="progess-bars">
                    	<li>
                        	<div class="progress">
                            	<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 50"></div>
                                <span>5<i class="fa fa-heart"></i></span>
                            </div>
                        </li>                               
                    </ul>
					<ul class="progess-bars">
                    	<li>
                        	<div class="progress">
                            	<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 50"></div>
                                <span>5<i class="fa fa-heart"></i></span>
                            </div>
                        </li>                               
                    </ul>
                    <p><?php echo $option["desc"] ?></p>
                </div>
         	</div>
            <input type="button" class="btn btn-primary btn-lg" value"投票">
        </div>
    	<?php endforeach; ?>
	</div>
    
	<div class="row review">
        <div id="others" class="col-md-12 col-sm-12 panel panel-info">
            <div class="panel-heading">用户评论</div>
            <div class="panel-body">
                <p id="comment"></p>
                <button onclick="morecomment()">更多评论</button>
            </div>
        </div>

        <div id="commentPost" class="col-md-12 col-sm-12 panel panel-info">
            <div class="panel-heading">发表评论</div>
            <div class="panel-body">
                <textarea class="Input_text">说些什么吧...</textarea>       
                <div class="Input_Foot"> 
                    <button class="postBtn">确定</button></br> 
                </div>
            </div>   
        </div>
    </div>
</div>
<link rel="stylesheet" href="/css/viewvote.css">
<link rel="stylesheet" href="/css/normalize.min.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/animate.css">
<link rel="stylesheet" href="/css/templatemo-misc.css">
<link rel="stylesheet" href="/css/templatemo-style.css">

