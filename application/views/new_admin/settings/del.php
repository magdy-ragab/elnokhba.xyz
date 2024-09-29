<div class="panel panel-danger">
	<div class="panel-heading">
		<h4 class="panel-title">الحذف</h4>
	</div>
	<div class="panel-body">
	<?php 
	if($del==0){
		echo '<p class="text-danger">عفواً .... لم يتم الحذف  
		<a class="btn btn-primary btn-xs" href="'.$admin_dir.'/news/view/">عودة</a></p>';
	}else{
		echo '<p class="text-success">تم الحذف برجاء اﻹنتظار</p>';
	}
	echo '<script>setTimeout(function(){location.href="'.$admin_dir.'/news/view/";},5000);</script>';?>
	</div>
</div>