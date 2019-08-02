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
			<form action="admin_edit" method="post" enctype="multipart/form-data" onsubmit="return validation()">
				{{ csrf_field() }}
			<table class="table table-bordered admin-table">
					<tbody>
						<tr>
							<th class="th-inverse col-sm-3 col-xs-4">ID</th>
							<input type="hidden" name="id" value="{{ $form->id }}">
							<td>{{ $form->id }}</td>
						</tr>
						<tr>
							<th class="th-inverse">タイトル</th>
							<td>
								<input type="text" name="title" class="form-control" id="inputText" value="{{ $form->title }}">
								<p class="alert alert-danger mt10 mb0" id="titleEmpty" style="display:none">タイトルを入力してください。</p>
								<p class="alert alert-danger mt10 mb0" id="titleOver" style="display:none">タイトルは50文字までにしてください。</p>
							</td>
						</tr>
						<tr>
							<th class="th-inverse">本文</th>
							<td>
								<textarea class="form-control" name="text" rows="2" id="textArea">{{ $form->text }}</textarea>
								<p class="alert alert-danger mt10 mb0" id="textOver" style="display:none">本文は500文字までにしてください。</p>
							</td>
						</tr>
						<tr class="tr-img">
							<th class="th-inverse">画像</th>
							<td>
								<div class="row">
									<div class="col-sm-7 img-block">
										<input type="file" name="image" accept=".png,.jpg,.gif" value="参照">
										<p class="alert alert-danger mt10 mb0" id="formatError" style="display:none">画像は.jpg、.gif、.pngのいずれかにしてください。</p>
									</div>
									<div class="col-sm-5 img-block">
										@if($form->image !== '')
										<a href="/storage/img/{{ $form->image }}" target="_blank">
											<img id="imgSrc" src="/storage/img/{{ $form->image }}" alt="" width="60%" align="middle">
										</a>
										<label class="ml10">
											<input type="checkbox" name="imgDel" value="false"> 画像を削除
										</label>
										@endif
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="mb30">
					<button type="button" class="btn btn-default" onclick="location.href='admin_list'">戻る</button>
					<button type="submit" class="btn btn-default" onclick="return confirm('登録します。よろしいですか？');">登録</button>
				</div>
				</form>

			</div>
		</div>
	</div>
	<!-- /container -->
	<script type="text/javascript" language="javascript">
		var image       = [];
		var src         = $('#imgSrc').attr('src');
		var titleEmpty  = $('#titleEmpty')
		var titleOver   = $('#titleOver')
		var textOver    = $('#textOver')
		var formatError = $('#formatError')
		image.push(src);

		$('input[name=imgDel]').on('change', function()
		{
			if ($(this).is(':checked'))
			{
				$(this).attr('value', 'true');
			}
			else
			{
				$(this).attr('value', 'false');
			}

			if ($('input[name=imgDel]').val() === 'true')
			{
				$('#imgSrc').attr('src', "");
			}
			else if ($('input[name=imgDel]').val() === 'false')
			{
				$('#imgSrc').attr('src', image[0]);
			}
		})

		function validation()
		{
			var fileImage  = $('input[type=file]')
			var image      = fileImage.val();
			var imageSlice = image.split(".");
			var extention  = imageSlice[imageSlice.length - 1];
			var hasError   = false;
	
			if (($('#inputText').val().length) > 50)
			{
				titleOver.show();
				hasError = true;
			}

			if (($('#inputText').val()) === "")
			{
				titleEmpty.show();
				hasError = true;
			}

			if (($('#textArea').val().length) > 500)
			{
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