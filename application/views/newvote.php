<div class="container">
	<!--form action="javascript:alert('验证成功,可以提交.');" role="form"-->
	<?php echo form_open_multipart('vote/submit_vote') ?>
		<div class="form-group ">
			<label for="title">发起的投票标题</label>
			<!--input type="text" class="form-control " maxlength="30"  id="title" placeholder="Enter Title" required-->
			<input type='text' name='vote_title' class="form-control" placeholder="Enter Title" maxlength="30" />
		</div>
		<div class="form-group">
			<label for="description">投票的描述</label>
			<textarea class="form-control" rows="5" name="vote_description" placeholder="描述一下您的感受和情形吧" required></textarea>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				
				<div class="form-group">
					<label for="subtitle1">投票的选项1</label>
					<input type="text" class="form-control" name="vote_options_title[]" placeholder="第一个选项是什么呢" required>
				</div>
				<div class="form-group">
					<label for="description1">投票的描述</label>
					<textarea class="form-control" rows="2"  name="vote_options_desc[]" placeholder="描述一下这个选项吧" ></textarea>
				</div>
				<a href="#"  class="thumbnail">
					<label for="pic1" class="sr-only">上传选项1的图片</label>
					<input type="file" name="vote_options_pic_0" onchange="javascript:setImagePreview(this,localImag1,preview1);" required>
					<p class="help-block">上传并预览图片</p>
					<div id="localImag1" >  
						<img id="preview1" alt="" class="img-thumbnail"/>  
					</div> 
				</a>
			</div>
			<div class="form-group col-md-6">
				<div class="form-group">
					<label for="subtitle2">投票的选项2</label>
					<input type="text" class="form-control" name="vote_options_title[]" placeholder="第二个选项是什么呢" required>
				</div>
				<div class="form-group">
					<label for="description2">投票的描述</label>
					<textarea class="form-control" rows="2" name="vote_options_desc[]" placeholder="描述一下这个选项吧"></textarea>
				</div>
				<div class="form-group thumbnail">
					<label for="pic2"class="sr-only">上传选项2的图片</label>
					<input type="file" name="vote_options_pic_1" onchange="javascript:setImagePreview(this,localImag2,preview2);" required>
					<p class="help-block">上传并预览图片</p>
					<div id="localImag2" >
						<img id="preview2" class="img-thumbnail"alt="" />
					</div>
				</div>
				<a href="#icon3"  class="btn btn-default  col-offset-xs-6 col-xs-6" id="more3">我还想要选项3</a>
			</div>
		</div>
		<div class="row">
			<div id="icon3" class="form-group col-md-6" style="display:none">
				<div class="form-group">
					<label for="subtitle3">投票的选项3</label>
					<input type="text" class="form-control" name="vote_options_title[]" id="title" placeholder="第三个选项是什么呢" required>
				</div>
				<div class="form-group">
					<label for="description3">投票的描述</label>
					<textarea class="form-control" rows="2" name="vote_options_desc[]" id="description3" placeholder="描述一下这个选项吧"></textarea>
				</div>
				<a href="#icon3" class="thumbnail">
					<label for="pic3"class="sr-only">上传选项3的图片</label>
					<input type="file" name="vote_options_pic_2" id="pic3" onchange="javascript:setImagePreview(this,localImag3,preview3);" required>
					<p class="help-block">上传并预览图片</p>
					<div id="localImag3" >  
						<img id="preview3" class="img-thumbnail"alt="" />  
					</div> 
				</a>
				<a href="#icon2" class="btn btn-default col-xs-6" id="no3">我不要选项3了</a>
				<a href="#icon4" class="btn btn-default col-xs-6" id="more4">我还想要选项4</a>
			</div>
			<div id="icon4" class="form-group col-md-6" style="display:none">
				<div class="form-group">
					<label for="subtitle4">投票的选项4</label>
					<input type="text" class="form-control" id="title" name="vote_options_title[]" placeholder="第四个选项是什么呢" required>
				</div>
				<div class="form-group">
					<label for="description4">投票的描述</label>
					<textarea class="form-control" rows="2" name="vote_options_desc[]" id="description4" placeholder="描述一下这个选项吧"></textarea>
				</div>
				<a href="#icon4" class="thumbnail">
					<label for="pic4" class="sr-only">上传选项4的图片</label>
					<input type="file" name="vote_options_pic_3" id="pic4" onchange="javascript:setImagePreview(this,localImag4,preview4);" required>
					<p class="help-block">上传并预览图片</p>
					<div id="localImag4" >  
						<img id="preview4" class="img-thumbnail"alt="" />  
					</div> 
				</a>
				<a href="#icon3" class="btn btn-default col-xs-6" id="no4">我不要选项4了</a>
			</div>
		</div>
		<hr />
		<div class="row" style="text-align: center">
			<button type="submit" style="margin: auto" class="btn btn-primary">Submit</button>
		</div>
	<?php echo form_close() ?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#no3").click(function(){
			$("#icon3").toggle(400);
			$("#more3").toggle();
		});
	});
	$(document).ready(function(){
		$("#no4").click(function(){
			$("#icon4").toggle(400);
			$("#more4").toggle();
			$("#no3").toggle();
		});
	});
	$(document).ready(function(){
		$("#more3").click(function(){
			$("#icon3").toggle(400);
			$("#more3").toggle();
		});
	});
	$(document).ready(function(){
		$("#more4").click(function(){
			$("#icon4").toggle(400);
			$("#more4").toggle();
			$("#no3").toggle();
		});
	});
</script>
