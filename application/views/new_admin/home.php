<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>تسجيل الدخول</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet"
		href="<?=base_url("assets/bootstrap-3.2.0/css/bootstrap.min.css")?>">
	<link rel="stylesheet"
		href="<?=base_url("assets/bootstrap-3.2.0/css/bootstrap-rtl.min.css")?>">
	<link
		rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/all.css">
	<link
		rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/font-awesome.min.css">

	<!-- jQuery library -->
	<script src="<?=base_url("assets/js/jquery.js")?>"></script>

	<!-- Latest compiled JavaScript -->
	<script src="<?=base_url("assets/js/bootstrap.min.js")?>"></script>
	<script
		src="<?=base_url("assets/js/jquery.form-validator.min.js")?>"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin/admin.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/admin/login.js"></script>

</head>

<body class="login-page">
	<div class="container-fluid">
		<div class="row mt30">
			<div class="col-md-12 text-center">
				<img src="<?php echo base_url() ?>assets/img/logo.png"
					class="mauto img-responsive" />
			</div>
		</div>
		<div class="col-md-offset-3 col-md-6 col-xs-offset-1 col-xs-10" id="login-panel">
			<?php
			echo form_open('new_admin/login'); ?>
			<input type="hidden" id="hash_start" name="hash_start" />
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">تسجيل الدخول</h4>
				</div>
				<div class="panel-body">
					<?php

					if ($blocked === 1) {
						echo '<div class="alert alert-danger fade in">
							لقد تم حظرك من الدخول .... 
							تستطيع محاولة الدخول بعد نصف ساعة كحد أقصى <br />
							إذا كنت نسيت كلمة المرور إضغط على
							<strong><em>نسيت كلمة المرور ؟ </em></strong> بالأســفل. <br />
							لاحظ انه بإستمرار المحاولات الخاطئة فإنك تزيد من مدة الحظر
							</div>';
					} else {
						if ( (isset($errors) && count($errors) ) || validation_errors()) {
							foreach ($errors as $error) {
								$error_msg .= "<p>- {$error}</p>";
							}
							echo '<div class="alert alert-danger fade in">
							<a href="#" data-dismiss="alert" aria-label="close"
								class="close">&times;</a>
							' . $error_msg . validation_errors() . '</div>';
						}

						$error_msg = '';
						if (isset($success) && is_array($success) && count($success)) {
							foreach ($success as $success_msgs) {
								$error_msg .= "- {$success_msgs}<br />";
							}
							echo '<div class="alert alert-success fade in">
							<a href="#" data-dismiss="alert" aria-label="close"
								class="close">&times;</a>
							' . $error_msg . '</div>';
						}
					?>
						<div class="col-xs-12">
							<div class="form-group has-feedback">
								<input
									type="text"
									id="user-email"
									name="user-email"
									value=""
									class="form-control"
									placeholder="اسم المستخدم أو كلمة المرور"
									autocomplete="off" data-validation="required"
									data-validation-error-msg="مطلوب اسم مستخدم او
										البريد اﻹلكتروني">
								<span
									class="glyphicon glyphicon-user form-control-feedback"></span>
							</div>
							<div class="form-group has-feedback">
								<input
									type="password"
									id="user-password"
									name="user-password"
									value=""
									class="form-control"
									placeholder="كلمة المرور"
									data-validation="required"
									data-validation-error-msg="برجاء ملء خانة كلمة المرور" />
								<span
									class="glyphicon glyphicon-flag form-control-feedback"></span>
							</div>
							<?php if ($cap || $capctha_error) { ?>
								<div class="form-group">
									<div class="col-md-6">
										<input
											type="text"
											id="user-capcha"
											name="user-capcha"
											value=""
											class="form-control"
											placeholder="انقل هذه الحروف" />
									</div>
									<div class="col-md-6">
										<?php echo $cap['image']; ?>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="col-xs-12">
							<label class="d-block">
								<input
									type="checkbox"
									name="remeber_me"
									value="Y">
										تذكرني
							</label>
						</div>
					<?php } ?>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-6">
							<button
								class="btn btn-primary"
								value="1"
								id="login-submit"
								name="login-submit">
									<span class="glyphicon glyphicon-lock"></span>
									<span>دخول</span>
							</button>
						</div><!-- / .col-sm-6 -->
						<div class="col-sm-6 text-left">
							<a
								href="#"
								data-toggle="modal"
								data-target="#forgetModel">
									نسيت كلمة المرور ؟
							</a>
						</div><!-- / .col-sm-6 -->
					</div><!-- / .row -->
				</div>
			</div>
			<?php echo form_close(); ?>
			<div class="small text-left horus-footer">
				Powered by
				<a href="https://sprintsweb.com/" target="_blank">
					<em>sprintsweb</em>
				</a>
				<span class="text-white">
					<a href="https://wa.me/+201153200087" target="_blank">
						<span class="fa fa-whatsapp"></span>
					</a>
					<a href="tel:+201153200087" target="_blank">
						<span class="fa fa-phone"></span>
					</a>
				</span><!-- / .text-red -->
			</div>
		</div>
	</div>


	<div id="forgetModel" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">نسيت كلمة المرور</h4>
				</div>
				<div class="modal-body">
					<?php echo form_open('new_admin/forgetMyPassword'); ?>


					<label class="col-md-12">البريد الإلكتروني</label>
					<div class="col-md-12 btn-group">
						<input
							type="email"
							class="form-control col-md-9"
							name="femail" id="femail"
							data-validation="required"
							data-validation-error-msg="برجاء إدخال البريد الإلكتروني">
						<button
							type="submit"
							name="fsubmit"
							class="btn btn-primary col-md-3">
								إرســـال
						</button>
					</div>
					<div class="row"></div>

					<?php echo form_close(); ?>
				</div>
				<div class="modal-footer">
					<button
						type="button"
						class="btn btn-default"
						data-dismiss="modal">إنهاء</button>
				</div>
			</div>

		</div>
	</div>
	<link rel="stylesheet"
		href="<?php echo base_url() ?>assets/css/admin-home.css" />
	<script
		type="text/javascript"
		src="<?php echo base_url() ?>assets/js/custom.js"></script>
</body>

</html>