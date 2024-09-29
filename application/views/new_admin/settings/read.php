<div class="page-head">
	<h1><?php echo $row->subject?></h1>
</div>
<div class="row"><div class="col-md-4 text-muted">المرسل</div><div class="col-md-8"><?php echo $row->name; ?></div></div>
<div class="row"><div class="col-md-4 text-muted">إيميل المرسل</div><div class="col-md-8"><?php echo $row->email; ?></div></div>
<div class="row"><div class="col-md-4 text-muted">موضوع الرسالة</div><div class="col-md-8"><?php echo $row->subject; ?></div></div>
<div class="row"><div class="col-md-4 text-muted">الرسالة</div><div class="col-md-8"><?php echo nl2br($row->message); ?></div></div>