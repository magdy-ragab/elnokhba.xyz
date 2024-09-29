<!-- shop area start-->
<div class="page-contentArea adresses-page">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">


                <!-- nav bar -->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 ">
                            <ul class="nav-email shadow mb-20">
                                <li>
                                    <a href="<?= base_url() ?>profile">
                                        <i class="fa fa-th-large"></i> مشترياتي
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= base_url() ?>wishlist"><i class="fa fa-heart"></i> المفضلة</a>
                                </li>
                                <?php /*<li>
				    <a href="<?= base_url() ?>compare"><i class="fa fa-exchange"></i> المقارنات</a>
                                </li>
                                <li>
                                    <a href="<?= base_url() ?>last"><i class="fa fa-tag"></i> الاحدث زيارة</a>
                                </li> */?>
                                <li class="active">
                                    <a href="<?= base_url() ?>setting">
                                        <i class="fa fa-cog"></i> اعدادات الحساب
                                    </a>
                                </li>
                            </ul><!-- /.nav -->
                        </div>

                        <div class="col-sm-9 ">

                            <!-- resumt -->

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="col-md-12 bordered">
                                        <div class="clearfix inputs rounded">
                                            <h2>تغيير البيانات</h2>
                                            <?php 
					if($_SESSION['worng_password']):
					    echo '<div class="alert alert-danger">كلمة المرور الحالية غير صحيحة</div>';
					endif;
					if($_SESSION['worng_file']):
					    echo '<div class="alert alert-danger">الملف لس صورة أو حجمه كبير</div>';
					endif;
					if($_SESSION['success']):
					    echo '<div class="alert alert-success">تم تغيير البيانات</div>';
					endif;
					
					echo form_open_multipart(base_url() . "setting/user_data"); ?>
                                            <p>
                                                <labe for="username" class="col-md-3">اسم المستخدم</labe>
                                                <input data-validation="required"
                                                    data-validation-error-msg="اسم المستخدم مطلوب" type="text"
                                                    class=" col-md-9" name="username" id="username"
                                                    value="<?=$row['username']?>">
                                            </p>
                                            <p>
                                                <labe for="up" class="col-md-3">الصورة الشخصية</labe>
                                                <input type="file" class=" col-md-9" name="up" id="up">
                                            </p>
                                            <p>
                                                <labe for="tel" class="col-md-3">الهاتف / الموبايل</labe>
                                                <input data-validation="required"
                                                    data-validation-error-msg="الهاتف/الموبايل  مطلوب" type="text"
                                                    class=" col-md-9" name="tel" id="tel" value="<?=$row['tel']?>">
                                            </p>
                                            <p>
                                                <labe for="address" class="col-md-3">العنوان</labe>
                                                <input data-validation="required"
                                                    data-validation-error-msg="العنوان  مطلوب" type="text"
                                                    class=" col-md-9" name="address" id="address"
                                                    value="<?=$row['address']?>">
                                            </p>
                                            <p>
                                                <labe for="current_password" class="col-md-3">كلمة المرور الحالية</labe>
                                                <input data-validation="required"
                                                    data-validation-error-msg="كلم المرور?" type="password"
                                                    class=" col-md-9" name="current_password" id="current_password">
                                            </p>

                                            <p>
                                                <button type="submit" name="save_setting" value="1"
                                                    class="col-md-4 col-md-push-8 btn btn-primary">حفظ
                                                    الإعدادات</button>
                                            </p>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12 bordered">
                                        <div class="clearfix inputs rounded">
                                            <h2>تغيير كلمة المرور</h2>
                                            <?php echo form_open(base_url() . "setting/change_password");
					
					if($_SESSION['worng_password2']):
					    echo '<div class="alert alert-danger">كلمة المرور الحالية غير صحيحة</div>';
					endif;
					if($_SESSION['umatch_password']):
					    echo '<div class="alert alert-danger">كلمة المرور الجديدة و اعادتها غير متطابقة</div>';
					endif;
					if($_SESSION['success2']):
					    echo '<div class="alert alert-success">تم تغيير كلمة المرور</div>';
					endif;
					
					if($row['pic']):
					    ?>
                                            <div class="col-md-9 col-md-push-2 col-xs-12"><img
                                                    src="<?=base_url()."uploads/user/{$row['pic']}"?>"
                                                    class="img-responsive img-rounded" /></div>
                                            <div class="cl"></div>
                                            <?php
					endif;
					?>
                                            <p>
                                                <labe for="current_password" class="col-md-3">كلمة المرور الحالية</labe>
                                                <input data-validation="required"
                                                    data-validation-error-msg="كلمة المرور" type="password"
                                                    class=" col-md-9" name="current_password" id="current_password">
                                            </p>
                                            <p>
                                                <labe for="pwd1" class="col-md-3">كلمة المرور الجديدة</labe>
                                                <input data-validation="required"
                                                    data-validation-error-msg="كلمة المرور الجديدة" type="password"
                                                    class=" col-md-9" name="pwd1" id="pwd1">
                                            </p>

                                            <p>
                                                <labe for="pwd2" class="col-md-3">إعادةكلمة المرور </labe>
                                                <input data-validation="required"
                                                    data-validation-error-msg="إعادة كلمة المرور" type="password"
                                                    class=" col-md-9" name="pwd2" id="pwd2">
                                            </p>

                                            <p>
                                                <button type="submit" name="change_password" value="1"
                                                    class="col-md-4 col-md-push-8 btn btn-primary">تغيير كلمة
                                                    المرور</button>
                                            </p>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- resume -->

                    </div>
                </div>


            </div>
            <!--conten Coloumn-->

        </div>
        <!--Main row-->
    </div>
    <!--container-->
</div>
<!--page-contentArea-->