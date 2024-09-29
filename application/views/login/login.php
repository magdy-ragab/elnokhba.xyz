
        <!-- shop area start-->
        <div class="shop_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="shop_menu shop_menu_tk ">
                            <ul class="cramb_area cramb_area_2 cramb_area_ktp">
                                <li><a href="index.html">الرئيسية /</a></li>
                                <li><a href="#">تسجيل الدخول</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- shop area end-->
        <!--my account area start-->
        <div class="my_account_area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="account_heading">
                            <p>يمكنك تسجيل الدخول او تسجيل عضوية جديدة </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
			
                        <div class="all_cntnt">
                            <div class="frm_content">
                                <h2>تسجيل الدخول</h2>
                            </div>
			    <?php if($email_error) { $this->shop->alert('عفواً هذه البيانات غير صحيحة', 'error' ); } ?>
                            <form method="post" action="<?=base_url()?>login/login" id="login">
				<input type="hidden" name="type" id="type" value="user" />
                                <div class="al_form-fields">
                                    <p>
                                        <label>
                                           البريد الالكتروني
                                        <span class="required">*</span>
                                        </label>
		       <input type="email" name="usermail" placeholder="البريد الالكتروني" id="username" data-validation="required,email" data-validation-error-msg="برجاء ادخال بريد الكتروني" value="<?php if(isset($_POST['usermail'])){ echo $_POST['usermail'];}?>">
                                    </p>
                                    <p>
                                        <label>
                                        كلمة المرور
                                        <span class="required">*</span>
                                        </label>
                                        <input type="password" name="password" placeholder="كلمة المرور" id="password"data-validation="required" data-validation-error-msg="كلمة المرور مطلوبة">
                                    </p>
					
                                </div>
				
                                <div class="form-action">
                                    <div class="new_act new_act_3">
                                        <button type="submit" name="submit_login" value="1" class="button_act button_act_3">تسجيل الدخول</button>
                                        <label>
                                        <input type="checkbox">
                                        تذكرني
                                        </label>
                                    </div>
                                    <p class="lost_password">
                                        <a href="<?=base_url()?>forgetpassword">فقدت كلمة المرور ؟</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="all_cntnt">
                            <div class="frm_content">
                                <h2>تسجيل عضوية جديدة</h2>
                            </div>
                            <form method="post" action="<?=base_url()?>register/registerUser" id="registr">
				<input type="hidden" name="type" id="type" value="user" />
				<?php
				if( isset($email_error_) && $email_error_ ==1 )
				{
				    $this->shop->alert('هذا البريد الالكتروني موجود من قبل', 'error');
				}
				?>
                                <div class="al_form-fields">
                                    <p>
                                        <label>
                                        اسم المستخدم 
                                        <span class="required">*</span>
                                        </label>
                                        <input type="text" name="username" placeholder="اسم المستخدم" data-validation="required" data-validation-error-msg="برجاء ادخال الاسم" id="username">
                                    </p>
                                        <p>
                                        <label>
                                         البريد الالكتروني
                                        <span class="required">*</span>
                                        </label>
                                        <input type="email" name="email" placeholder="البريد الالكتروني" id="email" data-validation="required,email" data-validation-error-msg="برجاء ادخال البريد الالكتروني">
                                    </p>
                                    <p>
                                        <label>
                                        كلمة المرور
                                        <span class="required">*</span>
                                        </label>
                                        <input type="password" name="password" placeholder="كلمة المرور" id="password" data-validation="required" data-validation-error-msg="برجاء ادخال كلمة المرور">
                                    </p>
                                </div>
                                <div class="form-action">
                                    <div class="new_act new_act_3">
                                        <button type="submit" name="submit_register2" value="1" class="button_act button_act_3">تسجيل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!--my account area end-->

