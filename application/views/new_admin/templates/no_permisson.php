<!DOCTYPE html><html>
<head>
	<meta charset="utf-8" />
	<title>لاتملك صلاحيات كافة</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css" />
	<style type="text/css">
	body
	{
		background-color: #fff4f4;
		font: 12px/31px tahoma;
	}
	
	#no_permission
	{
		background-color: #fff;
		border: 2px solid red;
		padding: 15px;
		text-align: center;
		font-size: 15pt;
		margin: 35px 50px; 
		color: #F00;
		border-radius: 3px;
		box-shadow: 0 0px 20px #ccc;
	}
	
	#no_permission img
	{
		margin: 50px;
		height: 350px
	}
	
	a
	{
		font-size: 13pt;
		color: red;
    	font-weight: bold;
	}
	</style>
</head><body>
<div id="no_permission">
	<img src="<?php echo base_url()?>assets/img/admin/warning.png" /> <br />
	 عفواً لاتملك صلاحيات كافية لعرض هذه الصفحة
	 <br />
	<a href="<?php echo  base_url().$this->core_model->admin_dir(); ?>">عودة إلى لوحة التحكم</a> 
</div>
</body></html>