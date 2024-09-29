
<!--=======Page Content Area=========-->   
<main id="pageContentArea">
    <header class="page-head text-center">
        <div class="blog-main-slider" style="background-image:url('../assets/img/b16.jpg'); no-repeat">
            <div class="overlay"></div>
            <div class="container">
                <h2>تغيير بياناتك</h2>
                <p>تظهر هذه البيانات في صفحتك</p>
            </div>
        </div>
    </header>
    
    
     
    <div class="page-contentArea adresses-page pt-50 pb-50"  >
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12" >
		    
		    <?php
		    if(isset($updated))
		    {
			$this->shop->alert('تم تحديث البيانات', 'success', base_url().'productcp/index');
		    }
		    echo form_open_multipart();
		    ?>
		    <div class="row form-group"><input value="<?=$user->fname?>" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب" type="text" class="col-md-9 form-control" name="fname" id="fname"><label for="fname" class="col-md-3">الاسم الاول</label></div>
		    <div class="row form-group"><input value="<?=$user->lname?>" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب" type="text" class="col-md-9 form-control" name="lname" id="lname"><label for="lname" class="col-md-3">اللقب</label></div>
		    <div class="row form-group"><select class="col-md-9 form-control" name="country" id="country">
		    <?php foreach($this->shop->countryList() as $country){
			echo "<option value='{$country->title}'";
			if($country->title == $user->country) echo " selected";
			echo ">{$country->title}</option>";
		    } ?>
		    </select><label for="country" class="col-md-3">الدولة</label></div>
		    <div class="row form-group"><input type="file" class="col-md-9 form-control" name="pic" id="pic"><label for="pic" class="col-md-3">الصورة الشخصية</label></div>
		    <div class="row form-group"><input value="<?=$user->address?>" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب" type="text" class="col-md-9 form-control" name="address" id="address"><label for="address" class="col-md-3">العنوان بالتفصيل</label></div>
		    <div class="row form-group"><input value="<?=$user->tel?>" data-validation="required" data-validation-error-msg="هذا الحقل مطلوب" type="text" class="col-md-9 form-control" name="tel" id="tel"><label for="tel" class="col-md-3">الهاتف</label></div>
		    <div class="row form-group"><textarea class="col-md-9 form-control" name="about" id="about"><?=$user->about?></textarea><label for="about" class="col-md-3">نبذة عن نشاطك</label></div>
		    <div class="row form-group"><button type="submit" name="saveUserData" value="1" class="col-md-12 btn btn-primary form-control" name="tel" id="tel">حفظ</button></div>
		    <?php
		    echo form_close();
		    ?>
		    
		</div>
	    </div>
	</div>
    </div>
</main>