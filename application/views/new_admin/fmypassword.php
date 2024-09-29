<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?><!DOCTYPE html><html>
<head>
    <meta charset="UTF-8">
    <title>نسيت كلمة المرور</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url();?>assets/css/all.css">
    <link rel="stylesheet" type="text/css" href="<? echo base_url();?>assets/css/login.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script src="<? echo base_url();?>assets/js/admin/admin.js"></script>
    <script src="<? echo base_url();?>assets/js/admin/login.js"></script>

</head>
<body>

    <div class="container-fluid">
        <div class="row mt30">
            <div class="col-md-12 text-center">
                <img src="<?php echo base_url()?>assets/img/logo.png" class="mauto img-responsive" />
            </div>
        </div>
        <div class="col-md-offset-3 col-md-6 col-xs-offset-1 col-xs-10" id="login-panel">
            <div class="panel panel-default">
                <div class="panel-heading"><h4 class="panel-title">نسيت كلمة المرور</h4></div>
                <div class="panel-body">
                    <?php
                    if($wrong_email)
                    {
                         echo '<div class="alert alert-danger fade in">
                         <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>هذا البريد الإلكتروني غير موجود</div>';
                    }
                    if(validation_errors())
                    {
                    echo '<div class="alert alert-danger fade in">
                    <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>'.
                    validation_errors() . '</div>';

                    }
                    if($not_email)
                    {
                         echo '<div class="alert alert-danger fade in">
                         <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>هذا البريد الإلكتروني غير موجود</div>';
                    }
                     
                    if($not_email2)
                    {
                         echo '<div class="alert alert-danger fade in">
                         <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>هذا البريد غير موجود أو تم تغيير كلمة المرور بالفعل !!</div>';
                    }
                     
                    if($not_equal)
                    {
                         echo '<div class="alert alert-danger fade in">
                         <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>كلمة المرور غير مطابقة</div>';
                    }
                    
                    if($send)
                    {
                        echo '<div class="alert alert-info fade in">
                         <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>تم إرسال رسالة على البريد الإلكتروني </div>';
                    }
                     if($done)
                    {
                        echo '<div class="alert alert-info fade in">
                         <a href="#" data-dismiss="alert" class="close" rel="close">&times;</a>تم تغيير كلمة المرور</div>';
                    }
                     
                     
                     if($show_form==1):
                        echo form_open();
                        ?>
                        <input type="hidden" name="reset_hash" value="<?php echo $code ?>">
                        <div class="cl">
                            <label for="email" class="col-md-4">البريد الإلكتروني  </label>
                            <input type="email" class="col-md-8 form-control" name="email" id="email" value="" data-validation="required" data-validation-error-msg="البريد الإلكتروني مطلوب" />
                        </div>
                        <div class="cl"><label for="password1" class="col-md-4">كلمة المرور</label><input type="password" class="col-md-8 form-control" id="password1" name="password1"data-validation="required" data-validation-error-msg="كلمة المرور"></div>
                        <div class="cl"><label for="password2" class="col-md-4">إعادة كلمة المرور</label><input type="password" data-validation="required" name="password2" data-validation-error-msg="كلمة المرور" class="col-md-8 form-control" id="password2"></div>
                        <div class="cl">    
                            <button type="submit" name="change" value="1" class="col-md-4 col-md-offset-8 btn btn-primary">تغيير كلمة المرور</button>
                        </div>
                        <?php
                        echo form_close();
                     endif;
                    ?>

                </div>
                <div class="panel-footer">
                    <a href="<?php echo base_url().$this->core_model->admin_dir(); ?>">عودة لتسجيل الدخول</a>
                </div>
            </div>
        </div>
    </div>

<link rel="stylesheet" href="<?php echo base_url()?>/assets/css/custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>/assets/js/custom.js"></script>
</body>
</html>