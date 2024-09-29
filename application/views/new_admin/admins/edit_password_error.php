<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	</div>
</div>

<input type="hidden" name="word" value="<?php echo $cap['word']?>" />
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">تعديل كلمة المرور  </h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid text-center">
			عفواً لا يوجد مشرف/مدير بهذا الرقم !!
		</div>
	</div>
	
</div>