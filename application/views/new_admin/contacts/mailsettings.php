<?php $cont= $this->router->fetch_class() ?><div class="page-header"><h1><?php echo $page_title?></h1></div>
<div class="row">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li><a href="<?php echo $admin_dir?>">الرئيسية</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	</div>
</div>

<?php echo form_open("new_admin/contacts/mailsettings"); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $page_title; ?></h4>
	</div>
	<div class="panel-body">
        
        <div class="container-fluid">
            <p><b>طريقة إرسال الرسائل</b></p>
        </div>
        <div class="container-fluid">
	        <p>
	            <label for="send_tosend_to" class="col-md-4">إرسال إلى <a href="#" data-toggle="modal" data-target="#deleteModel"><i class="glyphicon glyphicon-question-sign text-danger"></i></a></label>
	            <span class="col-md-8"><input type="text" class="form-control" name="send_to" id="send_to" value="<?php echo $settings->send_to; ?>" /></span>
	        </p>
        </div>
        
        <div class="container-fluid">
	        <p>
	            <label for="settings_type_simple1" class="col-md-4">إعدادات بسيطة</label>
	            <span class="col-md-8"><input type="radio" name="settings_type" <?php if($settings->sendmail_settings=='0') echo " checked "; ?>id="settings_type_simple"onclick="$('#mailSettingsAdvancedDiv').slideUp('fast')" value="0" /></span>
	        </p>
        </div>
        
        <div class="container-fluid">
            <p>
	            <label for="settings_type_advanced1" class="col-md-4">إعدادات متقدمة (مستحسن)</label>
	            <span class="col-md-8"><input type="radio" name="settings_type" <?php if($settings->sendmail_settings=='1') echo " checked "; ?>onclick="$('#mailSettingsAdvancedDiv').slideDown('fast')" id="settings_type_advanced" value="1" /></span>
	        </p>
        </div>
	    <div id="mailSettingsAdvancedDiv" style="display: none;">
	        <div class="alert alert-info dashed-border text-center"><i class="glyphicon glyphicon-alert red"></i>
             برجاء ملاحظة أن هذه الإعدادات متقدمة، و متعلقة بالسيرفر؛ إذا كنت لا تعرف ماهي الإعدادت المناسبة يمكنك معرفتها بالتواصل مع الشركة المستضيفة</div>
            <label class="col-md-4" for="smtp_host">smtp host</label>
            <input type="text" name="smtp[host]" id="smtp_host" value="<?php echo $row['host'] ?>" class="form-control col-md-8" />

            <label class="col-md-4" for="smtp_user">smtp user</label>
            <input type="text" name="smtp[user]" id="smtp_user" value="<?php echo $row['user'] ?>" class="form-control col-md-8" />


            <label class="col-md-4" for="smtp_pass">smtp password</label>
            <input type="text" name="smtp[pass]" id="smtp_pass" value="<?php echo $row['pass'] ?>" class="form-control col-md-8" />

            <label class="col-md-4" for="smtp_port">smtp_port</label>
            <input type="text" name="smtp[port]" id="smtp_port" value="<?php echo $row['port'] ?>" class="form-control col-md-8" />


            <label class="col-md-4" for="smtp_from">smtp from</label>
            <input type="text" name="smtp[from]" id="smtp_from" value="<?php echo $row['from'] ?>" class="form-control col-md-8" />
		</div>
		
	</div>
	<div class="panel-footer">
		<button name="save_smtp_data" type="submit" value="1" class="form-control btn btn-primary col-md-6 col-md-offset-6">تعديل البيانات</button>
	</div>
</div>
<?php echo form_close();?>










<div id="deleteModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">مساعدة</h4>
      </div>
      <div class="modal-body text-danger">
        <p>افصل بين كل بريد الكتروني وآخر بعلامة الفاصلة  (,)</p>
      </div>
      <div class="modal-footer">
      	<div class="col-md-6 col-md-offset-6">
	        <button type="button" class="btn btn-info" data-dismiss="modal">إغلاق</button>
      	</div>
      </div>
    </div>

  </div>
</div>