<!-- banner1 -->
	<div class="banner1">
		<div class="container">
		</div>
	</div>
<!-- //banner1 -->

<!-- single -->
<div class="single">
	<div class="container">
	
	<ol class="breadcrumb">
  		<li class="breadcrumb-item"><a href="<?php echo base_url();?>">الرئيسية</a></li>
  		<li class="breadcrumb-item"><a href="<?php echo base_url();?>gallery">قائمة الطعام</a></li>
  		<li class="breadcrumb-item active"><?php echo $row['title'] ?></li>
	</ol>
	
	
		<h1 class="animated fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="300ms"><?php echo $row['title'] ?></h1>
		<div class="single-left wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="300ms">
			<p>نشر في <span><?php $d= explode(" ",$row['date_create']); echo $this->Hijri->toArabicDateFull($d[0]) ?></span></p>
			<img src="<?php echo base_url()."uploads/gallery/".$row['pic'];?>" alt=" " class="img-responsive" />
		</div>
		<div class="single-right wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
			<p><?php echo nl2br($row['content']); ?></p>
		</div>
	</div>
</div>