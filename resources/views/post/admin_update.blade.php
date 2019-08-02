<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>画像掲示板（管理画面）</title>
	<!-- BootstrapのCSS読み込み -->
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ URL::asset('css/custom/common.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ URL::asset('css/custom/admin.css') }}"  type="text/css" rel="stylesheet">
	<!-- jQuery読み込み -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- BootstrapのJS読み込み -->
	<script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
</head>
<body class="admin">
	
	<div class="container">
		<div class="page-header">
			<h1>投稿管理</h1>
		</div>
		
		<div class="row">
			<div class="col-lg-12">
				<p class="mb30">登録が完了しました。</p>
				<button type="button" class="btn btn-default" onclick="location.href='admin_list'">戻る</button>
			</div>
		</div>
	</div>
	<!-- /container -->
</body>
</html>