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
	<script src="{{ URL::asset('js/custom/script.js') }}" type="text/javascript"></script>
</head>
<body class="admin">
	<div class="container">
		<div class="page-header">
			<h1>投稿管理</h1>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<table class="table table-bordered admin-table">
					<thead>
						<tr>
							<th class="col-md-1">ID</th>
							<th class="col-md-2">タイトル</th>
							<th class="col-md-4">本文</th>
							<th class="col-md-2">画像</th>
							<th class="col-md-2">投稿日時 / 変更日時</th>
							<th class="col-md-1">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($posts as $post)
							<tr>
								<td class="">{{ $post->id }}</td>
								<td class="">{{ $post->title }}</td>
								<td class="">{{ $post->text }}</td>

								@if($post->image !== '')
									<td class="text-center"><div class="thumbnail"><img src="/storage/img/{{ $post->image }}" alt=""></div></td>
								@else
									<td class="text-center"></td>
								@endif

								@php
								$registDate     = $post->regist_date;
								$registDateTime = date('Y/m/d H:i', strtotime($registDate));
								$updateDate     = $post->update_date;
								$updateDateTime = date('Y/m/d H:i', strtotime($updateDate));
								@endphp
								
								@if($registDate === $updateDate)
									<td class='text-center'>{{ $registDateTime }}</td>
								@else
									<td class='text-center'>{{ $registDateTime }}<br>{{ $updateDateTime }}</td>
								@endif

								<td class="text-center">
									<input type="button" value="変更" onclick=" location.href='admin_edit?id={{ $post->id }}'"><br>
									<form action="" method="post" onclick="return msgDelete('{{ $post->id }}')">
										{{ csrf_field() }}
										<input type="hidden" name="id" value="{{ $post->id }}">
										<input type="submit" value="削除">
									</form>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<!-- /row -->
		<p class="gotoTopBtn"><a href="#"><img src="{{ URL::asset('./img/btn_pagetop.png') }}" alt="ページの先頭へ"></a></p>
	</div>
	<!-- /container -->
<script type="text/javascript" language="javascript">
function msgDelete(id) {
	// 確認ダイアログを表示
	if(window.confirm("IDが「"+id+"」のデータを削除します。よろしいですか？")){
		// OKボタンを押下した場合
		// location.href = "admin_delete?id="+id;

		// document.getElementById("form").id.value=id;
		// document.getElementById("form").submit();
	}
	else
	{
		return false;
	}
}
</script>
</body>
</html>