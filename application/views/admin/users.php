<html>
<head>
	<title>管理员操作</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
	<script src="/js/jquery-1.9.1.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">

			<div class="navbar-header">
				<a class="navbar-brand" href="/index.php/admin/users">管理员控制台</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/index.php/admin/users">账户</a></li>
					<li><a href="/index.php/admin/votes">投票</a></li>
					<li><a href="/index.php/admin/comments">评论</a></li>
					<li><a href="/index.php/admin/logout">Logout</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container">
		<h3>所有账户</h3>
		<table class="table table-bordered">
			<thead>
				<th>UserID</th>
				<th>Name</th>
				<th>Email</th>
				<th>操作</th>
			</thead>
			<tbody>

				<?php foreach($users as $user): ?>
					<tr>
				<td><?php echo $user->ID ?></td>
				<td><?php echo $user->Name ?></td>
				<td><?php echo $user->Email ?></td>
				<td><a href="/index.php/admin/delete_user/?user_id=<?php echo $user->ID ?>">删除</a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</body>
</html>