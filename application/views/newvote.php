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
			</div>
		</div>
	</hr>
	<div class="row" style="text-align: center">
		<button type="submit" style="margin: auto" class="btn btn-default">Submit</button>
	</div>

	<?php echo form_close() ?>
</div>
</br></br></br>
