<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>画像掲示板（ユーザー画面）</title>
	<!-- BootstrapのCSS読み込み -->
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ URL::asset('css/custom/common.css') }}" type="text/css" rel="stylesheet">
	<link href="{{ URL::asset('css/custom/user.css') }}"   type="text/css" rel="stylesheet">
	<!-- jQuery読み込み -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- BootstrapのJS読み込み -->
	<script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('js/custom/script.js') }}" type="text/javascript"></script>
</head>

<body>
	<div class="container">
		<div class="page-header">
			<h1>画像掲示板</h1>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="well">
					<form class="form-horizontal" action="/post" method="post" enctype="multipart/form-data" onsubmit="return validation()">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-lg-12">

								<!-- 投稿に成功したときだけ表示するよう変更しましょう -->
								@if (Session::has('message'))
									<p class="alert alert-success mb10" role="alert">
										{{ session('message') }}
									</p>
								@endif

								<!-- 入力エラーがあるときだけ表示するよう変更しましょう -->
								<div id="errorBox" class="alert alert-danger mb10" role="alert" style="display:none">
									<p id="titleEmpty" style="display:none">タイトルを入力してください。</p>
									<p id="titleOver" style="display:none">タイトルは50文字以内にしてください。</p>
									<p id="textOver" style="display:none">本文は500文字までにしてください。</p>
									<p id="formatError" style="display:none">画像は.jpg、.gif、.pngのいずれかにしてください。</p>
								</div>

								<label for="title" class="mt10 mb10">タイトル</label>
								<input type="text" class="form-control mb10" id="inputText" name="title">

								<label for="text" class="mt10 mb10">本文</label>
								<textarea class="form-control mb20" rows="2" id="textArea" name="text"></textarea>

								<label for="image" class="mb10">画像</label>
									<input type="file" id="image" name="image">

								<div class="text-center mt20 mb20">
									<input type="submit" class="btn btn-lg btn-primary" value="投稿する">
								</div>
							</div>
						</div>

					</form>
				</div>
				<!-- /well -->
				<div class="posts">
					@foreach($posts as $post)
					<div class="well">
						<div class="row">
							@if($post->image !== '')
							<div class="col-sm-6 mb10">
								<img class="upImg" src="/storage/img/{{ $post->image }}" alt="">
							</div>
							@else
								<div class="col-sm-6 mb10"></div>
							@endif
							<div class="col-sm-6 mb10">
								<h2 class="lead">{{ $post->title }}</h2>
								<p>{{ $post->text }}</p>

							@php
								$registDate     = $post->regist_date;
								$registDateTime = date('Y-m-d H:i', strtotime($registDate));
								echo "<p class='day'>{$registDateTime}</p>";
							@endphp

							</div>
						</div>
					</div>
					@endforeach
				</div>

				{{-- <div class="posts">
					<div class="well">
						<div class="row">
							<div class="col-sm-6 mb10">
								<img class="upImg" src="/storage/img/2.jpg" alt="">
							</div>
							<div class="col-sm-6 mb10">
								<h2 class="lead">投稿タイトル</h2>
								<p>投稿メッセージ</p>
								<p class="day">2017-01-02 02:56</p>
							</div>
						</div>
					</div> --}}
					<!-- /well -->

					{{-- <div class="well">
						<div class="row">
							<div class="col-sm-6 mb10">
								<img class="upImg" src="/storage/img/1.jpg" alt="">
							</div>
							<div class="col-sm-6 mb10">
								<h2 class="lead">四万十川</h2>
								<p>四万十川（しまんとがわ）は、高知県の西部を流れる渡川水系の本川で、一級河川。全長196km、流域面積2186km2。四国内で最長の川で、流域面積も吉野川に次ぎ第2位となっている。</p>
								<p class="day">2017-01-01 12:03</p>
							</div>
						</div>
					</div> --}}
					<!-- /well -->
				{{-- </div> --}}
				<!-- /posts -->

			</div>
		</div>
		<!-- /row -->
		<p class="gotoTopBtn"><a href="#"><img src="{{ URL::asset('./img/btn_pagetop.png') }}" alt="ページの先頭へ"></a></p>
	</div>
	<!-- /container -->
	<script type="text/javascript">
		var errorBox    = $('#errorBox')
		var titleEmpty  = $('#titleEmpty')
		var titleOver   = $('#titleOver')
		var textOver    = $('#textOver')
		var formatError = $('#formatError')

		$(function(){
			if ($('.alert-success').size() > 0) {
				setTimeout(function(){
					$('.alert-success').fadeOut("slow");
				}, 800);
			}
		});

		function validation()
		{
			var fileImage  = $('input[type=file]')
			var image      = fileImage.val();
			var imageSlice = image.split(".");
			var extention  = imageSlice[imageSlice.length - 1];
			var hasError   = false;
	
			if (($('#inputText').val().length) > 50)
			{
				errorBox.show();
				titleOver.show();
				hasError = true;
			}

			if (($('#inputText').val()) === "")
			{
				errorBox.show();
				titleEmpty.show();
				hasError = true;
			}

			if (($('#textArea').val().length) > 500)
			{
				errorBox.show();
				textOver.show();
				hasError = true;
			}

			if ((extention === 'jpg') || (extention === 'jpeg') || (extention === 'png') || (extention === 'gif'))
			{
			}
			else if(image === "")
			{
			}
			else
			{
				errorBox.show();
				formatError.show();
				hasError = true;
			}

			if (hasError === true)
			{
				return false;
			}
		}
	</script>
</body>
</html>