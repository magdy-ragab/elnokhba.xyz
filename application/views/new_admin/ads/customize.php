<?php $cont=$this->router->fetch_class();?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-10">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>/admin_index">الرئيسية</a></li>
			<li>الإعلانات</li>
		</ul>
	</div>
	<div class="col-md-2 hidden-xs">
		<a href="#" role="button" class="btn btn-primary btn-block" class="dropdown-toggle" data-toggle="dropdown">الإعلانات <span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li class="disabled"><a href="<?php echo "{$admin_dir}/{$cont}/add";?>" class="disabled">اضافة إعلان</a></li>
			<li><a href="<?php echo "{$admin_dir}/{$cont}/view";?>">عرض الإعلانات</a></li>
		</ul>
	</div>
</div>

<?php 
echo form_open_multipart( $this->core_model->admin_dir()."/".$cont."/customize");
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">تخصيص إعلان</h4>
	</div>
	<div class="panel-body">
		<div class="container-fluid">
			<?php
			if(validation_errors())
			{
				echo '<div class="alert alert-danger fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>'.
				validation_errors() . '</div>';
				
			}
			
			if($inserted)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تخصيص الإعلانات
				</div>';
			}
			if($updated)
			{
				echo '<div class="alert alert-success fade in">
				<a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>
				تم تعديل الإعلان </div>';
			}
			?>
		    <div class="table-responsive">
			<table class="spacing">
			    <tbody>
				<tr>
				    <td class="emtpycell">&nbsp;</td>
				    <td class="emtpycell">&nbsp;</td>
				    <td>
					رقم الإعلان
					1
					<input type="text" class="form-control" name="ad[1]" value="<?=$this->shop->getad(1)->ad?>" >
				    </td>
				</tr>
			    </tbody>
			</table>
			<table class="spacing">
			    <tbody>
				<tr>
				    <td rowspan="2">
					رقم الإعلان
					2
					<input type="text" class="form-control" name="ad[2]" value="<?=$this->shop->getad(2)->ad?>" >
				    </td>
				
				    <td>
					رقم الإعلان
					3
					<input type="text" class="form-control" name="ad[3]" value="<?=$this->shop->getad(3)->ad?>" >
				    </td>
				</tr>
				<tr>
				    <td>
					رقم الإعلان
					4
					<input type="text" class="form-control" name="ad[4]" value="<?=$this->shop->getad(4)->ad?>" >
				    </td>
				</tr>
			    </tbody>
			</table>
			<table class="spacing">
			    <tbody>
				<tr>
				    <td>
					رقم الإعلان
					5
					<input type="text" class="form-control" name="ad[5]" value="<?=$this->shop->getad(5)->ad?>" >
				    </td>
				    <td>
					رقم الإعلان
					6
					<input type="text" class="form-control" name="ad[6]" value="<?=$this->shop->getad(6)->ad?>" >
				    </td>
				    <td>
					رقم الإعلان
					7
					<input type="text" class="form-control" name="ad[7]" value="<?=$this->shop->getad(7)->ad?>" >
				    </td>
				</tr>
			    </tbody>
			</table>
			<table class="spacing">
			    <tbody>
				<tr>
				    <td>
					رقم الإعلان
					8
					<input type="text" class="form-control" name="ad[8]" value="<?=$this->shop->getad(8)->ad?>" >
				    </td>
				</tr>
			    </tbody>
			</table>
			<table class="spacing">
			    <tbody>
				<tr>
				    <td>
					رقم الإعلان
					9
					<input type="text" class="form-control" name="ad[9]" value="<?=$this->shop->getad(9)->ad?>" >
				    </td>
				    <td>
					رقم الإعلان
					10
					<input type="text" class="form-control" name="ad[10]" value="<?=$this->shop->getad(10)->ad?>" >
				    </td>
				    <td>
					رقم الإعلان
					11
					<input type="text" class="form-control" name="ad[11]" value="<?=$this->shop->getad(11)->ad?>" >
				    </td>
				</tr>
			    </tbody>
			</table>
		    </div>
		    
		    
		</div>
	</div>
	<div class="panel-footer">
		<button class="btn btn-primary fl" name="<?php if($edit) echo 'edit_news'; else echo 'add_news';?>" value="1"> <span class="glyphicon glyphicon-check"></span> <?php if($edit) echo 'تـعديــل';else echo 'إضـافــة'; ?></button>
	</div>
</div>
<?php form_close();?>



