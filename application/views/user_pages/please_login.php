<div class="row">
    <div class="col-md-12">
        <form method="post" action="<?=base_url()?>login/login" id="login">
            <h3> تسجيل الدخول</h3>
            <input type="email" name="usermail" placeholder="البريد الالكتروني" id="username" data-validation="required,email" data-validation-error-msg="برجاء ادخال بريد الكتروني" value="<?php if(isset($_POST['usermail'])){ echo $_POST['usermail'];}?>">
            <input type="password" name="password" placeholder="كلمة المرور" id="password" data-validation="required" data-validation-error-msg="كلمة المرور مطلوبة">
            <input type="hidden" name="back" value="<?=base_url()."buy/index"?>">
            <input type="submit" name="submit_login" value="تسجيل الدخول" class="btn-blue btn">				
            <br><a href="<?php echo base_url(). get_cookie('country') ?>/signup.html" class="lost">تسجيل عضوية مجانية</a>
         </form>
    </div><!--column-->
</div>